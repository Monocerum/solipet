<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Solipet</title>
</head>
<body>
    <h2>Reset Your Solipet Password</h2>

    <p>Hello!</p>

    <p>
        We received a request to reset the password associated
        with your Solipet account.
    </p>

    <p>
        Click the button below to create a new password:
    </p>

    <p>
        <a href="{{ $url }}">Reset Password</a>
    </p>

    <p>
        This password reset link will expire in
        {{ $expireMinutes }} minutes.
    </p>

    <p>
        If you did not request a password reset,
        you can safely ignore this email.
    </p>

    <p>Regards,<br>Solipet Team</p>
</body>
</html>