<?php
error_reporting(0);
session_start();
//print_r($_REQUEST);
//exit;
require_once 'class.DataTransaction.php';
require_once 'class.functions.php';
require_once '../includes/labels.php';
$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$user = new User($db);
$mysql = new DataTransaction($db);

$fn = new functions($db);

//echo "<pre>";
//print_r($_REQUEST);
foreach ($_REQUEST as $key => $value) {
    if (is_array($value)) {
        $str_value = implode(',', $value);
        $update_arr[$key] = $str_value;
    } else {
        $update_arr[$key] = $value;
    }
}

$sizeof_post = sizeof($update_arr);
$NewArray4Update = array_slice($update_arr, 0, ($sizeof_post - 4), true);
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
//echo "<pre>";
//print_r($UpdateFields);
if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'VLogin') {

    $Query = $mysql->selectdata('b_user', '', array('is_active' => 'Y', 'Email' => $_REQUEST['Email']));

    if (is_array($Query) && isset($Query[0]['UserID'])) {
        
        $PwdQuery = $mysql->selectdata('v_users', array('UserID', 'FirstName', 'LastName', 'MiddleName', 'EmailID', 'UserName', 'MobileNumber', 'RoleID', 'DOB', 'is_active'), array('password' => md5($_REQUEST['password']), 'UserID' => $Query[0]['UserID']));
        $_SESSION[SESSION_ALIAS]['session'] = $PwdQuery[0];
           echo json_encode(array("ErrorStatus" => 0, "ErrorMessage" => "", "SuccessMessage" => "Login Successful"));
        //}
    } else {
        echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "No user exist with this details", "SuccessMessage" => ""));
    }
} else if ($_REQUEST['do'] == 'insert_data') {
    $Data = unserializeForm($_REQUEST['data']);
    foreach ($Data as $key => $value) {
        if (empty($value) || $value == NULL)
            unset($Data[$key]);
    }
    $FixedFields = array('EntryByUser' => $_SESSION[SESSION_ALIAS]['session']['user_id'], 'EntryDate' => date('Y-m-d'), 'ModificationByUser' => $_SESSION[SESSION_ALIAS]['session']['user_id'], 'ModifyDate' => date('Y-m-d'));
    if (isset($_REQUEST['table_name']) && $_REQUEST['table_name'] == 't4m_users') {
        $UserTableArray = array('UserType' => $Data['UserType'], 'username' => $Data['username'], 'password' => '', 'PrefixID' => $Data['PrefixID'], 'first_name' => $Data['first_name'], 'middle_name' => $Data['middle_name'], 'last_name' => $Data['last_name'], 'dob' => $Data['dob'], 'profile_pic' => $Data['profile_pic'], 'sex' => $Data['sex'], 'land_number' => $Data['land_number'], 'AddressProof' => $Data['AddressProof'], 'PhotoProof' => $Data['PhotoProof'], 'OtherProof' => $Data['OtherProof'], 'store_name' => $Data['store_name'], 'about_me' => $Data['about_me'], 'term_text' => $Data['term_text'], 'SecQue' => $Data['SecAns'], 'ip_address' => $Data['ip_address'], 'is_active' => $Data['is_active']);
        if ($UserTableArray['password'] == md5('')) {
            unset($UserTableArray['password']);
        }
        $InsertData = array_merge($UserTableArray, $FixedFields);
        foreach ($InsertData as $key => $value) {
            if (empty($value) || $value == NULL) {
                unset($InsertData[$key]);
            }
        }
        $Insert = $mysql->insert($InsertData, $_REQUEST['table_name']);

        $AddressTableArray = array('FullName' => $Data['first_name'] . ' ' . $Data['middle_name'] . ' ' . $Data['last_name'], 'is_active' => 'Y', 'AddressLine1' => $Data['AddressLine1'], 'AddressLine2' => $Data['AddressLine2'], 'AddressLine3' => $Data['AddressLine3'], 'ZIPCode' => $Data['ZIPCode'], 'LandMark' => $Data['LandMark'], 'CountrySrNo' => $Data['CountrySrNo'], 'StateSrNo' => $Data['StateSrNo'], 'CitySrNo' => $Data['CitySrNo'], 'MobileNumber' => $Data['MobileNumber']);
        foreach ($AddressTableArray as $key => $value) {
            if (is_null($value) || $value == '')
                unset($AddressTableArray[$key]);
        }

        $InsertAddress = $mysql->insert($AddressTableArray, 't4m_address_book');

        if (isset($Insert) && isset($InsertAddress)) {
            echo json_encode(array("ErrorStatus" => 0, "ErrorMessage" => "", "SuccessMessage" => "Data saved successfully"));
        } else {
            echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Something went wrong! Please try again", "SuccessMessage" => ""));
        }
    } else {
        $InsertData = array_merge($Data, $FixedFields);
        $Insert = $mysql->insert($InsertData, $_REQUEST['table_name']);
        if ($Insert) {
            echo json_encode(array("ErrorStatus" => 0, "ErrorMessage" => "", "SuccessMessage" => "Data saved successfully"));
        } else {
            echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Something went wrong! Please try again", "SuccessMessage" => ""));
        }
    }
} else if ($_REQUEST['do'] == 'update_data') {
    $Data = unserializeForm($_REQUEST['data']);
    foreach ($Data as $key => $value) {
        if (empty($value) || $value == NULL)
            unset($Data[$key]);
    }
    $FixedFields = array('ModificationByUser' => $_SESSION[SESSION_ALIAS]['session']['user_id'], 'ModifyDate' => date('Y-m-d'));
    if (isset($_REQUEST['table_name']) && $_REQUEST['table_name'] == 't4m_users') {
        $UserTableArray = array('UserType' => $Data['UserType'], 'username' => $Data['username'], 'password' => '', 'PrefixID' => $Data['PrefixID'], 'first_name' => $Data['first_name'], 'middle_name' => $Data['middle_name'], 'last_name' => $Data['last_name'], 'dob' => $Data['dob'], 'profile_pic' => $Data['profile_pic'], 'sex' => $Data['sex'], 'land_number' => $Data['land_number'], 'AddressProof' => $Data['AddressProof'], 'PhotoProof' => $Data['PhotoProof'], 'OtherProof' => $Data['OtherProof'], 'store_name' => $Data['store_name'], 'about_me' => $Data['about_me'], 'term_text' => $Data['term_text'], 'SecQue' => $Data['SecAns'], 'ip_address' => $Data['ip_address'], 'is_active' => $Data['is_active']);
        if ($UserTableArray['password'] == md5('')) {
            unset($UserTableArray['password']);
        }
        $UpdateData = array_merge($UserTableArray, $FixedFields);
        foreach ($UpdateData as $key => $value) {
            if (empty($value) || $value == NULL) {
                unset($UpdateData[$key]);
            }
        }
        $Update = $mysql->update($_REQUEST['table_name'], $UpdateData, array($_REQUEST['cond_field'] => $_REQUEST['cond_value']));

        $AddressTableArray = array('FullName' => $Data['first_name'] . ' ' . $Data['middle_name'] . ' ' . $Data['last_name'], 'is_active' => 'Y', 'AddressLine1' => $Data['AddressLine1'], 'AddressLine2' => $Data['AddressLine2'], 'AddressLine3' => $Data['AddressLine3'], 'ZIPCode' => $Data['ZIPCode'], 'LandMark' => $Data['LandMark'], 'CountrySrNo' => $Data['CountrySrNo'], 'StateSrNo' => $Data['StateSrNo'], 'CitySrNo' => $Data['CitySrNo'], 'MobileNumber' => $Data['MobileNumber']);
        foreach ($AddressTableArray as $key => $value) {
            if (is_null($value) || $value == '')
                unset($AddressTableArray[$key]);
        }

        $UpdateAddress = $mysql->update('t4m_address_book', $AddressTableArray, array($_REQUEST['cond_field'] => $_REQUEST['cond_value'], 'DefaultStatus' => 'Y'));

        if (isset($Update) && isset($UpdateAddress)) {
            echo json_encode(array("ErrorStatus" => 0, "ErrorMessage" => "", "SuccessMessage" => "Data saved successfully"));
        } else {
            echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Something went wrong! Please try again", "SuccessMessage" => ""));
        }
    } else {
        $UpdateData = array_merge($Data, $FixedFields);
        //print_r($UpdateData);
        $Update = $mysql->update($_REQUEST['table_name'], $UpdateData, array($_REQUEST['cond_field'] => $_REQUEST['cond_value']));
        if ($Update) {
            echo json_encode(array("ErrorStatus" => 0, "ErrorMessage" => "", "SuccessMessage" => "Data saved successfully"));
        } else {
            echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Something went wrong! Please try again", "SuccessMessage" => ""));
        }
    }
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'logout') {
    unset($_SESSION[SESSION_ALIAS]['session']);
    unset($_SESSION[SESSION_ALIAS]['CartItems']);
    unset($_SESSION[SESSION_ALIAS]['CartItemTotal']);
    unset($_SESSION[SESSION_ALIAS]['CartQuantityTotal']);
    unset($_SESSION[SESSION_ALIAS]['Order']);
    echo json_encode(array("ErrorStatus" => 0, "RedirectURL" => 'home'));
} else if(isset($_REQUEST['do']) && $_REQUEST['do'] == 'SendForgotPasswordToken'){
     $ForgatPasswordToken = $fn->ForgotPasswordTokenGenerate();
     $response = json_encode($ForgatPasswordToken, true);
     echo $response;
} else if(isset($_REQUEST['do']) && $_REQUEST['do'] == 'ChangePasswordPassword'){
     $ChangeForgotPassword = $fn->ForgotPasswordChange();
     $response = json_encode($ChangeForgotPassword, true);
     echo $response;
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'AddressBookManagement') {
    //$Query = $mysql->selectdata('t4m_users', '', array('is_active' => 'Y', 'email' => $_REQUEST['email'], 'UserType' => $_REQUEST['UserType']));
    $FormData = unserializeForm($_REQUEST['FormData']);
    $FormData['user_id'] = $_SESSION[SESSION_ALIAS]['session']['user_id'];
    if (isset($_SESSION[SESSION_ALIAS]['session']['user_id'])) {
        if (isset($FormData['AddressID']) && $FormData['AddressID'] != '') {
            $AddressQuery = $mysql->update('t4m_address_book', $FormData, array('AddressID' => $FormData['AddressID']));
        } else {
            unset($FormData['AddressID']);
            $AddressQuery = $mysql->insert($FormData, 't4m_address_book');
        }

        if (isset($AddressQuery)) {
            echo json_encode(array("ErrorStatus" => 0, "ErrorMessage" => "", "SuccessMessage" => "Address Saved Successfully"));
        } else {
            echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Something went wrong! Please reload page and try again", "SuccessMessage" => ""));
        }
    } else {
        echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Session Expired! Please login and try again", "SuccessMessage" => ""));
    }
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'ProfileManagement') {
    $FormData = unserializeForm($_REQUEST['FormData']);
    $FormData['user_id'] = $_SESSION[SESSION_ALIAS]['session']['user_id'];
    if (isset($_SESSION[SESSION_ALIAS]['session']['user_id'])) {
        if (isset($FormData['user_id']) && $FormData['user_id'] != '') {
            $ProfileQuery = $mysql->update('t4m_users', $FormData, array('user_id' => $FormData['user_id']));
        }
        if (isset($ProfileQuery)) {
            echo json_encode(array("ErrorStatus" => 0, "ErrorMessage" => "", "SuccessMessage" => "Profile Saved Successfully"));
        } else {
            echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Something went wrong! Please reload page and try again", "SuccessMessage" => ""));
        }
    } else {
        echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Session Expired! Please login and try again", "SuccessMessage" => ""));
    }
} else if ($_REQUEST['do'] == 'change_avatar') {
    if ($_REQUEST['user_type'] == 1) {
        echo $query_str = $mysql->update('t4m_admin_users', array('profile_pic' => $_REQUEST['avatar']), array('user_id' => $_REQUEST['user_id']));
    } else {
        echo $query_str = $mysql->update('t4m_users', array('profile_pic' => $_REQUEST['avatar']), array('user_id' => $_REQUEST['user_id']));
    }
    //echo $image_query = $stdb->update(TBL_USERS, array('user_id' => $_REQUEST['user_id']), array('profile_pic' => $_REQUEST['avatar']), '');
} else if ($_REQUEST['do'] == "check_email") {
    $exist = ' email ="' . $_REQUEST['value'] . '"';
    if (isset($_REQUEST['user_id'])) {
        $exist .= " AND user_id != '" . $_REQUEST['user_id'] . "'";
    }
    $select_email = $mysql->selectdata('t4m_users', array('user_id', 'username', 'email'), $exist);
    if (is_array($select_email) && !empty($select_email)) {
        echo "Y";
    } else {
        echo "N";
    }
} else if ($_REQUEST['do'] == "check_username") {
    $exist = ' username ="' . $_REQUEST['value'] . '"';
    if (isset($_REQUEST['user_id'])) {
        $exist .= ' AND user_id != "' . $_POST['user_id'] . '"';
    }
    $select_username = $mysql->selectdata('t4m_users', array('user_id', 'username', 'email'), $exist);

    if (is_array($select_username) && !empty($select_username)) {
        echo "Y";
    } else {
        echo "N";
    }
} else if ($_REQUEST['do'] == "verify_password") {
    if ($_REQUEST['user_type'] == 1) {
        $query_str = $mysql->selectdata('t4m_admin_users', array('user_id', 'password'), array('user_id' => $_SESSION[SESSION_ALIAS]['session']['user_id']));
    } else {
        $query_str = $mysql->selectdata('t4m_users', array('user_id', 'password'), array('user_id' => $_SESSION[SESSION_ALIAS]['session']['user_id']));
    }
    if ($query_str[0]['password'] == md5($_REQUEST['cur_pwd'])) {
        echo 1;
    } else {
        echo 0;
    }
} else if ($_REQUEST['do'] == "update_password") {
    if ($_REQUEST['user_type'] == 1) {
        $query_str = $mysql->update('t4m_admin_users', array('password' => md5($_REQUEST['password'])), array('user_id' => $_SESSION[SESSION_ALIAS]['session']['user_id']));
    } else {
        $query_str = $mysql->update('t4m_users', array('password' => md5($_REQUEST['password'])), array('user_id' => $_SESSION[SESSION_ALIAS]['session']['user_id']));
    }
    if ($query_str) {
        echo 1;
    }
} else if ($_REQUEST['do'] == "PasswordValidate") {
    if (isset($_REQUEST['password']) && isset($_REQUEST['cnf_password'])) {
        if (strlen($_REQUEST['password']) > 7 && strlen($_REQUEST['password']) < 17) {
            if (preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $_REQUEST['password'])) {
                if ($_REQUEST['password'] != $_REQUEST['cnf_password']) {
                    echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Password not matching"));
                }
            } else {
                echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Password must be alphabet & number"));
            }
        } else {
            echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Please enter password between 8-16 characters"));
        }
    } else {
        echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Please enter password field"));
    }
}  else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetStates') {
    $States = $db->prepare("SELECT * FROM `t4m_states` WHERE `t4m_states`.`CountrySrNo`='" . $_REQUEST['CountrySrNo'] . "' AND `t4m_states`.`is_active` = 'Y'");
    $States->execute();
    $StateArray = $States->fetchAll(PDO::FETCH_ASSOC);
    $StatesHTML = '';
    $StatesHTML .= '<option value="">Select State</option>';
    foreach ($StateArray as $K => $V) {
        $StatesHTML .= '<option value="' . $V['StateSrNo'] . '">' . $V['StateName'] . '</option>';
    }
    echo $StatesHTML;
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetAreas') {
    $Areas = $db->prepare("SELECT * FROM `v_area` WHERE `v_area`.`CityID`='" . $_REQUEST['CityID'] . "' AND `v_area`.`is_active` = 'Y'");
    $Areas->execute();
    $AreasArray = $Areas->fetchAll(PDO::FETCH_ASSOC);
    $AreasHTML = '';
    $AreasHTML .= '<option value="">Select Area</option>';
    foreach ($AreasArray as $K => $V) {
        $AreasHTML .= '<option value="' . $V['AreaID'] . '">' . $V['AreaName'] . '</option>';
    }
    echo $AreasHTML;
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'Registration') {
    
     $Regist = $fn->Registration();
     $response = json_encode($Regist, true);
     echo $response;
    
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'UserLogin') {
     $Login = $fn->UserLogin('{"UserName":"'.$_REQUEST['UserName'].'","Password":"'.$_REQUEST['Password'].'"}');
     $response = json_encode($Login, true);
     echo $response;
    
}else if ($_REQUEST['do'] == "ChangeStatus") {
    $update_status = $mysql->update($_REQUEST['table'], array($_REQUEST['status_field'] => $_REQUEST['status'],"ModificationDate" => date('Y-m-d H:i:s'),"ModificationBy"=>$_SESSION[SESSION_ALIAS]['session']['UserID']), array($_REQUEST['id_field'] => $_REQUEST['id']));
    if ($update_status) {
        echo "Status Changed";
    } else {
        echo 0;
    }
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertStateData') {
     $State = $fn->InsertStateData();
     $response = json_encode($State, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertCityData') {
     $City = $fn->InsertCityData();
     $response = json_encode($City, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertAreaData') {
     $Area = $fn->InsertAreaData();
     $response = json_encode($Area, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertCategoryData') {
     $CategoryData = $fn->InsertCategoryData();
     $response = json_encode($CategoryData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertCreditNoteData') {
     $InsertCreditNoteData= $fn->InsertCreditNoteData();
     $response = json_encode($InsertCreditNoteData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertBookData') {
     $BookData = $fn->InsertBookData();
     $response = json_encode($BookData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'PlaceOrder') {
     $PlaceOrderData = $fn->PlaceOrder();
     $response = json_encode($PlaceOrderData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'AgentPlaceOrder') {
     $AgentPlaceOrderData = $fn->AgentPlaceOrder();
     $response = json_encode($AgentPlaceOrderData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'RetailerPlaceOrder') {
     $RetailerPlaceOrderData = $fn->RetailerPlaceOrder();
     $response = json_encode($RetailerPlaceOrderData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'UserPlaceOrder') {
//    echo "<pre>";
//    print_r($_REQUEST);
//    exit;
     $UserPlaceOrderData = $fn->UserPlaceOrder();
     $response = json_encode($UserPlaceOrderData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertRetailerBookStockData') {
    $RetailerBookQuantityData = $fn->InsertRetailerBookStockData();
     $response = json_encode($RetailerBookQuantityData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertUserBookStockData') {
    $UserBookQuantityData = $fn->InsertUserBookStockData();
     $response = json_encode($UserBookQuantityData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertBookQuantityData') {
     $BookQuantityData = $fn->InsertBookQuantityData();
     $response = json_encode($BookQuantityData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertAgentBookStockData') {
//    echo "<pre>" ;
//    print_r($_REQUEST);
    $AgentBookQuantityData = $fn->InsertAgentBookStockData();
     $response = json_encode($AgentBookQuantityData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertOnBehalfOFAgentBookStockData') {
//    echo "<pre>" ;
//    print_r($_REQUEST);
    $AgentBehalfBookQuantityData = $fn->InsertOnBehalfOFAgentBookStockData();
     $response = json_encode($AgentBehalfBookQuantityData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertAgentData') {
    $AgentData = $fn->InsertAgentData();
     $response = json_encode($AgentData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertRetailerOpeningBalanceData') {
    $RetailerOpeningBalanceData = $fn->InsertRetailerOpeningBalanceData();
     $response = json_encode($RetailerOpeningBalanceData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertRetailerOpeningBalance') {
    $RetailerOpeningBalance = $fn->InsertRetailerOpeningBalance();
     $response = json_encode($RetailerOpeningBalance, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertGeneralUserBalanceData') {
    $RetailerOpeningBalanceData = $fn->InsertGeneralUserBalanceData();
     $response = json_encode($RetailerOpeningBalanceData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertClientData') {
    $AgentData = $fn->InsertClientData();
     $response = json_encode($AgentData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'update_data_book') {
//    echo "<pre>";
//    print_r($_REQUEST);
//    exit;
    
    $UpdateQuery = $mysql->update($TableName, $UpdateFields, $UpdateCondition);
    if ($UpdateQuery) {
        $ReturnMessage = "Record Updated Successfully";
    }
    echo $ReturnMessage;
}else if ($_REQUEST['do'] == "DeleteSingleRecord") {
    
//    if ($_REQUEST['table'] == 'v_state' || $_REQUEST['table'] == 'v_country' || $_REQUEST['table'] == 'v_city') {
//       
//        $Flag = array();
//        $TablesToCheck = explode(',', $_REQUEST['TablesToCheck']);
//        $FieldsToCheck = explode(',', $_REQUEST['FieldsToCheck']);
//        for ($i = 0; $i < sizeof($TablesToCheck); $i++) {
//            
//            $CheckQuery = $db->prepare("SELECT * FROM " . $TablesToCheck[$i] . " WHERE " . $FieldsToCheck[$i] . " = '" . $_REQUEST['id'] . "'");
//            $CheckQuery->execute();
//            $Rows = $CheckQuery->rowCount();
//            if ($Rows > 0) {
//                $Flag[$i] = 1;
//            } else {
//                $Flag[$i] = 0;
//            }
//        }
//        if (in_array(1, $Flag)) {
//            $ReturnMessage = 'This Recored Is In Use';
//        } else {
//            $update_status = $mysql->update($_REQUEST['table'], array($_REQUEST['status_field'] => $_REQUEST['status'], "ModificationDate" => date('Y-m-d H:i:s'), "ModificationBy" => $_SESSION[SESSION_ALIAS]['session']['UserID']), array($_REQUEST['id_field'] => $_REQUEST['id']));
//            if ($update_status) {
//                $ReturnMessage = "Record Deleted";
//            } else {
//                $ReturnMessage = '0';
//            }
//        }
//    } else {
     $update_status = $mysql->update($_REQUEST['table'], array($_REQUEST['status_field'] => $_REQUEST['status'], "ModificationDate" => date('Y-m-d H:i:s'), "ModificationBy" => $_SESSION[SESSION_ALIAS]['session']['UserID']), array($_REQUEST['id_field'] => $_REQUEST['id']));
        if ($update_status) {
            $ReturnMessage = "Record Deleted";
        } else {
            $ReturnMessage = '0';
        }
//    }
    echo $ReturnMessage;
}else if ($_REQUEST['do'] == "RemoveRetailerBook") {
     $update_status = $mysql->update($_REQUEST['table'], array($_REQUEST['status_field'] => $_REQUEST['status'], "ModificationDate" => date('Y-m-d H:i:s'), "ModificationBy" => $_SESSION[SESSION_ALIAS]['session']['UserID']), array($_REQUEST['id_field'] => $_REQUEST['id']));
        if ($update_status) {
            $ReturnMessage = "Record Deleted";
        } else {
            $ReturnMessage = '0';
        }
    echo $ReturnMessage;
}else if ($_REQUEST['do'] == "GetDataByMobileNumber") {
//    echo "SELECT Address.*,City.CityName,User.UserName,User.Email FROM b_user_address AS Address LEFT JOIN b_city AS City ON Address.CityID = City.CityID LEFT JOIN b_user AS User ON Address.UserID = User.UserID WHERE Address.is_active != 'D' AND User.MobileNumber='".$_REQUEST['MobileNumber']."' ";
            $GeneralData = $db->prepare("SELECT Address.*,City.CityName,User.UserName,User.Email FROM b_user_address AS Address LEFT JOIN b_city AS City ON Address.CityID = City.CityID LEFT JOIN b_user AS User ON Address.UserID = User.UserID WHERE Address.is_active != 'D' AND User.MobileNumber='".$_REQUEST['MobileNumber']."' ");
            $GeneralData->execute();
            $GeneralWiseData = $GeneralData->fetch(PDO::FETCH_ASSOC);
//            print_r($GeneralWiseData);
            $response = json_encode($GeneralWiseData, true);
//            print_r($GeneralWiseData);
    echo $response ;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'AddToCart') {
    $CartData = $fn->AddToCart('{"BookID":"'.$_REQUEST['BookID'].'","UserID":"'.$_REQUEST['UserID'].'","Quantity":"'.$_REQUEST['Quantity'].'"}');
     $response = json_encode($CartData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'SearchBook') {
     $SearchData = $fn->SearchBook('{"SearchText":"'.$_REQUEST['SearchText'].'"}');
     $response = json_encode($SearchData, true);
     $SearchHTML = '';
     foreach ($SearchData['GetSearchBookWiseData'] as $K => $V) {
//         $SearchHTML = '<div class="col-md-4 box_2">';
         $SearchHTML = '<div class="grid_1"><a href="Single.php?BookID="'.$V['BookID'].'">';
         $SearchHTML = '<div class="b-link-stroke b-animate-go  thickbox">';
         $SearchHTML = '<img src="admin/uploads/BookImage/'.$V['BookImage'].'" class="img-responsive" style="height: 200px;width: 100%" alt=""/></div>
                                        <div class="grid_2">
                                            <p>"'.$V['BookTitle'].'""</p>
                                            <ul class="grid_2-bottom">
                                                <li class="grid_2-left">Price    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$V['BookPrice'].'</li>
                                                <li class="grid_2-left">Author &nbsp; : '.$V['BookAutherName'].'</p></li>
                                                <li class="grid_2-right">
                                                    <div class="btn btn-primary btn-normal btn-inline " >
                                                        
                                                        <a href="Single.php?BookID='.$V['BookID'].'">Get It</a>
                                                    </div></li>
                                                <div class="clearfix"> </div>
                                            </ul>
                                        </div></a>
                                </div>';
         
     }
     echo $SearchHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'RemoveFromCart') {
    $CartData = $fn->RemoveFromCart('{"BookID":"'.$_REQUEST['BookID'].'","UserID":"'.$_REQUEST['UserID'].'","CartID":"'.$_REQUEST['CartID'].'","Quantity":"'.$_REQUEST['Quantity'].'"}');
     $response = json_encode($CartData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertRegistrationData') {
//    echo "HEllo";
//    exit;
     $RegistrationData = $fn->InsertRegistrationData();
     $response = json_encode($RegistrationData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertExpenseData') {
//    echo "HEllo";
//    exit;
     $ExpenseData  = $fn->InsertExpenseData();
     $response = json_encode($ExpenseData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'SearchPlayersData') {
        $SearchResult = $fn->SearchPlayersData('{"CityID":"'.$_REQUEST['CityID'].'","PlayerName":"'.$_REQUEST['PlayerName'].'","CaptainAge":"'.$_REQUEST['CaptainAge'].'","CaptainGender":"'.$_REQUEST['CaptainGender'].'","CaptainID":"'.$_REQUEST['CaptainID'].'","BodyType":"'.$_REQUEST['BodyType'].'","FavoritePosition":"'.$_REQUEST['FavoritePosition'].'"}');
        $response = json_encode($SearchResult, true);
        $PlayerData = '';
        $PlayerData .= '<table class="table-responsive table table-striped" border=1 width=100%>'; 
        $PlayerData .= '<tr><th>Player Name</th><th>Height</th><th>Weight</th><th>Age</th><th>Date Of Birth</th><th>Email Id</th><th>Favorite Position</th><th>Body Type</th><th>Select Player</th></tr>';
     if($SearchResult['ResponseCode'] != 0){
     foreach ($SearchResult['GetPlayerData'] as $K => $V) {
         $DOB = date('d-m-Y',  strtotime($V['DOB']));
        $PlayerData .= '<tr><td>'; 
        $PlayerData .= '<a title="Click Here To See More" href="search_my_profile&UserID='.$V['UserID'].'">' . $V['FirstName'] . ' ' . $V['LastName'] . '</a>';
        $PlayerData .= '</td>';
        $PlayerData .= '<td>'; 
        $PlayerData .= '<label>' . htmlspecialchars($V['Height']). '</label>';
        $PlayerData .= '</td>';
        $PlayerData .= '<td>'; 
        $PlayerData .= '<label>' . $V['Weight'] . ' Kg</label>';
        $PlayerData .= '</td>';
        $PlayerData .= '<td>'; 
        $PlayerData .= '<label>' . $V['Age'] . ' Year</label>';
        $PlayerData .= '</td>';
        $PlayerData .= '<td>'; 
        $PlayerData .= '<label>' . $DOB. '</label>';
        $PlayerData .= '</td>';
        $PlayerData .= '<td>'; 
        $PlayerData .= '<label>' . $V['EmailID'] . '</label>';
        $PlayerData .= '</td>';
        $PlayerData .= '<td>'; 
        $PlayerData .= '<label>' . $V['FavoritePosition'] . '</label>';
        $PlayerData .= '</td>';
        $PlayerData .= '<td>'; 
        $PlayerData .= '<label>' . $V['BodyType'] . '</label>';
        $PlayerData .= '</td>';
        $PlayerData .= '<td><input type="checkbox" id='.$V['UserID'].' name="SelectedPlayer" > </td></tr>';
        }
        $PlayerData .= '<tr><td colspan="9" align="center"><input type="button" class="btn btn-primary" name="SelectPlaer" value="Send Invitation" onclick="SaveTeamPlayer()"> </td></tr>';
        }else{
        $PlayerData .= '<tr><td colspan="9" align="center">No Record Found </td></tr>';
        }
        $PlayerData .= '</table>';
        echo $PlayerData;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'ChangeEmail') {
//    print_r($_REQUEST);
//    exit;
     $SendTeamToVerification = $fn->EmailIDChange();
     $response = json_encode($SendTeamToVerification, true);
     echo $response;
    
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'EmailChangeToken') {

     $ChangeEmailOTP = $fn->EmailChangeTokenGenerate();
     $response = json_encode($ChangeEmailOTP, true);
     echo $response;
    
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetCities') {
   
    $Cities = $db->prepare("SELECT * FROM `v_city` WHERE `v_city`.`StateID`='" . $_REQUEST['StateID'] . "' AND `v_city`.`is_active` = 'Y'");
    $Cities->execute();
    $CityArray = $Cities->fetchAll(PDO::FETCH_ASSOC);
    $CityHTML = '';
    $CityHTML .= '<option value="">Select City</option>';
    foreach ($CityArray as $K => $V) {
        $CityHTML .= '<option value="' . $V['CityID'] . '">' . $V['CityName'] . '</option>';
    }
    echo $CityHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetBook') {
   
    $QueryBooks = $db->prepare("SELECT * FROM `b_bookmaster` WHERE `CategoryID`='" . $_REQUEST['CategoryID'] . "' AND `is_active` = 'Y'");
    $QueryBooks->execute();
    $BooksArray = $QueryBooks->fetchAll(PDO::FETCH_ASSOC);
    $BooksHTML = '';
    $BooksHTML .= '<option value="">Select Book</option>';
    foreach ($BooksArray as $K => $V) {
        $BooksHTML .= '<option value="' . $V['BookID'] . '">' . $V['BookTitle'] . '</option>';
    }
    echo $BooksHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetBookPrice') {
   
    $QueryBooks = $db->prepare("SELECT * FROM `b_bookmaster` WHERE `BookID`='" . $_REQUEST['BookID'] . "' AND `is_active` = 'Y'");
    $QueryBooks->execute();
    $BooksArray = $QueryBooks->fetch(PDO::FETCH_ASSOC);
//    echo "<pre>";
//    print_r($BooksArray['BookPrice']);
    $BookPrice = $BooksArray['BookPrice'];
    echo $BookPrice ;
//    $BooksHTML = '';
//    $BooksHTML .= '<option value="">Select Book</option>';
//    echo $BooksHTML;
} else if ($_REQUEST['do'] == "save_image_to_table") {
    $insert = $mysql->insert(array($_REQUEST['upload_id'] => $_REQUEST['upload_value'], $_REQUEST['image_field'] => $_REQUEST['image_name'], 'ImageOrderNo' => $_REQUEST['ImageOrderNo'], 'is_active' => 'Y'), $_REQUEST['table']);
    if ($insert) {
        echo "Success";
    }
} else if ($_REQUEST['do'] == "delete_image_from_table") {
    $delete_task = $mysql->delete($_REQUEST['table'], array($_REQUEST['image_field'] => $_REQUEST['image_value']));
    if ($delete_task) {
        echo "Deleted";
    }
}

function unserializeForm($str) {
    $returndata = array();
    $strArray = explode("&", $str);
    $i = 0;
    foreach ($strArray as $item) {
        $array = explode("=", $item);
        $returndata[$array[0]] = str_replace(array('+', '%2B'), array(' ', '+'), urldecode($array[1]));
    }
    return $returndata;
}

function RemoveItem($ProdSrNo) {
    unset($_SESSION[SESSION_ALIAS]['CartItems'][$ProdSrNo]);
    require_once '../class/class.DataTransaction.php';
    $db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $mysql = new DataTransaction($db);
    $mysql->delete('t4m_cart_items', array('CustomerID' => $_SESSION[SESSION_ALIAS]['session']['user_id'], 'ProdSrNo' => $ProdSrNo));
    $CartItemPriceTotal = 0;
    foreach ($_SESSION[SESSION_ALIAS]['CartItems'] as $KeyI => $ValueI) {
        $CartItemPriceTotal += $ValueI['ProductTotalPrice'];
    }
    $_SESSION[SESSION_ALIAS]['CartItemTotal'] = $CartItemPriceTotal; //Total Quantity
    $_SESSION[SESSION_ALIAS]['CartQuantityTotal'] = count($_SESSION[SESSION_ALIAS]['CartItems']);
}
