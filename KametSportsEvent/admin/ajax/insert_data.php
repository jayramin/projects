<?php

error_reporting(0);
session_start();

require_once '../../class/class.DataTransaction.php';
//require_once '../../class/class.user.php';
//require_once '../../class/class.password.php';
require_once '../../includes/labels.php';
$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$user = new User($db);
$mysql = new DataTransaction($db);
$LoginUserID = (isset($_SESSION[SESSION_ALIAS]['session']['UserType'])) ? $_SESSION[SESSION_ALIAS]['session']['UserType'] : 1;
$TableName = $_REQUEST['table_name'];
// Instructions to use dynamic email format
if (array_key_exists('_wysihtml5_mode', $_POST)) {
    unset($_POST['_wysihtml5_mode']);
}
$sizeof_post = sizeof($_POST);
$NewArray = array_slice($_POST, 0, $sizeof_post - 1, true);
extract($_POST);
$msg = '';
$AppendCommonFields = array("EntryBy"=>$_SESSION[SESSION_ALIAS]['session']['UserID'],"EntryDate" => date('Y-m-d H:i:s'), "ModificationDate" => date('Y-m-d H:i:s'));

$InsertData = array_merge($AppendCommonFields, $NewArray);
//print_r($InsertData);

if ($_REQUEST['table_name'] == 't4m_class') {
    $ClassID = $mysql->insert($InsertData, 't4m_class');
    foreach ($_REQUEST['CatSrNo'] AS $Key => $Value) {
        $InsertID = $mysql->insert(array('ClassSrNo' => $ClassID, 'CatSrNo' => $Value, 'is_active' => 'Y','EntryByUser' => $_SESSION[SESSION_ALIAS]['session']['user_id'],'ModificationByUser' => $_SESSION[SESSION_ALIAS]['session']['user_id'], 'EntryDate' => date("Y-m-d H:i:s"), 'ModifyDate' => date("Y-m-d H:i:s")), 't4m_institute_category');        
    }
    $ReturnMessage='Data Saved Successfully';
    echo $ReturnMessage;
} else {
    $InsertID = $mysql->insert($InsertData, $_POST['table_name']);
    $Message = "Record Inserted Successfully";
    echo $Message;
}
