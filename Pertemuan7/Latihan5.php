<?php
    // $_POST
    // mengambil data lewat FORM
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 5</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <form method="post" action="latihan6.php">
        <label>Masukkan Nama:  </label> <br>
        <input type="text" name="nama"> <br>

        <label>Masukkan NRP:  </label> <br>
        <input type="text" name="nrp"> <br>

        <label>Masukkan Email:  </label> <br>
        <input type="text" name="email"> <br>

        <label>Masukkan Jurusan:  </label> <br>
        <select name="jurusan">
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Teknik Mesin">Teknik Mesin</option>
            <option value="Teknik Pangan">Teknik Pangan</option>
        </select> <br>

        <button type="submit">Kirim Data</button>
    </form>
</body>
</html>