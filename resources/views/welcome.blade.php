<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <p id="messages"></p>
    @vite('resources/js/app.js')
    <script>
        // Wait for Echo to be initialized
        setTimeout(() => {
            if (window.Echo) {
                window.Echo.channel('test-channel')
                    .listen('.TestBroadcast', (e) => {
                        console.log('Received message:', e.message);
                        document.getElementById('messages').innerHTML += '<p>' + e.message + '</p>';
                    });
                console.log('Event listener attached');
            } else {
                console.log('Echo is not initialized');
            }
        }, 1000);
    </script>


</body>

</html>
