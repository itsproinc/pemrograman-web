<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        .kotak {
            width: 30px;
            height: 30px;
            text-align: center;
            background-color: skyblue;
            line-height: 30px;
            transition: 1s;
            margin: 1px;
            display: inline-block;
        }

        .merah {
            background-color: salmon;
        }

        .kotak:hover {
            transform: rotate(360deg);
        }
    </style>

    
</head>
<body>       
    <?php
    for ($i=1; $i <= 5; $i++) { 
        echo "<div class='kotak'> $i </div>";
    }

    echo '<hr>';

        for($i = 0; $i <= 10; $i++)
        {
            for ($j=1; $j <= 10; $j++) { 
                if($i % 2 == 0) // Ganjil
                    echo "<div class='kotak'> $j </div>";
                else // Genap
                    echo "<div class='kotak merah'> $j </div>";
            }
            echo '<br>';
        }
    ?>
</body>
</html>

