<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelas</title>
</head>
<body>
    @if ($class)
    <form action="{{ route('kelas.update',['kela' => $class->id]) }}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="nama_kelas" placeholder="Nama Kelas" value="{{ $class->nama_kelas }}">
        <input type="text" name="deskripsi" placeholder="deskripsi" value="{{ $class->deskripsi }}">
        <button type="submit">Edit</button>
    @else
    <form action="{{ route('kelas.store') }}" method="post">
        @csrf
        <input type="text" name="nama_kelas" placeholder="Nama Kelas">
        <input type="text" name="deskripsi" placeholder="deskripsi">
        <button type="submit">Tambah</button>
    </form>
    @endif
    
</body>
</html>