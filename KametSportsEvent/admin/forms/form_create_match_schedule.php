<?php
//$data = $fn->getDataByID('v_match_schedule', 'MatchId', $_REQUEST['MatchId']);
$data = $fn->GetMatchScheduleDataByID('v_match_schedule', 'MatchId', $_REQUEST['MatchId']);
$GroupName= explode(',', $data['GetMatchScheduleData']['GroupName']);  

                               if($_REQUEST['method'] == 'add')
                                {
                                    $TournamentID = $_REQUEST['TournamentID'];
                                }else{
                                    $TournamentID = $data['GetMatchScheduleData']['TournamentID'];
                                }

$GetTournamnetWiseForTeamScheduleData = $fn->GetTournamnetWiseForTeamScheduleData('{"TournamentID":"' . $TournamentID . '"}');
$IntraGroupID  = $_REQUEST['Group'];
$TournamentStartDate = date('d-m-Y', strtotime($GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][0]['StartDate']));
$TournamentEndDate = date('d-m-Y', strtotime($GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][0]['EndDate']));
$Time = str_replace('@',':',$_REQUEST['MatchTime']);
$Ntime = date('h:i A', strtotime($Time . " +1 hours"));

//$GetTournamnetWiseForTeamScheduleData = $fn->GetTournamnetWiseForTeamScheduleData('{"TournamentID":"' . $TournamentID . '"}');

?>
<!-- Content Start -->
<?php $GroupID = $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData']['GroupID'] ;
        ?>

<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="TournamentID" class="control-label"><?php echo Tournament; ?> <span style="color: red;">*</span> </label>&nbsp;
                    <span id="TournamentError" style="color: red"></span>
                    <?php
                    $SelectedState = isset($data['GetMatchScheduleData']['TournamentID']) ? $data['GetMatchScheduleData']['TournamentID'] : $_REQUEST['TournamentID'];
                    $Condition = "is_active = 'Y' AND StartDate >= '".date("Y-m-d")."' ";
                    $db_array = array("tbl_name" => 'v_tournaments', "condition" => $Condition);
                    $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "form-control chosen-select required", "onchange" => "LoadRound(this.value,\"RoundID\",\"IN\");");
                    $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Select Tournament", 'selected' => $SelectedState);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Round" class="control-label"><?php echo Round; ?> <span style="color: red;">*</span> </label>&nbsp;
                    <span id="RoundError" style="color: red"></span>
                    <?php
                    $selected = isset($data['GetMatchScheduleData']['RoundID']) ? $data['GetMatchScheduleData']['RoundID'] : $_REQUEST['RoundID'];
