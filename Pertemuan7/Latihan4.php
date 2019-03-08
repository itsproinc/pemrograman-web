<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LATIHAN 4</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h3>Detail Mahasiswa</h3>
    <ul>
        <li>Nama: <?= $_GET['nama']; ?></li>
        <li>NRP: <?= $_GET['nrp']; ?></li>
        <li>Email: <?= $_GET['email']; ?></li>
        <li>Jurusan: <?= $_GET['jurusan']; ?></li>
    </ul>
</body>
</html>