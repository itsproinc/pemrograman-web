<?php
    $mahasiswa = [
        ['Sandhika', '043040023', 'sandhikagalih@unpas.ac.id', 'Teknik Informatika'], 
        ['Doddy Ferdiansyah', '033040123', 'doddy@yahoo.com', 'Teknik Mesin']
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