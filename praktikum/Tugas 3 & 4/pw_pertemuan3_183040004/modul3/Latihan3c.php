<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latihan 3c</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <?php
        function hitungLuasLingkaran($r) {
            echo "<h4>Menghitung Luas Lingkaran</h4>";
            echo "Jari-jari = $r";
            echo "<br>";
            echo "Luas lingkaran = " . round(pi() * pow($r, 2)) . " cm²";
            echo "<hr>";
        }

        function hitungKelilingLingkaran($r) {
            echo "<h4>Menghitung Keliling Lingkaran</h4>";
            echo "Jari-jari = $r";
            echo "<br>";
            echo "Keliling lingkaran = " . round(pi() * (2 * $r), 1) . " cm";
            echo "<hr>";
        }
        
        hitungLuasLingkaran(10);
        hitungKelilingLingkaran(20);
    ?>
</body>
</html>