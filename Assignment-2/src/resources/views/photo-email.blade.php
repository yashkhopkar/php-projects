<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Email</title>
</head>
<body>
<p>Hi,</p>
<p>Please find the link to the photo "{{ $photo->title }}" below:</p>
<p><a href="{{ $url }}">{{ $url }}</a></p>
<p>Regards,</p>
<p>The Photo Album Team</p>
</body>
</html>