//                    $StateFilter = isset($data['RoundID']) ? "is_active='Y' AND CityID='" . $data['CityID'] . "'" : "is_active='Y'";
                    $db_array = array("tbl_name" => 'v_rounds', "condition" => "is_active='Y'");
                    $select_array = array("name" => "RoundID", "id" => "RoundID", "class" => "form-control chosen-select required");
                    $option_array = array("value" => "RoundID", "label" => "RoundName", "placeholder" => "Select Round", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="state_name" class="control-label"><?php echo StateName; ?> <span style="color: red;">*</span> </label>&nbsp;
                    <span id="StateError" style="color: red"></span>
                    <?php
                    $SelectedState = isset($_REQUEST['StateID']) ? $_REQUEST['StateID'] : "";
                    $StateFilter = isset($data['StateID']) ? "is_active='Y' AND CountryID='" . $data['CountryID'] . "'" : "is_active='Y'";
                    $db_array = array("tbl_name" => 'v_state', "condition" => $StateFilter);
                    $select_array = array("name" => "StateID", "id" => "StateID", "class" => "form-control chosen-select required", "onchange" => "LoadCity(this.value,\"" . $SelectedState . "\",\"CityID\",\"AreaID\",\"IN\");");
                    $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $SelectedState);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="city_name" class="control-label"><?php echo CityName; ?> <span style="color: red;">*</span> </label>&nbsp;
                    <span id="CityError" style="color: red"></span>
                    <?php
                    $selected = isset($_REQUEST['CityID']) ? $_REQUEST['CityID'] : "";
                    $StateFilter = isset($data['CityID']) ? "is_active='Y' AND CityID='" . $data['CityID'] . "'" : "is_active='Y'";
                    $db_array = array("tbl_name" => 'v_city', "condition" => "is_active='Y'");
                    $select_array = array("name" => "CityID", "id" => "CityID", "class" => "form-control chosen-select required","onchange" => "LoadGround(this.value,\"GroundID\",\"IN\");");
                    $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="GroundID" class="control-label"><?php echo GroundName; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $selected = isset($data['GetMatchScheduleData']['GroundID']) ? $data['GetMatchScheduleData']['GroundID'] : $_REQUEST['GroundID'];
                    $db_array = array("tbl_name" => 'v_ground_master', "condition" => "is_active='Y'");
                    $select_array = array("name" => "GroundID", "id" => "GroundID", "class" => "form-control chosen-select required","onchange" => "LoadCourt(this.value);");
                    $option_array = array("value" => "GroundID", "label" => "GroundName", "placeholder" => "Select Ground", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Court" class="control-label"><?php echo Court; ?> <span style="color: red;">*</span> </label>&nbsp;
                    <span id="CourtError" style="color: red"></span>
                    <?php
                    $SelectedState = isset($data['GetMatchScheduleData']['CourtID']) ? $data['GetMatchScheduleData']['CourtID'] : $_REQUEST['CourtID'];
                    $db_array = array("tbl_name" => 'v_court_master', "condition" => "is_active='Y'");
                    $select_array = array("name" => "CourtID", "id" => "CourtID", "class" => "form-control chosen-select required");
                    $option_array = array("value" => "CourtID", "label" => "CourtName", "placeholder" => "Select Court", 'selected' => $SelectedState);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                
                    <div class="col-lg-6" style="padding-left: 0px; ">
                <label for="MatchType" class="control-label"><?php echo MatchType; ?> <span style="color: red;">*</span> </label><br>

                <input type="radio" name="MatchType" class="control-label" id="MatchType" value="Intra" <?php if ($_REQUEST['MatchType'] == 'Intra') { ?> checked="checked"<?php } else { ?> <?php } ?> onclick="GetGroupDrp()">&nbsp;Intra&nbsp;
                <input type="radio" name="MatchType" class="control-label" id="MatchType" value="Cross" <?php if ($_REQUEST['MatchType'] == 'Cross') { ?> checked="checked"<?php } else if ($_REQUEST['MatchType'] != 'Intra') { ?>checked="checked" <?php } ?>onclick="RemoveGropDiv()" >&nbsp;Cross&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                
                <div class="col-lg-6" <?php if($_REQUEST['MatchType']=='Cross' ){ ?> style="display:none"<?php }else if($_REQUEST['MatchType']=='Intra' ){ ?> style="display:block"<?php }  else { ?> style="display:none"<?php }?> id="IntraGroupDropDown">
                    <label for="Group" class="control-label"><?php echo Group; ?> <span style="color: red;">*</span> </label>
                    <select id="Group"  class="form-control chosen-select required">
                        <option value="">Select Group</option>
                    </select>
                </div>

            </div>
            <div class="col-lg-3"><br>
                <input type="button" name="Search" class="btn btn-primary control-label" id="Search" value="Search" onclick="GetTournamentIdWiseData()">
            </div>
        </div>
    </div>
    <hr>
    <?php
    if ($_REQUEST['TournamentID'] != '' && $GetTournamnetWiseForTeamScheduleData['Message'] != 'No Record Found' || $_REQUEST['MatchId'] != '') {
        if ($GetTournamnetWiseForTeamScheduleData['Message'] != 'No Record Found') {
            
            if($_REQUEST['MatchId'] != '' && $_REQUEST['method'] == 'edit'){ ?>
                <div class="row">
                <?php if ($data['GetMatchScheduleData']['TournamentID'] != '' && $GetTournamnetWiseForTeamScheduleData['Message'] != 'No Record Found' && $data['GetMatchScheduleData']['MatchType'] == 'Cross' && $_REQUEST['MatchType'] != 'Intra') {?>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="GroupA" class="control-label"><?php if($_REQUEST['MatchId'] != ''){ echo $GroupName[0]; }else{ echo $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][0]['GroupName']; }?>  <span style="color: red;">*</span> </label>
                                <?php
                                $GetGroupDropDownData = $fn->GetGroupDropDownData('{"TournamentID":"' . $TournamentID . '","GroupID":"' . $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][0]['GroupID'] . '"}');
                                ?>
                                <select class="form-control chosen-select required"  id="GroupTeamRelationID1" name="GroupTeamRelationID1">
                                    <option value="">Select Team</option>
                                    <?php foreach ($GetGroupDropDownData['GetGroupDrpData'] as $name) { ?>
                                    <option value="<?php if($name['TeamID'] == $data['GetMatchScheduleData']['GroupTeamRelationID1']){ echo $name['TeamID'];?>"selected=selected<?php }else{ echo $name['TeamID'];}?> ><?= $name['TeamName'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="GroupB" class="control-label"><?php if($_REQUEST['MatchId'] != ''){ echo $GroupName[1]; }else{ echo $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][1]['GroupName']; }?><span style="color: red;">*</span> </label>
                                <?php
//                                
                                $GetGroupDropDownData = $fn->GetGroupDropDownData('{"TournamentID":"' . $TournamentID . '","GroupID":"' . $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][1]['GroupID'] . '"}');
                                ?>
                                
                                    <select class="form-control chosen-select required"  id="GroupTeamRelationID2" name="GroupTeamRelationID2">
                                    <option value="">Select Team</option>
                                    <?php foreach ($GetGroupDropDownData['GetGroupDrpData'] as $name) { ?>
                                     <option value="<?php if($name['TeamID'] == $data['GetMatchScheduleData']['GroupTeamRelationID2']){ echo $name['TeamID'];?>"selected=selected<?php }else{ echo $name['TeamID'];}?> ><?= $name['TeamName'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                                
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="MatchDate" class="control-label"><?php echo MatchDate; ?> <span style="color: red;">*</span> </label>                     
                                <input type="text" name="MatchDate" class="form-control material required" id="MatchDate" placeholder="DD-MM-YYYY" value="<?php if($data['GetMatchScheduleData']['MatchDate'] != '') { echo date('d-m-Y',  strtotime($data['GetMatchScheduleData']['MatchDate'])); }?>" data-toggle="tooltip" title="Only Tournament Date Is Avalible to select">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="MatchStartTime" class="control-label"><?php echo MatchStartTime; ?> <span style="color: red;">*</span> </label>
                                <input type="text" name="MatchTime" class="form-control material required" id="MatchTime" value="<?php if($data['GetMatchScheduleData']['MatchTime'] != '') { echo $data['GetMatchScheduleData']['MatchTime']; }?>">
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-lg-12">

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="GroupA" class="control-label"><?php echo $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][0]['GroupName']; ?> <span style="color: red;">*</span> </label>
                                
                                <select class="form-control chosen-select required" id="GroupTeamRelationID1" name="GroupTeamRelationID1" onchange="DataForSecondDrp(this.value)">
                                    <option value="">Select Team</option>
                                    <?php foreach ($GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'] as $name) { ?>
                                        <option value="<?= $name['TeamID'] ?>"><?= $name['TeamName'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="GroupB" class="control-label"><?php echo $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][1]['GroupName']; ?> <span style="color: red;">*</span> </label>
                                <?php ?>
                                <select class="form-control chosen-select required" id="GroupTeamRelationID2" name="GroupTeamRelationID2">
                                    <option value="">Select Team</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="MatchDate" class="control-label "><?php echo MatchDate; ?> <span style="color: red;">*</span> </label>
                                <input type="text" name="MatchDate" class="form-control material required" id="MatchDate" placeholder="DD-MM-YYYY" value="<?php if($_REQUEST['MatchDate'] != ''){ echo $_REQUEST['MatchDate']; }?>" data-toggle="tooltip" title="Only Tournament Date Is Avalible to select"><?php if($_REQUEST['MatchDate'] != ''){ echo $_REQUEST['MatchDate']; }?>
                                
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="MatchStartTime" class="control-label"><?php echo MatchStartTime; ?> <span style="color: red;">*</span> </label>
                                <input type="text" name="MatchTime" class="form-control material required" id="MatchTime" value="<?php if($_REQUEST['MatchTime'] != ''){ 
                                    $time = $_REQUEST['MatchTime'];
                                    
                                }?>">
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div><br>
            <hr>
            <input type="hidden" name="MatchId" id="MatchId" value="<?php echo $_REQUEST['MatchId'] ?>" >
            <div class="form-group">
                <?php // if (isset($_REQUEST['MatchId'])) { ?>
                    <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="UpdateMatchScheduleData(this.form);" ><?php echo update; ?></button>
                
                <a class="btn btn-warning text-uppercase waves" href="view_match_schedule"><?php echo cancel; ?></a>
            </div>
           <?php }else{ ?>
                <div class="row">
                <?php if ($_REQUEST['TournamentID'] != '' && $GetTournamnetWiseForTeamScheduleData['Message'] != 'No Record Found' && $_REQUEST['MatchType'] == 'Cross') { ?>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="GroupA" class="control-label"><?php if($_REQUEST['MatchId'] != ''){ echo $GroupName[0]; }else{ 
                                    
                                    echo $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][0]['GroupName']; }?>  <span style="color: red;">*</span> </label>
                                <?php
                                $GetGroupDropDownData = $fn->GetGroupDropDownData('{"TournamentID":"' . $TournamentID . '","GroupID":"' . $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][0]['GroupID'] . '"}');
                               
                                ?>
                                <select class="form-control chosen-select required"  id="GroupTeamRelationID1" name="GroupTeamRelationID1">
                                    <option value="">Select Team</option>
                                    <?php foreach ($GetGroupDropDownData['GetGroupDrpData'] as $name) { ?>
                                        <option value="<?= $name['TeamID'] ?>"><?= $name['TeamName'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="GroupB" class="control-label"><?php if($_REQUEST['MatchId'] != ''){ echo $GroupName[1]; }else{ echo $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][1]['GroupName']; }?><span style="color: red;">*</span> </label>
                                <?php
//                                
                                $GetGroupDropDownData = $fn->GetGroupDropDownData('{"TournamentID":"' . $TournamentID . '","GroupID":"' . $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][1]['GroupID'] . '"}');
                                ?>
                                
                                    <select class="form-control chosen-select required"  id="GroupTeamRelationID2" name="GroupTeamRelationID2">
                                    <option value="">Select Team</option>
                                    <?php foreach ($GetGroupDropDownData['GetGroupDrpData'] as $name) { ?>
                                        <option value="<?php echo $name['TeamID'] ?>" <?php if($data['GetMatchScheduleData']['TeamID'] == $name['TeamID']){ ?> selected <?php } ?>><?php echo $name['TeamName'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                                
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="MatchDate" class="control-label"><?php echo MatchDate; ?> <span style="color: red;">*</span> </label>
                                <input type="text" name="MatchDate" class="form-control material required" id="MatchDate" placeholder="DD/MM/YYYY" value="<?php if($_REQUEST['MatchDate'] != '') { echo $_REQUEST['MatchDate']; }?>" data-toggle="tooltip" title="Only Tournament Date Is Avalible to select" >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="MatchStartTime" class="control-label"><?php echo MatchStartTime; ?> <span style="color: red;">*</span> </label>
                                <input type="text" name="MatchTime" class="form-control material required" id="MatchTime" value="<?php if($_REQUEST['MatchTime'] != '') { echo $Ntime; }?>">
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <?php
                                    if($_REQUEST['Group'] == $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][0]['GroupID']){
                                        $IntraGroupName = $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][0]['GroupName'];
                                    }else{
                                        $IntraGroupName = $GetTournamnetWiseForTeamScheduleData['GetTeamGroupData'][1]['GroupName'];
                                    }
                                    ?>
                                <label for="GroupA" class="control-label"><?php echo $IntraGroupName; ?> <span style="color: red;">*</span> </label>
                                <input type="hidden" id="IntraGroupID" value="<?php echo $IntraGroupID?>">
                                <?php 
                                
                                    $GetGroupDropDownDataIntra = $fn->GetGroupDropDownData('{"TournamentID":"' . $TournamentID . '","GroupID":"' .$IntraGroupID. '"}');
//                                    echo '<pre>';
//                                    print_r($GetGroupDropDownDataIntra['GetGroupDrpData']);
                                    ?>
                                
                                <select class="form-control chosen-select required" id="GroupTeamRelationID1" name="GroupTeamRelationID1" onchange="DataForSecondDrp(this.value)">
                                    
                                    <option value="">Select Team</option>
                                    <?php foreach ($GetGroupDropDownDataIntra['GetGroupDrpData'] as $name) { ?>
                                        <option value="<?= $name['TeamID'] ?>"><?= $name['TeamName'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="GroupB" class="control-label"><?php echo $IntraGroupName ?> <span style="color: red;">*</span> </label>
                                <?php ?>
                                <select class="form-control chosen-select required" id="GroupTeamRelationID2" name="GroupTeamRelationID2">
                                    <option value="">Select Team</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="MatchDate" class="control-label "><?php echo MatchDate; ?> <span style="color: red;">*</span> </label>
                                <input type="text" name="MatchDate" class="form-control material required" id="MatchDate" placeholder="DD-MM-YYYY" value="<?php if($_REQUEST['MatchDate'] != ''){ echo $_REQUEST['MatchDate']; }?>" data-toggle="tooltip" title="Only Tournament Date Is Avalible to select" ><?php if($_REQUEST['MatchDate'] != ''){ echo $_REQUEST['MatchDate']; }?>
                                
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="MatchStartTime" class="control-label"><?php echo MatchStartTime; ?> <span style="color: red;">*</span> </label>
                                <input type="text" name="MatchTime" class="form-control material required" id="MatchTime" value="<?php if($_REQUEST['MatchTime'] != ''){ 
                                    $time = $_REQUEST['MatchTime'];
                                    
                                }?>">
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div><br>
            <hr>
            
            <div class="form-group">
                    <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="InsertMatchScheduleData(this.form);" ><?php echo save; ?></button>
                <a class="btn btn-warning text-uppercase waves" href="view_match_schedule"><?php echo cancel; ?></a>
            </div>
           <?php }  ?>
            
        <?php } ?>
    <?php } else { ?>
        <div class='col-lg-12'>
            <div class='col-lg-6'></div>
            <label>No Record Found</label>
        </div>
    <?php } ?>


