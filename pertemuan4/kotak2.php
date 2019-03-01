<?php
    function TampilkanKotak ($jumlahKotak) {
        for($i = 1; $i <= $jumlahKotak; $i++)
        {
            echo "<div class='kotak'>$i</div>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            .kotak {
                width: 30px;
                height: 30px;
                background-color: lightblue;
                text-align: center;
                line-height: 30px;
                display: inline-block;
                margin: 2px;
            }

            .merah {
                background-color: salmon;
            }
        </style>
    </head>

    <body>
           <?php
                for ($i = 1; $i <= 10 ; $i++) { 
                    TampilkanKotak($i);
                    echo '<br>';
                }
           ?>
    </body>
</html>