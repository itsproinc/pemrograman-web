<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modul 2 - Latihan 2c</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .kotak {
            background-color: white;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            border:1px solid;
            float: left;
            margin: 2px;
            color: black;
        }

        .kotak1 {
            background-color: #57e65a;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            border:1px solid;
            float: left;
            margin: 2px;
            color: black;
        }

        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <?php
        for ($foo = 1; $foo <= 5; $foo++) { 
            for ($bar = 1; $bar <= $foo; $bar++) { 
                echo "<div class='kotak'>#$foo</div>";
                echo "<div class='kotak1'>$bar</div>";
            }
            echo "<div class='clear'></div";
            echo "<br>";
        }
    ?>
</body>
</html>