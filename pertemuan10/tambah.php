<?php
    require 'functions.php';

    if(isset($_POST['tambah']))
    {
        if (tambah($_POST) > 0) {
            echo "<script>
                    alert('data berhasil ditambahkan');
                    document.location.href = 'index.php';
                </script>";
        }
        else
        {
            echo "<script>
                    alert('data gagal berhasil ditambahkan');
                </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Tambah Data Mahasiswa</title>
</head>
<body>
    <h3>Form Tambah Data Mahasiswa</h3>

    <form method="POST" action="">
        <ul>
            <li>
                <label for="nrp">NRP: </label><br>
                <input type="text" name="nrp" required>
            </li>

            <li>
                <label for="nama">Nama: </label><br>
                <input type="text" name="nama" required>
            </li>

            <li>
                <label for="email">Email: </label><br>
                <input type="text" name="email" required>
            </li>

            <li>
                <label for="jurusan">Jurusan: </label><br>
                <input type="text" name="jurusan" required>
            </li>

            <li>
                <button type="submit" name="tambah">Tambah Data!</button>
            </li>
        </ul>
    </form>
</body>
</html>