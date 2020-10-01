<?php
    $hardware = [
        "Motherboard" => ["Papan Sirkuit komponen komputer", 500000, 200000],
        "Processor" => ["Sebuah IC yang mengontrol seluruh jalannya sistem komputer", 300000, 200000],
        "Hard Disk" => ["Media penyimpanan sekunder", 800000, 500000],
        "PC Cooler" => ["Mengurangi panas yang dihasilkan oleh komputer", 200000, 100000],
        "VGA Card" => ["Mengolah data grafik yang akan ditampilkan oleh monitor", 900000, 800000],
        "Optical Drive" => ["Membaca, maupun menulis data dari kepingan CD", 500000, 300000],
        "Card Reader" => ["Untuk membaca data-data yang tersimpan dalam memory card", 10000, 5000],
        "Modem" => ["Mengubah sinyal digital menjadi sinyal analog", 200000, 150000]
    ];

    $numbering = 1;
    $totHargaBaru = 0;
    $totHargaSekon = 0;
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

<table border = "1" cellspacing = 0 cellpadding = 5>
    <tr>
        <td style="text-align: center"><b>No.</b></td>
        <td style="text-align: center"><b>Nama Perangkat</b></td>
        <td style="text-align: center"><b>Fungsi</b></td>
        <td style="text-align: center"><b>Harga Baru</b></td>
        <td style="text-align: center"><b>Harga Sekon</b></td>
    </tr>
    <?php foreach ($hardware as $hw => $info) : ?>
        <tr>
            <td style="text-align: center"> <?= $numbering ?> </td>
            <td> <?= $hw ?> </td>
            <td> <?= $info[0] ?> </td>
            <td> Rp <?= $info[1] ?> </td>
            <td> Rp <?= $info[2] ?> </td>
        </tr>
        <?php 
            $numbering++; 
            $totHargaBaru += $info[1];
            $totHargaSekon += $info[2];
        ?>
    <?php endforeach ?>

    <tr>
        <td style="text-align: center"><b>#</b></td>
        <td style="text-align: center" colspan="2"><b>Jumlah </b></td>
        <td> Rp <?= $totHargaBaru ?></td>
        <td> Rp <?= $totHargaSekon ?></td>
    <tr>

<table>
</body>
</html>