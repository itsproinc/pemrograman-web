<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan 5c</title>
</head>
<body>
    <table border = "1" cellspacing = 0 cellpadding = 10>
        <!-- Image -->
        <tr><td style="text-align: center" rowspan="6" > <img src= "img/<?= $_GET["Image"] ?>.jpg" height="50%"> </td></tr>

        <!-- Name -->
        <tr><td><b> Chipset </b></td><td colspan="3" style="width:100%"> <?= $_GET["Chipset"] ?> </td> </tr>
        <tr><td><b> Internal </b></td><td colspan="3"> <?= $_GET["Internal"] ?> </td> </tr>

        <tr><td rowspan="2"><b> Camera </b></td></td>
        <td><b> Main </b></td> <td> <?= $_GET["MainCamera"] ?> </td>
        <tr><td><b> Selfie </b></td> <td> <?= $_GET["SelfieCamera"] ?> </td> </tr>

        <tr><td><b> Sensor </b></td> <td colspan="3"> <?= $_GET["Sensor"] ?> </td> </tr>
        
    </table>
</body>
</html>