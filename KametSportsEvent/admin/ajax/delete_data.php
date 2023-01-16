<?php

session_start();
error_reporting(0);
require_once '../../config/connection.php';
require_once'../../config/constants.php';
require_once '../../class/mysql.php';
require_once '../../class/function.class.php';
require_once '../language/en.php';
require_once '../../class/index.class.php';
$lang = new en();
$stdb = new DataTransaction();
$functions = new myfunctions();

if ($_REQUEST['do'] == "status") {
    if ($_REQUEST['user_id'] != "") {
        $stdb->changestatus($_REQUEST['table'], "" . $_REQUEST['id_field'] . " = '" . $_REQUEST['id'] . "' and EntryByUser= '" . $_REQUEST['user_id'] . "'", "" . $_REQUEST['status_field'] . "", "'" . $_REQUEST['status'] . "'");
    } else {
        if ($_REQUEST['table'] == TBL_SEASON) {
            $stdb->changestatus($_REQUEST['table'], "" . $_REQUEST['id_field'] . " != ''", "" . $_REQUEST['status_field'] . "", '0');
        }
        $stdb->changestatus($_REQUEST['table'], "" . $_REQUEST['id_field'] . " = '" . $_REQUEST['id'] . "'", "" . $_REQUEST['status_field'] . "", "'" . $_REQUEST['status'] . "'");
        if ($_REQUEST['table'] == TBL_SEASON) {
            $ay_query = $stdb->selectdata(TBL_SEASON, "is_active = 1");
            $ay_data = mysql_fetch_object($ay_query);
            $_SESSION['SEASON'] = $ay_data;
        }
    }
} else if ($_REQUEST["do"] == "delete") {
    if ($_REQUEST['user_id'] != "") {
        $delete_condition_array = array("" . $_REQUEST['id_field'] . "" => $_REQUEST['id'], "EntryByUser" => $_REQUEST['user_id']);
    } else {
        $delete_condition_array = array("" . $_REQUEST['id_field'] . "" => $_REQUEST['id']);
    }

    $stdb->delete($_REQUEST['table'], $delete_condition_array);
    if ($_REQUEST['user_id'] == '1') {
        $data = file_get_contents('../dashboard/masters/' . $_REQUEST['table'] . '.txt');
        $arr_data = json_decode($data, true);

        for ($i = 0; $i < sizeof($arr_data); $i++) {
            if ($arr_data[$i][$_REQUEST['id_field']] == $_REQUEST['id']) {
                unset($arr_data[$i]);
                array_multisort($arr_data);
// print_r(json_encode($arr_data));
                $my_file = '../dashboard/masters/' . $_REQUEST['table'] . '.txt';
                $handle = fopen($my_file, 'w') or die('Cannot open file: ' . $my_file);
                file_put_contents($my_file, json_encode($arr_data), FILE_APPEND);
            }
        }
    }
}//to update the record
else if ($_REQUEST['do'] == "menu_reorder") {
    $i = 1;
    foreach ($_REQUEST['list'] as $key => $value) {
        $field_array = array('menu_order' => $i, 'menu_parent_id' => $value);
        $cond_array = array('menu_id' => $key);
        $stdb->update(TBL_MENUS, $cond_array, $field_array, '');
        $i++;
    }
    echo 'success';
} else if ($_REQUEST['do'] == "unset_session") {
//echo $_SESSION['group_allocation_id'];
    unset($_SESSION['group_allocation_id']);
} else if ($_REQUEST['do'] == "check_email") {
    $select_email = $stdb->selectdata(TBL_USERS, "email = '" . $_REQUEST['value'] . "'");
    $rows = mysql_num_rows($select_email);
    if ($rows > 0) {
        echo "Y";
    } else {
        echo "N";
    }
} else if ($_REQUEST['do'] == "check_username") {
    $select_username = $stdb->selectdata(TBL_USERS, "username = '" . $_REQUEST['value'] . "'");
    $rows = mysql_num_rows($select_username);
    if ($rows > 0) {
        echo "Y";
    } else {
        echo "N";
    }
} else if ($_REQUEST['do'] == "get_state") {
    $country_id = $_REQUEST['CountrySrNo'];
    $state_id = $_REQUEST['StateSrNo'];
//print_r($state_id);
    $obj_country = new DataTransaction();
    $state_list = $obj_country->selectdata(TBL_STATES, 'CountrySrNo = ' . $country_id);
//print_r($state_list);
    echo "<option value = ''>Select State</option>";
    while ($row = mysql_fetch_assoc($state_list)) {
        echo "<option value = '" . $row['StateSrNo'] . "' ";
        if ($state_id == $row['StateSrNo']) {
            echo "selected='selected'>";
        } else {
            echo " >";
        }
        echo $row['StateName'];
        echo "</option>";
    }
} else if ($_REQUEST['do'] == "get_city") {
    $state_id = $_REQUEST['StateSrNo'];
    $city_id = $_REQUEST['CitySrNo'];
    $obj_state = new DataTransaction();
    $city_list = $obj_state->selectdata(TBL_CITIES, 'StateSrNo = ' . $state_id);
//print_r($state_list);
    echo "<option value = ''>Select City</option>";
    while ($row = mysql_fetch_assoc($city_list)) {
        echo "<option value = '" . $row['CitySrNo'] . "' ";
        if ($city_id == $row['CitySrNo']) {
            echo "selected='selected'>";
        } else {
            echo " >";
        }
        echo $row['CityName'];
        echo "</option>";
    }
} else if ($_REQUEST['do'] == "get_area") {
    $city_id = $_REQUEST['CitySrNo'];
    $area_id = $_REQUEST['ARSrNo'];
    $obj_city = new DataTransaction();
    if (!empty($city_id)) {
        $area_list = $obj_city->selectdata(TBL_AREAS, 'CitySrNo = ' . $city_id);
        echo "<option value = ''>Select Area</option>";
        while ($row = mysql_fetch_assoc($area_list)) {
            echo "<option value = '" . $row['ARSrNo'] . "' ";
            if ($area_id == $row['ARSrNo']) {
                echo "selected='selected'>";
            } else {
                echo " >";
            }
            echo $row['AreaName'];
            echo "</option>";
        }
    }
} else if ($_REQUEST['do'] == "get_medium") {
    $city_id = $_REQUEST['BrSrNo'];
    $area_id = $_REQUEST['MDSrNo'];
    $obj_city = new DataTransaction();
    if (!empty($city_id)) {
        $area_list = $obj_city->selectdata(TBL_EDUCATION_MEDIUM_MASTER, 'BrSrNo = ' . $city_id);
        echo "<option value = ''>Select Medium</option>";
        while ($row = mysql_fetch_assoc($area_list)) {
            echo "<option value = '" . $row['MDSrNo'] . "' ";
            if ($area_id == $row['MDSrNo']) {
                echo "selected='selected'>";
            } else {
                echo " >";
            }
            echo $row['MediumName'];
            echo "</option>";
        }
    }
} else if ($_REQUEST['do'] == "get_standards") {
    $medium_id = $_REQUEST['MDSrNo'];
    $standard_id = $_REQUEST['STSrNo'];
    $obj_city = new DataTransaction();
    if (!empty($medium_id)) {
        $area_list = $obj_city->selectdata(TBL_STANDARD_MASTER, 'MDSrNo = ' . $medium_id);
        echo "<option value = ''>Select Standard</option>";
        while ($row = mysql_fetch_assoc($area_list)) {
            echo "<option value = '" . $row['STSrNo'] . "' ";
            if ($standard_id == $row['STSrNo']) {
                echo "selected='selected'>";
            } else {
                echo " >";
            }
            echo $row['StandardName'];
            echo "</option>";
        }
    }
} else if ($_REQUEST['do'] == "get_batches") {
    $condition = "is_active = '1' ";
    $medium_id = $_REQUEST['MDSrNo'];
    $standard_id = $_REQUEST['STSrNo'];
    $bat_id = $_REQUEST['BatSrNo'];
    if (isset($medium_id) && $medium_id != '0') {
        $condition .= " AND MDSrNo='" . $medium_id . "'";
    }
    if (isset($standard_id) && $standard_id != '0') {
        $condition .= " AND STSrNo='" . $standard_id . "'";
    }
    $obj_city = new DataTransaction();
    $bat_list = $obj_city->selectdata(TBL_BATCH_MASTER, $condition);
    echo "<option value = ''>Select Batch</option>";
    while ($row = mysql_fetch_assoc($bat_list)) {
        echo "<option value = '" . $row['BatSrNo'] . "' ";
        if ($bat_id == $row['BatSrNo']) {
            echo "selected='selected'>";
        } else {
            echo " >";
        }
        echo $row['BatName'];
        echo "</option>";
    }
} else if ($_REQUEST['do'] == "CountrySrNo") {
    $country_id = $_POST['CountrySrNo'];
    $obj_country = new DataTransaction();
    $state_list = $obj_country->selectdata(TBL_STATES, 'CountrySrNo = ' . $country_id);
    echo "<option selected value = ''>Select State</option>";
    while ($row = mysql_fetch_assoc($state_list)) {
        echo "<option value = " . $row['StateSrNo'] . ">";
        print_r($row['StateName']);
        echo "</option>";
    }
} else if ($_REQUEST['do'] == 'StateSrNo') {
    $state_id = $_POST['StateSrNo'];
    $obj_state = new DataTransaction();
    $city_list = $obj_state->selectdata(TBL_CITIES, 'StateSrNo = ' . $state_id);
    echo "<option selected='selected' value = ''>Select City</option>";
    while ($row = mysql_fetch_assoc($city_list)) {
        echo "<option value = " . $row['CitySrNo'] . ">";
        print_r($row['CityName']);
        echo "</option>";
    }
} else if ($_REQUEST['do'] == 'CitySrNo') {
    $city_id = $_POST['CitySrNo'];
    $obj_city = new DataTransaction();
    $area_list = $obj_city->selectdata(TBL_AREAS, 'CitySrNo = ' . $city_id);
    echo "<option selected value = ''>Select Area</option>";
    while ($row = mysql_fetch_assoc($area_list)) {
        echo "<option value = " . $row['ARSrNo'] . ">";
        print_r($row['AreaName']);
        echo "</option>";
    }
} else if ($_REQUEST['do'] == 'TeamPlayers') {
    $player_query = $stdb->innerdata(TBL_USERS, "apl_player_team_relation.TeamID='" . $_REQUEST['TeamID'] . "'", array("apl_player_team_relation" => "apl_player_team_relation.PlayerID=apl_users.user_id"), "", array("apl_users.user_id" => "user_id", "apl_users.last_name" => "last_name", "apl_users.first_name" => "first_name"));
    echo "<option value = ''>" . $lang->lang['no'] . "</option>";
    while ($row = mysql_fetch_assoc($player_query)) {
        echo "<option value = '" . $row['user_id'] . "' ";
        if ($_REQUEST['MOM'] == $row['user_id']) {
            echo "selected='selected'>";
        } else {
            echo " >";
        }
        echo $row['first_name'] . " " . $row['last_name'];
        echo "</option>";
    }
} else if ($_REQUEST['do'] == 'load_player_statistics') {
    $player_list = $stdb->selectdata(TBL_BATTING, "is_active='1' AND MatchID = '" . $_REQUEST['MatchID'] . "' AND TeamID = '" . $_REQUEST['TeamID'] . "' AND PlayerID = '" . $_REQUEST['PlayerID'] . "'");
    while ($row = mysql_fetch_assoc($player_list)) {
        $data[] = $row;
    }
    if (mysql_num_rows($player_list) > 0) {
        echo json_encode($data);
    } else {
        echo 'NULL';
    }
} else if ($_REQUEST['do'] == 'load_bowler_statistics') {
    $player_list = $stdb->selectdata(TBL_BOWLING, "is_active='1' AND MatchID = '" . $_REQUEST['MatchID'] . "' AND TeamID = '" . $_REQUEST['TeamID'] . "' AND PlayerID = '" . $_REQUEST['PlayerID'] . "'");
    while ($row = mysql_fetch_assoc($player_list)) {
        $data[] = $row;
    }
    if (mysql_num_rows($player_list) > 0) {
        echo json_encode($data);
    } else {
        echo 'NULL';
    }
}
?>