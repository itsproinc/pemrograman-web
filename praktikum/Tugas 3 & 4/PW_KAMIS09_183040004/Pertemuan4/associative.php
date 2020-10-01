<?php
    $mahasiswa = [
        "001" => "Ahmad",
        "002" => "Budi",
        "003" => "Chika"
    ];

    $mahasiswa2 = [
        [
            "nrp" => "001",
            "nama" => "Abdul",
            "jurusan" => "Teknik Informatika",
            "umur" => 18
        ],
        [
            "nrp" => "002",
            "nama" => "Budi",
            "jurusan" => "Teknik Informatika",
            "umur" => 18
        ]
    ];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Array Associative</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
</head>
<body>
    <h4>Show array associative using foreach</h4>
    <?php foreach ($mahasiswa as $nrp => $nama) : ?>
        <li><?php echo "$nrp : $nama" ?> </li>
    <?php endforeach ?>
    <br>

    <h4>Show array associative using forloop</h4>
    <?php for ($i=0; $i < Count($mahasiswa); $i++) : ?>
        <?php $hasil = key($mahasiswa) ?>
            <li><?php echo "$hasil :" . $mahasiswa[$hasil] ?> </li>
        <?php next($mahasiswa) ?>
    <?php endfor ?>
    <br>

    <h4>Show nested array using foreach</h4>
    <?php foreach ($mahasiswa2 as $mhs) : ?> 
        NRP: <?= $mhs["nrp"]; ?> <br>
        Nama: <?= $mhs["nama"]; ?> <br>
        Jurusan: <?= $mhs["jurusan"]; ?> <br>
        Umur: <?= $mhs["umur"]; ?>
        <br><br>
    <?php endforeach ?>
</body>
</html>