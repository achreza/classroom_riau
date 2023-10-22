<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard</title>
</head>

<body>
    <h1>ini dashboard {{ $name }}</h1>
    <a href="{{ route('kelas.index') }}">Kelas</a>
    <a href="{{ route('tugas.index') }}">Tugas</a>
    <a href="{{ route('auth.logout') }}">Logout</a>

    <table border="1">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas as $item)
                <tr>
                    <td>{{ $item->nama_kelas }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>
                        <a href="{{ route('kelas.edit', ['kelas' => $item->id]) }}">Edit</a>
                        {{-- <a href="{{ route('kelas.destroy',['kelas' => $item->id]) }}">Hapus</a> --}}
                        <form action="{{ route('kelas.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
</body>

</html>
