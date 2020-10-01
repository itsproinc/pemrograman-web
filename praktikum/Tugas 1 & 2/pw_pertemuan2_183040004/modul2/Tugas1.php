<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tugas 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .kotak {
            width: 30px;
            height: 30px;
            border:1px solid;
            float: left;
            margin: 2px;
        }

        .clear {
            clear: both;
        }

        .black {
            background-color: black;
        }
    </style>
</head>
<body>
    <?php
        for ($foo = 1; $foo <= 5; $foo++) {
            for ($bar = 1; $bar <= 5; $bar++) {
                if($foo %2 == 0 && $bar %2 == 0 || $foo %2 == 1 && $bar %2 == 1)
                    echo "<div class='kotak black'></div>";
                else
                    echo "<div class='kotak'></div>";
            }
            echo "<div class='clear'></div";
            echo "<br>";
        }
    ?>
</body>
</html>