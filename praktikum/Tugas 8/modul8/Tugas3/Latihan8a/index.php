<?php
    header('Content-Type: text/html; charset=ISO-8859-1');
    require 'function.php';

    if(isset($_GET['cari'])) {
        $keyword = $_GET['s'];
        $smartphone = query("SELECT * FROM smartphone WHERE
            name LIKE '%$keyword%' OR
            chipset LIKE '%$keyword%' OR
            internal LIKE '%$keyword%' OR
            camera LIKE '%$keyword%' OR
            sensor LIKE '%$keyword%'");
    } else
        $smartphone = query("SELECT * FROM smartphone");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <a href="logout.php">Logout</a><br>
    <a href="tambah.php"><button>Tambah Data</button></a>
    <form action="" method="get">
        <input type="text" name="s" id="s" class="form-control" placeholder="Search...">
        <button type="submit" name="cari" id="cari">Cari</button>
    </form>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Opsi</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Chipset</th>
                <th>Internal</th>
                <th>Camera</th>
                <th>Sensor</th>
            </tr>
        </thead>

        <tbody>
            <?php if(empty($smartphone)) : ?>
                <tr>
                    <td colspan="8"></td>
                    <h1 align="center">Data tidak ditermukan!</h1>
                </tr>
            <?php else : ?>
                <?php $no = 1; ?>
                <?php foreach ($smartphone as $sma) : ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td>
                        <a href="hapus.php?id=<?=$sma['id']?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
                        <a href="ubah.php?id=<?=$sma['id']?>">Ubah</a>
                    </td>
                    <td>
                        <img src="../assets/img/<?=$sma['image']?>" style="width:100%">
                    </td>

                    <td> <?= $sma["name"]; ?> </td>       
                    <td> <?= $sma["chipset"]; ?> </td>              
                    <td> <?= $sma["internal"]; ?> </td>               
                    <td> <?= $sma["camera"]; ?> </td>              
                    <td> <?= $sma["sensor"]; ?> </td>
                </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</body>
</html>