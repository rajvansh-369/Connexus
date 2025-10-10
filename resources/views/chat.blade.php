<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laravel WebSocket Chat</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: #4f46e5;
            color: white;
            padding: 15px 20px;
            font-size: 20px;
            font-weight: bold;
        }

        #chat-box {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .message {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 12px;
            line-height: 1.4;
            font-size: 15px;
            display: inline-block;
            position: relative;
            word-wrap: break-word;
            animation: fadeIn 0.2s ease;
        }

        .me {
            align-self: flex-end;
            background: #4f46e5;
            color: white;
            border-bottom-right-radius: 0;
        }

        .other {
            align-self: flex-start;
            background: #e5e7eb;
            color: #111827;
            border-bottom-left-radius: 0;
        }

        .timestamp {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 2px;
            text-align: right;
        }

        footer {
            display: flex;
            padding: 10px;
            background: #fff;
            border-top: 1px solid #e5e7eb;
        }

        input,
        button {
            font-size: 15px;
            border: none;
            outline: none;
        }

        #msg {
            flex: 1;
            padding: 10px 12px;
            border-radius: 20px;
            border: 1px solid #ddd;
            margin-right: 10px;
        }

        #send {
            background: #4f46e5;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background 0.2s;
        }

        #send:hover {
            background: #4338ca;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .username-input {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        .username-input input {
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 200px;
        }
    </style>
</head>

<body>
    <header>💬 Laravel Live Chat</header>
    {{-- @dd($user) --}}
    <div class="username-input">
        <label>
            <strong>Name:</strong>
            <input id="name" placeholder="Enter your name" value="{{$user->name}}" />
        </label>
    </div>

    <div id="chat-box"></div>

    <footer>
        <input id="msg" placeholder="Type a message..." autocomplete="off" />
        <button id="send">Send</button>
    </footer>

    <script>
        const username = "{{ $user->name }}";
        const ws = new WebSocket('ws://' + location.hostname + ':6001');
        const chatBox = document.getElementById('chat-box');
        const msgInput = document.getElementById('msg');
        const sendBtn = document.getElementById('send');
        const nameInput = document.getElementById('name');

        // Load previous chat from localStorage
        const chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
        chatHistory.forEach(addMessageToUI);

        ws.addEventListener('open', () => addSystemMessage('✅ Connected to chat server'));
        ws.addEventListener('close', () => addSystemMessage('❌ Disconnected'));
        ws.addEventListener('message', (event) => {
            const data = event.data;
            addMessageToUI({
                sender: 'other',
                text: data,
                time: new Date().toLocaleTimeString()
            });
            saveMessage({
                sender: 'other',
                text: data,
                time: new Date().toLocaleTimeString()
            });
        });

        sendBtn.addEventListener('click', sendMessage);
        msgInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        function sendMessage() {
            const text = msgInput.value.trim();
            if (!text) return;
            const message = `${username}: ${text}`;
            ws.send(message);
            const msgObj = {
                sender: 'me',
                text: message,
                time: new Date().toLocaleTimeString()
            };
            addMessageToUI(msgObj);
            saveMessage(msgObj);
            msgInput.value = '';
        }

        function addMessageToUI({
            sender,
            text,
            time
        }) {
            const msgDiv = document.createElement('div');
            msgDiv.className = 'message ' + sender;
            msgDiv.textContent = text;

            const timeDiv = document.createElement('div');
            timeDiv.className = 'timestamp';
            timeDiv.textContent = time;

            const container = document.createElement('div');
            container.appendChild(msgDiv);
            container.appendChild(timeDiv);
            chatBox.appendChild(container);

            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function addSystemMessage(text) {
            const sysMsg = {
                sender: 'other',
                text,
                time: new Date().toLocaleTimeString()
            };
            addMessageToUI(sysMsg);
        }

        function saveMessage(msg) {
            const history = JSON.parse(localStorage.getItem('chatHistory') || '[]');
            history.push(msg);
            localStorage.setItem('chatHistory', JSON.stringify(history));
        }
    </script>
</body>

</html>
