<?php
    $mahasiswa = [
        ['Bakhtiar', '183040004', 'bakhtiar.183040004@mail.unpas.ac.id', 'Teknik Informatika'],
        ['Rizky Ramadhan', '183040008', 'ramadhan@mail.unpas.ac.id', 'Teknik Informatika'],
        ['Hadi Sutarma', '183040035', 'sutarma@mail.unpas.ac.id', 'Teknik Informatika'],
        ['Nathaniel Wijayanto', '183040023', 'wijayanto@mail.unpas.ac.id', 'Teknik Informatika'],
        ['Avip Syaifulloh', '183040024', 'syaifulloh@mail.unpas.ac.id', 'Teknik Informatika'],
        ['Fadhlanrasif Ibrahim Supriana', '184040015', 'supriana@mail.unpas.ac.id', 'Teknik Informatika']
    ]
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <h3>Daftar Mahasiswa</h3>
    <?php for ($mhs = 0; $mhs < count($mahasiswa); $mhs++) { ?>
        <ul>
            <li> <?php echo "Nama: {$mahasiswa[$mhs][0]}"; ?> </li>
            <li> <?php echo "NPM: {$mahasiswa[$mhs][1]}"; ?> </li>
            <li> <?php echo "Email: {$mahasiswa[$mhs][2]}"; ?> </li>
            <li> <?php echo "Jurusan: {$mahasiswa[$mhs][3]}"; ?> </li>
        </ul>
    <?php } ?>
</body>
</html>