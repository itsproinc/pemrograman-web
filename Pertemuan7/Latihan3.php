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
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h3>Daftar Mahasiswa</h3>
    <ul>
        <?php foreach($mahasiswa as $mhs) : ?>
        <li>
            <a href="Latihan4.php?
            nama=<?= $mhs['nama'];?>
            &nrp=<?= $mhs['nrp'];?>
            &email=<?= $mhs['email'];?>
            &jurusan=<?= $mhs['jurusan']; ?>"> <?= $mhs['nama']; ?> </a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>