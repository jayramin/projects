<?php

	require("PHPMailer_v5.1/class.phpmailer.php");

	if(isset($_POST['submit']))
	{
		echo $name=$_POST['name'];
		echo $email_send="miteshdarji1112@gmail.com";
		echo $email_msg=$_POST['email'];
		echo $description=$_POST['description'];
		//die("Helo");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;  // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465; 
		$mail->Username = "miteshdarji1112@gmail.com";  
		$mail->Password = "MeetGopi232";
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
			echo $error = 'Message sent!';
			//return true;
		}
	}
?>