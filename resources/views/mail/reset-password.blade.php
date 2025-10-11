<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Password Received</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div
        style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color: #333;">Your Account Password</h2>
        <p>Hello {{ $data['name']}},</p>
        <p>We have generated a password for your account. Please find it below:</p>
        <p style="font-size: 18px; font-weight: bold; color: #2d87f0;">{{ $data['password']}}</p>
        <p>For security reasons, we recommend that you change your password after logging in.</p>
        <br>
        <p>Thank you,<br>The Team</p>
    </div>
</body>

</html>
