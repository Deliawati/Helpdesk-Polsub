<!DOCTYPE html>
<html>
<head>
    <title>Balasan Pertanyaan</title>
</head>
<body>
    <h2>Balasan Pertanyaan Anda</h2>

    <h3>Dibalas Oleh :</h3>
    <p>{{ Auth::user()->name }}</p>

    <p><strong>Pertanyaan:</strong></p>
    <p>{{ $tiket->pertanyaan }}</p>

    <hr>

    <h3>Balasan:</h3>
    <p>{{ $tiket->balasan }}</p>
</body>
</html>
