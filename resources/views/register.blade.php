<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    {{-- form register --}}
    
    <form action="{{ url('register') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="email" placeholder="Email" value="{{ $email }}" readonly>
        <input type="text" name="kode" placeholder="NIM">
        <input type="text" name="jurusan" placeholder="jurusan">
        <button type="submit">Register</button>
    </form>
</body>
</html>