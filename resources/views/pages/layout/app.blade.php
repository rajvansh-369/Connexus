<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Chat Application</title>

    <link rel="stylesheet" href="{{ asset('assets/css/custome.css') }}">
    @livewireStyles
</head>
 @vite('resources/js/app.js')
<body>

    <div class="container">
        <!-- Sidebar -->
        @include('pages.layout.sidebar')

        @yield('content')
        @include('pages.layout.footer')
    </div>

    @livewireScripts


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


    <script>
        // Image upload preview
        document.getElementById('imageUpload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            console.log("file", file);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profileImage').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Form submission
        // document.getElementById('profileForm').addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     // Show success message
        //     const successMsg = document.getElementById('successMessage');
        //     successMsg.classList.add('show');

        //     // Hide success message after 3 seconds
        //     setTimeout(() => {
        //         successMsg.classList.remove('show');
        //     }, 3000);

        //     // Here you would normally send the data to your backend
        //     console.log('Profile updated:', {
        //         firstName: document.getElementById('firstName').value,
        //         lastName: document.getElementById('lastName').value,
        //         email: document.getElementById('email').value,
        //         phone: document.getElementById('phone').value,
        //         about: document.getElementById('about').value
        //     });
        // });

        // Cancel button handler
        function handleCancel() {
            if (confirm('Are you sure you want to discard your changes?')) {
                window.history.back();
            }
        }

        // Auto-resize textarea
        const textarea_edit = document.getElementById('about');
        textarea_edit.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    </script>
</body>

</html>
