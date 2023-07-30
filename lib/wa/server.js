const { Client, LocalAuth } = require('whatsapp-web.js');
const fs = require('fs');
const express = require('express');
const qrcode = require('qrcode');
const qrCodeTerminal = require('qrcode-terminal');
const socketIO = require('socket.io');
const http = require('http');

// file config
const SESSION_FILE_PATH = './wtf-session.json';
let sessionCfg;
if (fs.existsSync(SESSION_FILE_PATH)) {
  sessionCfg = require(SESSION_FILE_PATH);
}

// initial instance
const PORT = process.env.PORT || 3000;
const app = express();
const server = http.createServer(app);
const io = socketIO(server);
const client = new Client({
    authStrategy: new LocalAuth({
        clientId: "dsalkjdsd"
    }),
    puppeteer: {
        headless: true,
    }
});


// index routing and middleware
app.use(express.json());
app.use(express.urlencoded({extended: true}));
app.get('/', (req, res) => {
  res.sendFile('index.html', {root: __dirname});
});

// initialize whatsapp and the example event
client.on('message', msg => {
  if (msg.body == '!ping') {
    msg.reply('pong');
  } else if (msg.body == 'skuy') {
    msg.reply('helo ma bradah');
  }
});
client.initialize();

// socket connection
var today  = new Date();
var now = today.toLocaleString();
io.on('connection', (socket) => {
  socket.emit('message', `${now} Connected`);

  client.on('qr', (qr) => {
    qrCodeTerminal.generate(qr, {small: true});
    qrcode.toDataURL(qr, (err, url) => {

      socket.emit("qr", url);
      socket.emit('message', `${now} QR Code received`);
    });
  });

  client.on('ready', () => {
    socket.emit('message', `${now} WhatsApp is ready!`);
  });

  client.on('authenticated', (session) => {
    socket.emit('message', `${now} Whatsapp is authenticated!`);
  });

  client.on('auth_failure', function(session) {
    socket.emit('message', `${now} Auth failure, restarting...`);
  });

  client.on('disconnected', function() {
    socket.emit('message', `${now} Disconnected`);

    client.destroy();
    client.initialize();
  });
});

app.get('/api', async (req, res) => {
    let destination = req.query.tujuan;
    let message = req.query.pesan;

    if (!destination || !message) {
        res.status(400).json({ status: false, message: "Nomor tujuan dan/atau pesan tidak di cantumkan" })
    }

    if (destination.substring(0, 3) === "+62") {
        destination = destination.substring(3);
    } else if (destination.substring(0, 2) === "62") {
        destination = destination.substring(2)
    } else {
        destination = destination.substring(1);
    }

    destination = `62${destination}@c.us`;

    let cekUser = await client.isRegisteredUser(destination);

    if (cekUser == true) {
        client.sendMessage(destination, message);
        res.status(200).json({ status: true, pesan: "Pesan berhasil terkirim" });
    } else {
        res.status(400).json({ status: false, pesan: "Pesan gagal terkirim" });
    }

})

app.get('/api/v2', async (req, res) => {
    let destination = req.query.tujuan;
    let message = req.query.pesan;
    let title = req.query.title;
    let link = req.query.link;

    if (!destination || !message) {
        res.status(400).json({ status: false, message: "Nomor tujuan dan/atau pesan tidak di cantumkan" })
    }

    if (destination.substring(0, 3) === "+62") {
        destination = destination.substring(3);
    } else if (destination.substring(0, 2) === "62") {
        destination = destination.substring(2)
    } else {
        destination = destination.substring(1);
    }

    destination = `62${destination}@c.us`;

    let cekUser = await client.isRegisteredUser(destination);

    let messages = `*${title}*\n\n${message}\n\nBerikut adalah link download file Surat Panggilan Orang tua\n${link}\n\nTerima kasih.`

    if (cekUser == true) {
        client.sendMessage(destination, messages);
        res.status(200).json({ status: true, pesan: "Pesan berhasil terkirim" });
    } else {
        res.status(400).json({ status: false, pesan: "Pesan gagal terkirim" });
    }

});

server.listen(PORT, () => {
  console.log('App listen on port ', PORT);
});
