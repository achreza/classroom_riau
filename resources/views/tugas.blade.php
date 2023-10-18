<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tugas</title>
</head>
<body>
    <form action="{{ route('tugas.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="judul" placeholder="Judul">
        <input type="text" name="deskripsi" placeholder="Deskripsi">
        <input type="file" name="file">
        <input type="date" name="tgl_mulai">
        <input type="date" name="tgl_akhir">
        <button type="submit">Tambah</button>
    </form>
</body>
</html>