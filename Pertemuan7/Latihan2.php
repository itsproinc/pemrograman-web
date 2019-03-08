<?php
    // SUPERGLOBALS
    // Variabel milik PHP yang dapat kita gunakan di setiap halaman

    // $_GET
    // bisa mendapatkan data lewat URL

    // var_dump($_GET);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <h3>Halo, Selamat datang <?= $_GET['nama'] ?></h3>    
</body>
</html>