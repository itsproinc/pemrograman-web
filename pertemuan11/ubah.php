<?php
    require 'functions.php';

    $id = $_GET['id'];
    $mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

    if(isset($_POST['ubah']))
    {
        if (ubah($_POST) > 0) {
            echo "<script>
                    alert('data berhasil diubah');
                    document.location.href = 'index.php';
                </script>";
        }
        else
        {
            echo "<script>
                    alert('data gagal diubah');
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
    <title>Form Ubah Data Mahasiswa</title>
</head>
<body>
    <h3>Form Ubah Data Mahasiswa</h3>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= $mhs['id'] ?>">

        <ul>        
            <li>
                <label for="nrp">NRP: </label><br>
                <input type="text" name="nrp" required value="<?=$mhs['nrp']?>">
            </li>

            <li>
                <label for="nama">Nama: </label><br>
                <input type="text" name="nama" required value="<?=$mhs['nama']?>">
            </li>

            <li>
                <label for="email">Email: </label><br>
                <input type="text" name="email" required value="<?=$mhs['email']?>">
            </li>

            <li>
                <label for="jurusan">Jurusan: </label><br>
                <input type="text" name="jurusan" required value="<?=$mhs['jurusan']?>">
            </li>

            <li>
                <button type="submit" name="ubah">Ubah Data!</button>
            </li>
        </ul>
    </form>
</body>
</html>