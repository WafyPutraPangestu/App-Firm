<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Email Key Login</h1>
    <p>hallo {{ $data['nama_lengkap'] }}</p>
    <p>Berikut adalah client key untuk login ke aplikasi kami:</p>
    <h2>{{ $data['client_key'] }}</h2>
</body>
</html>