<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 3a</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .ganti_style {
            font-size: 28px;
            font-family: arial;
            color: #8c782d;
            font-style: italic;
            font-weight: bold; 
            padding: 5px;
        }

        .box_model {
            border-radius: 5px;
            margin: 20px 0 0 20px;
            border: 1px solid black;
            height: 40px;
            width: 600px;
            box-shadow: 1px 1px 15px rgba(0, 0, 0.5);
        }
    </style>
</head>
<body>
    <?php
        function gantiStyle ($tulisan, $style1, $style2)
        {
            echo "<div class='$style1 $style2'>$tulisan</div>";
        }

        gantiStyle("Selamat datang di praktikum PW 2019", "ganti_style", "box_model");
    ?>
</body>
</html>