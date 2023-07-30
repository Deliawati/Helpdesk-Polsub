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

        .autocomplete {
            /*the container must be positioned relative:*/
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
@endsection

@section('content')
    <section class="our-services">
        <div class="container pt-5">
            <h4>Chatbot</h4>
            <p>Silahkan bertanya kepada chatbot kami. Jika pertanyaan Anda tidak terjawab, silahkan ajukan pertanyaan dengan
                membuat tiket agar kami dapat membantu Anda dengan lebih baik.</p>

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
                        <div class="autocomplete">
                            <input type="text" class="form-control input-box" id="user-input" name="pertanyaan"
                                placeholder="Ketik pesan..." autocomplete="off">
                        </div>
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
                                            <a href="{{ asset('storage') }}/${attachment.jenis}/${attachment.nama}" title="${attachment.nama}" target="_blank">
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

        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }

        /*An array containing all the country names in the world:*/
        var countries = [
            @foreach ($pertanyaan as $p)
                "{{ $p }}",
            @endforeach
        ];

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("user-input"), countries);
    </script>
@endsection
