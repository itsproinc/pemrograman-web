<?php
    // ARRAY
    // array adalah variabel yang dapat menyimpan banyak elemen/nilai

    // membuat array
    $hari = array('Senin', 'Selasa', 'Rabu');
    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei'];
    $myArray = ['Sandhika', 33, true];

    // Mencetak array
    // menggunakan echo, untuk mencetak 1 elemen di dalam array sesuai dengan index-nya
    echo $hari[2];
    echo '<br>';
    echo $bulan[0];
    echo '<hr>';

    // mencetak semua isi array (KHUSUS UNTUK DEBUGGING)
    // var_dump(), print_r()
    var_dump($hari);
    echo '<br>';
    print_r($myArray);
    echo '<hr>';

    // mencetak semua isi array UNTUK USER
    // for / foreach
    for ($i = 0; $i < 3; $i++) { 
        echo $hari[$i];
        echo '<br>';
    }

    echo '<br>';

    for($i = 0; $i < count($bulan); $i++) {
        echo $bulan[$i];
        echo '<br>';
    }

    echo '<br>';

    foreach ($hari as $h) {
        echo $h;
        echo '<br>';
    }


    echo '<br>';

    foreach($bulan as $b) {
        echo $b;
        echo '<br>';
    }