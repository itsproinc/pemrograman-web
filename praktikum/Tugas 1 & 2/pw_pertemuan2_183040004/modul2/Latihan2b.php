<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modul 2 - Latihan 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <table border="1" cellpadding="3" widthpadding="0">
        <tr>
            <th>Kolom 1</th>
            <th>Kolom 2</th>
            <th>Kolom 3</th>
            <th>Kolom 4</th>
            <th>Kolom 5</th>
        </tr>

    <?php
        for ($foo = 1; $foo <= 5; $foo++) { 
            echo "<tr>";
            for ($bar = 1; $bar <= 5; $bar++) { 
                if($foo %2 == 0)
                    echo "<th></th>";
                else
                    echo "<th>Baris $foo, Kolom $bar</th>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>