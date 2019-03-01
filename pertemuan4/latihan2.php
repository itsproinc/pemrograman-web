<?php
    function VolumeDuaKubus ($a, $b) {
        $volumeA = $a * $a * $a;
        $volumeB = $b * $b * $b;
    
        $jumlah = $volumeA + $volumeB;
    
        return $jumlah;
    }

    echo VolumeDuaKubus(9, 4);
    echo '<hr>';
    echo VolumeDuaKubus(10, 15);
?>