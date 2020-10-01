<?php
    // Avoid user from accessing this file directly
    if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
        die(header('Location: ../index.php'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--Import materialize.css -->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"/>
    <!--Import main.css -->
    <link type="text/css" rel="stylesheet" href="css/sphonestore.css"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <!-- Captcha -->
	<!-- TESTING -->
    <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI" data-callback="Captcha" data-error-callback="ResetButton" data-size="invisible"></div>
	<input type="hidden" id="recaptcha-callback">
</body>
</html>