<?php

error_reporting(0);
session_start();
// mysql.php file has functions for select insert update delete. so no need to write static quries. just call functions with parameters.
require_once'../../config/connection.php';
require_once'../../config/constants.php';
require_once '../../class/mysql.php';
require_once '../../labels/en.php';
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
    $query_admin = $db->selectdata(TBL_ADMIN_USERS, "(email = '$username' OR username = '$username') AND password = '$password' AND is_active = 'Y'");
    $query_users = $db->selectdata(TBL_USERS, "(email = '$username' OR username = '$username') AND password = '$password' AND is_active = 'Y'");
    $num_rows_admin = mysql_num_rows($query_admin);
    $data_admin = mysql_fetch_object($query_admin);
    
    $num_rows_users = mysql_num_rows($query_users);
    $data_users = mysql_fetch_object($query_users);
    //print_r($data_admin);
// checking whether any match found or not
    if ($num_rows_admin > 0 || ($num_rows_users > 0 && $data_users->AgreementAcceptance == 'Yes')) {
// record found then set sessions and redirected to index.php page which is a home page
        session_start();
        $_SESSION['is_login'] = 'yes';
        $_SESSION['user_data'] = ($data_admin != '') ? $data_admin : $data_users;
        $assign = 1;
        unset($_SESSION['sessionX']);
        //print_r($_SESSION);
        echo $assign;
    } else {
// record not found. so message shown on screen
        echo '<strong>Sorry!</strong> Username/Password not available</div>';
    }
} else if ($_POST['do'] == 'customer_authenticate') {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $query = $db->selectdata(TBL_USERS, "(email = '$username' OR username = '$username') AND password = '$password' AND is_active = 'Y'");
    $num_rows = mysql_num_rows($query);
    $data = mysql_fetch_object($query);
    if ($num_rows > 0) {
        session_start();
        $_SESSION['is_login'] = 'yes';
        $_SESSION['user_data'] = $data;
        $assign = 1;
        unset($_SESSION['sessionX']);
        //print_r($_SESSION);
        echo $assign;
    } else {
        echo '<strong>Oops!</strong> Not a valid info.</div>';
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
    $email = $_POST['email'];
    $foget_poassword_query = $db->selectdata(TBL_ADMIN_USERS, "email = '" . trim($email) . "'");
    $num_rows = mysql_num_rows($foget_poassword_query);
    $data = mysql_fetch_object($foget_poassword_query);
    //print_r($data);
    if ($num_rows > 0) {
        $to = $email;
        $cc = 'nilkumar117@gmail.com';
        $bcc = '';
        $subject = "Password Reset";
//$forget_password_mail_content = file_get_contents(MAILFORMAT_PATH . "/forget_password_mail_to_user.txt");

        $message = '<div style="background-color: #9585bf;padding:5px;color: whitesmoke;font-size: 12px;"><h1>' . $lang->lang['site_name'] . '<small> - ' . $lang->lang['site_tab'] . '</small></h1></div>
            <table width = "100%" style = "border:1px solid #000;background-color: #e4e6e9;">
                <tr>
                    <td style="padding:15px;">Reset your account by clicking link on the right. </td>
                    <td valign = "middle" style="padding:15px;">
                        <a href = "' . SITE_URL . 'change_password.php?key=' . base64_encode($to) . '" style = "background:#6fb3e0;display: inline-block; padding:5px 7px; color:#fff; text-decoration:none;text-shadow: 0 -1px 0 rgba(0,0,0,.25);background-image: none!important;border: 5px solid #FFF;border-radius: 0;transition: background-color .15s,border-color .15s,opacity .15s;cursor:pointer;" target = "_blank"> Select New Password <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i></a>
                    </td>
                </tr>
            </table>';
        $alert_msg = "";
        $attachment = "";
        $functions->send_email($to, $cc, $bcc, $subject, $message, $alert_msg, $attachment);
        echo '<i class="ace-icon fa fa-thumb green"></i> We just sent an email to you. Please check.</div>';
    } else {
        echo '<i class="ace-icon fa fa-ban red"></i> We do not have a/c with this email address</div>';
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
        $msg_body = $db->selectdata(TBL_EMAIL_FORMAT, "`is_active` = 'Y' AND `param_id` = '20'");
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
        $db->InsertData(array("receiver_email" => $to, "subject" => $client_subject, "body" => $message, "is_active" => 'Y', "sent_date" => date("Y-m-d H:i:s")), TBL_SENT_EMAILS, '');

        echo '<strong><i class="ace-icon fa fa-thumb green"></i>Whoa!</strong> We just sent an email to you. Please check.</div>';
    } else {
        echo '<strong><i class="ace-icon fa fa-ban red"></i>Sorry!</strong> We do not have a/c with this email address</div>';
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