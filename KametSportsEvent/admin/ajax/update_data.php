<?php

//print_r($_REQUEST);

error_reporting(0);
session_start();
require_once '../../class/class.DataTransaction.php';
require_once '../../includes/labels.php';
$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$user = new User($db);
$mysql = new DataTransaction($db);
foreach ($_REQUEST as $key => $value) {
    if (is_array($value)) {
        $str_value = implode(',', $value);
        $update_arr[$key] = $str_value;
    } else {
        $update_arr[$key] = $value;
    }
}

$sizeof_post = sizeof($update_arr);
$NewArray4Update = array_slice($update_arr, 0, ($sizeof_post - 3), true);
$condition_filed = explode(',', $_REQUEST['cond_field']);
$condition_value = explode(',', $_REQUEST['cond_value']);
$TableName = $_REQUEST['table_name'];
$LoginUserID = (isset($_SESSION[SESSION_ALIAS]['session']['UserType'])) ? $_SESSION[SESSION_ALIAS]['session']['UserType'] : 1;
$UpdateCondition = array();
for ($i = 0; $i < sizeof($condition_filed); $i++) {
    $UpdateCondition[$condition_filed[$i]] = $condition_value[$i];
}

$UpdateCommonFields = array("ModificationBy"=>$_SESSION[SESSION_ALIAS]['session']['UserID'],"ModificationDate" => date('Y-m-d H:i:s'));
$UpdateFields = array_merge($UpdateCommonFields, $NewArray4Update);

if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'DeleteRecord') {
    $mysql->update($TableName, array("ModificationDate" => date('Y-m-d H:i:s')));
    $UpdateQuery = $mysql->update($TableName, $UpdateFields, $UpdateCondition);
    if ($UpdateQuery && $_REQUEST['Mode'] == 'DELETE') {
        $ReturnMessage = "Record Deleted Successfully";
    } else if ($UpdateQuery && $_REQUEST['Mode'] == 'UPDATE') {
        $ReturnMessage = "Status Changed Successfully";
    }
    echo $ReturnMessage;
}

else if ($_REQUEST['do'] == "ChangeStatus") {
    $update_status = $mysql->update($_REQUEST['table'], array($_REQUEST['status_field'] => $_REQUEST['status'],"ModificationDate" => date('Y-m-d H:i:s'),"ModificationBy"=>$_SESSION[SESSION_ALIAS]['session']['UserID']), array($_REQUEST['id_field'] => $_REQUEST['id']));
    if ($update_status) {
        echo "Status Changed";
    } else {
        echo 0;
    }
}
else if ($_REQUEST['do'] == "DeleteSingleRecord") {
    
    if ($_REQUEST['table'] == 'v_state' || $_REQUEST['table'] == 'v_country' || $_REQUEST['table'] == 'v_city') {
       
        $Flag = array();
        $TablesToCheck = explode(',', $_REQUEST['TablesToCheck']);
        $FieldsToCheck = explode(',', $_REQUEST['FieldsToCheck']);
        for ($i = 0; $i < sizeof($TablesToCheck); $i++) {
            
            $CheckQuery = $db->prepare("SELECT * FROM " . $TablesToCheck[$i] . " WHERE " . $FieldsToCheck[$i] . " = '" . $_REQUEST['id'] . "'");
            $CheckQuery->execute();
            $Rows = $CheckQuery->rowCount();
            if ($Rows > 0) {
                $Flag[$i] = 1;
            } else {
                $Flag[$i] = 0;
            }
        }
        if (in_array(1, $Flag)) {
            $ReturnMessage = 'This Recored Is In Use';
        } else {
            $update_status = $mysql->update($_REQUEST['table'], array($_REQUEST['status_field'] => $_REQUEST['status'], "ModificationDate" => date('Y-m-d H:i:s'), "ModificationBy" => $_SESSION[SESSION_ALIAS]['session']['UserID']), array($_REQUEST['id_field'] => $_REQUEST['id']));
            if ($update_status) {
                $ReturnMessage = "Record Deleted";
            } else {
                $ReturnMessage = '0';
            }
        }
    } else {
        $update_status = $mysql->update($_REQUEST['table'], array($_REQUEST['status_field'] => $_REQUEST['status'], "ModificationDate" => date('Y-m-d H:i:s'), "ModificationBy" => $_SESSION[SESSION_ALIAS]['session']['UserID']), array($_REQUEST['id_field'] => $_REQUEST['id']));
        if ($update_status) {
            $ReturnMessage = "Record Deleted";
        } else {
            $ReturnMessage = '0';
        }
    }
    echo $ReturnMessage;
} 
else {
  // echo 'asdf';
    $UpdateQuery = $mysql->update($TableName, $UpdateFields, $UpdateCondition);
    if ($UpdateQuery) {
        $ReturnMessage = "Record Updated Successfully";
    }
    echo $ReturnMessage;
}