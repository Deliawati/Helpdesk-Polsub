const express = require('express')
const app = express()
const port = 3000


// const { Client, Location, List, Buttons, LocalAuth} = require('./index');
const fs = require('fs');
const qrcode = require('qrcode-terminal');
const { Client, LocalAuth  } = require('whatsapp-web.js');

const SESSION_FILE_PATH = './session.json';
let sessionData;

if(fs.existsSync(SESSION_FILE_PATH)) {
    sessionData = require(SESSION_FILE_PATH);
}

const client = new Client({
      authStrategy: new LocalAuth({
        clientId: "dsalkjdsa"
      }),
      puppeteer: {
        headless: true,
      }
});

// Save session values to the file upon successful auth

client.initialize();

client.on('qr', qr => {
    qrcode.generate(qr, {small: true});
});


client.on('authenticated', () => {
    console.log('AUTHENTICATED');
});

client.on('auth_failure', msg => {
    console.error('AUTHENTICATION FAILURE', msg);
});

client.on('ready', () => {
    console.log('READY');
});


app.get('/api', async (req, res) => {  
  let destination = req.query.tujuan;
  let message = req.query.pesan;

  if (!destination || !message) {
    res.status(400).json({ status: false, message: "Nomor tujuan dan/atau pesan tidak di cantumkan"})
  }

  if (destination.substring(0,3) === "+62") {
    destination = destination.substring(3);
  } else if (destination.substring(0, 2) === "62"){
    destination = destination.substring(2)
  } else {
    destination = destination.substring(1);
  }

  destination = `62${destination}@c.us`;
  
  let cekUser = await client.isRegisteredUser(destination);

  if(cekUser == true){
      client.sendMessage(destination, message);
      res.status(200).json( { status : true , pesan : "Pesan berhasil terkirim"});
  }else {
      res.status(400).json( { status : false , pesan : "Pesan gagal terkirim"});
  }

})

app.get('/api/v2', async (req, res) => {  
  let destination = req.query.tujuan;
  let message = req.query.pesan;
  let title = req.query.title;
  let link = req.query.link;

  if (!destination || !message) {
    res.status(400).json({ status: false, message: "Nomor tujuan dan/atau pesan tidak di cantumkan"})
  }

  if (destination.substring(0,3) === "+62") {
    destination = destination.substring(3);
  } else if (destination.substring(0, 2) === "62"){
    destination = destination.substring(2)
  } else {
    destination = destination.substring(1);
  }

  destination = `62${destination}@c.us`;
  
  let cekUser = await client.isRegisteredUser(destination);

  let messages = `*${title}*\n\n${message}\n\nBerikut adalah link download file Surat Panggilan Orang tua\n${link}\n\nTerima kasih.`

  if(cekUser == true){
      client.sendMessage(destination, messages);
      res.status(200).json( { status : true , pesan : "Pesan berhasil terkirim"});
  }else {
      res.status(400).json( { status : false , pesan : "Pesan gagal terkirim"});
  }

})



app.get('/', (req, res) => {
  res.send('hi')
})

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})
