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
                                            Log In to Your Account
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
                                                User Name
                                            </span>
                                        </label>
                                        <!--<input type="text" id="f1" placeholder="First Name">-->
                                        <input id="LoginUserID" name="LoginUserID" class=" required" placeholder="User Name" required autofocus type="text" onkeydown="PressEnterLogin(event, 'home');">
                                    </div>
                                </div>
                                <div class="single-field-container">
                                    <div class="form-group">
                                        <label for="f2">
                                            <span>
                                                Password
                                            </span>
                                        </label>
<!--                                        <input type="text" id="f2" placeholder="Password" onkeydown="PressEnterLogin(event, 'home');">-->
                                        <input id="LoginPassword" name="LoginPassword" placeholder="Password" class=" required" required type="password" onkeydown="PressEnterLogin(event, 'home');">
                                        <a href="ForgotPassword" class="pull-right">
                                                Forgot password?
                                            </a>
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
                                                    <button class="" type="button" onclick="login('home');">
                                                Login
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
<script>
//function login(redirect_url) {
//    var UserName = $("#LoginUserID").val();
//    var Password = $("#LoginPassword").val();
// 
//    
//    if (UserName != '' && Password != '') {
//        $('.alert_box_error').hide();
//        $('.alert_box_error').hide();
//        
//            jQuery.ajax({
//                url: "<?php echo SITE_URL; ?>class/class.ajaxRequest.php",
//                data: {UserName: UserName, Password: Password, do: 'KametLogin'},
//                beforeSend: function () {
//                    $('.alert_box_success').show();
//                    $('.alert_box_success').html('Please wait...');
//                },
//                success: function (result) {
////                    alert(result);
//                    $('.alert_box_success').show();
//                    $('.alert_box_success').html(result);
//                    var data = $.parseJSON(result);
//                    if (data.ResponseCode == 1) {
//                        
//                        $('.alert_box_success').show();
//                        $('.alert_box_error').hide();
//                        $('.alert_box_success').html(data.SuccessMessage);
//                        if (redirect_url != '') {
//                            window.location = 'admin/' + redirect_url;
//                        } else {
//                            window.location = 'admin/home';
//                        }
//                    } else {
//                        $('.alert_box_success').hide();
//                        $('.alert_box_error').show();
//                        $('.alert_box_error').html(data.ErrorMessage);
//                    }
//                }
//            });
//    } else {
//        $('.alert_box_success').hide();
//        $('.alert_box_error').show();
//        $('.alert_box_error').html('<strong>Sorry...!</strong> Username/Password fields are required');
//    }
//
//}
</script>