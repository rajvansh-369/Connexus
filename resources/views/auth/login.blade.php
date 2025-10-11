<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Chat Application</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            display: flex;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .login-left-content {
            max-width: 400px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin: 0 auto 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .login-left h1 {
            font-size: 32px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .login-left p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 15px;
            text-align: left;
            margin-top: 20px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .login-right {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-size: 28px;
            color: #111;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #667781;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #111;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
            outline: none;
            font-family: inherit;
        }

        .form-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
            color: #667781;
            padding: 5px;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #667eea;
        }

        .remember-me label {
            font-size: 14px;
            color: #667781;
            cursor: pointer;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: #764ba2;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            gap: 15px;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: #e0e0e0;
        }

        .divider-text {
            color: #667781;
            font-size: 14px;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #111;
            transition: all 0.3s;
        }

        .social-btn:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .social-btn img {
            width: 20px;
            height: 20px;
        }

        .signup-link {
            text-align: center;
            font-size: 14px;
            color: #667781;
        }

        .signup-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .signup-link a:hover {
            color: #764ba2;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            display: none;
        }

        .error-message.show {
            display: block;
            animation: shake 0.3s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-10px);
            }

            75% {
                transform: translateX(10px);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-left {
                padding: 40px 30px;
            }

            .login-right {
                padding: 40px 30px;
            }

            .login-left h1 {
                font-size: 26px;
            }

            .features {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .social-login {
                flex-direction: column;
            }

            .form-options {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }

        span.error {
            color: red;
            font-weight: 500;
            font-size: 12px;
        }

        p.alert-danger {
            background-color: #e56666;
            border: 1px solid #ff0000;
            color: #ffffff;
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-family: "Inter", "Segoe UI", sans-serif;
            display: block;
            margin: 10px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        p.alert-danger strong {
            color: #004085;
            /* Highlighted bold text */
        }

        p.alert-danger {
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        p.alert-danger:hover {
            background-color: #fbd8d8;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }


        /* Success Alert */
        .p.alert-success {
            background-color: #d4edda;
            /* Light green background */
            border: 1px solid #c3e6cb;
            /* Green border */
            color: #155724;
            /* Dark green text */
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-family: "Inter", "Segoe UI", sans-serif;
            display: block;
            margin: 10px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            animation: fadeInSuccess 0.5s ease-in-out;
            /* Animation */
        }

        /* Optional bold text inside alert */
        .p.alert-success strong {
            color: #0b2e13;
        }

        /* Animation for fade-in effect */
        @keyframes fadeInSuccess {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Optional hover effect */
        .p.alert-success:hover {
            background-color: #cce5cc;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
    </style>
    @livewireStyles
</head>

<body>
    <div class="login-container">
        <!-- Left Side -->
        <div class="login-left">
            <div class="login-left-content">
                <div class="logo">💬</div>
                <h1>Welcome to ChatApp</h1>
                <p>Connect with friends and family, share moments, and stay in touch with the people who matter most.
                </p>

                <div class="features">
                    <div class="feature">
                        <div class="feature-icon">🔒</div>
                        <span>End-to-end encrypted messages</span>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">📱</div>
                        <span>Available on all devices</span>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">⚡</div>
                        <span>Instant delivery & notifications</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-right">
            <div class="login-header">
                <h2>Sign In</h2>
                <p>Enter your credentials to access your account</p>
            </div>

            <div class="error-message" id="errorMessage">
                Invalid email or password. Please try again.
            </div>

            @livewire('login')
            <div class="divider">
                <div class="divider-line"></div>
                <span class="divider-text">OR</span>
                <div class="divider-line"></div>
            </div>

            <div class="social-login">
                <button class="social-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                            fill="#FBBC05" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335" />
                    </svg>
                    Google
                </button>
                <button class="social-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#1877F2">
                        <path
                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                    Facebook
                </button>
            </div>

            <div class="signup-link">
                Don't have an account? <a href="#">Sign Up</a>
            </div>
        </div>
    </div>
    @livewireScripts
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });

        // Form submission
        const loginForm = document.getElementById('loginForm');
        const errorMessage = document.getElementById('errorMessage');

        // loginForm.addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     const email = document.getElementById('email').value;
        //     const password = document.getElementById('password').value;
        //     const remember = document.getElementById('remember').checked;

        //     // Add your Laravel/Livewire login logic here
        //     console.log('Login attempt:', {
        //         email,
        //         password,
        //         remember
        //     });

        //     // Example: Show error message
        //     // errorMessage.classList.add('show');

        //     // On success, redirect to chat
        //     // window.location.href = '/chat';
        // });

        // Hide error message on input
        document.getElementById('email').addEventListener('input', function() {
            errorMessage.classList.remove('show');
        });

        document.getElementById('password').addEventListener('input', function() {
            errorMessage.classList.remove('show');
        });
    </script>
</body>

</html>
