<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Chat Application</title>

    <link rel="stylesheet" href="{{ asset('assets/css/custome.css') }}">
</head>

<body>

    <div class="container">
        <!-- Sidebar -->
        @include('pages.layout.sidebar')

        @yield('content')
        @include('pages.layout.footer')
    </div>


    <script>
        const modal = document.getElementById("myModal");
        const openBtn = document.getElementById("openModalBtn");
        const closeBtn = document.getElementById("closeModalBtn");

        openBtn.addEventListener("click", () => {
            modal.classList.add("show");
        });

        closeBtn.addEventListener("click", () => {
            modal.classList.remove("show");
        });

        // Optional: Close on clicking outside modal content
        window.addEventListener("click", (e) => {
            if (e.target === modal) {
                modal.classList.remove("show");
            }
        });


        // Auto-resize textarea
        const textarea = document.querySelector('.message-input');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 100) + 'px';
        });

        // Send message on Enter (but allow Shift+Enter for new line)
        textarea.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                // Add your send message logic here
                console.log('Message sent:', this.value);
                this.value = '';
                this.style.height = 'auto';
            }
        });
    </script>
</body>

</html>
