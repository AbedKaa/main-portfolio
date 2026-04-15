<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #111;">
    <h2>New Contact Message</h2>

    <p><strong>Name:</strong> {{ $contactMessage->name }}</p>
    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
    <p><strong>Subject:</strong> {{ $contactMessage->subject ?: 'No Subject' }}</p>

    <hr>

    <p><strong>Message:</strong></p>
    <p>{!! nl2br(e($contactMessage->message)) !!}</p>
</body>

</html>
