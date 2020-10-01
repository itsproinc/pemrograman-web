<?php
	require_once('php/settings.php');
	require_once('php/header.php');
	require_once('php/navbar.php');
	
	require_once('php/modal.php');
	require_once('php/loadingmodal.php');
	
	$email = "";
	$token = "";
	if(isset($_GET['e'])){
		$email = filter_var($_GET['e'], FILTER_SANITIZE_EMAIL);
	}

	if(isset($_GET['t'])){
		$token = filter_var(preg_replace('/\s+/', '', $_GET['t']), FILTER_SANITIZE_STRING);
	}
?>

<!DOCTYPE html>
<html>
<head>
   	<title>Sign Up</title>
</head>

<body id="activation">
	<!-- Sign up -->
    <div class="signup">
		<!-- Sign tabs -->
      	<ul class="row signupTabs">
			<li class="signupTab col s12 m6" id="registration"><a href="signup.php">Registration</a></li>
			<li class="signupTab col s12 m6 active" id="activation">Activation</li>
		</ul>
		<!-- Activation -->
      	<div class="signupContainer">
			<div class="row">
				<div class="col s12">
					<div class="row">
						<h5 class="center white-text">Activation</h5>
							<!-- Email -->
							<div class="input-field col s12">
								<i class="material-icons prefix">email</i>
								<input placeholder="Email" type="email" class="activationEmailInput" maxlength="64" value="<?= $email ?>" required>

								<!-- Disabled -->
								<input placeholder="Email" type="email" class="activationEmailInputDisabled hide" maxlength="64" tabindex="-1" disabled>

								<div class="col s12">
									<p id="activationEmailFieldResult" class="fieldResult"></p>
								</div>
							</div>

							<!-- Token -->
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input placeholder="Token" type="text" class="activationTokenInput hide" maxlength="60" value="<?= $token ?>" required>

								<!-- Disabled -->
								<input placeholder="Token" type="text" class="activationTokenInputDisabled hide" maxlength="60" disabled>

								<div class="col s12">
									<p id="activationFieldResult" class="fieldResult"></p>
								</div>
							</div>
						</div>
						
						<!-- Resend mail -->
						<div class="row">
							<div class="col s12">
								<button class="waves-effect waves-indigo btn indigo activationResendTokenButton disabled">Resend Token (30)</button> 
							</div>

							<div class="col s12">
								<p id="activationTokenResult" class="fieldResult leftAlign fieldWarning"></p>
							</div>
						</div>						
					</div>
				</div>
            </div>
        </div>
	</div>

	<?php 
		require_once('php/footer.php');
		require_once('php/javascript.php') 
	?>
</body>
</html>