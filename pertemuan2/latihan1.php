<?php 
    // PERTEMUAN 2
    // Belajar sintaks PHP Dasar
    // sintaks // digunakan untuk buat komentar

    echo 'Bakhtiar';
    echo '<br>';
    echo 'Saya kuliah di Teknik Informatika UNPAS';
    echo '<hr>';

    // TIPE DATA (primitif)
    // angka (integer, float, string, boolean, null

    echo 123;
    echo '<br>';
    echo 10.5;

    echo '<hr>';

    // ^ caret
    // | vertical bar / pipe
    // ~ tilde
    // ` back ticks

    // VARIABEL
    // tempat penampungan nilai
    // $
    $nama = 'Bakhtiar';
    echo $nama;
    echo '<br>';
    $x = 10;
    $y = 20;
    $z = $x + $y;
    echo $z;
    // aturan membuat variabel
    // ga boleh ada spasi
    // $nama_depan snake_case
    // $namaDepan camelCase
    // ga boleh diawali angka tapi boeh mengandung angka
    // $nama1 boleh

    echo '<hr>';
    // OPERATOR
    // ASSIGNMENT / Penugasan
    // =, +=, -=, *=, /=
    $x = 10;
    $x = 100 + $x;
    echo $x;
    echo '<br>';

    $y = 20;
    $y -= 200;
    echo $y;

    echo '<hr>';
    // ARITMATIKA
    // +, -, *, /, %   
    // KaBaTaKu
    echo (1 + 2) * 3 - 4;
    echo '<br>';
    echo 10 % 3;
    echo '<hr>';

    // escape character '\'
    echo 'Hari ini saya kuliah "Pemograman Web"';
    echo '<br>';
    echo "Hari ini hari Jum'at";
    echo '<br>';
    echo 'Hari Jum\'at, saya kuliah "Pemograman Web"';
    echo '<br>';
    echo "Hari Jum'at, saya kuliah \"Pemograman Web\"";

    echo '<hr>';
    // STRING
    // '', ""
    $nama = 'Bakhtiar';
    $umur = 33;
    $jurusan = 'Teknik Informatika';

    echo "Halo, nama saya $nama, umur saya $umur tahun. Saya kuliah di jurusan $jurusan";

    echo '<hr>';

    // OPERATOR PENGGABUNG STRING / CONCATENASI / CONCAT
    // .
    $nama_depan = 'Bakhtiar';
    $nama_belakang = 'Tiar';
    echo $nama_depan . ' ' . $nama_belakang;
    echo '<br>';
    echo 'Halo, nama saya ' . $nama . ', umur saya ' . $umur . ' tahun. Saya kuliah di jurusan ' . $jurusan;
    echo '<hr>';

    // INCREMENT / DECREMENT
    // ++, --
    $x = 1;
    // $x = $x + 1;
    // $x = $x + 1;
    // $x++;
    ++$x;
    $x++;
    echo $x++;
    echo $x;
?>