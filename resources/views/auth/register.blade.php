<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f6f9;
      display: flex;
      height: 100vh;
      align-items: center;
      justify-content: center;
    }
    form {
      background: white;
      padding: 30px;
      border-radius: 10px;
      width: 300px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      background: #4f46e5;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
    }
    button:hover { background: #4338ca; }
    .link { text-align: center; margin-top: 10px; }
  </style>
</head>
<body>
  <form method="POST" action="/register">
    @csrf
    <h2>Register</h2>
    <input type="text" name="name" placeholder="Name" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
    <button type="submit">Sign Up</button>
    <div class="link">
      <a href="/login">Already have an account?</a>
    </div>
    @if($errors->any())
      <p style="color:red;">{{ $errors->first() }}</p>
    @endif
  </form>
</body>
</html>
