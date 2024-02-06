<!-- otp_mail.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to E-commerce</title>
</head>
<body>
    <p>Welcome to E-commerce,</p>
    
    <p>You may activate your account by clicking on this link:</p>
    
    <a href="{{ $activateLink }}">{{ $activateLink }}</a>
    
    <p>Thank you,</p>
</body>
</html>
