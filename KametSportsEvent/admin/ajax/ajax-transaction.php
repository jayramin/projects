<?php
error_reporting(0);
session_start();
echo 'Check';
require_once '../../class/class.DataTransaction.php';
require_once '../../includes/labels.php';
$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$mysql = new DataTransaction($db);
//$create_city_state_relation = new create_city_state();
print_r($_REQUEST);
if ($_REQUEST['do'] == "get_state") {
    $country_id = $_REQUEST['CountrySrNo'];
    $state_id = $_REQUEST['StateSrNo'];
    $state_list = $mysql->selectdata('t4m_states', array('CountrySrNo', 'StateSrNo', 'StateName', 'is_active'), 'CountrySrNo = "' . $country_id . '" AND is_active="Y" ORDER BY StateName ASC');
    echo "<option value = ''>Select State</option>";
    foreach ($state_list AS $Key => $Value) {
        //while ($row = mysql_fetch_assoc($state_list)) {
        echo "<option value = " . $Value['StateSrNo'] . " ";
        if ($state_id == $Value['StateSrNo']) {
            echo "selected='selected'>";
        } else {
            echo " >";
        }
        echo $Value['StateName'];
        echo "</option>";
    }
} else if ($_REQUEST['do'] == "get_city") {
    $state_id = $_REQUEST['StateSrNo'];
    $city_id = $_REQUEST['CitySrNo'];
    $city_list = $mysql->selectdata('t4m_cities', '', 'StateSrNo = ' . $state_id . ' AND is_active="Y" ORDER BY CityName ASC');
    echo "<option value = ''>Select City</option>";
    foreach ($city_list AS $Key => $Value) {
        //while ($row = mysql_fetch_assoc($city_list)) {
        echo "<option value = " . $Value['CitySrNo'] . " ";
        if ($city_id == $Value['CitySrNo']) {
            echo "selected='selected'>";
        } else {
            echo " >";
        }
        echo $Value['CityName'];
        echo "</option>";
    }
} else if ($_REQUEST['do'] == "get_area") {
    $state_id = $_REQUEST['StateSrNo'];
    $city_id = $_REQUEST['CitySrNo'];
    $area_id = $_REQUEST['ARSrNo'];
    $area_list = $mysql->selectdata('t4m_areas', '', 'CitySrNo = ' . $city_id . ' AND is_active="Y" ORDER BY AreaName ASC');
    echo "<option value = ''>Select Area</option>";
    foreach ($area_list AS $Key => $Value) {
        //while ($row = mysql_fetch_assoc($area_list)) {
        echo "<option value = " . $Value['ARSrNo'] . " ";
        if ($city_id == $Value['ARSrNo']) {
            echo "selected='selected'>";
        } else {
            echo " >";
        }
        echo $Value['AreaName'];
        echo "</option>";
    }
} else if ($_REQUEST['do'] == "get_subcat") {
    $cat_id = $_REQUEST['BranchSpecificForCategory'];
    $subcat_id = $_REQUEST['BranchSpecificForSubCategory'];
    $subcategory_list = $mysql->selectdata('t4m_subcategory_master', '', 'CatSrNo="' . $cat_id . '" AND is_active="Y" ORDER BY SubCatName ASC');
    echo "<option value = ''>Select SubCategory</option>";
    foreach ($subcategory_list AS $Key => $Value) {
        //while ($row = mysql_fetch_assoc($state_list)) {
        echo "<option value = " . $Value['SubCatSrNo'] . " ";
        if ($state_id == $Value['SubCatSrNo']) {
            echo "selected='selected'>";
        } else {
            echo " >";
        }
        echo $Value['SubCatName'];
        echo "</option>";
    }
}else if ($_REQUEST['do'] == 'GetClass') {
    $Query = 'SELECT t4m_class.ClassName,t4m_cities.CitySrNo FROM t4m_class INNER JOIN t4m_cities 
               ON t4m_class.CitySrNo=t4m_cities.CitySrNo 
               WHERE t4m_class.CitySrNo="' . $_REQUEST['CitySrNo'] . '" AND t4m_class.CatSrNo="' . $_REQUEST['CatSrNo'] . '"';
    echo $Query;
    $QueryData = $conn->query($Query);
    if ($QueryData) {
        echo '1';
    } else {
        echo '0';
    }
} else if ($_REQUEST['do'] == 'sendmessage') {
    echo 'TEST';
    print_r($_REQUEST);
}