<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 3d</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php
        function urutanAngka ($angka)
        {
            $num = 1;
            for ($i=1; $i <= $angka; $i++) { 
                for ($j=1; $j <= $i; $j++) { 
                    echo "$num ";
                    $num++;
                }

                echo "<br>";
            }
        }

        echo urutanAngka(5);
    ?>
</body>
</html>