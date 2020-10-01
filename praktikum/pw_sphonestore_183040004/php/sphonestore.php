<?php
    // Avoid user from accessing this file directly
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
        die(header('Location: ../index.php'));

    require_once ('connection.php');
    require_once 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Wrong
    function cdie($message){
        $result = [
            'status' => 0,
            'message' => $message
        ];

        die(json_encode($result));
    }

    // Detect call
    if(isset($_POST['call'])) {
        switch($_POST['call']) {
            case 'checkemail': CheckEmail(); break;
            case 'checkusername': CheckUsername(); break;
            case 'signup': Signup(); break;
            case 'signin': Signin(); break;
            case 'checkactivationemail': CheckActivationEmail(); break;
            case 'checktoken': CheckToken(); break;
            case 'activateaccount': ActivateAccount(); break;
            case 'resendtoken': ResendToken(); break;
            case 'changeemail': ChangeEmail(); break;
            case 'addproduct': AddProduct(); break;
            case 'showquery': ShowQuery(); break;
            case 'editproduct': EditProduct(); break;
            case 'deleteproduct': DeleteProduct(); break;
            default: cdie("Fatal error");
        }
    }

    // Check if email valid & check if exists on database
    function CheckEmail () {
        $conn = Connect();
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            require_once '.api-key.php';

            $verification = \NeverBounce\Single::check($email, true, true);

            // Get numeric verification result
            if(($verification->result_integer) == 0) {
                if($_POST['call'] == 'checkemail') {
                    $result = [
                        'status' => 1
                    ];
                    echo (json_encode($result));
                } else
                    return true;
            } else {
                // Close
                $stmt->close();
                $conn->close();
                cdie('Email is invalid'); // Invalid
            }
        } else {
            // Close
            $stmt->close();
            $conn->close();
            cdie("Email is taken");
        }

        // Close query      
        $stmt->close();
        $conn->close();
    }

    // Check if email valid & check if exists on database
    function CheckActivationEmail () {
        $conn = Connect();
        
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if($result->num_rows == 1)
            $status = 1;
        else
            $status = 0;

        // Close query
        $stmt->close();
        $conn->close();

        $result = [
            'status' => $status,
        ];
        echo (json_encode($result));
    }

    // Check if username exists on database
    function CheckUsername () {
        $conn = Connect();
        
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            if($_POST['call'] == 'checkusername'){
                $result = [
                    'status' => 1,
                    'message' => 'Username is available'
                ];
                echo (json_encode($result));
            } else
                return true;
        } else {
            // Close
            $stmt->close();
            $conn->close();
            cdie('Username is taken');
        }

        // Close query
        $stmt->close();
        $conn->close();
    }

    // Check password and repeatpassword
    function CheckPassword() {
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $repeatPassword = filter_var($_POST['repeatPassword'], FILTER_SANITIZE_STRING);

        if($password == $repeatPassword)
            return true;
        else
        // Close
        cdie('Password and repeat password not the same');
    }

    // Captcha
    function Captcha($token) {
        // All submit start from captcha
        $fields_string = '';
        $fields = array(         
            'secret' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe', // Testing
            'response' => $token
        );

        foreach($fields as $key => $value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        $res = json_decode($result, true);

        if($res['success']) {
            return true;
        } else {
            cdie('Captcha failed, please try again');
        }
    }
    
    function AddUser(){
        $conn = Connect();
        $hashedPassword = password_hash(filter_var($_POST['password'], FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)");
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

        $stmt->bind_param("ssss", $name, $email, $username, $hashedPassword);
        if($stmt->execute()){
            return true;
        }else{
            $stmt->close();
            $conn->close();
            cdie('Unable to add user, please try again later');
        }

        // Close query
        $stmt->close();
        $conn->close();
    }

    // Signup
    function Signup() {
        $token = $_POST['token'];
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        // Verify captcha backend
        if(Captcha($token)){
            if(CheckEmail()) {
                if(CheckUsername()) {
                    if(CheckPassword()){
                        if(AddUser()){
                            if(GenerateToken(0, $email)){
                                // Finish
                                $result = [
                                    'status' => 1,
                                    'email' => $email
                                ];

                                echo (json_encode($result));
                            }
                        }
                    }
                }
            }
        }
    }

    // Signin
    function Signin() {
        $token = $_POST['token'];
        // Verify captcha backend
        if(Captcha($token)){
            $conn = Connect();
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $keepLoggedin = $_POST['keeploggedin'];

            // Get password
            $stmt = $conn->prepare("SELECT password, verified FROM users WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 1){
                if($data = $result->fetch_assoc()){
                    if(password_verify($password, $data['password'])){
                        // Password correct
                        // Check verified
                        if($data['verified'] === 0){ // Unverified
                            if(GenerateToken(0, $email)){
                                $status = 2;                               
                            }                                   
                        } elseif ($data['verified'] === 1) { // Verified
                            $status = 1;

                            // Session
                            $_SESSION['userid'] = GetUserIDByEmail($email);
                        } else {
                            $stmt->close();
                            $conn->close();
                            cdie('Unknown error!');
                        }
                    } else {
                        $stmt->close();
                        $conn->close();
                        cdie('Incorrect password');
                    }
                }
            }else{
                $stmt->close();
                $conn->close();
                cdie('Email does not exists');
            }

            // Close connection
            $stmt->close();
            $conn->close();

            // Finish
            $result = [
                'status' => $status,
                'email' => $email
            ];

            echo (json_encode($result));
        }
    }

    function CheckUserExists($userId) {
        $conn = Connect();

        // Get password
        $stmt = $conn->prepare("SELECT name FROM users WHERE userid = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            return true;
        }

        $stmt->close();
        $conn->close();
    }

    function CheckProductExists($productId) {
        $conn = Connect();

        // Get password
        $stmt = $conn->prepare("SELECT name FROM product WHERE productid = ?");
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            return true;
        }

        $stmt->close();
        $conn->close();
    }

    function GetUserIDByEmail($userEmail){
        $conn = Connect();
        $email = filter_var($userEmail, FILTER_SANITIZE_EMAIL);

        // Get password
        $stmt = $conn->prepare("SELECT userid FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            if($data = $result->fetch_assoc()){
                return $data['userid'];
            }
        }

        // Close query
        $stmt->close();
        $conn->close();
    }

    function GetUserNameByEmail($userEmail){
        $conn = Connect();
        $email = filter_var($userEmail, FILTER_SANITIZE_EMAIL);

        // Get password
        $stmt = $conn->prepare("SELECT name FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            if($data = $result->fetch_assoc()){
                return $data['name'];
            }
        }

        // Close query
        $stmt->close();
        $conn->close();
    }

    // Generate & add token
    function GenerateToken($type, $userEmail){
        $token = bin2hex(random_bytes(30));
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $email = filter_var($userEmail, FILTER_SANITIZE_EMAIL);
        $userId = GetUserIDByEmail($email);

        // Add to database
        $conn = Connect();

        // Detect if token already exists
        $stmt = $conn->prepare("SELECT * FROM tokens WHERE userid = ? AND type = ?");
        $stmt->bind_param('ii', $userId, $type);
        $stmt->execute();
        $result = $stmt->get_result(); 
        if($result->num_rows == 1){
            // Replace old with new
            $delStmt = $conn->prepare("DELETE FROM tokens WHERE userid = ? AND type = ?");
            $delStmt->bind_param("ii", $userId, $type);
            $delStmt->execute();

            $delStmt->close();
        }
        $stmt->close();

        // Add to database
        $stmt = $conn->prepare("INSERT into tokens (id, userid, type, token) VALUES (?, ?, ?, ?)");
        $null = null;

        $stmt->bind_param("iiis", $null, $userId, $type, $hashedToken);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        return SendMail($type, $token, $userEmail);
    }
    function SendMail($type, $token, $userEmail) {
        // Send mail
        $randSignature = bin2hex(random_bytes(10));
        $email = filter_var($userEmail, FILTER_SANITIZE_EMAIL);
        $name = GetUserNameByEmail($email);

        if($type == 0){
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
            $rawLink = $protocol . $_SERVER['HTTP_HOST'] . "/pw-praktikum/sphonestore/activation.php?e=" . $email . "&t=" . $token;
            $link = filter_var($rawLink, FILTER_SANITIZE_URL);
            $to      = $email;
            $subject = 'SPhoneStore - Activation';

            $message = "<body>";
            $message .= "<div style='background-color: #3949ab; text-align: center; padding:5px 15px; margin-bottom:5px'>";
            $message .= "<h2 style='color:white !important'>SPhoneStore</h2>";
            $message .= "</div>";
            
            $message .= "<div style='background-color: #3949ab; text-align: center; padding:20px'>";
            $message .= "<h2 style='color:white !important'>Activation</h2>";
            $message .= "<hr style='color:white !important'>";
            $message .= "<h3 style='color:white !important'>Hi, <b>$name</b></h3>";
            $message .= "<p style='color:white !important'>Thankyou for joining SPhoneStore, you are one step away before you are able to start buying/selling. All you need is to input this code below";
            $message .= "<h3 style='color:white !important'>$token</h3>";
            $message .= "<p style='color:white !important'>Alternatively, you can press this button below to do it for you.</p>";
            $message .= "<a href='" . $link . "' style='color:white !important'><button style='width:75%; height:50px; background-color:#7986cb; border: 0px; color: white; font-size: 20px'>Activate</button></a>";
            $message .= "<p style='color:white !important'>- This button and token only lasts for 30 minutes -</p>";
            $message .= "<hr>";
            $message .= "<p style='color:white !important'>Watch out for scammers! we would never ask your token or credentials, keep it safe</p>";
            $message .= "<div style='opacity:0'>$randSignature</div>";
            $message .= "</div>";
            $message .= "</body>";
        } elseif ($type == 1) {         
            $to      = $email;
            $subject = 'SPhoneStore - New Email Confirmation';

            $message = "<body>";
            $message .= "<div style='background-color: #3949ab; text-align: center; padding:5px 15px; margin-bottom:5px'>";
            $message .= "<h2 style='color:white !important'>SPhoneStore</h2>";
            $message .= "</div>";
            
            $message .= "<div style='background-color: #3949ab; text-align: center; padding:20px'>";
            $message .= "<h2 style='color:white !important'>New Email Confirmation</h2>";
            $message .= "<hr style='color:white !important'>";
            $message .= "<h3 style='color:white !important'>Hi, <b>$name</b></h3>";
            $message .= "<p style='color:white !important'>It seems you are trying to change your email address, if you didn't request any changes, just ignore this because your email won't be changed untill you input this token, otherwise if it's you trying to change email kindly input this token below. keep in mind you won't be receiving anymore email here and you will start receiving email on your new email.</p>";
            $message .= "<h3 style='color:white !important'>$token</h3>";
            $message .= "<p style='color:white !important'>- This token only lasts for 30 minutes -</p>";
            $message .= "<hr>";
            $message .= "<p style='color:white !important'>Watch out for scammers! we would never ask your token or credentials, keep it safe</p>";
            $message .= "<div style='opacity:0'>$randSignature</div>";
            $message .= "</div>";
            $message .= "</body>";
        }

        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->isHTML(true);
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'itsproinc@gmail.com';
            $mail->Password = 'jcvaaqzporbkbzsq';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('sphonestore@gmail.com', 'SPhoneStore');
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            cdie('Failed to send message, please try again later with error: ' . $e);
        }
    }
   
    // Check if token exists on database
    function CheckToken () {
        $type = $_POST['type'];
        
        switch($type) {
            // Activation token
            case 0:
                $conn = Connect();
                        
                $token = filter_var($_POST['token'], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $userId = GetUserIDByEmail($email);

                $stmt = $conn->prepare("SELECT token, created FROM tokens WHERE userid = ? AND type = ?");
                $stmt->bind_param("ii", $userId, $type);
                $stmt->execute();
                
                $result= $stmt->get_result();
                if($result->num_rows == 1){
                    if($data = $result->fetch_assoc()){
                        if(password_verify($token, $data['token'])){
                            if(strtotime($data['created']) > strtotime("-30 minutes")){   
                                $status = 1;
                            } else {
                                // Close query
                                $stmt->close();
                                $conn->close();
                                cdie('Token expired, please generate new one');
                            }
                        } else {
                            // Close query
                            $stmt->close();
                            $conn->close();
                            cdie("Invalid token");
                        }
                    }
                } else {
                    // Close query
                    $stmt->close();
                    $conn->close();
                    cdie("Invalid token!");
                }

                // Close query
                $stmt->close();
                $conn->close();

                $result = [
                    'status' => $status,
                ];

                echo (json_encode($result)); 
            break;
            // New email token
            case 1:
                $conn = Connect();
                        
                $token = filter_var($_POST['token'], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $userId = GetUserIDByEmail($email);

                $stmt = $conn->prepare("SELECT token, created FROM tokens WHERE userid = ? AND type = ?");
                $stmt->bind_param("ii", $userId, $type);
                $stmt->execute();
                
                $result= $stmt->get_result();
                if($result->num_rows == 1){
                    if($data = $result->fetch_assoc()){
                        if(password_verify($token, $data['token'])){
                            if(strtotime($data['created']) > strtotime("-30 minutes")){   
                                $status = 1;
                            } else {
                                // Close query
                                $stmt->close();
                                $conn->close();
                                cdie('Token expired, please generate new one');
                            }
                        } else {
                            // Close query
                            $stmt->close();
                            $conn->close();
                            cdie('Invalid token');
                        }
                    }
                } else {
                    // Close query
                    $stmt->close();
                    $conn->close();
                    cdie('Invalid token!');
                }

                // Close query
                $stmt->close();
                $conn->close();

                $result = [
                    'status' => $status,
                ];

                echo (json_encode($result)); 
            break;
        }
    }

    // Activate account
    function ActivateAccount() {
        $conn = Connect();

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $userId = GetUserIDByEmail($email);
        $type = 0;

        // Delete token
        $stmt = $conn->prepare("DELETE FROM tokens WHERE userid = ? AND type = ?");
        $stmt->bind_param("ii", $userId, $type);
        $stmt->execute();
        $stmt->close();

        // Edit user
        $accountActivate = 1;

        $stmt = $conn->prepare("UPDATE users SET verified = ? WHERE userid = ?");
        $stmt->bind_param("ii", $accountActivate, $userId);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        $result = [
            'status' => 1
        ];
        echo (json_encode($result));
    }

function ResendToken() {
    // Get verification by email
    $tokenType = $_POST['tokenType'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $conn = Connect();

    switch ($tokenType){
        case 0: // Resend
            // Resend verification
            // Check if verified and exists on database
            $stmt = $conn->prepare("SELECT verified FROM users WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 1){
                if($data = $result->fetch_assoc()){
                    if($data['verified'] === 0){ // Unverified
                        if(GenerateToken($tokenType, $email)){
                            $result = [
                                'status' => 1
                            ];
                            echo (json_encode($result));
                        }                                   
                    } elseif ($data['verified'] === 1) { // Verified
                        $stmt->close();
                        $conn->close();
                        cdie('Email already verified');
                    } else {
                        $stmt->close();
                        $conn->close();
                        cdie('Unknown error');
                    }
                }
            }else{
                $stmt->close();
                $conn->close();
                cdie('Email not registered');
            }
        break;

        case 1: // Resend with no email verification
            if(GenerateToken($tokenType, $email)){
                $result = [
                    'status' => 1
                ];
                echo (json_encode($result));
            }
        break;
    }
}

function ChangeEmail() {
    $conn = Connect();

    $email = filter_var($_POST['email']);
    $oldEmail = filter_var($_POST['oldemail']);

    $userId = GetUserIDByEmail($oldEmail);
    $type = 1;

    // Delete token
    $stmt = $conn->prepare("DELETE FROM tokens WHERE userid = ? AND type = ?");
    $stmt->bind_param("ii", $userId, $type);
    $stmt->execute();
    $stmt->close();

    // Change user email
    $stmt = $conn->prepare("UPDATE users SET email = ? WHERE userid = ?");
    $stmt->bind_param("si", $email, $userId);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    $result = [
        'status' => 1
    ];
    echo (json_encode($result));
}

function LoadMiniProfile($userid) {
    $conn = Connect();

    $stmt = $conn->prepare("SELECT name, balance, points, membertype FROM users WHERE userid = ?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();   
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        if($data = $result->fetch_assoc()){
            $result = [
                'name' => $data['name'],
                'balance' => $data['balance'],
                'points' => $data['points'],
                'membertype' => $data['membertype']
            ];
            return json_encode($result);
        }
    }
    
    $stmt->close();
    $conn->close();
}

function LoadUserProfile($userid) {
    $conn = Connect();

    $stmt = $conn->prepare("SELECT email, telp FROM users WHERE userid = ?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();   
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        if($data = $result->fetch_assoc()){
            $result = [
                'email' => $data['email'],
                'telp' => $data['telp']
            ];
            return json_encode($result);
        }
    }
    
    $stmt->close();
    $conn->close();
}

function AddProduct() {
    $token = $_POST['token'];
    $imageData = json_decode(stripslashes($_POST['imagedata']));
    $userId = $_POST['userid'];
    $productName = filter_var($_POST['productname'], FILTER_SANITIZE_STRING);
    $productSKU = filter_var($_POST['productsku'], FILTER_SANITIZE_STRING);
    $productStock = filter_var($_POST['productstock'], FILTER_SANITIZE_NUMBER_INT);
    $productDescription = filter_var($_POST['productdescription'], FILTER_SANITIZE_STRING);
    $productCondition = filter_var($_POST['productcondition'], FILTER_SANITIZE_NUMBER_INT);
    $productPrice = filter_var($_POST['productprice'], FILTER_SANITIZE_NUMBER_INT);
    $productWeight = filter_var($_POST['productweight'], FILTER_SANITIZE_NUMBER_INT);
    
    // Verify captcha backend
    if(Captcha($token)){
        // Upload all image
        $conn = Connect();
        $stmt = $conn->prepare("INSERT into product (productid, name, sku, stock, description, productcondition, price, weight, image, userid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $null = null;
        $empty = '';
        $stmt->bind_param("issisiiisi", $null, $productName, $productSKU, $productStock, $productDescription, $productCondition, $productPrice, $productWeight, $empty, $userId);
        
        $stmt->execute();
        $stmt->close();

        // Get productid
        $stmt = $conn->prepare("SELECT productid FROM product WHERE name = ? AND sku = ? AND stock = ? AND description = ? AND productcondition = ? AND price = ? AND weight = ? AND image = ? AND userid = ?");

        $null = null;
        $empty = '';
        $stmt->bind_param("ssisiiisi", $productName, $productSKU, $productStock, $productDescription, $productCondition, $productPrice, $productWeight, $empty, $userId);
        
        $stmt->execute();   
        $result = $stmt->get_result();

        if($result->num_rows == 1){
            if($data = $result->fetch_assoc()){
                $pId = $data['productid'];
            }
        }

        $stmt->close();

        $imgLink = array();
        for ($i=0; $i < count($imageData); $i++) {            
            array_push($imgLink, UploadImage($userId, $imageData[$i], $data['productid']));
        }


        // Add product to database
        $image = json_encode($imgLink);

        // Update iamge
        // Upload all image
        $conn = Connect();
        $stmt = $conn->prepare("UPDATE product SET image = ? WHERE productid = ?" );

        $stmt->bind_param("si", $image, $pId);
        
        $stmt->execute();
        $stmt->close();
        $conn->close();

        $result = [
            'status' => 1
        ];
        echo json_encode($result);
    }
}

function UploadImage($userid, $img, $productid) {
    $unique = bin2hex(random_bytes(15));
    $folderPath = "../img/";

    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $link = $folderPath . $unique . '.png';

    file_put_contents($link, $image_base64);

    // Insert database
    $conn = Connect();
    $stmt = $conn->prepare("INSERT into images (id, userid, productid, link) VALUES (?, ?, ?, ?)");

    $null = null;
    $stmt->bind_param("iiis", $null, $userid, $productid, $link);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    return $link;
}

function LoadProfileProduct($userId) {
    $conn = Connect();

    $stmt = $conn->prepare("SELECT productid, name, sku, stock, price, image FROM product WHERE userid = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();   
    $result = $stmt->get_result();

    if($result->num_rows >= 1){
        $products = array();
        while($row = $result->fetch_assoc()) {
            $products[] = array($row);
        }
        return json_encode($products);
    }
    
    $stmt->close();
    $conn->close();
}

function LoadProduct($id) {
    $conn = Connect();

    $stmt = $conn->prepare("SELECT productid, name, stock, description, productcondition, price, weight, image, userid FROM product WHERE productid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();   
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        if($data = $result->fetch_assoc()){
            return json_encode($data);
        }
    }
    
    $stmt->close();
    $conn->close();
}

function LoadAllProduct() {
    $conn = Connect();

    $stmt = $conn->prepare("SELECT productid, name, stock, description, productcondition, price, weight, image, userid FROM product");
    $stmt->execute();   
    $result = $stmt->get_result();

    if($result->num_rows >= 1){
        $products = array();
        while($row = $result->fetch_assoc()) {
            $products[] = array($row);
        }

        return json_encode($products);
    }
    
    $stmt->close();
    $conn->close();
}

function ShowQuery() {
    $conn = Connect();

    $type = $_POST['type'];

    if($type == 0) {
        if(isset($_POST['search']) && !empty($_POST['search'])) {
            $search = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
            $searchQuery = "name LIKE '%$search%'";
        } else
            $searchQuery = '1';

        $sort = $_POST['sort'];
        if(isset($_POST['sort']) && !empty($_POST['sort'])) {
        switch($_POST['sort']){
            case 'az':
                    $sortQuery = "ORDER BY name ASC";
            break;

            case 'za':
                    $sortQuery = "ORDER BY name DESC";
            break;

            case 'r':
                    $sortQuery = 'AND 1';
            break;

            case 'lh':
                    $sortQuery = "ORDER BY price ASC";
            break;

            case 'hl':
                    $sortQuery = "ORDER BY price DESC";
            break;
        }
        } else
            $sortQuery = 'AND 1';
    }

    switch($type){
        case 0: // Index
            $conn = Connect();

            $query = "SELECT productid, name, stock, description, productcondition, price, weight, image, userid FROM product WHERE $searchQuery $sortQuery";
            $stmt = $conn->prepare($query);
            $stmt->execute();   
            $result = $stmt->get_result();

            if($result->num_rows >= 1){
                $products = array();
                while($row = $result->fetch_assoc()) {
                    $products[] = array($row);
                }

                echo json_encode($products);
            }
            
            $stmt->close();
            $conn->close();
        break;

        case 1:
            $id = $_POST['id'];
            $conn = Connect();

            $stmt = $conn->prepare("SELECT * FROM product WHERE productid = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();   
            $result = $stmt->get_result();

            if($result->num_rows >= 1){
                $products = array();
                while($row = $result->fetch_assoc()) {
                    $products[] = array($row);
                }
                echo json_encode($products);
            }
            
            $stmt->close();
            $conn->close();
        break;
    }
}

function PDFReport($id) {
    require("phpToPDF.php"); 

    $products = json_decode(LoadProfileProduct($id), true);

    if($products == null){
        return;
    }

    $message = "<body>";
    $message .= "<div style='background-color: #3949ab; text-align: center; padding:5px 15px; margin-bottom:5px'>";
    $message .= "<h2 style='color:white !important'>SPhoneStore</h2>";
    $message .= "</div>";
    $message .= "<div style='background-color: #3949ab; text-align: center; padding:20px'>";
    $message .= "<h2 style='color: white'>Store Reporting</h2>";
    $message .= "<hr>";

    $message .= "<table border='1px' cellpadding='5px' style='color: white'>";
    $message .= "<tr>";
    $message .= "<th>Name</th>";
    $message .= "<th>Price</th>";
    $message .= "<th>SKU</th>";
    $message .= "<th>Stock</th>";
    $message .= "</tr>";

    foreach ($products as $prod) {
        $data = $prod[0];
        $message .= "<tr>";
        $message .= "<td>" . $data['name'] . "</td>";
        $message .= "<td>" . $data['price'] . "</td>";
        $message .= "<td>" . $data['sku'] . "</td>";
        $message .= "<td>" . $data['stock'] . "</td>";
        $message .= "</tr>";                
    }

    $message .= "</table>";
    $message .= "</div>";
    $message .= "</body>";

    $pdf_options = array(
    "source_type" => 'html',
    "source" => $message,
    "action" => 'save',
    "save_directory" => '',
    "file_name" => 'sphonestore.pdf');

    phptopdf($pdf_options);

    header("Location: sphonestore.pdf");
}

function EditProduct() {
    $token = $_POST['token'];
    $imageData = json_decode(stripslashes($_POST['imagedata']));
    $productId = $_POST['productid'];
    $userId = $_POST['userid'];
    $productName = filter_var($_POST['productname'], FILTER_SANITIZE_STRING);
    $productSKU = filter_var($_POST['productsku'], FILTER_SANITIZE_STRING);
    $productStock = filter_var($_POST['productstock'], FILTER_SANITIZE_NUMBER_INT);
    $productDescription = filter_var($_POST['productdescription'], FILTER_SANITIZE_STRING);
    $productCondition = filter_var($_POST['productcondition'], FILTER_SANITIZE_NUMBER_INT);
    $productPrice = filter_var($_POST['productprice'], FILTER_SANITIZE_NUMBER_INT);
    $productWeight = filter_var($_POST['productweight'], FILTER_SANITIZE_NUMBER_INT);

    // Verify captcha backend
    if(Captcha($token)){
        $conn = Connect();
        // Upload all image
        $imgLink = array();
        for ($i=0; $i < count($imageData); $i++) {
            $rawImageData = $imageData[$i];
            if(substr($rawImageData, 0, 5) != 'data:') {
                $path = "../" . $rawImageData;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $fixedImageData = 'data:image/' . $type . ';base64,' . base64_encode($data);
            } else{
                $fixedImageData = $rawImageData;
            }

            array_push($imgLink, UploadImage($userId, $fixedImageData, $productId));
        }

        // Update product to database
        $image = json_encode($imgLink);
        
        $stmt = $conn->prepare("UPDATE product SET name = ?, sku = ?, stock = ?, description = ?, productcondition = ?, price = ?, weight = ?, image = ? WHERE productid = ?");

        $stmt->bind_param("ssisiiisi", $productName, $productSKU, $productStock, $productDescription, $productCondition, $productPrice, $productWeight, $image, $productId);
        
        $stmt->execute();
        $stmt->close();
        $conn->close();

        $result = [
            'status' => 1
        ];
        echo json_encode($result);
    }
}

function DeleteProduct() {
    $productId = $_POST['productid'];
    $userId = $_POST['userid'];

    $conn = Connect();
    $stmt = $conn->prepare("DELETE FROM images WHERE productid = ? AND userid = ?");
    $stmt->bind_param("ii", $productId, $userId);
    $stmt->execute();
    $stmt->close();
    
    $stmt = $conn->prepare("DELETE FROM product WHERE productid = ? AND userid = ?");
    $stmt->bind_param("ii", $productId, $userId);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    $result = [
        'status' => 1
    ];
    echo json_encode($result);
}

?>