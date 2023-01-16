<?php
error_reporting(0);
session_start();
//echo "<pre>";
//print_r($_REQUEST);
// mysql.php file has functions for select insert update delete. so no need to write static quries. just call functions with parameters.
require_once'../../config/connection.php';
require_once'../../config/constants.php';
require_once '../../class/mysql.php';
require_once '../language/en.php';
require_once '../../class/function.class.php';
$db = new DataTransaction();
$lang = new en();
$functions = new myfunctions();
if ($_POST['do'] == 'authenticate') {
// get username from textbox
    $username = $_POST["username"];
// get password from textbox and converted in md5
    $password = md5($_POST["password"]);
// called selectdata function from mysql.php file. 2 parametres are required. 1st-> table name & 2nd->condition
    $query = $db->selectdata(TBL_USERS, "(email = '$username' OR username = '$username') AND password = '$password' AND is_active = '1'");
    $num_rows = mysql_num_rows($query);
    $data = mysql_fetch_object($query);
// checking whether any match found or not
    
    if ($num_rows > 0) {
// record found then set sessions and redirected to index.php page which is a home page
        //session_start();
        $_SESSION['is_login'] = 'yes';
        $_SESSION['user_data'] = $data;
        $assign = 1;
        unset($_SESSION['sessionX']);
        echo $assign;
    } else {
// record not found. so message shown on screen
        echo 'Invalid User Name OR Password.';
    }
} else if ($_POST['do'] == 'authenticate_page') {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $query = $db->selectdata(TBL_USERS, "password = '$password'");
    $num_rows = mysql_num_rows($query);

    $data = mysql_fetch_object($query);

    if ($num_rows > 0) {
        echo '1';

        $_SESSION['page_confirm'][$_REQUEST['page_url'] . '_confirmation'] = 'OK';

        if (isset($_REQUEST['edit_page']) && $_REQUEST['edit_page'] == 'ok') {
            $_SESSION['edit_confirm'][$_REQUEST['page_url'] . '_confirmation'] = 'OK';
            //setCookie('edit_confirm','OK',365);
        }
        unset($_SESSION['sessionX']);
    } else {
        echo '0';
    }
} else if ($_POST['do'] == 'check_email') {
//echo $_POST['type'];
// checking whether create button is pressed or not.
    if ($_POST['type'] == '0') {
        $check_email_query = $db->selectdata(TBL_USERS, "email = '" . $_POST['email'] . "'");
    } else {
        $check_email_query = $db->selectdata(TBL_USERS, "email = '" . $_POST['email'] . "' AND user_id != '" . $_POST['type'] . "'");
    }
    $check_email_rows = mysql_num_rows($check_email_query);

    if ($check_email_rows > 0) {
        echo 0;
    } else {
        echo '<div class="alert alert-danger">
    <strong>Error!</strong> Some fields are invalid Please try again.
</div>';
    }
} else if ($_POST['do'] == 'sendnewpass') {
    if (isset($_REQUEST['email_valu']) && $_REQUEST['email_valu'] != '') {
        $email = $_REQUEST['email_valu'];
    } else {
        $email = $_POST['email'];
    }
    $foget_poassword_query = $db->selectdata(TBL_USERS, "email = '" . trim($email) . "'");
    $num_rows = mysql_num_rows($foget_poassword_query);
    $data = mysql_fetch_object($foget_poassword_query);
    //print_r($data);
    if ($num_rows > 0) {
        $to = $email;
        $cc = 'nilkumar117@gmail.com';
        $bcc = '';
        $subject = "Reset Password";
//$forget_password_mail_content = file_get_contents(MAILFORMAT_PATH . "/forget_password_mail_to_user.txt");
        $message = '<table width="100%" height="100" border="0">
    <tr align="center" style="border-left:1px solid #277DC0; border-right:1px solid #277DC0">
        <td align = "center">
            <table width = "600px" border = "0" style = "border-top:4px solid #277DC0; border-bottom:4px solid #277DC0">
                <tr style = "padding:10px 7px;">
                    <td colspan = "2">
                        <h2>' . $lang->lang['company_name'] . '
                        </h2>
                    </td>
                </tr>
                <tr style = "padding:10px 7px;">
                    <td>Please Reset your account by clicking on following link</td>
                    <td valign = "middle">
                        <a href = "' . SITE_URL . 'reset_password.php?token=' . base64_encode($to) . '" style = "background:#277DC0; padding:5px 7px; color:#fff; text-decoration:none;" target = "_blank">RESET PASSWORD </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table >';
        $alert_msg = "";
        $attachment = "";
        $functions->send_email($to, $cc, $bcc, $subject, $message, $alert_msg, $attachment);
        echo '<div class="alert alert-success">New password has been send to your email address</div>';
    } else {
        echo '<div class="alert alert-danger">Your email address not found in the system. Please try again</div>';
    }
} else if ($_POST['do'] == 'sendnewpass_new') {
    if (isset($_REQUEST['email_valu']) && $_REQUEST['email_valu'] != '') {
        $email = $_REQUEST['email_valu'];
    } else {
        $email = $_POST['email'];
    }

    //$foget_poassword_query = $db->selectdata(TBL_USERS, "email = '" . trim($email) . "' AND user_id = '".$_POST['user_pass_id']."'");
    $foget_poassword_query = $db->selectdata(TBL_USERS, "user_id = '" . $_POST['user_pass_id'] . "'");
    $num_rows = mysql_num_rows($foget_poassword_query);
    $data = mysql_fetch_assoc($foget_poassword_query);
    //print_r($data);
    if ($num_rows > 0) {
        $to = $data['email'];
        $cc = '';
        $bcc = '';
        $msg_body = $db->selectdata(TBL_EMAIL_FORMAT, "`is_active` = '1' AND `param_id` = '20'");
        if ($msg_body_data = mysql_fetch_array($msg_body)) {
            $client_body = $msg_body_data['body'];
            $client_subject = $msg_body_data['subject'];
        }
//search for text withing body to replace
        $body_search = array("%%LINK%%");
        $link = '<a href = "' . SITE_URL . 'reset_old_password.php?token=' . base64_encode($to) . '&uid=' . base64_encode($_POST['user_pass_id']) . '" style = "background:#277DC0; padding:5px 7px; color:#fff; text-decoration:none;" target = "_blank">RESET PASSWORD </a>';
//Replace Dynamic details in following array
        $body_replace = array($link);
        $message = str_replace($body_search, $body_replace, $client_body);
        $alert_msg = "";
        $functions->send_email($to, $cc, $bcc, $client_subject, $message, $alert_msg, '');
        $db->InsertData(array("receiver_email" => $to, "subject" => $client_subject, "body" => $message, "is_active" => '1', "sent_date" => date("Y-m-d H:i:s")), TBL_SENT_EMAILS, '');

        echo '<div class="alert alert-success">New password has been send to your email address</div>';
    } else {
        echo '<div class="alert alert-danger">Your email address not found in the system. Please try again</div>';
    }
} else if ($_POST['do'] == 'resetpass') {
    if ($_REQUEST['password'] == $_REQUEST['confpassword']) {
        $new_md5_pass = md5($_REQUEST['password']);
        $db->changestatus(TBL_USERS, "email = '" . $_POST["email"] . "'", "password", "'$new_md5_pass'");
        echo 1;
    } else {
        echo "Please insert same password";
    }
} else if ($_POST['do'] == 'change_password') {
    //echo "Hi";
//check old password
    $old_password = $functions->get_user($_SESSION['user_data']->user_id, 'password');

    if ($old_password == md5($_REQUEST['old_password'])) {
        if ($_REQUEST['password'] == $_REQUEST['confirm_password']) {
            $new_md5_pass = md5($_REQUEST['password']);
            $db->changestatus(TBL_USERS, "user_id = '" . $_SESSION ['user_data']->user_id . "'", "password", "'$new_md5_pass'");
            echo 1;
        } else {
            echo "Password and Confirm Password does not match";
        }
    } else {
        echo "Old Password does not match";
    }
} else {
    echo '<div class="alert alert-danger">
                  <strong>Error!</strong> Invalid User Name OR Password.</div>';
    return false;
}
?>