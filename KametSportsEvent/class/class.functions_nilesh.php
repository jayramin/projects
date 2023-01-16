<?php

class functions_nilesh {

    public $db;

    function __construct($db = NULL) {
        $db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_db = $db;
        $this->_connection = $db;
    }
    public function ResultList($Condition = '') {
        $Array = json_decode($Condition, true);
        $ResultFiter = '';
        if (isset($Array['TournamentID']) && $Array['TournamentID'] > 0) {
            $ResultFiter.=" AND VR.TournamentID='" . $Array['TournamentID'] . "'";
        }
        if (isset($Array['MatchID']) && $Array['MatchID'] > 0) {
            $ResultFiter.=" AND VR.MatchID='" . $Array['MatchID'] . "'";
        }
        if (isset($Array['Team1ID']) && trim($Array['Team1ID']) > 0 && trim($Array['Team2ID']) == '') {
            $ResultFiter.=" AND (VR.WinningTeamID='" . $Array['Team1ID'] . "' OR VR.LosingTeamID='" . $Array['Team1ID'] . "')";
        }
        if (isset($Array['Team1ID']) && trim($Array['Team1MatchStatus']) != '' && trim($Array['Team2ID']) == '') {
            if ($Array['Team1MatchStatus'] == 'WIN') {
                $ResultFiter.=" AND VR.WinningTeamID='" . $Array['Team1ID'] . "'";
            } else if ($Array['Team1MatchStatus'] == 'LOST') {
                $ResultFiter.=" AND VR.LosingTeamID='" . $Array['Team1ID'] . "'";
            }
        }
        if (isset($Array['Team2ID']) && trim($Array['Team2ID']) > 0 && trim($Array['Team1ID']) == '') {
            $ResultFiter.=" AND (VR.WinningTeamID='" . $Array['Team2ID'] . "' OR VR.LosingTeamID='" . $Array['Team2ID'] . "')";
        }
        if (isset($Array['Team2ID']) && trim($Array['Team2MatchStatus']) != '' && trim($Array['Team2ID']) == '') {
            if ($Array['Team2MatchStatus'] == 'WIN') {
                $ResultFiter.=" AND VR.WinningTeamID='" . $Array['Team2ID'] . "'";
            } else if ($Array['Team2MatchStatus'] == 'LOST') {
                $ResultFiter.=" AND VR.LosingTeamID='" . $Array['Team2ID'] . "'";
            }
        }
        if (isset($Array['Team1ID']) && trim($Array['Team1ID']) > 0 && isset($Array['Team2ID']) && trim($Array['Team2ID']) > 0) {
            $ResultFiter.=" AND (VR.WinningTeamID='" . $Array['Team1ID'] . "' OR VR.LosingTeamID='" . $Array['Team1ID'] . "' OR VR.WinningTeamID='" . $Array['Team2ID'] . "' OR VR.LosingTeamID='" . $Array['Team2ID'] . "')";
        }
        if (isset($Array['PlayerOfTheMatch']) && trim($Array['PlayerOfTheMatch']) > 0) {
            $ResultFiter.=" AND VR.PlayerOfTheMatch='" . $Array['PlayerOfTheMatch'] . "'";
        }
        if (isset($Array['VenueID']) && trim($Array['VenueID']) != '') {
            $ResultFiter.=" AND VMS.GroundID = '" . $Array['VenueID'] . "'";
        }
        if (isset($Array['CourtID']) && trim($Array['CourtID']) != '') {
            $ResultFiter.=" AND VMS.CourtID = '" . $Array['CourtID'] . "'";
        }
        if (isset($Array['RoundID']) && trim($Array['RoundID']) != '') {
            $ResultFiter.=" AND VMS.RoundID = '" . $Array['RoundID'] . "'";
        }
        if (isset($Array['MatchDate']) && trim($Array['MatchDate']) != '' && trim($Array['StartDate']) == '' && trim($Array['EndDate']) == '') {
            $ResultFiter.=" AND VMS.MatchDate = '" . $Array['MatchDate'] . "'";
        }
        if (isset($Array['StartDate']) && trim($Array['StartDate']) != '' && trim($Array['EndDate']) == '' && trim($Array['MatchDate'])=='') {
            $ResultFiter.=" AND VMS.MatchDate >= '" . $Array['StartDate'] . "'";
        }
        if (isset($Array['EndDate']) && trim($Array['EndDate']) != '' && trim($Array['StartDate']) && trim($Array['MatchDate'])=='') {
            $ResultFiter.=" AND VMS.MatchDate <= '" . $Array['EndDate'] . "'";
        }
        if (isset($Array['StartDate']) && trim($Array['StartDate']) != '' && isset($Array['EndDate']) && trim($Array['EndDate']) != '' && trim($Array['MatchDate'])=='') {
            $ResultFiter.=" AND VMS.MatchDate >= '" . $Array['StartDate'] . "' AND VMS.MatchDate <= '" . $Array['EndDate'] . "'";
        }
        if (isset($Array['MatchTime']) && trim($Array['MatchTime']) != '') {
            $ResultFiter.=" AND VMS.MatchTime = '" . $Array['MatchTime'] . "'";
        }
        $ResultString = "SELECT VR.ResultID,VR.TournamentID,VR.MatchID,DATE_FORMAT(VMS.MatchDate,'%d-%m-%Y') AS MatchDate,DATE_FORMAT(VMS.MatchTime,'%h:%i %p') AS MatchTime,VMS.GroundID,VG.GroundName,VMS.CourtID,VCM.CourtName,VR.WinningTeamID,VTW.TeamName AS WinningTeamName,VTW.TeamLogo AS WinningTeamLogo,VR.LosingTeamID,VTL.TeamName AS LosingTeamName,VTL.TeamLogo AS LosingTeamLogo, VR.WinningTeamSet,VR.LosingTeamSet,VR.Margin,VR.PlayerOfTheMatch AS PlayerOfTheMatchID,CONCAT(VPM.FirstName,' ',VPM.LastName) AS PlayerOfTheMatchName FROM v_result AS VR INNER JOIN v_tournaments AS VT ON VR.TournamentID = VT.TournamentID INNER JOIN v_match_schedule AS VMS ON VR.MatchID = VMS.MatchId INNER JOIN v_teams AS VTW ON VR.WinningTeamID = VTW.TeamID INNER JOIN v_teams AS VTL ON VR.LosingTeamID = VTL.TeamID LEFT JOIN v_ground_master AS VG ON VMS.GroundID = VG.GroundID LEFT JOIN v_court_master AS VCM ON VMS.CourtID = VCM.CourtID LEFT JOIN v_users AS VPM ON VR.PlayerOfTheMatch = VPM.UserID WHERE VR.is_active = 'Y'" . $ResultFiter;
        $ResultQuery = $this->_db->prepare($ResultString);
        $ResultQuery->execute();
        $ResultData = $ResultQuery->fetchAll(PDO::FETCH_ASSOC);
        if (is_array($ResultData) && count($ResultData) > 0) {
            $ResponseList='';
            foreach ($ResultData AS $Key => $Value) {
                $SetString="SELECT VRS.ResultSetID,VRS.SetNo,VRS.MatchID,VRS.WinningTeamID,VRS.WinningTeamScore,VRS.WinningTeamOpErrScore,VRS.WinningTeamTotal,VRS.LosingTeamID,VRS.LosingTeamScore,VRS.LosingTeamOpErrScore,VRS.LosingTeamTotal,VRS.SetTime,VRS.Margin FROM v_result_sets AS VRS WHERE VRS.is_active = 'Y' AND MatchID='" . $Value['MatchID'] . "'";
                $SetQuery = $this->_db->prepare($SetString);
                $SetQuery->execute();
                $Value['SetDetails'] = $SetQuery->fetchAll(PDO::FETCH_ASSOC);
                $ResponseList[]=$Value;
            }
            $ResultResponse['ResponseCode'] = 1;
            $ResultResponse['Message'] = 'Success';
            $ResultResponse['ResultList'] = $ResponseList;
        } else {
            $ResultResponse['ResponseCode'] = 0;
            $ResultResponse['Message'] = 'No Record Found';
        }
        return $ResultResponse;
    }

