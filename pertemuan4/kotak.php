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
                for($i = 1; $i <= 10; $i++)
                {
                    for($j = 1; $j <= 5; $j++)
                    {
                        if($i % 2 == 0 && $j % 2 == 1 || $i % 2 == 1 && $j % 2 == 0)
                             echo "<div class='kotak merah'>$i</div>";
                        else
                            echo "<div class='kotak'>$i</div>";
                    }
                    echo '<br>';
                }
            ?>
    </body>
</html>