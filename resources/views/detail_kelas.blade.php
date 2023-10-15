
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Kelas</title>
</head>
<body>
    <h1>{{ $kelas->nama_kelas }}</h1>
    <ul>
        @foreach($tugas as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</body>
</html>