    public function ViewResultDetails($Condition = '') {
        $Array = json_decode($Condition, true);
        $Filter = '';
        if ((isset($Array['MatchID']) && trim($Array['MatchID']) > 0) || (isset($Array['TournamentID']) && trim($Array['TournamentID']) > 0)) {
            if (isset($Array['MatchID']) && trim($Array['MatchID']) > 0) {
                $Filter.=" AND VR.MatchID='" . $Array['MatchID'] . "'";
            }
            if (isset($Array['TournamentID']) && trim($Array['TournamentID']) > 0) {
                $Filter.=" AND VR.TournamentID='" . $Array['TournamentID'] . "'";
            }
            if (isset($Array['TeamID']) && trim($Array['TeamID']) > 0) {
                $Filter.=" AND (VR.WinningTeamID='" . $Array['TeamID'] . "' OR VR.LosingTeamID='" . $Array['TeamID'] . "')";
            }
            if (isset($Array['PlayerID']) && trim($Array['PlayerID']) > 0) {
                $Filter.=" AND VRP.PlayerID='" . $Array['PlayerID'] . "'";
            }
            if (isset($Array['MatchDate']) && trim($Array['MatchDate']) != '') {
                $Filter.=" AND VMS.MatchDate='" . $Array['MatchDate'] . "'";
            }
            //echo $String="SELECT VRP.SetID FROM v_result_player AS VRP INNER JOIN v_result_sets AS VRS ON VRP.SetID=VRS.ResultSetID INNER JOIN v_result AS VR ON VR.MatchID=VRP.MatchID INNER JOIN v_match_schedule AS VMS ON VMS.MatchId=VR.MatchID WHERE VRS.is_active = 'Y'".$Filter;
            echo $String="SELECT VRP.SetID FROM v_result_sets AS VRS INNER JOIN v_result_player AS VRP ON VRS.ResultSetID=VRP.SetID INNER JOIN v_result AS VR ON VR.MatchID=VRP.MatchID INNER JOIN v_match_schedule AS VMS ON VMS.MatchId=VR.MatchID WHERE VRS.is_active = 'Y'".$Filter;
            $DetailedResultQuery = $this->_db->prepare($String);
            $DetailedResultQuery->execute();
            $DetailedResultData = $DetailedResultQuery->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($DetailedResultData) && count($DetailedResultData) > 0) {
                $ResultDetails['ResponseCode'] = 1;
                $ResultDetails['Message'] = 'Success';
                $ResultDetails['ResultDetails'] = $DetailedResultData;
            } else {
                $ResultDetails['ResponseCode'] = 0;
                $ResultDetails['Message'] = 'No Record Found';
            }
        } else {
            $ResultDetails['ResponseCode'] = 0;
            $ResultDetails['Message'] = 'MatchID/TournamentID Not Provided';
        }
        return $ResultDetails;
    }

}
