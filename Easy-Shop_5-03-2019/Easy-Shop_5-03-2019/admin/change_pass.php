<?php
//ob_start();
include('include/config.php');

if(isset($_REQUEST['login']))
{
	$username=$_REQUEST['username'];
	$password=$_REQUEST['password'];
	
	$sql="select * from admin_details_tbl where username='$username' AND pass='$password'";
	$res=$conn->query($sql);
	$row=$res->fetch_object();
	if(count($row)>0)
	{
		header('location:dashboard.php');
	}
	else
	{
		header('location:index.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>Columbus shoes</title>
	<?php include('include/alllink.php'); ?>
	
</head>

<body>
		<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Welcome Admin to Columbus Shoes</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						Keep remember your new password and do not share with others.
					</div>
					<form class="form-horizontal" action="" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" placeholder="Enter old Password" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" placeholder="Enter new Password" />
							</div>
							<div class="clearfix"></div>
							
							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" placeholder="Re-Enter new Password" />
							</div>
							<div class="clearfix"></div>
							
						
							<p class="center span5">
							<button type="submit" class="btn btn-primary" name="chng_pass">Submit</button>
							</p>
							<div class="input-prepend" title="Password" data-rel="tooltip">
								<a href="index.php">Back to Admin Home Page</a>
							</div>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
				</div><!--/fluid-row-->
		
	</div><!--/.fluid-container-->
<div style="margin-top:200px;">
		<?php include('include/footer.php'); ?>
	</div>
		
</body>
</html>
