<?php
    // Avoid user from accessing this file directly
    if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
        die(header('Location: ../index.php'));

    $loggedin = false;
    $nontification = 0;

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['userid'])) {
        $loggedin = true;

        // Load mini player profile
        require_once('sphonestore.php');
        $miniProfile = json_decode(LoadMiniProfile($_SESSION['userid']), true);

        $name = $miniProfile['name'];
        $balance = number_format($miniProfile['balance'], 2, ',', '.');
        $points = number_format($miniProfile['points'], 2, ',', '.');
        $membertype = ($miniProfile['membertype']) ? "Premium member & merchant" : "Regular member & merchant"; 

        
    }

    require_once('bghover.php')
?>

<!DOCTYPE html>
<html>
<body>
    <!-- Sign in bar -->
    <div class="userBar">
        <div class="userContainer">
            <!-- Userbox -->
            <!-- Cart amount badge -->
            <?php if($nontification > 0): ?>
                <span class="nontificationBadge"> <?= $nontification ?> </span>
            <?php endif ?>

            <button class="waves-effect waves-indigo btn-flat accountButton">
                <div>
                    <li class="valign-wrapper">
                        <i class="material-icons valign">account_circle</i>
                        <span>My Account</span>
                    </li> 
                </div>
            </button> 

            <!-- User info box -->
            <div class="userInfoContainer">
                <?php if(!$loggedin): ?>
                    <!-- Not logged in -->
                    <div class="row">
                        <h6 class="center">Sign In</h6>
                        <!-- Email -->
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>

                          <input placeholder="Email" type="email" class="signinEmailInput" name="email" maxlength="64" required>
                        </div>

                        <!-- Password -->
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            
                            <input placeholder="Password" id="icon_telephone" type="password" class="signinPasswordInput" name="password" maxlength="16" required>
                        </div>

                        <!-- Keep logged in -->
                        <p>
                            <label class="checkContainer">
                                <input type="checkbox" class="checkbox-white filled-in saveEmail"/>
                                <span>Keep Logged In</span>
                            </label>
                        </p>
                        
                        <!-- Sign in -->
                        <div class="col s12">
                            <button class="waves-effect waves-indigo btn signinButton disabled" type="submit" name="signin">Sign in</button>
                        </div>
                        
                        <div class="col s12
                        ">
                            <p id="signinResult" class="signinResult"></p>
                        </div>
            
                        <div class="divider"></div>  
                        <!-- Forgot password -->
                        <p class="center signinText">Forgot Password?</p>
                        <div class="input-field col s12">
                            <a href="">
                            <span class="waves-effect waves-indigo btn">Forgot Password</span>
                            </a>
                        </div>
                        
                        <!-- Sign Up -->
                        <p class="center signinText">No Account Yet?</p>
                        <div class="input-field col s12">
                            <a href="signup.php">
                            <span class="waves-effect waves-indigo btn">Sign Up Now!</span>
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <div class="miniProfile">
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

                        <div class="miniProfileInfo">
                            <div class="col s6">                    
                                <p>Balance: Rp <?= $balance ?></p>
                                <p>Points: <?= $points ?></p>
                            </div>

                            <div class="col s6 miniProfileButton">
                                <a href="profile.php"><button class="waves-effect waves-indigo btn">Profile</button></a>
                                
								<a href="shop.php"><button class="waves-effect waves-indigo btn">My Shop</button></a>
                            </div>
                        </div>

                        <button class="waves-effect waves-indigo btn signoutButton">Sign Out</button>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <!-- Cart box -->
        <div class="cartContainer">
            <!-- Cart amount badge -->
            <span class="amountBadge">0</span>
            
            <button class="waves-effect waves-indigo btn-flat"><i class="material-icons">shopping_cart</i></button>
        </div>
    </div>
</body>
</html>
        
