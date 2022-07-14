<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Change</title>
</head>
<body>


                <p><b>Dear {{$candidate_name}},</b></p>
                <p> Click the Below link to Change Password </p><a href="{{ url('email_pass',$passcode_token) }}">Change your Password Link</a>

                <p><b>Thank you,</b></p>
                <p>HR Team- HEPL</p>



</body>
</html>
