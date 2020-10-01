<?php
    $hardware = [
        "Motherboard" => "Papan Sirkuit komponen komputer",
        "Processor" => "Sebuah IC yang mengontrol seluruh jalannya sistem komputer",
        "Hard Disk" => "Media penyimpanan sekunder",
        "PC Cooler" => "Mengurangi panas yang dihasilkan oleh komputer",
        "VGA Card" => "Mengolah data grafik yang akan ditampilkan oleh monitor",
        "Optical Drive" => "Membaca, maupun menulis data dari kepingan CD",
        "Card Reader" => "Untuk membaca data-data yang tersimpan dalam memory card",
        "Modem" => "Mengubah sinyal digital menjadi sinyal analog"
    ];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 4c</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
</head>
<body>
<table>
    <?php foreach ($hardware as $hw => $desc) : ?>
        <tr>
            <td> <?= $hw ?> </td>
            <td>: <?= $desc ?> </td>
        </tr>
    <?php endforeach ?>
<table>
</body>
</html>