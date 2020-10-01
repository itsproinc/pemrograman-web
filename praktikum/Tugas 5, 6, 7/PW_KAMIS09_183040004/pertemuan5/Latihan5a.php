<?php
    if(isset($_GET['angka']))
        $angka = $_GET['angka'];
    else
        $angka = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan 5a</title>

    <style>
        .kotak {
            width: 25px;
            height: 25px;
            display: inline-block;
            border: 1px solid black;
            line-height: 25px;
            text-align: center;
        }

        .biru {
            background-color: skyblue;
        }
    </style>
</head>
<body>
    <?php for($i = 0; $i < $angka; $i++): ?>
        <?php for($j = 1; $j <= ($angka - $i); $j++) : ?>
            <?php if($i % 2 == 0): ?>
                <div class="kotak biru"> <?= ($angka - $i) ?> </div>
            <?php else: ?>
                <div class="kotak">  <?= ($angka - $i) ?> </div>
            <?php endif ?>
        <?php endfor ?>
        <br>
    <?php endfor ?>
</body>
</html>