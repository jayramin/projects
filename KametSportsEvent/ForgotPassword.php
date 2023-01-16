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
                                    <center><p> Forgot Password </p></center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <form action="#">
                        <div class="sign-up-field-container">
                            <div class="single-field-container">
                                <span class="alert alert_box_error"></span>
                                <span class="alert alert_box_success"></span>
                                <div class="form-group">
                                    <label for="UserName">
                                        <span>Email</span>
                                    </label>
                                    <input id="ForgotPasswordEmailID" name="LoginEmailID" class="required" placeholder="User Name" autofocus type="text">
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
                                                <button class="" type="button" onclick="SendForgotPasswordToken('ForgotPasswordEmailID');">
                                                    Send Token
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
