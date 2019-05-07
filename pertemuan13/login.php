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

        $cek_user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        if(mysqli_num_rows($cek_user) == 1){
            $user = mysqli_fetch_assoc($cek_user);
            // cek password
            if(password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                header('Location: index.php');
            } else {
                $error = 'Password salah!';
            }
        } else {
            $error = 'Username belum terdaftar';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <h3>Login</h3>

    <?php if(isset($error)): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif ?>

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

    <li>
        <a href="registrasi.php"><button>Registrasi</button></a>
    </li>
</body>
</html>