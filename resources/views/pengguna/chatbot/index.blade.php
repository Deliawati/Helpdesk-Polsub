@extends('layouts.app')

@section('title', 'Chatbot')

@section('head')
    <style>
        #wrap-chat {
            height: 450px;
            max-height: 450px;
            overflow-y: scroll;
            padding: 5px;
        }

        .message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        .user-message {
            background-color: #e6f3ff;
            max-width: 45%;
            margin-left: auto;
        }

        .bot-message {
            background-color: #f0f0f0;
            max-width: 45%;
        }

        .message-bot-icon {
            float: left;
            margin-right: 10px;
        }

        .message-user-icon {
            float: right;
            margin-right: 10px;
        }

        .message-time {
            /* float: right; */
            font-size: 0.8em;
            color: #888;
        }

        .input-container {
            display: flex;
            margin-top: 20px;
        }

        .input-box {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .send-button {
            margin-left: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <section class="our-services">
        <div class="container pt-5">
            <h4>Chatbot</h4>
            <p>Silahkan bertanya kepada chatbot kami. Jika pertanyaan Anda tidak terjawab, silahkan ajukan pertanyaan dengan membuat tiket agar kami dapat membantu Anda dengan lebih baik.</p>

            <div class="card">
                <div class="card-body">
                    <div id="wrap-chat">
                        <div class="message bot-message">
                            <span class="message-bot-icon"><i class="mdi mdi-robot"></i></span>
                            <p>Selamat datang di Chatbot kami!
                            </p>
                            <p>Mohon gunakan ejaan yang baik dan benar!</p>
                            <div class="message-time text-right">{{ \Carbon\Carbon::now()->format('h:i A') }}</div>
                        </div>
                    </div>
                    <div class="input-container">
                        <input type="text" class="form-control input-box" id="user-input" name="pertanyaan"
                            placeholder="Ketik pesan...">
                        <button class="send-button" onclick="sendMessage()">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function getCurrentTime() {
            var date = new Date();
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var currentTime = hours + ':' + minutes + ' ' + ampm;
            return currentTime;
        }

        function sendMessage() {
            var userInput = document.getElementById('user-input').value;
            var userMessage =
                '<div class="message user-message"><span class="message-user-icon"><i class="mdi mdi-account"></i></span><p>' +
                userInput + '</p><div class="message-time">' + getCurrentTime() + '</div></div>';
            var chatContainer = document.querySelector('#wrap-chat');
            chatContainer.innerHTML += userMessage;

            // Lakukan proses pemrosesan pesan di sini, misalnya dengan mengirim permintaan ke backend atau memproses dengan JavaScript.
            $.ajax({
                url: "{{ route('pengguna.chatbot.process') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    pertanyaan: userInput
                },
                success: function(response) {
                    var botMessage =
                        `<div class="message bot-message">
                            <span class="message-bot-icon"><i class="mdi mdi-robot"></i></span>
                            ${response.data.jawaban}
                            <div class="message-time">${getCurrentTime()}</div>`;
                    if (response.data.attachments.length > 0) {
                        botMessage += '<hr/><div class="font-weight-bold mb-2">Attachments:</div>';
                        // foreach attachments
                        response.data.attachments.forEach(attachment => {
                            botMessage += `
                                    <ul>
                                        <li>
                                            <a href="{{asset('storage')}}/${attachment.jenis}/${attachment.nama}" title="${attachment.nama}" target="_blank">
                                                ${attachment.nama}
                                            </a>
                                        </li>
                                    </ul>
                                `;
                        });
                    }
                    botMessage += '</div>';
                    chatContainer.innerHTML += botMessage;
                    document.getElementById('user-input').value = '';
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endsection
