<?php
    session_start();

    if(isset($_SESSION['username'])){
        header("Location: index.php");
        exit;
    }

    if(isset($_POST['login'])){
        require 'functions.php';
        $username = $_POST['username'];
        $password = $_POST['password'];

        $cek_user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");

        if(mysqli_num_rows($cek_user) == 1){
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            $error = 'Username / Password Salah!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>

    <?php if(isset($error)): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif ?>
</head>
<body>
    <h3>Login</h3>

    <form action="" method="POST">
        <li>
            <label for="username">Username: </label>
            <input type="text" name="username">
        </li>

        <li>
            <label for="password">Password: </label>
            <input type="password" name="password">
        </li>

        <li>
            <button type="submit" name="login">Login</button>
        </li>
    </form>
</body>
</html>