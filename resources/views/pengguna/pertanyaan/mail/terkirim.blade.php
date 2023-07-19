<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Tiket Terkirim</title>
</head>
<body>
    <h3 style="color: #09ca97">Selamat tiket anda telah terkirim!</h3>
    <p><strong>Kategori:</strong></p>
    <p>{{ $tiket->kategori }}</p>
    <p><strong>Pertanyaan:</strong></p>
    <p>{{ $tiket->pertanyaan }}</p>
</body>
</html>
