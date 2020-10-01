<?php
    header('Content-Type: text/html; charset=ISO-8859-1');
    require 'function.php';
    $smartphone = query("SELECT * FROM smartphone");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan 6a</title>
</head>
<body>
    <div class="container">
        <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Chipset</th>
                        <th>Internal</th>
                        <th>Camera</th>
                        <th>Sensor</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($smartphone as $sma) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <img src="img/<?=$sma['image']?>" style="width:100%">
                        </td>

                        <td> <?= $sma["name"]; ?> </td>       
                        <td> <?= $sma["chipset"]; ?> </td>              
                        <td> <?= $sma["internal"]; ?> </td>               
                        <td> <?= $sma["camera"]; ?> </td>      
                        <td> <?= $sma["sensor"]; ?> </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
    </div>
</body>
</html>