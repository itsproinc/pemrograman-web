<?php
    // OPERATOR

    // Perbandingan

    // ==, !=, <, >, <=, >=
    $a = 10;
    $b = 10;

    // menghasilkan 1 jika TRUE, kosong jika FALSE

    echo $a >= $b;
    echo '<br>';
    $c = 15;
    echo ($c % 2) == 1;
    echo '<br>';
    
    // IDENTITAS
    // ===, !===
    echo 1 === "1";
    echo '<hr>';

    // OPERATOR LOGIKA
    // && (and), || (or), ! (not)
    $x = 11;
    echo ($x % 2 == 1) && ($x < 10);
?>