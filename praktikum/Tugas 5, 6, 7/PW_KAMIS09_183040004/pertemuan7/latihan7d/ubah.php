<?php
    require 'function.php';
    $id = $_GET['id'];
    $sma = query("SELECT * FROM smartphone WHERE id = $id")[0];

    if(isset($_POST['ubah']))
    {
        if (ubah($_POST) > 0) {
            echo "<script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>";
        }
        else {
            echo "<script>
                    alert('Data gagal diubah!');
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
    <title>Ubah Data Smartphone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $sma['id'] ?>">

        <label for="nama">Nama</label><br>
        <input type="text" name="nama" id="nama" value="<?= $sma['name'] ?>"><br><br>

        <label for="chipset">Chipset</label><br>
        <textarea rows="5" cols="50" type="text" name="chipset" id="chipset"><?= $sma['chipset'] ?></textarea><br><br>

        <label for="internal">Internal</label><br>
        <textarea rows="5" cols="50" type="text" name="internal" id="interal"><?= $sma['internal'] ?></textarea><br><br>

        <label for="camera">Camera</label><br>
        <textarea rows="5" cols="50" type="text" name="camera" id="camera"><?= $sma['camera'] ?></textarea><br><br>
        <label for="sensor">Sensor</label><br>

        <textarea rows="5" cols="50" type="text" name="sensor" id="sensor"><?= $sma['sensor'] ?></textarea><br><br>

        <label for="gambar">Gambar</label><br>
        <input type="text" name="gambar" id="gambar" value="<?= $sma['image'] ?>"><br><br>

        <button type="submit" name="ubah">Ubah</button>
        <a href="index.php"><button>Kembali</button></a>
    </form>
</body>
</html>