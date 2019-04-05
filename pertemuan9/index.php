<?php
    // koneksi ke mysql, dan memilih database
    // hostname, username, password, nama database
    $conn = mysqli_connect('localhost', 'root', '', 'pw_183040004');

    // query ke tabel mahasiswa
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa");
    
    // ambil data dari dalam $result
    // mysqli_fetch_row // array numerik
    // mysqli_fetch_assoc // array associative
    // mysqli_fetch_array // 2-2nya
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    $mahasiswa = $rows;

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

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach($mahasiswa as $mhs) : ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $mhs["nrp"] ?></td>
            <td><?= $mhs["nama"] ?></td>
            <td><?= $mhs["email"] ?></td>
            <td><?= $mhs["jurusan"] ?></td>
            <td>
                <a href="">ubah</a> | <a href="">hapus</a>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
</body>
</html>