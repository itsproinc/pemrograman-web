<?php
    // Avoid user from accessing this file directly
    if(isset($_POST['signout'])){
        session_start();
        session_destroy();
    } else {
       die(header('Location: ../index.php')); 
    }
?>