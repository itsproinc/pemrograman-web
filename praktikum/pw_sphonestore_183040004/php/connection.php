<?php
    // Avoid user from accessing this file directly
    if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
        die(header('Location: ../index.php'));

    function Connect() {
        $conn = new mysqli("localhost", "root", "", "sphonestore");

        if($conn->connect_error)
            die("Error 1");
        
        return $conn;
    }
?>
