<?php
    require 'function.php';
    if(isset($_POST['tambah']))
    {
        if (tambah($_POST) > 0) {
            echo "<script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>";
        }
        else {
            echo "<script>
                    alert('Data gagal ditambahkan!');
                    document.location.href = 'index.php';
                </script>";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tambah Data Smartphone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <form action="" method="post">
        <label for="nama">Nama</label><br>
        <input type="text" name="nama" id="nama"><br><br>

        <label for="chipset">Chipset</label><br>
        <textarea rows="5" cols="50" type="text" name="chipset" id="chipset"></textarea><br><br>

        <label for="internal">Internal</label><br>
        <textarea rows="5" cols="50" type="text" name="internal" id="interal"></textarea><br><br>

        <label for="camera">Camera</label><br>
        <textarea rows="5" cols="50" type="text" name="camera" id="camera"></textarea><br><br>
        <label for="sensor">Sensor</label><br>

        <textarea rows="5" cols="50" type="text" name="sensor" id="sensor"></textarea><br><br>

        <label for="gambar">Gambar</label><br>
        <input type="text" name="gambar" id="gambar"><br><br>

        <button type="submit" name="tambah">Tambah</button>
        <a href="index.php"><button>Kembali</button></a>
    </form>
</body>
</html>