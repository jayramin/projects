<?php
error_reporting(0);
session_start();
//print_r($_REQUEST);

require_once './class.DataTransaction.php';
require_once './class.functions.php';
require_once '../includes/labels.php';
$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$user = new User($db);
$mysql = new DataTransaction($db);

$fn = new functions($db);

if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'login') {

    $Query = $mysql->selectdata('v_users', '', array('is_active' => 'Y', 'EmailID' => $_REQUEST['email']));

    //print_r($Query);
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
}  else if ($_REQUEST['do'] == "ItemList") {
    $ColumnData = '';
    $ConditionData = '';
    $ResponseData = '';
    $ViewName = 't4m_product_master';
    $records_per_page = ITEMS_PER_PAGE;
    $Condition = array('t4m_product_master.is_active' => 'Y');
    $starting_position = 0;
    if (isset($_GET["sr_pg"])) {
        $starting_position = ($_GET["sr_pg"] - 1) * $records_per_page;
    }
    if ($Condition != '') {
        foreach ($Condition as $key1 => $value1) {
            $ConditionData .= "AND `$ViewName`.`" . $key1 . "` = '" . $value1 . "' ";
        }
        $Cond = substr($ConditionData, 3, -1);
    } else {
        $Cond = ' 1 ';
    }
    if (is_array($Columns) & isset($Columns)) {
        foreach ($Columns as $key) {
            $ColumnData .= " " . $key . ", ";
        }
    } else {
        $ColumnData = " *  ";
    }
    $Cols = substr($ColumnData, 0, -2);
    $ResponseData = $mysql->innerdata($ViewName, $Condition, array('t4m_product_category_master' => 't4m_product_category_master.CatSrNo=t4m_product_master.CatSrNo'), $Columns, array($_REQUEST['id'], $records_per_page));

    if (is_array($ResponseData) && !empty($ResponseData)) {
        $ItemHTML = '';
        //$ItemHTML .= '<div class="section_offset " >';
        //$ItemHTML .= '<div class="table_layout grid_view grid_view_products" id="products_container">';
        $ItemHTML .= '<div class="table_row">';
        foreach ($ResponseData as $IKey => $IValue) {
            $LastItemID = $IValue['ProdSrNo'];
            //$ItemHTML .= '<div class="table_cell">';
            $ItemHTML .= '<div class="table_cell ItemListID" id="' . $IValue['ProdSrNo'] . '">';
            $ItemHTML .= '<div class="product_item">';
            $ItemHTML .= '<div class="image_wrap">';
            $ItemHTML .= '<img src="assets/images/product_img_6.jpg" alt="">';
            $ItemHTML .= '<div class="actions_wrap">';
            $ItemHTML .= '<div class="centered_buttons">';
            $ItemHTML .= '<a href="#" class="button_dark_grey middle_btn quick_view" id="' . $IValue['ProdSrNo'] . '" onclick="quick_view(this);" data-modal-url="assets/modals/product_view.html">Quick View</a>';
            $ItemHTML .= '<a href="javascript::void(0);" class="button_blue middle_btn add_to_cart Add" id="sm_item_' . $IValue['ProdSrNo'] . '">Add to Cart</a>';
            $ItemHTML .= '</div><!--/ .centered_buttons -->';
            //$ItemHTML .= '<a href="#" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>';
            //$ItemHTML .= '<a href="#" class="button_dark_grey def_icon_btn middle_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>';
            $ItemHTML .= '</div>';
            $ItemHTML .= '<div class="label_new">New ' . $IValue['ProdSrNo'] . '</div>';
            $ItemHTML .= '<span id="sm_color_' . $IValue['ProdSrNo'] . '" style="display:none;">' . substr($IValue['ProdColor'], 0, 7) . '</span>';
            $ItemHTML .= '<input id="TListQuickProductCartQty_' . $IValue['ProdSrNo'] . '" type="hidden" value="1"/>';
            $ItemHTML .= '</div>';
            $ItemHTML .= '<div class="description">';
            $ItemHTML .= '<a href="#">' . $IValue['ProdName'] . $IValue['ProdShortDesc'] . '</a>';
            $ItemHTML .= '<div class="clearfix product_info">';
            $ItemHTML .= '<p>Cash on delivery available</p>';
            $ItemHTML .= '<p class="product_price alignleft"><span class="out_of_stock"><b>&#8360. ' . $IValue['ProdBasePrice'] . '</b></span></p>';
            $MfgData = $mysql->selectdata('t4m_manufacturer_master', '', array('MfgID' => $IValue['MfgID'])); //'SELECT `MfgName` FROM `t4m_manufacturer_master` WHERE `MfgID` =  "' . $IValue['MfgID'] . '"');            
            if (isset($MfgData[0]['MfgName']) && $MfgData[0]['MfgName'] != '') {
                $ItemHTML .= '<p class="product_price alignright">By <b>' . $MfgData[0]['MfgName'] . '</b></p>';
            }
            $ItemHTML .= '</div>';
            $ItemHTML .= '</div>';
            $ItemHTML .= '<div class="full_description">';
            $ItemHTML .= '<a href="#" class="product_title">' . $IValue['ProdName'] . $IValue['ProdSrNo'] . '</a>';
            $ItemHTML .= '<a href="#" class="product_category">' . $IValue['CatName'] . '</a>';
            $ItemHTML .= '<div class="v_centered product_reviews">';
            $ItemHTML .= '<ul class="topbar">';
            //$ItemHTML .= '<li>0 Review(s)</li>';
            //$ItemHTML .= '<li><a href="#">Add Your Review</a></li>';
            $ItemHTML .= '</ul>';
            $ItemHTML .= '</div>';
            $ItemHTML .= '<p>' . $IValue['ProdName'] . $IValue['ProdShortDesc'] . '</p>';
            //$ItemHTML .= '<a href="#" class="learn_more">Learn More</a>';
            //$ItemHTML .= '<a href="#" class="button_dark_grey middle_btn quick_view" data-modal-url="modals/quick_view.html">Quick View</a>';            
            $ItemHTML .= '</div>';
            $ItemHTML .= '<div class="actions">';
            $ItemHTML .= '<p class="product_price bold">&#8360. ' . $IValue['ProdBasePrice'] . '</p>';
            $ItemHTML .= '<ul class="seller_stats">';
            //$ItemHTML .= '<li>Shipping: '.$IValue['ProdBasePrice'].'/piece</li>';
            $ItemHTML .= '<li>Shipping: <span class="success">Free Shipping</span></li>';
            if (isset($IValue['TotalQty']) && $IValue['TotalQty'] > 0) {
                $ItemHTML .= '<li>Availability: <span class="success">in stock</span></li>';
            } else {
                $ItemHTML .= '<li>Availability: <span class="out_of_stock">' . $IValue['OutStockMessage'] . '</span></li>';
            }
            $SellerData = $mysql->leftdata('t4m_users', array('t4m_users.user_id' => $IValue['VendorID']), array('t4m_address_book' => 't4m_address_book.user_id=t4m_users.user_id', 't4m_countries' => 't4m_address_book.CountrySrNo=t4m_countries.CountrySrNo', 't4m_states' => 't4m_address_book.StateSrNo=t4m_states.StateSrNo', 't4m_cities' => 't4m_address_book.CitySrNo=t4m_cities.CitySrNo'), '', '');
            $ItemHTML .= '<li class="seller_info_wrap">';
            if (isset($SellerData['VendorName']) && $SellerData['VendorName'] != '') {
                $ItemHTML .= 'Vendor: <span class="seller_name">' . $SellerData['VendorName'] . '</span>';
            }
            $ItemHTML .= '<div class="seller_info_dropdown">';
            $ItemHTML .= '<ul class="seller_stats">';
            $ItemHTML .= '<li>';
            $ItemHTML .= '<ul class="topbar">';
            if (isset($SellerData['StateName']) || isset($SellerData['CityName'])) {
                $ItemHTML .= '<li>' . $SellerData['CityName'] . ' (' . $SellerData['StateName'] . ')</li>';
                //$ItemHTML .= 'Vendor: <span class="seller_name">' . $SellerData['VendorName'] . '</span>';  
            }
            if (isset($SellerData['cell_number'])) {
                $ItemHTML .= '<li class="seller_info_wrap">Contact Number</li>';
                $ItemHTML .= '</ul>';
                $ItemHTML .= '</li>';
                $ItemHTML .= '<li><span class="bold">' . $SellerData['cell_number'] . '</span></li>';
                $ItemHTML .= '</ul>';
            }
            //$ItemHTML .= '<div class="v_centered">';
            //$ItemHTML .= '<a href="#" class="button_blue mini_btn">Contact Seller</a>';
            //$ItemHTML .= '<a href="#" class="small_link">Chat Now</a>';
            //$ItemHTML .= '</div>';
            $ItemHTML .= '</div>';
            $ItemHTML .= '</li>';
            $ItemHTML .= '</ul>';
            $ItemHTML .= '<ul class="buttons_col">';
            $ItemHTML .= '<li><a  href="javascript::void(0);" class="button_blue middle_btn add_to_cart Add" id="sm_item_' . $IValue['ProdSrNo'] . '">Add to Cart</a></li>';
            //$ItemHTML .= '<li><a href="#" class="icon_link"><i class="icon-heart-5"></i>Add to Wishlist</a></li>';
            //$ItemHTML .= '<li><a href="#" class="icon_link"><i class="icon-resize-small"></i>Add to Compare</a></li>';
            $ItemHTML .= '</ul>';
            $ItemHTML .= '</div>';
            $ItemHTML .= '</div><!--/ .product_item-->';
            $ItemHTML .= '</div>';
            if ($IKey != 0 && ($IKey + 1) % 4 == 0) {
                $ItemHTML .= '</div><div class="table_row">';
            }
        }
        $ItemHTML .= '</div><!--/ .table_row -->';
        //$ItemHTML .= '</div>';    
        //$ItemHTML .= '</div>';    
        echo $ItemHTML;
    } else {
        echo 0;
    }
} else if ($_REQUEST['do'] == "QuickItemView") {
    $ProductData = $mysql->innerdata('t4m_product_master', array('t4m_product_master.ProdSrNo' => $_REQUEST['ProdSrNo']), array('t4m_product_category_master' => 't4m_product_category_master.CatSrNo=t4m_product_master.CatSrNo'), $Columns, '');
    $CategoryData = $mysql->selectdata('t4m_product_category_master', array('CatName', 'CatSrNo', 'CatLevel', 'Level0', 'Level1'), array('CatSrNo' => $ProductData[0]['CatSrNo']));
    $SubCategory1Data = $mysql->selectdata('t4m_product_category_master', array('CatName', 'CatSrNo', 'CatLevel', 'Level0', 'Level1'), array('CatSrNo' => $ProductData[0]['SubCatLevel2SrNo']));
    $VendorData = $mysql->leftdata('t4m_users', array('t4m_users.user_id' => $ProductData[0]['VendorID']), array('t4m_address_book' => 't4m_address_book.user_id=t4m_users.user_id', 't4m_countries' => 't4m_address_book.CountrySrNo=t4m_countries.CountrySrNo', 't4m_states' => 't4m_address_book.StateSrNo=t4m_states.StateSrNo', 't4m_cities' => 't4m_address_book.CitySrNo=t4m_cities.CitySrNo'), '', '');
    if (is_array($ProductData[0]) && !empty($ProductData[0])) {
        echo json_encode(array("ErrorStatus" => 0, "ErrorMessage" => "", "ProductData" => $ProductData[0], 'CategoryData' => $CategoryData[0], 'SubCategory1Data' => $SubCategory1Data[0], 'VendorData' => $VendorData[0]));
    } else {
        echo json_encode(array("ErrorStatus" => 1, "ErrorMessage" => "Something went wrong! Please reload page and try again", "SuccessMessage" => ""));
    }
} else if ($_REQUEST['do'] == "AddItemToCart") {
    if (isset($_REQUEST['WhatToDo']) && $_REQUEST['WhatToDo'] == 'Remove') {
        RemoveItem($_REQUEST['ProdSrNo']);
    }

    if (isset($_REQUEST['WhatToDo']) && ($_REQUEST['WhatToDo'] == 'Add' || $_REQUEST['WhatToDo'] == 'Minus')) {
        if (isset($_REQUEST['ProdSrNo']) && !empty($_REQUEST['ProdSrNo'])) {
            $ProductData = $mysql->innerdata('t4m_product_master', array('t4m_product_master.ProdSrNo' => $_REQUEST['ProdSrNo']), array('t4m_product_category_master' => 't4m_product_category_master.CatSrNo=t4m_product_master.CatSrNo'), $Columns, '');
            $CategoryData = $mysql->selectdata('t4m_product_category_master', array('CatName', 'CatSrNo', 'CatLevel', 'Level0', 'Level1'), array('CatSrNo' => $ProductData[0]['CatSrNo']));
            $SubCategory1Data = $mysql->selectdata('t4m_product_category_master', array('CatName', 'CatSrNo', 'CatLevel', 'Level0', 'Level1'), array('CatSrNo' => $ProductData[0]['SubCatLevel2SrNo']));
            $SizeData = $mysql->selectdata('t4m_product_size', array('SizeID', 'SizeName'), array('SizeID' => $ProductData[0]['ProdSize']));
            $VendorData = $mysql->leftdata('t4m_users', array('t4m_users.user_id' => $ProductData[0]['VendorID']), array('t4m_address_book' => 't4m_address_book.user_id=t4m_users.user_id', 't4m_countries' => 't4m_address_book.CountrySrNo=t4m_countries.CountrySrNo', 't4m_states' => 't4m_address_book.StateSrNo=t4m_states.StateSrNo', 't4m_cities' => 't4m_address_book.CitySrNo=t4m_cities.CitySrNo'), '', '');
            $MfgData = $mysql->selectdata('t4m_manufacturer_master', array('MfgID', 'MfgName', 'MfgOwnerName'), array('MfgID' => $ProductData[0]['MfgID']));
        }
        if (isset($_REQUEST['Quantity']) && $_REQUEST['Quantity'] > 0) {
            if ($_REQUEST['ProdSrNo'] === $_SESSION[SESSION_ALIAS]['CartItems'][$_REQUEST['ProdSrNo']]['ProdSrNo']) {
                if (isset($_REQUEST['Counter']) && $_REQUEST['Counter'] == 'Decrease') {
                    if ($_SESSION[SESSION_ALIAS]['CartItems'][$_REQUEST['ProdSrNo']]['ProductQuantity'] > 1) {
                        $Quantity = $_SESSION[SESSION_ALIAS]['CartItems'][$_REQUEST['ProdSrNo']]['ProductQuantity'] - 1;
                        $ProductPrice = ($ProductData[0]['ProdBasePrice'] * $Quantity);
                    }
                } else if (isset($_REQUEST['Counter']) && $_REQUEST['Counter'] == 'Increase') {
                    $Quantity = $_SESSION[SESSION_ALIAS]['CartItems'][$_REQUEST['ProdSrNo']]['ProductQuantity'] + $_REQUEST['Quantity'];
                    $ProductPrice = ($ProductData[0]['ProdBasePrice'] * $Quantity);
                }
            } else {
                $Quantity = $_REQUEST['Quantity'];
                $ProductPrice = $ProductData[0]['ProdBasePrice'] * $_REQUEST['Quantity'];
            }
        } else {
            $Quantity = 1;
            $ProductPrice = $ProductData[0]['ProdBasePrice'];
        }
        if (isset($_REQUEST['ColorCode']) && !empty($_REQUEST['ColorCode'])) {
            $ProductColor = $_REQUEST['ColorCode'];
        }


        $CartItemToStore = array('ProdSrNo' => $ProductData[0]['ProdSrNo'], 'ProdUniqID' => $ProductData[0]['ProdUniqID'], 'ProdCode' => $ProductData[0]['ProdCode'], 'ProdBasePrice' => $ProductData[0]['ProdBasePrice'], 'ProductQuantity' => $Quantity, 'ProductTotalPrice' => $ProductPrice, 'ProdName' => $ProductData[0]['ProdName'], 'ProdDesc' => $ProductData[0]['ProdDesc'], 'ProdPrimaryImage' => $ProductData[0]['ProdPrimaryImage'], 'MfgID' => $ProductData[0]['MfgID'], 'MfgName' => $MfgData[0]['MfgName'], 'BrandID' => $ProductData[0]['BrandID'], 'ProdColor' => $ProductColor, 'ProdSizeName' => $SizeData[0]['SizeName'], 'ProdSize' => $ProductData[0]['ProdSize'], 'ProdCommission' => '', 'ProdHeight' => $ProductData[0]['ProdHeight'], 'ProdWidth' => $ProductData[0]['ProdWidth'], 'ProdLength' => $ProductData[0]['ProdLength'], 'ProdWeight' => $ProductData[0]['ProdWeight'], 'ExpDeliveryPrice' => '', 'StoreID' => $ProductData[0]['StoreID'], 'DiscountActive' => '', 'DiscountPercentage' => '', 'DiscountAmount' => '', 'CatSrNo' => $ProductData[0]['CatSrNo'], 'CatName' => $CategoryData[0]['CatName'], 'SubCatLevel1SrNo' => $ProductData[0]['SubCatLevel1SrNo'], 'SubCatLevel1Name' => $SubCategory1Data[0]['CatName'], 'SubCatLevel2SrNo' => $ProductData[0]['SubCatLevel2SrNo'], 'SubCatLevel2Name' => '', 'VendorID' => $ProductData[0]['VendorID'], 'VendorName' => $VendorData[0]['first_name'] . ' ' . $VendorData[0]['middle_name'] . ' ' . $VendorData[0]['last_name'], 'VendorEmail' => $VendorData[0]['email'], 'VendorMobileNumber' => $VendorData[0]['cell_number']);
        if (isset($_SESSION[SESSION_ALIAS]['session']['user_id']) && !empty($_SESSION[SESSION_ALIAS]['session']['user_id'])) {
            MergeItems($CartItemToStore, $_REQUEST['ProdSrNo'], '');
        } else {
            MergeItems($CartItemToStore, $_REQUEST['ProdSrNo'], '');
        }
    }
    if (isset($_SESSION[SESSION_ALIAS]['session']['user_id']) && !empty($_SESSION[SESSION_ALIAS]['session']['user_id'])) {
        $TempItemCheck = $mysql->selectdata('t4m_cart_items', array('ProdSrNo', 'CustomerID'), array('CustomerID' => $_SESSION[SESSION_ALIAS]['session']['user_id'], 'ProdSrNo' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdSrNo']));
        $SessionItemData = array('CustomerID' => $_SESSION[SESSION_ALIAS]['session']['user_id'], 'ProdSrNo' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdSrNo'], 'ProdName' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdName'], 'VendorID' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['VendorID'], 'VendorName' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['VendorName'], 'VendorEmail' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['VendorEmail'], 'VendorMobileNumber' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['VendorMobileNumber'], 'ProdUniqID' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdUniqID'], 'ProdPrimaryImage' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdPrimaryImage'], 'ProdCode' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdCode'], 'ProdDesc' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdDesc'], 'MfgID' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['MfgID'], 'MfgName' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['MfgName'], 'BrandID' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['BrandID'], 'BrandName' => '', 'ProdSizeID' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdSize'], 'ProdSizeName' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdSizeName'], 'ProdHeight' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdHeight'], 'ProdWidth' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdWidth'], 'ProdLength' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdLength'], 'ProdWeight' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdWeight'], 'DiscountStatus' => 'No', 'DiscountPercentage' => '', 'DiscountAmount' => '', 'CatSrNo' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['CatSrNo'], 'CatName' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['CatName'], 'TotalQuantity' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProductQuantity'], 'ProdBasePrice' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProdBasePrice'], 'ProductNetAmount' => $_SESSION[SESSION_ALIAS]['CartItems'][$ProductData[0]['ProdSrNo']]['ProductTotalPrice']);
        if (isset($TempItemCheck[0]['ProdSrNo']) && isset($TempItemCheck[0]['CustomerID'])) {
            $SessionUpdateItem = $mysql->update('t4m_cart_items', $SessionItemData, array('ProdSrNo' => $TempItemCheck[0]['ProdSrNo']));
        } else {
            $SessionInsertItem = $mysql->insert($SessionItemData, 't4m_cart_items');
        }
    }
    $CartItemHTML = '';
    //$CartItemHTML .= '<div class="shopping_cart dropdown">';
    if (isset($_SESSION[SESSION_ALIAS]['CartQuantityTotal']) && $_SESSION[SESSION_ALIAS]['CartQuantityTotal'] > 0) {
        $CartItemHTML .= '<div class="animated_item">';
        $CartItemHTML .= '<p class="title">Items in your cart</p>';
        $CartItemHTML .= '</div>';
        $CartItemHTML .= '<div class="ScrollItemList" style="max-height: 200px;overflow-y: auto;">';
        $i = 1;
        foreach ($_SESSION[SESSION_ALIAS]['CartItems'] as $K => $V) {
            $CartItemHTML .= '<div class="animated_item" id="ch_item_' . $_SESSION[SESSION_ALIAS]['CartItems'][$K]['ProdSrNo'] . '">';
            $CartItemHTML .= '<div class="clearfix sc_product">';
            //$CartItemHTML .=  '<b>'.$i.'</b>';
            $CartItemHTML .= '<a href="#" class="product_thumb"><img src="assets/images/items/' . $_SESSION[SESSION_ALIAS]['CartItems'][$K]['ProdPrimaryImage'] . '"  style="max-height:60px;max-width:60px;" alt="' . $_SESSION[SESSION_ALIAS]['CartItems'][$K]['ProdName'] . '"></a>';
            $CartItemHTML .= '<a href="#" class="product_name">' . substr($_SESSION[SESSION_ALIAS]['CartItems'][$K]['ProdName'], 0, 20) . '...</a>';
            $CartItemHTML .= '<p>' . $_SESSION[SESSION_ALIAS]['CartItems'][$K]['ProductQuantity'] . ' x ' . str_replace(',', '', number_format($_SESSION[SESSION_ALIAS]['CartItems'][$K]['ProdBasePrice'], 2)) . '</p>';
            $CartItemHTML .= '<button id="rm_item_' . $_SESSION[SESSION_ALIAS]['CartItems'][$K]['ProdSrNo'] . '" class="close DeleteFromCart add_to_cart Remove"></button>';
            $CartItemHTML .= '</div><!--/ .clearfix.sc_product-->';
            $CartItemHTML .= '</div><!--/ .animated_item-->';
            $i++;
        }
        $CartItemHTML .= '</div>';
        $CartItemHTML .= '<div class="animated_item">';
        $CartItemHTML .= '<!-- - - - - Total info - - - - -  -->';
        $CartItemHTML .= '<ul class="total_info">';
        //$CartItemHTML .= '<li><span class="price">Tax:</span> $0.00</li>';
        //$CartItemHTML .= '<li><span class="price">Discount:</span> $37.00</li>';
        $CartItemHTML .= '<li class="total"><b><span class="price">Total:</span> Rs. ' . str_replace(',', '', number_format($_SESSION[SESSION_ALIAS]['CartItemTotal'], 2)) . '</b></li>';
        $CartItemHTML .= '</ul>';
        $CartItemHTML .= '</div><!--/ .animated_item-->';
        $CartItemHTML .= '<div class="animated_item">';
        $CartItemHTML .= '<a href="cart_items" class="button_grey">View Cart</a>';
        $CartItemHTML .= '<button type="button" class="button_grey EmptyAllCartItems">Empty Cart</button>';
        //$CartItemHTML .= '<a href="#" class="button_blue">Checkout</a>';
        $CartItemHTML .= '</div><!--/ .animated_item-->';
    } else {
        $CartItemHTML .= '<div class="animated_item">';
        $CartItemHTML .= '<p class="title">Your cart is empty right now.</p>';
        $CartItemHTML .= '</div>';
    }
    //$CartItemHTML .= '</div>';
    echo json_encode(array("ErrorStatus" => 0, 'CartItemCount' => count($_SESSION[SESSION_ALIAS]['CartItems']), 'CartItemTotal' => $_SESSION[SESSION_ALIAS]['CartItemTotal'], 'CartItemList' => $_SESSION[SESSION_ALIAS]['CartItems'], 'CartItemHTML' => $CartItemHTML));
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'EmptyAllCartItems') {
    unset($_SESSION[SESSION_ALIAS]['CartItems']);
    unset($_SESSION[SESSION_ALIAS]['CartItemTotal']);
    unset($_SESSION[SESSION_ALIAS]['CartQuantityTotal']);
    echo json_encode(array("ErrorStatus" => 0, "RedirectURL" => 'home'));
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'EmptySingleCartItems') {
    unset($_SESSION[SESSION_ALIAS]['CartItems'][$_REQUEST['ProdSrNo']]);
    echo json_encode(array("ErrorStatus" => 0, "RedirectURL" => 'home'));
} else if ($_REQUEST['do'] == 'save_prefix') {
    //echo $_REQUEST['user_id'];
    echo $mysql->update($_REQUEST['tbl_name'], array('PrefixID' => $_REQUEST['PrefixID']), array('user_id' => $_REQUEST['user_id']));
} else if ($_REQUEST['do'] == 'save_fname') {
    echo $mysql->update($_REQUEST['tbl_name'], array('first_name' => $_REQUEST['first_name']), array('user_id' => $_REQUEST['user_id']));
} else if ($_REQUEST['do'] == 'save_lname') {
    echo $mysql->update($_REQUEST['tbl_name'], array('last_name' => $_REQUEST['last_name']), array('user_id' => $_REQUEST['user_id']));
} else if ($_REQUEST['do'] == 'save_bdate') {
    echo $mysql->update($_REQUEST['tbl_name'], array('dob' => date('Y-m-d', $_REQUEST['dob'])), array('user_id' => $_REQUEST['user_id']));
    //$prefix_query = $stdb->update($_REQUEST['tbl_name'], array('user_id' => $_REQUEST['user_id']), array('dob' => $_REQUEST['bdate']), '');
} else if ($_REQUEST['do'] == 'save_cellno') {
    //echo $_REQUEST['cellno'];
    echo $mysql->update($_REQUEST['tbl_name'], array('cell_number' => $_REQUEST['cellno']), array('user_id' => $_REQUEST['user_id']));
    //$prefix_query = $stdb->update($_REQUEST['tbl_name'], array('user_id' => $_REQUEST['user_id']), array('cell_number' => $_REQUEST['cellno']), '');
} else if ($_REQUEST['do'] == 'save_landline') {
    echo $mysql->update($_REQUEST['tbl_name'], array('land_number' => $_REQUEST['land_number']), array('user_id' => $_REQUEST['user_id']));
    //$prefix_query = $stdb->update($_REQUEST['tbl_name'], array('user_id' => $_REQUEST['user_id']), array('land_number' => $_REQUEST['landline']), '');
} else if ($_REQUEST['do'] == 'save_about') {
    echo $mysql->update($_REQUEST['tbl_name'], array('about_me' => nl2br($_REQUEST['about_me'])), array('user_id' => $_REQUEST['user_id']));
    //$prefix_query = $stdb->update($_REQUEST['tbl_name'], array('user_id' => $_REQUEST['user_id']), array('about_me' => nl2br($_REQUEST['about'])), '');
} else if ($_REQUEST['do'] == 'save_email') {
    echo $mysql->update($_REQUEST['tbl_name'], array('email' => $_REQUEST['email']), array('user_id' => $_REQUEST['user_id']));
    //$prefix_query = $stdb->update($_REQUEST['tbl_name'], array('user_id' => $_REQUEST['user_id']), array('email' => $_REQUEST['email']), '');
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'CheckOutAddress') {
    $CheckAddress = $db->prepare("SELECT * FROM `t4m_address_book` LEFT JOIN `t4m_cities` ON `t4m_address_book`.`CitySrNo`=`t4m_cities`.`CitySrNo` LEFT JOIN `t4m_states` ON `t4m_cities`.`StateSrNo`=`t4m_states`.`StateSrNo` LEFT JOIN `t4m_countries` ON `t4m_states`.`CountrySrNo`=`t4m_countries`.`CountrySrNo` WHERE `t4m_address_book`.`is_active`='Y' AND `t4m_address_book`.`AddressID` = '" . $_REQUEST['CheckoutAddressID'] . "' LIMIT 1");
    $CheckAddress->execute();
    $CheckAddressArray = $CheckAddress->fetch(PDO::FETCH_ASSOC);
    if (isset($CheckAddressArray) && !empty($CheckAddressArray)) {
        unset($_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressID']);
        unset($_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']);
        $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressID'] = $_REQUEST['CheckoutAddressID'];
        $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText'] = $CheckAddressArray;
        echo json_encode(array("ErrorStatus" => 0));
    } else {
        echo json_encode(array("ErrorStatus" => 1));
    }
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'PaymentModeSelection') {
    $PayMode = $db->prepare("SELECT * FROM `t4m_payment_modes` WHERE `t4m_payment_modes`.`is_active`='Y' AND `t4m_payment_modes`.`PayID` = '" . $_REQUEST['PaymnetID'] . "' LIMIT 1");
    $PayMode->execute();
    $PayModeArray = $PayMode->fetch(PDO::FETCH_ASSOC);
    if (isset($PayModeArray) && !empty($PayModeArray)) {
        unset($_SESSION[SESSION_ALIAS]['Order']['PayID']);
        unset($_SESSION[SESSION_ALIAS]['Order']['PayName']);
        $_SESSION[SESSION_ALIAS]['Order']['PayMethodID'] = $_REQUEST['PaymnetID'];
        $_SESSION[SESSION_ALIAS]['Order']['PayMethodText'] = $PayModeArray;
        echo json_encode(array("ErrorStatus" => 0));
    } else {
        echo json_encode(array("ErrorStatus" => 1));
    }
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'PlaceOrder') {
    $OrderID = GetOrderID();
    //$CustomerData = array('OrderID'=>$OrderID,'CustomerID'=>$_SESSION[SESSION_ALIAS]['session']['user_id'],'CustomerFullName'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['FullName'],'CustomerEmailID'=>$_SESSION[SESSION_ALIAS]['session']['email'],'CustomerPhoneNo'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['MobileNumber'],'CustomerAddresLine1'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['AddressLine1'],'CustomerAddresLine2'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['AddressLine2'],'CustomerAddresLine3'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['AddressLine3'],'CountrySrNo'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['CountrySrNo'],'CountryName'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['CountryName'],'StateSrNo'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['StateSrNo'],'StateName'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['StateName'],'CitySrNo'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['CitySrNo'],'CityName'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['CityName'],'ZIPCode'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['ZIPCode'],'LandMark'=>$_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['LandMark'],'TotalOrderItems'=>'','TotalQuantity'=>'','OrderDiscountStatus'=>'','TotalOrderDiscountPercentage'=>'','TotalOrderDiscountPrice'=>'','PayMode'=>'','TotalCSTPercentage'=>'','TotalCSTAmount'=>'','TotalShippingPercentage'=>'','TotalShippingAmount'=>'','TotalGrossAmount'=>'','TotalDiscount'=>'','NetAmount'=>'','TotalTaxRate'=>'','TotalAppliedTaxAmount'=>'','TotalInclusiveStatus'=>'','OrderSignedFor'=>'','OrderSignature'=>'','OrderComment'=>'','OrderPlaceStatus'=>'Placed','OrderPlacedOnTime'=>date('H:i:s A'),'OrderPlacedOnDate'=>date('Y-m-d'),'OrderConfirmedByVendor'=>'Pending','OrderConfirmedByAdmin'=>'Pending','OrderShipmentDate'=>'','OrderShipmentTime'=>'','OrderDeliveryDate'=>'','OrderDeliveryTime'=>'','EntryDate'=>date(),'EntryTime'=>time(),'is_active'=>'Y');
    $arr = array();
    foreach ($_SESSION[SESSION_ALIAS]['CartItems'] as $key => $item) {
        $arr[$item['VendorID']][$key] = $item;
    }
    $Op = ksort($arr, SORT_NUMERIC);
    foreach ($arr as $K => $V) {
        $Query = $db->prepare("SELECT * FROM `t4m_address_book` INNER JOIN `t4m_users` ON `t4m_address_book`.`user_id`=`t4m_users`.`user_id` LEFT JOIN `t4m_cities` ON `t4m_address_book`.`CitySrNo`=`t4m_cities`.`CitySrNo` LEFT JOIN `t4m_states` ON `t4m_cities`.`StateSrNo`=`t4m_states`.`StateSrNo` LEFT JOIN `t4m_countries` ON `t4m_states`.`CountrySrNo`=`t4m_countries`.`CountrySrNo` WHERE `t4m_address_book`.`is_active`='Y' AND `t4m_address_book`.`DefaultStatus` = 'Y' AND `t4m_address_book`.`user_id` = '" . $K . "' LIMIT 1");
        $Query->execute();
        $VAddr = $Query->fetch(PDO::FETCH_ASSOC);
        $InvoiceAddress = $VAddr['AddressLine1'] . '<br>' . $VAddr['AddressLine2'] . '<br>' . $VAddr['AddressLine3'] . ' ' . $VAddr['ZIPCode'] . '<br>' . $VAddr['CityName'] . ' ' . $VAddr['StateName'] . ' ' . $VAddr['CountryName'];
        $CustomerAddress = $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['AddressLine1'] . '<br>' . $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['AddressLine2'] . '<br>' . $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['AddressLine3'] . ' ' . $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['ZIPCode'] . '<br>' . $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['CityName'] . ' ' . $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['StateName'] . ' ' . $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['CountryName'];
        $InvoiceNumber = '';
        $InvoiceNumber = substr($VAddr['StateName'], 0, 3) . '-' . strtoupper(substr($VAddr['CityName'], 0, 3)) . '-' . strtoupper(substr(uniqid(), 0, 8)) . '-' . strrev($VAddr['ZIPCode']);
        $TotalInvoiceAmount = '';
        $InvoiceQuantity = '';
        $OrderArray = '';
        $ItemNo = count($V);
        foreach ($V as $Itemskey => $ItemsValue) {
            $BasePrice = '';
            $Quantity = '';
            $BasePrice = $ItemsValue['ProdBasePrice'];
            $Quantity = $ItemsValue['ProductQuantity'];
            $InvoiceQuantity += $ItemsValue['ProductQuantity'];
            $TotalInvoiceAmount += $ItemsValue['ProductTotalPrice'];
            $OrderArray = array('OrderNo' => $OrderID, 'InvoiceID' => $InvoiceNumber, 'VendorID' => $K, 'CustomerID' => $_SESSION[SESSION_ALIAS]['session']['user_id'], 'ProdSrNo' => $ItemsValue['ProdSrNo'], 'ProdName' => $ItemsValue['ProdName'], 'ProdUniqID' => $ItemsValue['ProdUniqID'], 'ProdCode' => $ItemsValue['ProdCode'], 'ProdDesc' => $ItemsValue['ProdDesc'], 'MfgID' => $ItemsValue['MfgID'], 'MfgName' => $ItemsValue['MfgName'], 'BrandID' => $ItemsValue['BrandID'], 'BrandName' => '', 'ProdSizeID' => $ItemsValue['ProdSize'], 'ProdSizeName' => $ItemsValue['ProdSizeName'], 'ProdHeight' => $ItemsValue['ProdHeight'], 'ProdWeight' => $ItemsValue['ProdWeight'], 'ProdWidth' => $ItemsValue['ProdWidth'], 'ProdLength' => $ItemsValue['ProdLength'], 'DiscountStatus' => '', 'DiscountPercentage' => '', 'DiscountAmount' => '', 'CatSrNo' => $ItemsValue['CatSrNo'], 'CatName' => $ItemsValue['CatName'], 'TotalQuantity' => $ItemsValue['ProductQuantity'], 'ProdBasePrice' => $ItemsValue['ProdBasePrice'], 'ProductNetAmount' => $ItemsValue['ProductTotalPrice'], 'TotalDiscountAmount' => '', 'TotalProductAmount' => $ItemsValue['ProductTotalPrice'], 'OrderStatus' => 'Pending', 'OrderPlacedOnTime' => date('H:i:s A'), 'OrderPlacedOnDate' => date('Y-m-d'), 'OrderConfirmedByAdmin' => 'No', 'OrderConfirmedByVendor' => 'No', 'OrderShipmentDate' => '', 'OrderShipmentTime' => '', 'OrderDeliveryDate' => '', 'OrderDeliveryTime' => '', 'is_active' => 'Y', 'EntryTime' => date('Y-m-d H:i:s A'));
            $OrdersEntry = $mysql->insert($OrderArray, 't4m_orders');
            if (isset($OrdersEntry) && !empty($OrdersEntry)) {
                $mysql->delete('t4m_cart_items', array('CustomerID' => $_SESSION[SESSION_ALIAS]['session']['user_id'], 'ProdSrNo' => $ItemsValue['ProdSrNo']));
            }
        }
        $InvoiceEntry = $mysql->insert(array('OrderID' => $OrderID, 'VendorID' => $K, 'VendorName' => $VAddr['first_name'] . ' ' . $VAddr['last_name'], 'VendorAddress' => nl2br($InvoiceAddress), 'VendorPhoneNo' => $VAddr['cell_number'], 'CustomerID' => $_SESSION[SESSION_ALIAS]['session']['user_id'], 'CustomerName' => $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['FullName'], 'CustomerAddress' => nl2br($CustomerAddress), 'CustomerAddressLandMark' => $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['LandMark'], 'CustomerPhoneNo' => $_SESSION[SESSION_ALIAS]['Order']['CheckOutAddressText']['MobileNumber'], 'InvoiceNumber' => $InvoiceNumber, 'InvoiceGeneratedDate' => date('Y-m-d'), 'InvoiceGeneratedTime' => time(), 'InvoiceStatus' => 'Y', 'TotalItems' => $ItemNo, 'TotalQuantity' => $InvoiceQuantity, 'InvoiceAmount' => $TotalInvoiceAmount, 'PayModeID' => $_SESSION[SESSION_ALIAS]['Order']['PayMethodID'], 'PayModeName' => $_SESSION[SESSION_ALIAS]['Order']['PayMethodText']['PayName'], 'PaymentStatus' => 'Pending', 'PaymentReceivedTime' => '', 'EntryTime' => date('Y-m-d H:i:s A')), 't4m_invoice');
    }
    if (isset($InvoiceEntry)) {
        unset($_SESSION[SESSION_ALIAS]['Order']);
        unset($_SESSION[SESSION_ALIAS]['CartItems']);
        unset($_SESSION[SESSION_ALIAS]['CartQuantityTotal']);
        unset($_SESSION[SESSION_ALIAS]['CartItemTotal']);
        echo json_encode(array("ErrorStatus" => 0));
    } else {
        echo json_encode(array("ErrorStatus" => 1));
    }
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetStates') {
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
    
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'KametLogin') {
     $Login = $fn->login('{"UserName":"'.$_REQUEST['UserName'].'","Password":"'.$_REQUEST['Password'].'"}');
     $response = json_encode($Login, true);
     echo $response;
    
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'AprroveRequest') {
     $Approval = $fn->AprroveRequest('{"UserID":"'.$_REQUEST['UserID'].'","TeamID":"'.$_REQUEST['TeamID'].'","TournamentID":"'.$_REQUEST['TournamentID'].'","CaptainID":"'.$_REQUEST['CaptainID'].'"}');
     $response = json_encode($Approval, true);
     echo $response;
    
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'DeclineReason') {
     $DeclineReson = $fn->DeclineReason('{"TeamID":"'.$_REQUEST['TeamID'].'","CaptainID":"'.$_REQUEST['CaptainID'].'","UserID":"'.$_REQUEST['UserID'].'","EmailID":"'.$_REQUEST['EmailID'].'","FirstName":"'.$_REQUEST['FirstName'].'","LastName":"'.$_REQUEST['LastName'].'","DeclineReason":"'.$_REQUEST['DeclineReason'].'","TournamentID":"'.$_REQUEST['TournamentID'].'"}');
     $response = json_encode($DeclineReson, true);
     echo $response;   
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'AcceptBecomeCaptainRequest') {
//    echo '<pre>';
//    print_r($_REQUEST);
//    exit;
     $AcceptBecome = $fn->AcceptBecomeCaptainRequest('{"SwitchCaptainshipID":"'.$_REQUEST['SwitchCaptainshipID'].'","PlayerID":"'.$_REQUEST['PlayerID'].'","CaptainID":"'.$_REQUEST['CaptainID'].'","TeamID":"'.$_REQUEST['TeamID'].'"}');
     $response = json_encode($AcceptBecome, true);
     echo $response;
    
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'RejectBecomeCaptainRequest') {
//    echo '<pre>';
//    print_r($_REQUEST);
//    exit;
     $AcceptBecome = $fn->RejectBecomeCaptainRequest();
     $response = json_encode($AcceptBecome, true);
     echo $response;
    
}
else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'update_user_data') {
     $UpdateUserData = $fn->update_user_data();
     $response = json_encode($UpdateUserData, true);
     echo $response;  
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertTournamentData') {
    $sizeof_post = sizeof($_POST);
    $new_array = array_slice($_POST, 0, $sizeof_post - 1, true);
    $states = $new_array['StateID'];
    $cities = $new_array['CityID'];
    $statesnew = implode(',',$states);
    $citiesnew = implode(',',$cities);
    $_REQUEST['StateID'] = $statesnew;
    $_REQUEST['CityID'] = $citiesnew;
    $Tornament = $fn->InsertTournamentData();
    $response = json_encode($Tornament, true);
    echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'UpdateTournamentData') {
    $sizeof_post = sizeof($_POST);
    $new_array = array_slice($_POST, 0, $sizeof_post - 1, true);
    $states = $new_array['StateID'];
    $cities = $new_array['CityID'];
    $statesnew = implode(',',$states);
    $citiesnew = implode(',',$cities);
    $_REQUEST['StateID'] = $statesnew;
    $_REQUEST['CityID'] = $citiesnew;
     $TornamentUpdate = $fn->UpdateTournamentData();
     $response = json_encode($TornamentUpdate, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertGroupData') {
     $Gorup = $fn->InsertGroupData();
     $response = json_encode($Gorup, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'UpdateGroupData') {
     $GorupUpdate = $fn->UpdateGroupData();
     $response = json_encode($GorupUpdate, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertSetData') {
     $Set = $fn->InsertSetData();
     $response = json_encode($Set, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'UpdateSetData') {
     $SetUpdate = $fn->UpdateSetData();
     $response = json_encode($SetUpdate, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertCourtData') {
     $Court = $fn->InsertCourtData();
     $response = json_encode($Court, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'UpdateCourtData') {
     $CourtUpdate = $fn->UpdateCourtData();
     $response = json_encode($CourtUpdate, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertGroundData') {
     $Ground = $fn->InsertGroundData();
     $response = json_encode($Ground, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'UpdateGroundData') {
     $GroundUpdate = $fn->UpdateGroundData();
     $response = json_encode($GroundUpdate, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertMatchScheduleData') {
     $MatchSchedule = $fn->InsertMatchScheduleData();
     $response = json_encode($MatchSchedule, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'UpdateMatchScheduleData') {
     $MatchScheduleUpdate = $fn->UpdateMatchScheduleData();
     $response = json_encode($MatchScheduleUpdate, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertRoundData') {
     $Round = $fn->InsertRoundData();
     $response = json_encode($Round, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'UpdateRoundData') {
     $RoundUpdate = $fn->UpdateRoundData();
     $response = json_encode($RoundUpdate, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertRoundPointsData') {
     $RoundPoints = $fn->InsertRoundPointsData();
     $response = json_encode($RoundPoints, true);
     echo $response;
    
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'UpdateRoundPointsData') {
     $RoundPointsUpdate = $fn->UpdateRoundPointsData();
     $response = json_encode($RoundPointsUpdate, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertTeamData') {
     $Team = $fn->InsertTeamData();
     $response = json_encode($Team, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'UpdateTeamData') {
     $TeamUpdate = $fn->UpdateTeamData();
     $response = json_encode($TeamUpdate, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertSelectedTeamsInGroup') {
     $InsertTeamsInGroup = $fn->InsertSelectedTeamsInGroup();
     $response = json_encode($InsertTeamsInGroup, true);
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
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'SaveTeamPlayer') {
    $jsondata = '{"PlayerList":"'.$_REQUEST['PlayerList'].'","TeamID":"'.$_REQUEST['TeamID'].'","CaptainID":"'.$_REQUEST['CaptainID'].'","RoleID":"'.$_REQUEST['RoleID'].'"}';
     $SavePlayers = $fn->SaveTeamPlayer($jsondata);
     $response = json_encode($SavePlayers, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetTeamWisePlayerData') {
    $jsondata = '{"TournamentID":"'.$_REQUEST['TournamentID'].'","MatchId":"'.$_REQUEST['MatchId'].'"}';
     $Players = $fn->GetTeamWisePlayerData($jsondata);
     $response = json_encode($Players, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'DataForSecondDrp') {
    $Drp2TeamQuery = $db->prepare("SELECT GroupTeamRele.TournamentID,GroupTeamRele.GroupID,GroupTeamRele.TeamID,GroupTeamRele.GroupTeamRelationID,Tournament.TournamentName,Team.TeamName,VGroup.GroupName FROM v_groups_team_relation AS GroupTeamRele INNER JOIN v_tournaments AS Tournament ON GroupTeamRele.TournamentID = Tournament.TournamentID INNER JOIN v_teams AS Team ON GroupTeamRele.TeamID = Team.TeamID INNER JOIN v_groups AS VGroup ON GroupTeamRele.GroupID = VGroup.GroupID WHERE GroupTeamRele.TeamID NOT IN( '" . $_REQUEST['Group1ID'] . "') AND GroupTeamRele.TournamentID='" . $_REQUEST['TournamentID'] . "' AND GroupTeamRele.GroupID = '" . $_REQUEST['IntraGroupID'] . "' AND GroupTeamRele.is_active = 'Y'");
    $Drp2TeamQuery->execute();
    $Drp2TeamArray = $Drp2TeamQuery->fetchAll(PDO::FETCH_ASSOC);
    $Drp2TeamHTML = '';
    $Drp2TeamHTML .= '<option value="">Select Team</option>';
    foreach ($Drp2TeamArray as $K => $V) {
        $Drp2TeamHTML .= '<option value="' . $V['TeamID'] . '">' . $V['TeamName'] . '</option>';
    }
    echo $Drp2TeamHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'Group') {
    $TournamentWiseGroup = $fn->TournamentWiseGroup('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
     $response = json_encode($TournamentWiseGroup, true);
    $Drp2TeamHTML = '';
    $Drp2TeamHTML .= '<option value="">Select Group</option>';
    foreach ($TournamentWiseGroup['GetGroupData'] as $K => $V) {
        $Drp2TeamHTML .= '<option value="' . $V['GroupID'] . '">' . $V['GroupName'] . '</option>';
    }
    echo $Drp2TeamHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'ApproveTeamJoinRequest') {
     $ApproveTeamJoinRequest = $fn->ApproveTeamJoinRequest('{"PlayerID":"'.$_REQUEST['PlayerID'].'","TeamID":"'.$_REQUEST['TeamID'].'","CaptainID":"'.$_REQUEST['CaptainID'].'","RelationID":"'.$_REQUEST['RelationID'].'","NotificationID":"'.$_REQUEST['NotificationID'].'"}');
     $response = json_encode($ApproveTeamJoinRequest, true);
     echo $response;
    
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'RejectTeamJoinRequest') {
     $RejectTeamJoinRequest = $fn->RejectTeamJoinRequest('{"RelationID":"'.$_REQUEST['RelationID'].'","NotificationID":"'.$_REQUEST['NotificationID'].'","RejectReason":"'.$_REQUEST['RejectReason'].'"}');
     $response = json_encode($RejectTeamJoinRequest, true);
     echo $response;
    
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'RemoveFromTeam') {
    
//     $RejectTeamJoinRequest = $fn->RemoveFromTeam('{"PlayerID":"'.$_REQUEST['PlayerID'].'","TeamID":"'.$_REQUEST['TeamID'].'","RelationID":"'.$_REQUEST['RelationID'].'","ReasonForLeaveTeam":"'.$_REQUEST['ReasonForLeaveTeam'].'"}');
     $RejectTeamJoinRequest = $fn->RemoveFromTeam();
     $response = json_encode($RejectTeamJoinRequest, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'SendTeamToVerification') {
    
     $SendTeamToVerification = $fn->SendTeamToVerification('{"PlayerList":"'.$_REQUEST['PlayerList'].'","TeamID":"'.$_REQUEST['TeamID'].'","CaptainID":"'.$_REQUEST['CaptainID'].'","TournamentRulesStatus":"'.$_REQUEST['TournamentRulesStatus'].'","TournamentID":"'.$_REQUEST['TournamentID'].'","StateID":"'.$_REQUEST['StateID'].'","CityID":"'.$_REQUEST['CityID'].'"}');
     $response = json_encode($SendTeamToVerification, true);
     echo $response;
    
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
    
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'ChangeCaptainShip') {
//    print_r($_REQUEST['TeamID']);
//    exit;
     $ChangeCaptainShip = $fn->ChangeCaptainShip();
     $response = json_encode($ChangeCaptainShip, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'SaveFinalTeamForTournament') {
     $SaveFinalApprovedTeamForTournament = $fn->SaveFinalTeamForTournament();
     $response = json_encode($SaveFinalApprovedTeamForTournament, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'DeleteGeneralNotification') {
//    print_r($_REQUEST);
     $DeleteGeneralNotificationData = $fn->DeleteGeneralNotification('{"NotificationID":"'.$_REQUEST['NotificationID'].'"}');
     $response = json_encode($DeleteGeneralNotificationData, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'MakePaymentForTeam') {
 
    $MakePatmentReturn = $fn->MakePaymentForTeam('{"TournamentID":"'.$_REQUEST['TournamentID'].'","TeamID":"'.$_REQUEST['TeamID'].'","CaptainID":"'.$_REQUEST['CaptainID'].'","EmailID":"'.$_REQUEST['EmailID'].'","RegistrationFees":"'.$_REQUEST['RegistrationFees'].'","NotificationID":"'.$_REQUEST['NotificationID'].'"}');
    $response = json_encode($MakePatmentReturn, true);
    echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetTournamentDetails') {
    
     $GetTournamentDetails = $fn->GetTournamentDetails('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
     $response = json_encode($GetTournamentDetails, true);
    $TournamentQuery = $db->prepare("SELECT * FROM `v_teams_tournament_relation` WHERE TournamentID = '".$_REQUEST['TournamentID']. "' AND TeamID = '".$_REQUEST['TeamID']. "' AND is_active = 'Y'");
    $TournamentQuery->execute();
    $TournamentTeamData = $TournamentQuery->fetchAll(PDO::FETCH_ASSOC);
    $total = $TournamentQuery->rowCount();
    if($total > 0){
        $Flag = 'TRUE';
    }else{
        $Flag = 'FALSE';
    }
        $TournamentImage = $GetTournamentDetails['GetTournamentIDWiseData'][0]['TournamentImage'];
        $TournamentData = '';
        $TournamentData.='<div style="border: 1px solid #31708f;border-radius: 7px;box-shadow: 4px -4px 5px rgba(2, 1, 1, 0.3);">';
        $TournamentData.= '<center><img class="img-thumbnail" style="height:80px;width:90px;cursor:pointer;margin-top: 5px;" src="'.$GetTournamentDetails['GetTournamentIDWiseData'][0]['TournamentImage'].'" title="View" onclick="ShowImage()"></center>';
        $TournamentData.= '<center><h2 style="margin-top: 5px;">'.$GetTournamentDetails['GetTournamentIDWiseData'][0]['TournamentName'].'</h2></center>';
        $TournamentData .= '<table class="table-responsive table table-striped" width=100%>'; 
        $TournamentData .= '<tr><th style="width:7%">Tournament Start Date</th><th style="width:7%">Tournament End Date</th><th>Registration Fees</th><th style="width:7%">Registration Start Date</th><th style="width:7%">Registration End Date</th><th>Maximum Players</th><th>Minimum Players</th><th>Winner Prize</th><th>Runner Ups Prize</th><th>Player Of The Tournament Prize</th></tr>';
        if($GetTournamentDetails['ResponseCode'] != 0){
        foreach ($GetTournamentDetails['GetTournamentIDWiseData'] as $K => $V) {
        
        $TournamentData .= '<tr>';
        $TournamentData .= '<td style="width:8%;">'; 
        $TournamentData .= '<label>' . date('d-m-Y',  strtotime($V['StartDate'] )). '</label>';
        $TournamentData .= '</td>';
        $TournamentData .= '<td style="width:8%;">'; 
        $TournamentData .= '<label>' . date('d-m-Y',  strtotime($V['EndDate'])) . ' </label>';
        $TournamentData .= '</td>';
        $TournamentData .= '<td>'; 
        $TournamentData .= '<label>' . $V['RegistrationFees'] . ' </label>';
        $TournamentData .= '</td>';
        $TournamentData .= '<td>'; 
        $TournamentData .= '<label>' . date('d-m-Y',  strtotime( $V['RegistrationStartDate'])) . ' </label>';
        $TournamentData .= '</td>';
        $TournamentData .= '<td>'; 
        $TournamentData .= '<label>' . date('d-m-Y',  strtotime( $V['RegistrationEndDate'])) . '</label>';
        $TournamentData .= '</td>';
        $TournamentData .= '<td>'; 
        $TournamentData .= '<label>' . $V['MaximumPlayers'] . '</label>';
        $TournamentData .= '</td>'; 
        $TournamentData .= '<td>'; 
        $TournamentData .= '<label>' . $V['MinimumPlayers'] . '</label>';
        $TournamentData .= '</td>'; 
        $TournamentData .= '<td>'; 
        $TournamentData .= '<label>' . $V['WinnerPrize'] . '</label>';
        $TournamentData .= '</td>'; 
        $TournamentData .= '<td>'; 
        $TournamentData .= '<label>' . $V['RunnerUpsPrize'] . '</label>';
        $TournamentData .= '</td>'; 
        $TournamentData .= '<td>'; 
        $TournamentData .= '<label>' . $V['PlayerOfTheTournamnetPrice'] . '</label>';
        $TournamentData .= '</td>'; 
        $TournamentData .= '</tr>';
        $TournamentRule = $V['TournamentRules'];
     }
        }else{
            $TournamentData .= '<tr><td colspan="7" align="center">No Record Found </td></tr>';
        }
        
        $TournamentData .= '</table></div>';
     
     
       echo json_encode(array("Flag" => $Flag, "html" => $TournamentData,"TournamentRule" => $TournamentRule,"TorunamentImage" => $TournamentImage));
    
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
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetTournamentStates') {
    
    $TournamentState = $fn->GetTournamentStates('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
    $TournamentStateHTML = '';
    $TournamentStateHTML .= '<option value="">Select State</option>';
    foreach ($TournamentState['GetTournamentStates'] as $K => $V) {
        $TournamentStateHTML .= '<option value="' . $V['StateID'] . '">' . $V['StateName'] . '</option>';
    }
    echo $TournamentStateHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetTournamentCities') {
    $TournamentCitiesArray = $fn->GetTournamentCities('{"TournamentID":"'.$_REQUEST['TournamentID'].'","StateID":"'.$_REQUEST['StateID'].'"}');
    $TournamentCitiesHTML = '';
    $TournamentCitiesHTML .= '<option value="">Select City</option>';
    foreach ($TournamentCitiesArray['GetTournamentCities'] as $K => $V) {
        $TournamentCitiesHTML .= '<option value="' . $V['CityID'] . '">' . $V['CityName'] . '</option>';
    }
    echo $TournamentCitiesHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetRemainingIdType') {
   
    $IDType = $db->prepare("SELECT * FROM v_proof_type WHERE ProofID != '" . $_REQUEST['IdType'] . "' AND is_active = 'Y'");
    $IDType->execute();
    $IDTypeArray = $IDType->fetchAll(PDO::FETCH_ASSOC);
    $IDTypeHTML = '';
    $IDTypeHTML .= '<option value="">Select ID Type</option>';
    foreach ($IDTypeArray as $K => $V) {
        $IDTypeHTML .= '<option value="' . $V['ProofID'] . '">' . $V['DocumentName'] . '</option>';
    }
    echo $IDTypeHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'InsertMatchScore') {
   
     $InsertMatchScore = $fn->InsertMatchScore();
     $response = json_encode($InsertMatchScore, true);
     echo $response;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'DeleteScoreCardEntry') {
    $DeleteResultQuery = $db->prepare("DELETE FROM v_result WHERE TournamentID = '" . $_REQUEST['TournamentID'] . "' AND MatchID = '" . $_REQUEST['MatchID'] . "'");
    $Res = $DeleteResultQuery->execute();
    if($Res)
    {
        $DeleteResultSetQuery = $db->prepare("DELETE FROM v_result_sets WHERE TournamentID = '" . $_REQUEST['TournamentID'] . "' AND MatchID = '" . $_REQUEST['MatchID'] . "'");
        $NewRes = $DeleteResultSetQuery->execute();
    }
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetTeamPlayersForPlayerOfTheMatch') {
     $GetPlayersList = $fn->GetAllAppliedTournamentTeamPlayersData('{"TeamID":"'.$_REQUEST['TeamID'].'","TournamentID":"'.$_REQUEST['TournamentID'].'"}');
     $GetPlayers = $GetPlayersList['GetAppliedTeamPlayersData'];
     $HTML .= '<option value="">Select Player</option>';
     foreach ($GetPlayers as $K => $V) {
        $HTML .= '<option value="' . $V['PlayerID'] . '">' . $V['PlayerName'] . '</option>';
     }
    echo $HTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'TeamDetails') {
     $TeamData = $fn->GetTeamDataByTeamID('{"TeamID":"'.$_REQUEST['TeamID'].'"}');
      $TeamDetailsHTML = '';
      $TeamDetailsHTML .= '<center><img src="'.$TeamData['GetGenralNotificationData'][0]['TeamLogo'].'" style="height:150px"></center>';
      $TeamDetailsHTML .= '<label><h4><b>Team Name : </b></h4> </label><label> '.$TeamData['GetGenralNotificationData'][0]['TeamName'].'</label><br>';
      $TeamDetailsHTML .= '<label><h4><b>Team Slogan : <b></h4> </label><label> '.$TeamData['GetGenralNotificationData'][0]['TeamSlogan'].'</label><br>';
      foreach ($TeamData['GetGenralNotificationData'] AS $Keys => $Values){
           $TeamDetailsHTML .= '<label><h4><b>Player Name : </b></h4> </label><label> '.$Values['PalyerName'] .'';
           if($Values['CaptainshipStatus'] == 'Y'){
                      $TeamDetailsHTML .= '<label style="color:Green">(Captain)</label><br>';
                  }     
                  $TeamDetailsHTML .= '</label><br>';
      }
     echo $TeamDetailsHTML;
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
