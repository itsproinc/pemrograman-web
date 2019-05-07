<?php
    require 'functions.php';

    if(isset($_POST['registrasi'])) {
        if(registrasi($_POST) > 0) {
            echo "<script>
                alert('Registrasi Berhasil!');
                document.location.href = 'login.php';
                </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Registrasi</title>
</head>
<body>
    <h3>Form Registrasi</h3>
    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">Username: </label><br>
                <input type="text" name="username" required>
            </li>

            <li>
                <label for="username">Password: </label><br>
                <input type="password" name="password1" required>
            </li>

            <li>
                <label for="username">Konfirmasi Password: </label><br>
                <input type="password" name="password2" required>
            </li>

            <li>
                <button type="submit" name="registrasi" required>Registrasi</button>
            </li>
        </ul>
    </form>
</body>
</html>