<?php
    // STRUKTUR KENDALI / CONTROL FLOW
    // 1. PENGULANGAN / LOOP / ITERASI
    // while, for

    $i = 1; // inisialisasi / nilai awal
    while($i <= 5) { // selama kondisi () bernilai true
        // lakukan aksi di dalam {}
            echo "Hello World $i kali! <br>";
            $i++;
    }

    echo 'selesai.';
    echo '<hr>';

    // for
    for($i = 1; $i <= 5; $i++)
    {
        echo "Hello World $i kali! <br>";
    }
    echo 'selesai.';
    echo '<hr>';

    // PENGKODISIAN / PERCABANGAN
    // if, if.. else, if.. else if.. else

    $x = 30;
    $angkaFavorit = 27;
    for ($i=1; $i <= $x; $i++) { 
        if($i % 2 == 1 && $i != $angkaFavorit)
        {
            echo "$i adalah bilangan GANJIL";
            echo '<br>';
        } 
        else if ($i == $angkaFavorit)
        {
            echo "$i adalah ANGKA FAVORIT saya.";
            echo '<br>';
        }
        else
        {
            echo "$i adalah bilangan GENAP";
            echo '<br>';
        }
    }

?>