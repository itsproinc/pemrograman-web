<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 3b</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        .kotak {
            border: 1px solid black;
            padding: 10px;
        }
    </style>

<body>
    <?php
        $GLOBALS['jawabanIsset'] = "Isset adalah = Determine if a variable is set and is not NULL <br><br>";
        $GLOBALS['jawabanEmpty'] = "Empty adalah = Determine whether a variable is empty";

        function soal($style)
        {
            echo "<div class='$style'>" . $GLOBALS['jawabanIsset'] . $GLOBALS['jawabanEmpty'] . "</div>";
        }

        soal("kotak");
    ?>
</body>
</html>