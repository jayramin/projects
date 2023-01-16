<?php
error_reporting(0);
session_start();
require_once '../../class/class.DataTransaction.php';
//require_once '../../class/class.user.php';
///require_once '../../class/class.password.php';
require_once '../../class/class.functions.php';
require_once '../../includes/labels.php';
$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$user = new User($db);
$mysql = new DataTransaction($db);
$fn = new functions();
//$create_city_state_relation = new create_city_state();
if ($_REQUEST['do'] == "get_state") {
    $country_id = $_REQUEST['CountryID'];
    $state_id = $_REQUEST['StateID'];
    $state_list = $mysql->selectdata('v_state', array('CountryID', 'StateID', 'StateName', 'is_active'), 'CountryID = "' . $country_id . '" AND is_active="Y" ORDER BY StateName ASC');
    echo "<option value = ''>Select State</option>";
    foreach ($state_list AS $Key => $Value) {
        //while ($row = mysql_fetch_assoc($state_list)) {
        echo "<option value = " . $Value['StateID'] . " ";
        if ($state_id == $Value['StateID']) {
            echo "selected='selected'>";
        } else {
            echo " >";
        }
        echo $Value['StateName'];
        echo "</option>";
    }
} else if ($_REQUEST['do'] == "get_city") {
    $state_id = $_REQUEST['StateID'];
    $city_id = $_REQUEST['CityID'];
    $city_list = $mysql->selectdata('v_city', '', 'StateID = ' . $state_id . ' AND is_active="Y" ORDER BY CityName ASC');
    echo "<option value = ''>Select City</option>";
    foreach ($city_list AS $Key => $Value) {
        //while ($row = mysql_fetch_assoc($city_list)) {
        echo "<option value = " . $Value['CityID'] . " ";
        if ($city_id == $Value['CityID']) {
            echo "selected='selected'>";
        } else {
            echo " >";
        }
        echo $Value['CityName'];
        echo "</option>";
    }
} else if ($_REQUEST['do'] == "get_area") {
    // echo $_REQUEST['CityID'];
    //$state_id = $_REQUEST['StateID'];
    $city_id = $_REQUEST['CityID'];
    //$area_id = $_REQUEST['AreaID'];
    $area_list = $mysql->selectdata('v_area', '', 'CityID = ' . $city_id . ' AND is_active="Y" ORDER BY AreaName ASC');
   // print_r($area_list);
    $html = '';
    $html.= "<option value = ''>Select Area</option>";
    foreach ($area_list AS $Key => $Value) {
        //while ($row = mysql_fetch_assoc($area_list)) {
        $html.= "<option value = " . $Value['AreaID'] . " ";
        if ($city_id == $Value['AreaID']) {
            $html.= "selected='selected'>";
        } else {
            $html.= " >";
        }
        $html.= $Value['AreaName'];
        $html.= "</option>";
        
    }
    echo $html;
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
    $Query = 'SELECT t4m_class.ClassName,v_city.CityID FROM t4m_class INNER JOIN v_city ON t4m_class.CityID=v_city.CityID WHERE t4m_class.CityID="' . $_REQUEST['CityID'] . '" AND t4m_class.CatSrNo="' . $_REQUEST['CatSrNo'] . '"';
    $QueryData = $conn->query($Query);
    if ($QueryData) {
        echo '1';
    } else {
        echo '0';
    }
} else if ($_REQUEST['do'] == 'sendmessage') {
    $ClassSrNo=$_REQUEST['ClassSrNo'];
   $CCList = $mysql->selectdata('t4m_class', array('ClassEmailID'), 'ClassSrNo="' . $ClassSrNo . '"');
    $EmailID = $_REQUEST['EmailID'];
    $Message = 'Hello, You have received query from user with email address <b>' . $EmailID . '</b>.<br> Please find the message from the user.<br><i>' . $_REQUEST['Message'] . '</i><br><br><b>'.EMAIL_FOOTER.'</b>';
    $EmailStatus = $mysql->send_email(EMAIL_TO, $CCList[0]['ClassEmailID'], $bcc = null, 'Search Query From Viewer', $Message, $alert_msg, $attachment = null);
    if ($EmailStatus) {
        return 'Email Sent Successfully';
    } else {
        return $EmailStatus;
    }
}else if ($_REQUEST['do'] == 'SendMessage') {
    $Name=$_REQUEST['Name'];
    $EmailID=$_REQUEST['EmailID'];
    $Message='Hello, You have received query from user <b>'.$Name.'</b> with email address <b>'.$EmailID.'</b>.<br> Please find the message from the user.<br><i>'.$_REQUEST['Message'].'</i><br><br><b>'.EMAIL_FOOTER.'</b>';
    $EmailStatus=$mysql->send_email(EMAIL_TO, $cc = null, $bcc = null, 'Search Query From Viewer', $Message, $alert_msg, $attachment = null);
    if($EmailStatus){
        return 'Email Sent Successfully';
    }else {
        return $EmailStatus;
    }
} else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetAreas') {
    
    $Areas = $db->prepare("SELECT * FROM `v_area` WHERE `v_area`.`CityID`='" . $_REQUEST['CityID'] . "' AND `v_area`.`is_active` = 'Y'");
    $Areas->execute();
    $AreaArray = $Cities->fetchAll(PDO::FETCH_ASSOC);
    $AreaHTML = '';
    $AreaHTML .= '<option value="">Select Area</option>';
    foreach ($CityArray as $K => $V) {
        $AreaHTML .= '<option value="' . $V['AreaID'] . '">' . $V['AreaName'] . '</option>';
    }
    echo $AreaHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'LoadRound') {
//    echo "SELECT * FROM `v_rounds` WHERE `v_rounds`.`TournamentID`='" . $_REQUEST['TournamentID'] . "' AND `v_rounds`.`is_active` = 'Y'";
    $Round = $db->prepare("SELECT * FROM `v_rounds` WHERE `v_rounds`.`TournamentID`='" . $_REQUEST['TournamentID'] . "' AND `v_rounds`.`is_active` = 'Y'");
    $Round->execute();
    $RoundArray = $Round->fetchAll(PDO::FETCH_ASSOC);
    $RoundHTML = '';
    $RoundHTML .= '<option value="">Select Round</option>';
    foreach ($RoundArray as $K => $V) {
        $RoundHTML .= '<option value="' . $V['RoundID'] . '">' . $V['RoundName'] . '</option>';
    }
    echo $RoundHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'LoadGround') {
//    echo "SELECT * FROM `v_ground_master` WHERE `v_ground_master`.`GroundID`='" . $_REQUEST['GroundID'] . "' AND `v_ground_master`.`is_active` = 'Y'";
    $Ground = $db->prepare("SELECT * FROM `v_ground_master` WHERE `v_ground_master`.`CityID`='" . $_REQUEST['CityID'] . "' AND `v_ground_master`.`is_active` = 'Y'");
    $Ground->execute();
    $GroundArray = $Ground->fetchAll(PDO::FETCH_ASSOC);
    $GroundHTML = '';
    $GroundHTML .= '<option value="">Select Ground</option>';
    foreach ($GroundArray as $K => $V) {
        $GroundHTML .= '<option value="' . $V['GroundID'] . '">' . $V['GroundName'] . '</option>';
    }
    echo $GroundHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'LoadCourt') {
//    echo "SELECT * FROM `v_court_master` WHERE `v_court_master`.`GroundID`='" . $_REQUEST['GroundID'] . "' AND `v_court_master`.`is_active` = 'Y'";
    $Court = $db->prepare("SELECT * FROM `v_court_master` WHERE `v_court_master`.`GroundID`='" . $_REQUEST['GroundID'] . "' AND `v_court_master`.`is_active` = 'Y'");
    $Court->execute();
    $CourtArray = $Court->fetchAll(PDO::FETCH_ASSOC);
    $CourtHTML = '';
    $CourtHTML .= '<option value="">Select Court</option>';
    foreach ($CourtArray as $K => $V) {
        $CourtHTML .= '<option value="' . $V['CourtID'] . '">' . $V['CourtName'] . '</option>';
    }
    echo $CourtHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'LoadSets') {
//    echo "SELECT * FROM `v_set_master` WHERE `v_set_master`.`RoundID`='" . $_REQUEST['RoundID'] . "' AND `v_set_master`.`is_active` = 'Y'";
    $Sets = $db->prepare("SELECT * FROM `v_set_master` WHERE `v_set_master`.`RoundID`='" . $_REQUEST['RoundID'] . "' AND `v_set_master`.`is_active` = 'Y'");
    $Sets->execute();
    $SetsArray = $Sets->fetchAll(PDO::FETCH_ASSOC);
    $SetsHTML = '';
    $SetsHTML .= '<option value="">Select Round</option>';
    foreach ($SetsArray as $K => $V) {
        $SetsHTML .= '<option value="' . $V['SetID'] . '">' . $V['NoOfSets'] . '</option>';
    }
    echo $SetsHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetCitiesDataForTournamnet') {
//    print_r($_REQUEST);
    $StateList = implode(',',$_REQUEST['StateList']);
//    echo "SELECT * FROM `v_city` WHERE `v_city`.`StateID` IN ($StateList) AND `v_city`.`is_active` = 'Y'";
    $CityQuery = $db->prepare("SELECT * FROM `v_city` WHERE `v_city`.`StateID` IN ($StateList) AND `v_city`.`is_active` = 'Y'");
    $CityQuery->execute();
    $CityDataArray = $CityQuery->fetchAll(PDO::FETCH_ASSOC);
//    print_r($CityDataArray);
    $CityHTML = '';
    $CityHTML .= '<option value="">Select Cities</option>';
    foreach ($CityDataArray as $K => $V) {
        $CityHTML .= '<option value="' . $V['CityID'] . '">' . $V['CityName'] . '</option>';
    }
    echo $CityHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'LoadMatch') {
    
//echo "SELECT MatchSchedule.MatchId,MatchSchedule.TournamentID,MatchSchedule.GroupTeamRelationID1,MatchSchedule.GroupTeamRelationID2,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID1) AS FirstTeamName,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2) AS SecondTeamName FROM v_match_schedule AS MatchSchedule INNER JOIN v_teams AS Team ON MatchSchedule.GroupTeamRelationID1 = Team.TeamID WHERE MatchSchedule.TournamentID = '".$_REQUEST['TournamentID']."' AND MatchSchedule.is_active = 'Y'";
//    exit;
    $MatchQuery = $db->prepare("SELECT MatchSchedule.MatchId,MatchSchedule.TournamentID,MatchSchedule.GroupTeamRelationID1,MatchSchedule.GroupTeamRelationID2,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID1) AS FirstTeamName,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2) AS SecondTeamName FROM v_match_schedule AS MatchSchedule INNER JOIN v_teams AS Team ON MatchSchedule.GroupTeamRelationID1 = Team.TeamID WHERE MatchSchedule.TournamentID = '".$_REQUEST['TournamentID']."' AND MatchSchedule.is_active = 'Y' AND MatchSchedule.MatchStatus='Incomplete'");
    $MatchQuery->execute();
    $MatchDataArray = $MatchQuery->fetchAll(PDO::FETCH_ASSOC);
    
    $MatchHTML = '';
    $MatchHTML .= '<option value="">Select Match</option>';
    foreach ($MatchDataArray as $K => $V) {
        $TeamsName = $V['FirstTeamName'] .' VS '. $V['SecondTeamName'];
        $MatchHTML .= '<option value="' . $V['MatchId'] . '">' . $TeamsName .'</option>';
    }
    echo $MatchHTML;
}else if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'GetApprovedTeamsByTournament') {
    $html='';
    $html.='<option value="">Select Team</option>';
    $data = $fn->GetAllTournamentTeamData('{"Flag":"TeamData","TournamentID":"'.$_REQUEST['TournamentID'].'"}');
    foreach ($data['GetTournamentTeamData'] AS $Key => $Value) {
        $TeamData = $fn->GetAprrovalTeamData('{"TeamTournamentRelationID":"' . $Value['TeamTournamentRelationID'] . '","TournamentID":"' . $Value['TournamentID'] . '","TeamID":"' . $Value['TeamID'] . '"}');
        if ($TeamData['GetTournamentAprrovalWiseData']['AdminStatusCount'] >= $Value['MinimumPlayers']) {
            $html.="<option value='".$Value['TeamID']."'>".$Value['TeamName']."</option>";
        }
    }
    echo $html;
}