<!DOCTYPE html>
<html>
<head>
    <title>Email Pemberitahuan</title>
</head>
<body>
    <h1>{{ $data['subject'] }}</h1>
    <p>{!! nl2br($data['isi']) !!}.</p>
</body>
</html>
