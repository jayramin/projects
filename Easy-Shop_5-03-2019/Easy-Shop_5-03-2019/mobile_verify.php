<?php
session_start();
    
    if(isset($_REQUEST['votp']))
    {
    	$otp=$_REQUEST['otp'];
    	$main_otp=$_SESSION['otp']['otps'];
    	if($otp==$main_otp)
    	{
    		$no=$_SESSION['otp']['mobile'];
    		include 'conn.php';
    		$sq="update user_details set status='Active' where mobile='$no'";
    		$res=$con->query($sq);
    		if($res)
    		{
				$main_otp=$_SESSION['otp'];
				session_unset($main_otp);
				?>
    				<script type="text/javascript">
    				alert('Verification Completed Successfull , Now you can Login');
    				window.location="login.php";
    				</script>
    			<?php
    		}
    		else
    		{
    			?>
    				<script type="text/javascript">
    					alert('Verification Fail');
    					window.location="mobile_verify.php";
    				</script>
    			<?php	
    		}
    	}
    	else
    	{
    		?>
    				<script type="text/javascript">
    					alert('Wrong OTP entered by you, try again');
    					window.location="mobile_verify.php";
    				</script>
    			<?php	
    	}
    }
?>

<html>
<head>
<title>User Login</title>
<style>
body{
	font-family: calibri;
}
.tblLogin {
	border: #95bee6 1px solid;
    background: #d1e8ff;
    border-radius: 4px;
    max-width: 300px;
	padding:20px 30px 30px;
	text-align:center;
}
.tableheader { font-size: 20px; }
.tablerow { padding:20px; }
.error_message {
	color: #b12d2d;
    background: #ffb5b5;
    border: #c76969 1px solid;
}
.message {
	width: 100%;
    max-width: 300px;
    padding: 10px 30px;
    border-radius: 4px;
    margin-bottom: 5px;    
}
.login-input {
	border: #CCC 1px solid;
    padding: 10px 20px;
	border-radius:4px;
}
.btnSubmit {
	padding: 10px 20px;
    background: #2c7ac5;
    border: #d1e8ff 1px solid;
    color: #FFF;
	border-radius:4px;
}
</style>
</head>
<body>
	<?php
		if(!empty($error_message)) {
	?>
	<div class="message error_message"><?php echo $error_message; ?></div>
	<?php
		}
	?>
<center style="margin-top:130px;">
<form name="frmUser" method="post" action="">
	<div class="tblLogin">
		<div class="tableheader">Enter OTP</div>
		<p style="color:#31ab00;">Check your Registered Mobile No for the OTP</p>
		<div class="tablerow">
			<input type="text" name="otp" placeholder="One Time Password" class="login-input" required>
		</div>
		<div class="tableheader"><input type="submit" name="votp" value="Submit" class="btnSubmit"></div>
		<br>
		<div class="tableheader">
			<a href="index.php">Back to Shopping</a>
			<br>
			<a href="">Back to Registration</a>
		</div>
	</div>
</form>
</center>
</body></html>