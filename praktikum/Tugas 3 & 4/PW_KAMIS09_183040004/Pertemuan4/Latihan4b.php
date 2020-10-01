<?php
    $hardware = [
        "Motherboard",
        "Processor",
        "Hard Disk",
        "PC Cooler",
        "VGA Card",
        "SSD"
    ];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 4b</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
</head>
<body>
    <?php for ($i=0; $i < count($hardware) ; $i++) : ?>
        <?= $i + 1 . ". $hardware[$i]" ?>
        <br>
    <?php endfor ?>

    <?php
        array_push($hardware, "Card Reader", "Modem");
        sort($hardware);
    ?>

    <br>
    <?php for ($i=0; $i < count($hardware) ; $i++) : ?>
        <?= $i + 1 . ". $hardware[$i]" ?>
        <br>
    <?php endfor ?>
</body>
</html>