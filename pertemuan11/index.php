<?php
    require 'functions.php';
    $mahasiswa = query("SELECT * FROM mahasiswa");
    
    if(isset($_GET['cari'])) {
        $keyword = $_GET['keyword'];

        $query = "SELECT * FROM mahasiswa WHERE
                nama LIKE '%$keyword%' OR
                email LIKE '%$keyword%'
                ";
        $mahasiswa = query($query);
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daftar Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h3>Daftar Mahasiswa</h3>

    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br><br>

    <form action="" method="GET">
        <input type="text" name="keyword" autofocus>
        <button type="submit" name="cari">Cari!</button>
    </form>
    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>

        <?php if(empty($mahasiswa)) : ?>
            <tr>
                <td colspan="6">Data tidak ditemukana</td>
            </tr>
        <?php endif ?>
        <?php $i = 1; ?>
        <?php foreach($mahasiswa as $mhs) : ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $mhs["nrp"] ?></td>
            <td><?= $mhs["nama"] ?></td>
            <td><?= $mhs["email"] ?></td>
            <td><?= $mhs["jurusan"] ?></td>
            <td>
                <a href="ubah.php?id=<?= $mhs['id'] ?>">ubah</a> | 
                <a href="hapus.php?id=<?= $mhs['id'] ?>" onclick="return confirm('yakin?')">hapus</a>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
</body>
</html>