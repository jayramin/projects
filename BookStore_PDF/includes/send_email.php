<?php

error_reporting(0);

require_once('../class/mailer/class.phpmailer.php');
require_once('../includes/labels.php');
 
if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'send_email') {
 
    date_default_timezone_set('Asia/Kolkata');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
    $mail = new PHPMailer();
    $message_from = $_REQUEST['user_name'];
    $message_subject = $_REQUEST['subject'];
    $message_body = nl2br($_REQUEST['body']);
    $message_email = $_REQUEST['email'];
//$body             = file_get_contents('contents.html');
    $body = '<body style="margin: 10px;">';
    $body .= '<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">';
    $body .= '<div align="left"><img src="assets/images/logo.png" alt="Shopizen Inc." img="assets/images/logo.png" style="height: auto; width: auto"/></div>';
    $body .= '<br>';
    $body .= '&nbsp;Hello,<br><br>';
    $body .= '&nbsp;You have contact request from <b>'.$message_from.'</b> with email id <b>'.$message_email.'</b>. Following is message from the user<br>';
    $body .= '<br>';
    $body .= '"'.$message_body.'"';
    $body .= '<br><br>';
    $body .= EMAIL_FOOTER;
    $body .= '</div>';
    $body .= '</body>';
     
    //$body = eregi_replace("[\]", '', $body);    
    $mail->IsSMTP(); // telling the class to use SMTP
    //$mail->Host = "43.225.55.90"; // SMTP server
    //$mail->Host = "stmp.gmail.com"; // SMTP server
    $mail->SMTPDebug = 1;                     // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host = "43.225.55.90";      // sets GMAIL as the SMTP server
    $mail->Port = 465;                   // set the SMTP port for the GMAIL server
    //$mail->Username = "fevicolfevicol";  // GMAIL username
    //$mail->Password = "";            // GMAIL password
    //$mail->SetFrom('fevicolfevicol@gmail.com', 'Safari Infosoft');
    $mail->Username = CONTACT_EMAIL;  // GMAIL username
    $mail->Password = CONTACT_PASSWORD;            // GMAIL password
    $mail->SetFrom(CONTACT_EMAIL, SITE_NAME);
    $mail->Subject = $message_subject;
    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    $mail->MsgHTML($body);
    //$address = "nilesh@flexiwaresolutions.com";
    $address = EMAIL_TO;

    $mail->AddAddress($address, $message_from);
//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
   
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
}
?>