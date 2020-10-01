<?php
    // Avoid user from accessing this file directly
    if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
        die(header('Location: ../index.php'));
?>

<!DOCTYPE html>
<html>
<body>
    <div class="footer">
        This site is protected by reCAPTCHA and the Google
        <a href="https://policies.google.com/privacy">Privacy Policy</a> and
        <a href="https://policies.google.com/terms">Terms of Service</a> apply.
    </div>
</body>
</html>