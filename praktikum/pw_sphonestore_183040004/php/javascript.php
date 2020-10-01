<?php
    // Avoid user from accessing this file directly
    if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
        die(header('Location: ../index.php'));
?>

<!DOCTYPE html>
<body>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/sphonestore.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>