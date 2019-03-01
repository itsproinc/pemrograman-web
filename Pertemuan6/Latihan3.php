<?php
    $mahasiswa = [
        [
            'nama'      => 'Sandhika', 
            'nrp'       => '043040023', 
            'email'     => 'sandhikagalih@unpas.ac.id', 
            'jurusan'   => 'Teknik Informatika'
        ], 
        [
            'nama'      => 'Doddy Ferdiansyah', 
            'nrp'       => '033040123', 
            'email'     => 'doddy@yahoo.com', 
            'jurusan'   => 'Teknik Mesin'
        ]
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
    <?php for ($mhs = 0; $mhs < count($mahasiswa); $mhs++) : ?>
        <ul>
            <li> Nama: <?= $mahasiswa[$mhs]['nama']; ?> </li>
            <li> NPM:  <?= $mahasiswa[$mhs]['nrp']; ?> </li>
            <li> Email: <?= $mahasiswa[$mhs]['email']; ?> </li>
            <li> Jurusan: <?= $mahasiswa[$mhs]['jurusan']; ?> </li>
        </ul>
    <?php endfor; ?>

    
    
</body>
</html>