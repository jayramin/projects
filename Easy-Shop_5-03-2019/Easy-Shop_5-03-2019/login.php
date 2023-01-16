<?php
include 'top_header.php';
include 'conn.php';
if(isset($_REQUEST['signup']))
{   
    $fnm=$_REQUEST['fnm'];
    $lnm=$_REQUEST['lnm'];
    $email=$_REQUEST['email'];
    $pass=$_REQUEST['pass'];
    $mno=$_REQUEST['mno'];
    $gen=$_REQUEST['gen'];

    $in="insert into user_details (fname,lname,email,pass,mobile,gen) values ('$fnm','$lnm','$email','$pass','$mno','$gen')";
    //exit();
    $res=$con->query($in); 
    if($res)
    {
            $otp =rand(100000,999999);
            $msg="Welcome to www.easyshop.com. your OTP is ". $otp;
            $message = urlencode($msg);
            $user='101482';
            $sender = 'ESYSOP'; 
            $apikey = '010Q4NI5sNc0cQMctn4s';
            $baseurl = 'http://nimbusit.info/api/pushsms.php?user='.$user;
            $url = $baseurl.'&key='.$apikey.'&sender='.$sender.'&mobile='.$mno.'&text='.$message;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            // Use file get contents when CURL is not installed on server.
            //if(!$response){
              //  $response = file_get_contents($url);
            //}
            //session_start();
            $_SESSION['otp']= array('mobile'=>$mno,'otps'=>$otp);
        ?>
        <script type="text/javascript">
            alert('Congrats, Registration Success');
            window.location="mobile_verify.php";
        </script>
        <?php 
    }
    else
    {
        ?>
        <script type="text/javascript">
            alert('Error ,Problem while Registration please try again leter!!');
            window.location="login.php";
        </script>
        <?php 
    }
}
if(isset($_REQUEST['login']))
{	
	$unm=$_REQUEST['unm'];
	$pass=$_REQUEST['pass'];

	$lg="select * from user_details where email='$unm' AND pass='$pass' AND status='Active'";
	$res=$con->query($lg);
    $chk=$res->num_rows;
	if($chk==1)
	{
        $_SESSION['user']=$unm;
		?>
		<script type="text/javascript">
			alert('Congrats, Login Success');
			window.location="index.php";
		</script>
		<?php 
	}
	else
	{
		?>
		<script type="text/javascript">
			alert('Error ,Problem while Login please try again leter!!');
			window.location="login.php";
		</script>
		<?php 
	}
}
?>
 <!--breadcrumbs area start-->
	    <div class="breadcrumbs_area login_bread">
	        <div class="container">
	            <div class="row">
	                <div class="col-12">
	                    <div class="breadcrumb_content">
	                        <div class="breadcrumb_header">
	                            <a href="index.html"><i class="fa fa-home"></i></a>
	                            <span><i class="fa fa-angle-right"></i></span>
	                            <span> login</span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
		<!--breadcrumbs area end-->
       
        <!-- accont area start -->
        <div class="account_area">
                <div class="container">
                    <div class="row">
                       <!--login area start-->
                        <div class="col-lg-6 col-md-6">
                            <div class="account_form">
                                <div class="login_title">
                                    <h2>login</h2>
                                </div>
                                <div class="login_form login">
                                    <form id="myform" name="myfrom" action="#" method="POST" >
                                        <div class="login_input">
                                            <label>Username or email <span>*</span></label>
                        <input type="text" name="unm" data-bvalidator="email,required">
                                        </div>
                                        <div class="login_input">
                                            <label>Passwords  <span>*</span></label>
                                            <input type="password" name="pass" data-bvalidator="required">
                                        </div>
                                        <div class="login_submit">
                                            <button type="submit" name="login">login</button>
                                            <label for="remember">
                                                <input id="remember" type="checkbox">
                                                Remember me
                                            </label>
                                            <a href="#">Lost your password?</a>
                                        </div>
                                        
                                    </form>
                                </div>
                             </div>    
                        </div>
                        <!--login area start-->
                        
                        <!--register area start-->
                        <div class="col-lg-6 col-md-6">
                            <div class="login_title">
                                <h2>Register</h2>
                            </div>
                            <div class="login_form form_register">
                                <form id="myform1" name="myfrom1" action="#" method="POST">
                                    <div class="login_input">
                                        <label>First Name <span>*</span></label>
                        <input type="text" name="fnm" data-bvalidator="alpha,required">
                                    </div>
                                    <div class="login_input">
                                        <label>Last Name <span>*</span></label>
                                        <input type="text" name="lnm" data-bvalidator="alpha,required">
                                    </div>
                                    <div class="login_input">
                                        <label>Email address <span>*</span></label>
                                        <input type="text" name="email" data-bvalidator="email,required">
                                    </div>
                                    <div class="login_input">
                                        <label>Passwprd<span>*</span></label>
                                        <input type="text" name="pass" data-bvalidator="required">
                                    </div>
                                    <div class="login_input">
                                        <label>Contact <span>*</span></label>
                                        <input type="text" name="mno" data-bvalidator="digit,minlength[10],maxlength[12],required">
                                    </div>
                                   <div class="login_input">
                                        <label>I AM <span>*</span></label>
                                        <select style="width: 100px;" name="gen" data-bvalidator="required">
                                                <option value="Male">Male</option>
                                                <option value="FeMale">FeMale</option>
                                        </select>
                                    </div>
                                    <div class="login_submit">
                                        <button type="submit" name="signup" >Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--register area end-->
                    </div>
                </div>
            </div>
        <!-- accont area end -->
<?php
include 'footer.php'; 
?>