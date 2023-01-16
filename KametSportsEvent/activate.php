<?php
error_reporting(E_ALL);
require_once './includes/header.php';
$UserID = $_REQUEST['token'];
$tokenID = base64_decode($UserID);
$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$SliderStmt = $db->prepare("SELECT * FROM `v_users` WHERE `UserID`=$tokenID");
$SliderStmt->execute();
$UserData = $SliderStmt->fetch(PDO::FETCH_ASSOC);
if ($UserData['EmailVerificationStatus'] == 'Y') { ?>

<br><br>
<div class="signUp-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-5 col-md-offset-4">
                    <div class="sign-up-content-inner-area">
                        <div class="sign-up-bar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="sign-up-bar-left">
                                        <center><p> Kamet Sports Event </p></center>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sign-up-field-container"><br><br>
                            <div class="single-field-container">
                                <div class="row">
                            <div class="section">    

                                <h3 class="text-center">This account is already activated</h3>
                            </div>
                            <div class="section"><br>
                                <center><button type="button" class="btn btn-lg btn-success" onclick="window.location = 'login';">Go to Login</button></center>
                            </div>
                    </div>
                            </div> <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<br>
<?php } else {
//    echo "UPDATE v_users SET EmailVerificationStatus='Y' where UserID = '" . $tokenID . "'";
    $Query = $db->prepare("UPDATE v_users SET EmailVerificationStatus='Y' where UserID = '" . $tokenID . "'");
    $Query->execute();
    ?>

<br><br>
<div class="signUp-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-5 col-md-offset-4">
                    <div class="sign-up-content-inner-area">
                        <div class="sign-up-bar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="sign-up-bar-left">
                                        <center><p> Kamet Sports Event </p></center>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sign-up-field-container"><br><br>
                            <div class="single-field-container">
                                <div class="row">
                            <div class="section">    
                        <h2 class="PageTitle text-center"><b>Welcome to Kamet Sports Event!</b></h2><br>
                        <!--<h3 class="text-center">Thank you for Activate your Account</h3>-->
                        <h3 class="text-center">Congratulation Your Account Activated Successfully</h3>
                    </div>
                    <div class="section"><br>
                        <center><button type="button" class="btn btn-lg btn-success" onclick="window.location = 'login';">Go to Login</button></center>
                            </div>
                    </div>
                            </div> <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<br>
<?php }require_once './includes/footer.php'; ?>
