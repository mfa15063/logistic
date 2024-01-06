<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body>
    <h2>Email Verification</h2>

    <p>
        Thank you for registering! Before you get started, could you please verify your email address by clicking the
        following link:
    </p>

    <p>
        {{-- <a href="{{ $verificationUrl }}">Verify Email Address</a> --}}
        <a href="{{ route('verification.verify', $verificationUrl) }}">Verify Email Address</a>

    </p>

    <p>
        If you did not create an account, no further action is required.
    </p>

    <p>
        Regards,<br>
        Your Application Team
    </p>
</body>

</html>
