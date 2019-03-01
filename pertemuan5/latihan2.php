<?php
    $angka1 = [5, 10, 13, 2, 0];
    //array multidimensi
    $myArr = ['Sandhika', 33, true, [1, 2, 3]];
    
    $angka2 = [
        [1,2,3], 
        [4,5,6], 
        [7,8,9]
    ];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .kotak {
            width: 40px;
            height: 40px;
            background-color: salmon;
            text-align: center;
            line-height: 40px;
            margin: 2px;
            display: inline-block;
        }
    </style>
<body>
    <?php
        for ($i = 0; $i < count($angka1); $i++) { 
            echo "<div class='kotak'>$angka1[$i]</div>";
        }
    ?>
    <br>
    <?php
        
        foreach ($angka1 as $a) {
            echo "<div class='kotak'>$a</div>";
        }
    ?>
    <hr>
    <?php
        
        foreach ($angka2 as $a2) {
            foreach ($a2 as $a) {
                echo "<div class='kotak'>$a</div>";    
            }
            echo '<br>';
        }
    ?>

    <hr>

    <?php
        for ($i = 0; $i < count($angka2); $i++) { 
            for ($j = 0; $j < count($angka2[$i]); $j++) { 
                echo "<div class='kotak'> {$angka2[$i][$j]} </div>"; 
            }
            echo '<br>';
        }
    ?>
    <hr>
    <?php
        for ($i = 0; $i < count($angka2); $i++) { 
            foreach ($angka2[$i] as $a) {
                echo "<div class='kotak'>$a</div>";    
            }
            echo '<br>';
        }
    ?>

</body>
</html>