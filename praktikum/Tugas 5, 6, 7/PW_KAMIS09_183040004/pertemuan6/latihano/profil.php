<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan 5c</title>
</head>
<body>
    <table border = "1" cellspacing = 0 cellpadding = 10>
        <!-- Image -->
        <tr><td style="text-align: center" rowspan="5" > <img src= "img/<?= $_GET["image"] ?>" height="50%"> </td></tr>
        <!-- Name -->
        <tr><td><b> Chipset </b></td><td colspan="3" style="width:100%"> <?= $_GET["chipset"] ?> </td> </tr>
        <tr><td><b> Internal </b></td><td colspan="3"> <?= $_GET["internal"] ?> </td> </tr>

        <tr><td><b> Camera </b></td></td>
        <td> <?= $_GET["camera"] ?> </td>

        <tr><td><b> Sensor </b></td> <td colspan="3"> <?= $_GET["sensor"] ?> </td> </tr>
        
    </table>

    <a href="latihan6c.php">Kembali</a>
</body>
</html>