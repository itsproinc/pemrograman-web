<?php
    require 'function.php';

    if(isset($_COOKIE['id']) && isset($_COOKIE['hash'])) {
        $id = $_COOKIE['id'];
        $hash = $_COOKIE['hash'];

        $result = mysqli_query(koneksi(), "SELECT * FROM user WHERE username = '$username'");
        $row = mysqli_fetch_assoc($result);

        if($hash === hash('sha256', $row['id'], false)) {
            $_SESSION['user'] = $row['username'];
            header("Location: index.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">

    <style>
        .login {
            width: 30vw;
            height: 45vw;
            background-color: skyblue;
            border: 1px solid black;

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
        $error = "";
        session_start();
        if(isset($_SESSION['user'])) {
            header("Location: ../index.php");
        }

        if(isset($_POST['login']))
        {
            if(isset($_POST['username']) && isset($_POST['password']))
            {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $cek_user = mysqli_query(koneksi(), "SELECT * FROm user WHERE username = '$username'");

                if(mysqli_num_rows($cek_user) > 0) {
                    $row = mysqli_fetch_assoc($cek_user);

                    if(password_verify($password, $row['password'])) {
                        $_SESSION['user'] = $_POST['user'];
                        $_SESSION['hash'] = hash('sha256', $row['id'], false);

                        if(isset($_POST['remember'])) {
                            setcookie('user', $row['username'], time() + 60 * 60 * 24);
                            $hash = hash('sha256', $row['id']);
                            setcookie('hash', $hash, time() + 60 * 60 * 24);
                        }

                        if(hash('sha256', $row['id']) == $_SESSION['hash']) {
                            header("Location: index.php");
                            die;
                        }

                        die(header("Location: index.php"));
                    }
                    else
                        $error = "ID/Password salah";
                }
                else
                    $error = "ID/Password salah";
            }
        }
    ?>

    <a href="frontend.php">Kembali</a>
    <div class="login">
        <h1>Login Admin</h1>

        <img src="img/admin.png">

        <p style="color:red"> <?= $error ?> </p>

        <form method="post" action="">
            <table style="margin: 0 auto;">
                <tr>
                    <td> <label for="uname">Username: </label> </td>
                    <td> <input type="text" name="username"><br> </td>
                </tr>

                <tr>
                    <td> <label for="uname">Password: </label> </td>
                    <td> <input type="password" name="password"><br> </td>
                </tr>

                <tr>
                    <td>
                        <div class="input-group">
                            <label for="remember">Remember Me</label>
                            <input type="checkbox" id="rembember" name="remember">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="float: left"> <input type="submit" value="login" name="login" style="background-color:lime"> </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>