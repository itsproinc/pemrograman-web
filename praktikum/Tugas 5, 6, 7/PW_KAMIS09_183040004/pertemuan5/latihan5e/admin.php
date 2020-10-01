<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">

    <style>
        .login {
            width: 30vw;
            height: auto;
            background-color: skyblue;
            border: 1px solid black;
            padding-bottom: 1vw;

            margin: 0 auto;
            text-align: center;
        }

        .login img {
            width: 25vw;
        }
    </style>
</head>
<body>
    <?php  
        if(isset($_POST['logout']))
            echo "<script> document.location.href = 'login.php'; </script>";
    ?>

    <div class="login">
        <form method="post" action="">
            <table style="margin: 0 auto;">
                <h1>Selamat datang admin</h1>
                <tr>
                    <td> <input type="submit" value="logout" name="logout" style="background-color:salmon"> </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>