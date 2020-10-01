<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 5d</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">

    <style>
        .kotak {
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 25px;
            border: 1px solid black;
            display: inline-block;
        }

        .salmon {
            background-color: salmon;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <label> Masukkan Angka: </label>
        <input type="text" name="angka"> 
        <input type="submit" value="Tampilkan">
    </form>
    <?php
        if(isset($_POST['angka']))
            $angka = $_POST['angka'];
        else
            $angka = 0;
    ?>
    <br> 
    <?php for($i = 0; $i < $angka; $i++) : ?>
        <?php for($j = 0; $j < ($angka - $i); $j++) : ?>
            <?php if($i % 2 == 0) : ?>
                <div class="kotak salmon"> <?= ($angka - $i) ?> </div>
            <?php else : ?>
                <div class="kotak"> <?= ($angka - $i) ?> </div>
            <?php endif ?>
        <?php endfor ?>
        <br>
    <?php endfor ?>
</body>
</html>