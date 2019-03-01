<?php
    // FUNCTION
    // BUILT-IN FUNCTION
    // fungsi bawaan PHP

    echo date('[e] G:i l, d F Y');
    echo '<hr>';

    // UNIX TIMESTAMP
    // detik yang sudah berlalu dari 1 januari 1970
    echo time();
    echo '<hr>';

    echo date ('l', time() - 60 * 60 * 24 * 100);
    echo '<hr>';

    // mktime(0, 0, 0, 0, 0, 0)
    // jam, menit, detik, bulan, tanggal, tahun
    echo mktime(0, 0, 0, 1, 27, 2000);
    echo '<br>';
    echo date('l', mktime(0, 0, 0, 1, 27, 2000));
    echo '<hr>';

    // MATH
    echo pow(2, 8);
    echo '<br>';
    // bilangan random
    echo rand(1, 10);
    echo '<br>';
    // pembulatan
    // ceil(), floor(), round()
    echo round(2.5);
    echo '<hr>';
?>