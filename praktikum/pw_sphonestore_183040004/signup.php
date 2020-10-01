<?php
require_once('php/settings.php');
require_once('php/header.php');
require_once('php/navbar.php');
	
require_once('php/modal.php');
require_once('php/loadingmodal.php');
?>

<!DOCTYPE html>
<html>
<head>
   	<title>Sign Up</title>
</head>

<body>
	<!-- Sign up -->
   <div class="signup">
		<!-- Sign tabs -->
      	<ul class="row signupTabs">
            <li class="signupTab col s12 m6 active" id="registration">Registration</li>
            <li class="signupTab col s12 m6" id="activation"><a href="activation.php">Activation</a></li>
		   </ul>
         <!-- Sign up -->
         <div class="signupContainer">
            <div class="row">
               <!-- Sign up input -->
               <div class="col s12 m6 signupInput">
                  <div class="row">
                     <h5 class="center white-text">Sign Up</h5>

                     <!-- Full name -->						
                     <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input placeholder="Full Name" type="text" maxlength="32" class="nameInput" required autofocus>
                     </div>

                     <!-- Email -->
                     <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input placeholder="Email" type="email" class="emailInput" id="registerEmail" maxlength="64" required>

                        <!-- Disabled -->
                        <input placeholder="Email" type="email" class="emailInputDisabled hide" maxlength="64" tabindex="-1" disabled>

                        <div class="col s12">
                           <p id="emailFieldResult" class="fieldResult"></p>
                        </div>
                     </div>

                     <!-- Username -->
                     <div class="input-field col s12">
                        <i class="material-icons prefix">text_fields</i>
                        <input placeholder="Username" type="text" class="usernameInput" id="registerUsername" maxlength="16" required>

                        <!-- Disabled -->
                        <input placeholder="Username" type="text" class="usernameInputDisabled hide"  maxlength="16" tabindex="-1" disabled>

                        <div class="col s8">
                           <p class="fieldInfo">*Username must be 8-16 characters, no spaces allowed, and only _ symbol are allowed <br> *Username can't be changed later. <a class="tooltipped" data-position="right" data-tooltip="Username will be visible to public"><i class="material-icons tooltip">help</i></a></p>	
                        </div>		

                        <div class="col s4">
                           <p id="usernameFieldResult" class="fieldResult"></p>
                        </div>					
                     </div>

                     <!-- Password -->
                     <div class="input-field col s12 seePasswordable">
                        <i class="material-icons prefix">lock</i>
                        <input placeholder="Password" type="password" class="passwordInput" maxlength="32" required tabindex="0">

                        <!-- Visible -->
                        <input placeholder="Password" type="text" class="passwordInputShow hide" maxlength="32" tabindex="-1">

                        <a class="showPassword"><i class="material-icons prefix seePassword" tabindex="-1">remove_red_eye</i></a>
                     </div>

                     <!-- Repeat password -->
                     <div class="input-field col s12 seePasswordable">
                        <i class="material-icons prefix">lock</i>
                        <input placeholder="Repeat Password" type="password" class="repeatPasswordInput" maxlength="32" required tabindex="0">

                        <!-- Visible -->
                        <input placeholder="Repeat Password" type="text" class="repeatPasswordInputShow hide" maxlength="32" tabindex="-1">

                        <a class="showRepeatPassword"><i class="material-icons prefix seePassword" tabindex="-1">remove_red_eye</i></a>

                        <div class="col s8">
                           <p class="fieldInfo">*Password must be 8-32 characters, no spaces allowed, and only !@#%^&* symbols are allowed.</p>
                        </div>

                        <div class="col s4">
                           <p id="passwordFieldResult" class="fieldResult"></p>
                        </div>													
                     </div>	
                  </div>

                  <div class="row center">
                     <p class="accept">
                        By clicking "Sign Up", you agree to our <a href="">Terms of Service</a> and <a href="">Privacy Policy</a>
                     </p>

                     <!-- Submit -->
                     <div class="col s12">
                        <button class="waves-effect waves-indigo btn indigo signupButton disabled">Sign Up</button> 
                     </div>
                  </div>
               </div>
               
               <!-- Sign Up info -->
               <div class="col s12 m6 signupInfo">
                  <div class="row">
                     <div class="card-panel blue center">
                        <div class="white-text">
                           <b>Buy and sell with ZERO concern</b>
                        </div>
                        <br>
                        <div class="white-text">
                           Worry free from fraud.
                        </div>
                     </div>

                     <div class="card-panel blue center">
                        <div class="white-text">
                           <b>24/7 Support</b>
                        </div>
                        <br>
                        <div class="white-text">
                           Our customer support is on alert 24/7 to help you with your issue or just to answer your general inquiry.
                        </div>
                     </div>

                     <div class="card-panel blue center">
                        <div class="white-text">
                           <b>High Standards</b>
                        </div>
                        <br>
                        <div class="white-text">
                           We ensure every smartphone thats sold here must follow our high-standard rules to ensure quality and durability.
                        </div>
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