<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Tiket Terkirim</title>
</head>
<body>
    <h3 style="color: #09ca97">Tiket anda telah terkirim!</h3>
    <p>Tiket ini akan dibalas oleh admin yang menangani layanan {{ $tiket->kategori->nama }} .</p>
    <p><strong>Pertanyaan:</strong></p>
    <p>{{ $tiket->pertanyaan }}</p>
</body>
</html>
