<?php

	require("PHPMailer_v5.1/class.phpmailer.php");

	if(isset($_POST['submit']))
	{
		$name=$_POST['name'];
		$email_send="miteshdarji1112@gmail.com";
		$email_msg=$_POST['email'];
		$description=$_POST['description'];
		//die("Helo");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;  // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465; 
		$mail->Username = "miteshdarji1112@gmail.com";  
		$mail->Password = "Meet232";
		//$mail->AddAttachment($Path,$Path);           
		//$mail->SetFrom("avnish121@gmail.com", "Avnish");
		$mail->Subject ="From : www.onlineexam.com User Name :".$name;
		$mail->IsHTML();
		$mail->Body = $description."\n\n".$email_msg;
		$mail->AddAddress($email_send);
		if(!$mail->Send()) {
			$error = 'Mail error: '.$mail->ErrorInfo; 
			//return false;
		} else {
		?>
		<script>
			alert('Message sent!');
		</script>
		<?php
		}
	}
?>
<html>
<title>::Feedback Page</title>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<body>
<div id="bodymain">
	<?php
	include "../menu.php";
	?>
	<div id="frame">
	<div id="submenu">
	<?php
	include "student_menu.php";
	?> </div>
	<div id="slider"><div id="line">Mail Feedback</div>
<form method="post" name="" action="">
	<table border="0" align="center">
    	<tr>
        	<td>name</td>
            <td><input type="text" name="name" /></td>
        </tr>
        
        <tr>
        	<td>email</td>
            <td><input type="text" name="email" /></td>
        </tr>
        
        <tr>
        	<td>Description</td>
            <td><textarea name="description" cols="22" rows="7"></textarea></td>
        </tr>
        
        <tr>
       		<td align="center" colspan="2">
            	<input type="submit" name="submit" value="Submit" />
                <input type="reset" name="reset" value="Reset" />
            </td>
        </tr>
    </table>
</form>
		</div>
</div>
<?php
include "../footer.php";
?>
</div>
</body>
</html>
