<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reset Password</title>
    </head>
    <body>
        <p>Hello {{ $user->full_name }},</p>
        <p>Click below link to reset your password.</p>
        <p><a href="{{ route('forgotpassword.show', $data['token']) }}">Click here</a></p>
        <p></p>
        <p>Thank you!</p>
    </body>
</html>