</form>
<script>
    $('#MatchTime').timepicker();
    function GetTournamentIdWiseData() {
        var TournamentID = $("#TournamentID").val();
        var RoundID = $("#RoundID").val();
        var StateID = $("#StateID").val();
        var CityID = $("#CityID").val();
        var CourtID = $("#CourtID").val();
        var GroundID = $("#GroundID").val();
        var MatchId = $("#MatchId").val();
        var Group = $("#Group").val();
        var MatchType = $('input[name=MatchType]:checked', '#form').val();
        if (TournamentID != '') {
            if (RoundID != '') {
                $("#RoundError").text('');
                $("#TournamentError").text('');
                if(MatchId != '' && MatchId != undefined){
                    window.location = "view_match_schedule&method=edit&TournamentID=" + TournamentID + "&MatchType=" + MatchType + "&RoundID=" + RoundID + "&StateID=" + StateID + "&CityID=" + CityID + "&CourtID=" + CourtID + "&GroundID=" + GroundID+ "&MatchId=" + MatchId;
                }else if(MatchId == undefined){
                    if(Group != ''){
                    window.location = "view_match_schedule&method=add&TournamentID=" + TournamentID + "&MatchType=" + MatchType + "&RoundID=" + RoundID + "&StateID=" + StateID + "&CityID=" + CityID + "&CourtID=" + CourtID + "&GroundID=" + GroundID+ "&Group=" + Group;    
                    }else{
                    window.location = "view_match_schedule&method=add&TournamentID=" + TournamentID + "&MatchType=" + MatchType + "&RoundID=" + RoundID + "&StateID=" + StateID + "&CityID=" + CityID + "&CourtID=" + CourtID + "&GroundID=" + GroundID;    
                    }
                }
                
            } else {
                $("#RoundError").text('Select Round');
            }
        } else {
            $("#TournamentError").text('Select Tournament');
        }
    }
    function DataForSecondDrp(e, GroupID) {
        var Group1ID = e;
        var TournamentID = $("#TournamentID").val();
        var IntraGroupID = $("#IntraGroupID").val();
//        alert(Group1ID);
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: {"Group1ID": Group1ID, GroupID: GroupID,IntraGroupID:IntraGroupID, TournamentID: TournamentID, "do": "DataForSecondDrp"},
            success: function (result) {
//                alert_message_popup('',result);
                $("#GroupTeamRelationID2").html(result);
            }
        });
    }
    function GetGroupDrp(){
        var TournamentID = $("#TournamentID").val();
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: {TournamentID: TournamentID, "do": "Group"},
            success: function (result) {
//                alert_message_popup('',result);
                $("#IntraGroupDropDown").css("display","block");
                $("#Group").html(result);
                <?php if(isset($_REQUEST['Group']) && $_REQUEST['Group'] != ''){ ?>
                $('#Group').select2('val','<?php echo $_REQUEST['Group']; ?>');
                <?php } ?>
            }
        });
    }
    function RemoveGropDiv(){
        $('#Group').select2('val','');
        $("#IntraGroupDropDown").css("display","none");
              
    }
    $(document).ready(function () {
        var StartDate = '<?php echo $TournamentStartDate;?>';
        var date_input = $('input[name="MatchDate"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var FromEndDate = '<?php echo $TournamentEndDate;?>';
        date_input.datepicker({
            format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            startDate: StartDate,
            endDate: FromEndDate,
        });
        <?php if(isset($_REQUEST['Group']) && $_REQUEST['Group'] != ''){ ?>
        GetGroupDrp();
        <?php } ?>
    });
</script>