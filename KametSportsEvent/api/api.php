<?php
error_reporting(0);
session_start();
require_once("../includes/labels.php");
require_once("../config/config.php");
include_once 'RestServer.php';
//print_r($_SERVER['REQUEST_METHOD']);
//exit;
$Headers = getallheaders();
//$Headers['DeviceUniqID'] = 'hgfjnhgfj';
if (isset($Headers['DeviceUniqID']) && $Headers['DeviceUniqID'] != '') {
if (isset($_REQUEST['method']) && $_SERVER['REQUEST_METHOD'] == 'POST' && ( $_REQUEST['method'] == 'Registration' || $_REQUEST['method'] == 'ForgotPasswordTokenGenerate' || $_REQUEST['method'] == 'ForgotPasswordChange' || $_REQUEST['method'] == 'EmailChangeTokenGenerate' || $_REQUEST['method'] == 'EmailIDChange' || $_REQUEST['method'] == 'InsertTournamentData' || $_REQUEST['method'] == 'InsertTeamData' || $_REQUEST['method'] == 'update_user_data' || $_REQUEST['method'] == 'UpdateTeamData' || $_REQUEST['method'] == 'ApproveTeamJoinRequest' || $_REQUEST['method'] == 'RejectTeamJoinRequest' || $_REQUEST['method'] == 'ChangeCaptainShip' || $_REQUEST['method'] == 'RejectBecomeCaptainRequest' || $_REQUEST['method'] == 'RemoveFromTeam')) {
        if ($_REQUEST['class']) {
        $obj = new $_REQUEST['class']();
    }
    $rest = new RestServer($obj);
    $rest->handle();
}else if (isset($_REQUEST['method']) && $_SERVER['REQUEST_METHOD'] == 'GET' && ($_REQUEST['method'] == 'GetCountriesData' || $_REQUEST['method'] == 'GetAllStateData' || $_REQUEST['method'] == 'GetAllCitiesData' || $_REQUEST['method'] == 'GetAllAreasData' || $_REQUEST['method'] == 'DataByID' || $_REQUEST['method'] == 'login' || $_REQUEST['method'] == 'GetAllIDProofTypeData' || $_REQUEST['method'] == 'GetAllSecurityQuestionData' || $_REQUEST['method'] == 'GetUserProfileData' || $_REQUEST['method'] == 'GetAllTournamnetTypeData' || $_REQUEST['method'] == 'GetAllTeamData' || $_REQUEST['method'] == 'SearchPlayersData' || $_REQUEST['method'] == 'GetAboutUsData' || $_REQUEST['method'] == 'GetPrivacyData' || $_REQUEST['method'] == 'GetTermsConditionData' || $_REQUEST['method'] == 'GetUserAgreementData' || $_REQUEST['method'] == 'GetPaymentAgreementData' || $_REQUEST['method'] == 'GetHowItWorksData' || $_REQUEST['method'] == 'GetAddressData' || $_REQUEST['method'] == 'GetSubstitutionRulesData' || $_REQUEST['method'] == 'GetMatchRulesData' || $_REQUEST['method'] == 'GetSecurityQuestion' || $_REQUEST['method'] == 'GetAllNotification' || $_REQUEST['method'] == 'GetCanCreateTeamData' || $_REQUEST['method'] == 'SaveTeamPlayer' || $_REQUEST['method'] == 'GetAllTournaments' || $_REQUEST['method'] == 'MyTeamData' || $_REQUEST['method'] == 'GetTeamIDFromUserIDData' || $_REQUEST['method'] == 'GetMatchScheduleDataByTournamentID' || $_REQUEST['method'] == 'GetAllTeamJoinRequest' || $_REQUEST['method'] == 'GetAllTeamCaptainRequest' || $_REQUEST['method'] == 'MyTeamDataWithoutCaptain' || $_REQUEST['method'] == 'AcceptBecomeCaptainRequest' || $_REQUEST['method'] == 'GetTournamentDetails' || $_REQUEST['method'] == 'SendTeamToVerification' || $_REQUEST['method'] == 'GetTypeTitleData' || $_REQUEST['method'] == 'TournamentDropDown' || $_REQUEST['method'] == 'GetTournamentStates' || $_REQUEST['method'] == 'GetTournamentCities' || $_REQUEST['method'] == 'GetAllAddressProofTypeData' || $_REQUEST['method'] == 'MyTeamDataForPayment' || $_REQUEST['method'] == 'TournamentStartDateByTournamentID' || $_REQUEST['method'] == 'GetAllTournamentTeamData' || $_REQUEST['method'] == 'GetAllAppliedTeamDataByTournament' || $_REQUEST['method'] == 'GetAllAppliedTournamentTeamPlayersData' || $_REQUEST['method'] == 'MakePaymentForTeam' || $_REQUEST['method'] == 'GetGeneralNotificationData' || $_REQUEST['method'] == 'DeleteGeneralNotification' || $_REQUEST['method'] == 'GetNotificationData' || $_REQUEST['method'] == 'GetTeamDataByTeamID' || $_REQUEST['method'] == 'GetTournamentScoreCardDetails' || $_REQUEST['method'] == 'GetTournamentScoreCardDetailsByTeam' || $_REQUEST['method'] == 'TeamDetailsByTeamID' || $_REQUEST['method'] == 'GetPlayerProfileByPlayerID' || $_REQUEST['method'] == 'GetPlayerTotalCareerByPlayerID' || $_REQUEST['method'] == 'GetPlayerCareerTeamWiseByPlayerID' || $_REQUEST['method'] == 'CheckTeamAlreadySentForApproval' || $_REQUEST['method'] == 'MyTeamDataNewForTournament' || $_REQUEST['method'] == 'GetEligiblePlayersToVerify' || $_REQUEST['method'] == 'GetTournaments') )  {
        if ($_REQUEST['class']) {
            $obj = new $_REQUEST['class']();
        }
        $rest = new RestServer($obj);
        $rest->handle();
     
}else if ($_REQUEST['method'] == 'logout') {
    if ($_REQUEST['DeviceUniqID'] == '') {
        $DeviceID = $Headers['DeviceUniqID'];
    } else {
        $DeviceID = $_REQUEST['DeviceUniqID'];
    }
    $ActivityID = $mysql->query("UPDATE mlm_user_activity SET LastAccessTime = '" . date('Y-m-d H:i:s') . "',ServiceLastUsed = '" . $_REQUEST['method'] . "',LoginStatus = 'Deactivated' WHERE LoginStatus = 'Active' AND DeviceUniqID = '" . $DeviceID . "'");
    if (mysql_affected_rows() > '0') {
        $return_data['ResponseCode'] = 1;
        $return_data['Message'] = 'Logout Successfully';
    } else {
        $return_data['ResponseCode'] = 0;
        $return_data['Message'] = 'Already logged out';
    }
    echo json_encode($return_data);
}else{
    $Method_message = array("Message" => "Requested Method Not Apropriate");
    echo json_encode($Method_message);
} } else {
    $login_message = array("Message" => "Your are not logged in to any device");
    echo json_encode($login_message);
}