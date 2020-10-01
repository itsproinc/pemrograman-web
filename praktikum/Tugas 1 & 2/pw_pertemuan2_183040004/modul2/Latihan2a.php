<?php
    for ($foo = 1; $foo <= 3; $foo++) {
        $bar = 1;
        while($bar <= 3)
        {
            echo "Ini perulangan ke ($foo, $bar)";
            echo "<br>";
            $bar++;
        }
    }
?>