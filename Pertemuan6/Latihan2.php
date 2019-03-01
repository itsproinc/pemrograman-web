<?php
    // array associative
    $angka = [  'a' => 1, 
                'b' => 2, 
                'c' => 3
            ];
    echo $angka['c'];
    echo '<br>';
    foreach ($angka as $key => $value) {
        echo $key;
        echo '<br>';
    }
    echo '<hr>';

    $mahasiswa = [
        'nama'          => 'Sandhika Galih',
        'nrp'           => '0430400023',
        'email'         => 'sandhikagalih@unpas.ac.id',
        'jurusan'       => 'Teknik Informatika',
        'mata_kuliah'   => [
            'Pemrograman_web' => [
                'dosen' => 'Sandra Islama',
                'nilai' => [
                    'uts'   => 100,
                    'uas'   => 90,
                    'tugas' => [80, 70, 85]
                ]
            ]
        ]
    ];

    echo "Nilai tugas 2 PW saya: {$mahasiswa['mata_kuliah']['Pemrograman_web']['nilai']['tugas'][1]}";
?>