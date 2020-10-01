<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['userid'])) 
		die(header('Location: index.php'));
		
	$menu = 0;
	if(isset($_GET['m']))
		$menu = $_GET['m'];
	else
		header('Location: profile.php?m=0');

  require_once('php/settings.php');
	require_once('php/header.php');
	require_once('php/navbar.php');
	
	require_once('php/modal.php');
	require_once('php/loadingmodal.php');

	require_once('php/sphonestore.php');
	$miniProfile = json_decode(LoadMiniProfile($_SESSION['userid']), true);

  $name = $miniProfile['name'];
  $balance = number_format($miniProfile['balance'], 2, ',', '.');
  $points = number_format($miniProfile['points'], 2, ',', '.');
	$membertype = ($miniProfile['membertype']) ? "Premium member" : "Regular member"; 
	
	require_once('php/sidenav/profilesidenav.php');
	$profile = json_decode(LoadUserProfile($_SESSION['userid']), true);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
</head>

<body>
	<!-- Change Email Modal -->
	<div class="modal changeEmailModal hide">
		<div class="modalContent">
			 <a href="#"><i class="material-icons closeBtn">close</i></a>
			 <input type="hidden" class="oldEmail" value="<?= $profile['email'] ?>">

			<div class="col s12">
        <!-- Email -->
				<div class="input-field col s12">
					<i class="material-icons prefix">email</i>
					<input placeholder="New Email" type="email" class="changeEmailInput" id="changeEmail" maxlength="64" required>

					<!-- Disabled -->
					<input placeholder="Email" type="email" class="changeEmailInputDisabled hide" maxlength="64" tabindex="-1" disabled>

					<div class="col s12">
							<p id="changeEmailFieldResult" class="modalFieldResult"></p>
					</div>
				</div>

				<!-- Token -->
				<div class="input-field col s12">
					<i class="material-icons prefix">vpn_key</i>
					<input placeholder="Token" type="text" class="changeEmailTokenInput hide" maxlength="60" value="" required>

					<!-- Disabled -->
					<input placeholder="Token" type="text" class="changeEmailTokenInputDisabled hide" maxlength="60" disabled>

					<div class="col s12">
						<p id="changeEmailTokenFieldResult" class="modalFieldResult"></p>
					</div>
				</div>

				<!-- Resend mail -->
				<div class="row">
					<div class="col s12">
						<button class="waves-effect waves-indigo btn indigo changeEmailResendTokenButton disabled">Resend Token (30)</button> 
					</div>

					<div class="col s12">
						<p id="changeEmailResendTokenResult" class="fieldResult leftAlign fieldWarning"></p>
					</div>
				</div>
			</div>
		</div>
	</div> 

	<div class="content">
		<!-- User profile side bar -->
		<div class="row">
			<div class="col m4 hide-on-small-only">
				<div class="myAccountMiniProfile">
					<img src="" alt="" class="miniProfilePicture">

					<div class="miniProfileDesc">
						<div>
								<p><b><?= $name ?></b></p>
						</div>

						<div>
								<p class="smaller-text"><?= $membertype ?><p>
						</div>
					</div>   
				</div>

				<div class="myAccountSideBar">
					<!-- Profile -->
					<a href="?m=0">
						<button class="waves-effect waves-indigo btn">
							<div>
								<li class="valign-wrapper">
									<i class="material-icons">account_circle</i>
									<span>Profile</span>
								</li> 
							</div>
						</button> 
					</a>   
					
					<!-- Addresses -->
					<a href="">
						<button class="waves-effect waves-indigo btn">
							<div>
								<li class="valign-wrapper">
									<i class="material-icons">home</i>
									<span>Addresses</span>
								</li> 
							</div>
						</button>
					</a>

					<!-- Bank & Payment -->
					<a href="">
						<button class="waves-effect waves-indigo btn">
							<div>
								<li class="valign-wrapper">
									<i class="material-icons">account_balance</i>
									<span>Bank & Payment</span>
								</li> 
							</div>
						</button>  
					</a>  

					<!-- Change Password -->
					<a href="">
						<button class="waves-effect waves-indigo btn">
							<div>
								<li class="valign-wrapper">
									<i class="material-icons">security</i>
									<span>Change Password</span>
								</li> 
							</div>
						</button>  
					</a>
					<hr>

					<!-- My Orders -->
					<a href="">
						<button class="waves-effect waves-indigo btn">
							<div>
								<li class="valign-wrapper">
									<i class="material-icons">shopping_cart</i>
									<span>My Orders</span>
								</li> 
							</div>
						</button>  
					</a>   
				</div>
			</div>
			
			<!-- Profile -->
			<?php if($menu == 0): ?>
				<div class="col m8 s12">
					<div class="contentBG">
						<h6>My Profile</h6>
						<p class="smaller-text">Manage your profile information</p>
						<hr>

						<!-- Email -->
						<div class="row">
							<div class="contentItem">
								<div class="input-field col s12">
									<!-- Disabled -->
									<i class="material-icons prefix">email</i>
									<input placeholder="Email" type="email" class="" maxlength="64" tabindex="-1" value="<?= $profile['email'] ?>" disabled >
								</div>

								<div class="col s12">
										<a href="#" class="changeButton smaller-text changeEmail">Change</a>
								</div>
							</div>
						</div>

						<!-- Telp -->
						<div class="row">
							<div class="contentItem">
								<div class="input-field col s12">
									<!-- Disabled -->
									<i class="material-icons prefix">local_phone</i>
									<input placeholder="Telphone" type="tel" class="" maxlength="15" tabindex="-1" value="<?= $profile['telp'] ?>" disabled>
								</div>

								<div class="col s12">
										<a href="#" class="changeButton smaller-text">Change</a>
								</div>
							</div>
						</div>

						<!-- Gender -->
						<div class="row">
							<div class="contentItem">
								<div class="col s8">
									<p class="singleLine">Gender</p>
									<!-- Dropdown Trigger -->
									<a class='dropdown-trigger btn singleLine' href='#' data-target='genderSelector'>Change</a>

									<!-- Dropdown Structure -->
									<ul id='genderSelector' class='dropdown-content'>
										<li><a href="#!">Male</a></li>
										<li><a href="#!">Female</a></li>
										<li><a href="#!">Non-Binary</a></li>
									</ul>
								 </div>
							</div>
						</div>

					</div>
				</div>
			<?php endif ?>
		</div>
	</div>

	<?php 
		require_once('php/footer.php');
		require_once('php/javascript.php') 
	?>
</body>
</html>