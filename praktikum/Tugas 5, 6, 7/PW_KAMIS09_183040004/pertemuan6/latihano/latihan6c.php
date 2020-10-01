<?php
    header('Content-Type: text/html; charset=ISO-8859-1');
    require 'function.php';
    $smartphone = query("SELECT * FROM smartphone");

    $counter = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tugas2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 2% 5%;
        }
    </style>
</head>
<body>
    <h1>Smartphone</h1>
    <?php foreach ($smartphone as $phone) : ?>
        <table border = "1" cellspacing = 0 cellpadding = 10>
            <td colspan = "4" ><b> <a href="profil.php?image=<?= $phone['image']?>&Name=<?=$phone['name']?>&chipset=<?=$phone['chipset']?>&internal=<?=$phone['internal']?>&camera=<?=$phone['camera']?>&sensor=<?=$phone['sensor']?>"> <?= $counter++ . ". " . $phone["name"] ?> </a> </b>
            </td>
        </tr>
        </table>
        <br>
        <?php endforeach ?>
</body>
</html>