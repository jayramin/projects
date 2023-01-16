<?php
session_start();
if (isset($_SESSION['is_login']) && isset($_SESSION['is_lock']) && $_SESSION['is_lock'] != 'yes') {
    header("Location:dashboard");
    exit();
}
//error_reporting();
// this is a connection file to connect with databse
// mysql.php file has functions for select insert update delete. so no need to write static quries. just call functions with parameters.
require_once "../config/connection.php";
require_once "../config/constants.php";
require_once '../class/mysql.php';
require_once '../class/function.class.php';
require_once '../labels/en.php';
require_once '../class/users.class.php';
$db = new DataTransaction();
$fn = new myfunctions();
$lang = new en();
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<title>Lock | Shopizen</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
</head>
    <body onload="getTime()">
	<div class="wrapper full-page-wrapper page-login text-center">
		<div class="inner-page">
            <div id="showtime"></div>
            <div class="col-lg-4 col-lg-offset-4">
                <div class="lock-screen">
                    <h1><a data-toggle="modal" href="#myModal"><i class="fa fa-lock"></i></a></h1>
                    <p>Unlock Your Account</p>
                    <!-- Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Hello, Welcome Back</h4>
                                </div>
			<div class="container">
				<form id="form-login" data-toggle="validator" action="" class="form-horizontal" onsubmit="return login('authenticate', this.id);" method="post" role="form">
					<p class="title">Re-enter Password</p>
					<div class="form-group">
						<label for="username" class="control-label sr-only">Username</label>
						<div class="col-sm-12">
							<div class="input-group">
							<input type="text" name="username" id="username" placeholder="User ID" class="form-control" value="<?php echo @$_SESSION['user_data']->username ?>" readonly="" />
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
							</div>
						</div>
					</div>
					<label for="password" class="control-label sr-only">Password</label>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="input-group">
							<input type="password" name="password" id="password" class="form-control required" placeholder="Password" autocomplete="off">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							</div>
						</div>
					</div>
					<button type="submit" id="sign_in" class="btn btn-custom-primary btn-lg btn-block btn-login"><i class="fa fa-arrow-circle-o-right"></i>Sign In</button>
					<a href="logout.php" class="btn btn-theme04">&lsaquo; Not You?</a>
				</form>
			</div>
                            </div>
                        </div>
                    </div>
                </div><!--/lock-screen -->
            </div><!-- /col-lg-4 -->
        </div><!-- /container -->
        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery.2.1.1.min.js"></script>
		<script src="assets/login/login.js"></script>
		<script src="assets/js/custom.js"></script>
				<script src="assets/js/validate/jquery.validate.js"></script>
        <script>
            function getTime()
            {
                var today = new Date();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();
                // add a zero in front of numbers<10
                m = checkTime(m);
                s = checkTime(s);
                document.getElementById('showtime').innerHTML = h + ":" + m + ":" + s;
                t = setTimeout(function() {
                    getTime()
                }, 500);
            }

            function checkTime(i)
            {
                if (i < 10)
                {
                    i = "0" + i;
                }
                return i;
            }
        </script>
</div>
    </body>
<?php //echo $fn->js('assets/jquery/jquery-2.0.3.min.js,assets/login/login.js,assets/custom.js'); ?>
<!-- Mirrored from demo.thedevelovers.com/dashboard/kingadmin-v1.3/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Mar 2015 07:13:23 GMT -->
</html>