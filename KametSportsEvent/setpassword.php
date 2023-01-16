<?php
require_once './includes/header.php';

if (isset($_SESSION[SESSION_ALIAS]['session']['login_status']) && $_SESSION[SESSION_ALIAS]['session']['login_status']=='Yes') {
    echo '<script>window.location.href="admin/home"</script>';
}
?>
<div class="signUp-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-5 col-md-offset-4">
                    <div class="sign-up-content-inner-area">
                        <div class="sign-up-bar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="sign-up-bar-left">
                                        <center><p>
                                            Change Password
                                            </p></center>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <form action="#">
                             
                            <div class="sign-up-field-container">
                                <div class="single-field-container">
                                    <span class="alert alert_box_error"></span>
                            <span class="alert alert_box_success"></span>
                                    <div class="form-group">
                                        
                                        <label for="UserName">
                                            <span>
                                                New Password
                                            </span>
                                        </label>
                                        <input id="ForgotNewPassword" name="ForgotNewPassword" class=" required" placeholder="New Password" required autofocus type="password">
                                    </div>
                                </div>
                                <div class="single-field-container">
                                    <div class="form-group">
                                        <label for="f2">
                                            <span>
                                                Confirm Password
                                            </span>
                                        </label>
                                        <input id="ForgotConfirmPassword" name="ForgotConfirmPassword" placeholder="Confirm Password" class=" required" required type="password">
                                    </div>
                                </div>
                                <div class="single-field-container">
                                    <div class="form-group">
                                        <label for="f2">
                                            <span>
                                                Password Token
                                            </span>
                                        </label>
                                        <input id="ForgotPasswordToken" name="ForgotPasswordToken" placeholder="Token" class=" required" required type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="sign-up-bottom-content">
                                <ul>
                                    <li>
                                        <div class="sign-up-submit-btn">
                                            <div class="col-lg-12">
                                                <div class="col-lg-4">
                                                </div>
                                                <div class="col-lg-5">
                                                    <input type="hidden" id="ForgotPasswordUserID" value="<?php echo $_REQUEST['UserID']; ?>">
                                                    <button class="" type="button" onclick="ChangePassword('ForgotNewPassword','ForgotConfirmPassword','ForgotPasswordToken','ForgotPasswordUserID');">
                                                Reset
                                            </button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </li>
                                        <div class="form-group">
                                            
                                        </div>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ===========================================
        ==End SignUp area==
=========================================== -->
<?php
require_once './includes/footer.php';
?>