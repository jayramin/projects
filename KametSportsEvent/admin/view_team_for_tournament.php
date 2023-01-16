<?php
$iscaptain = $_SESSION['KametSports']['session']['CaptainshipStatus'];
$UserID = $_SESSION['KametSports']['session']['UserID'];
$data = $fn->GetAllTeamData('{"UserID":"' . $UserID . '"}');
$TeamID = $data['GetTeamWiseData']['TeamID'];
$MyTeamWiseData = $fn->MyTeamDataNewForTournament('{"TeamID":"' . $TeamID . '","TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$MyTeamEligiblePlayersData = $fn->GetEligiblePlayersToVerify('{"TeamID":"' . $TeamID . '","TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$AppliedTournamentData = $fn->AppliedTournamentData('{"TeamID":"' . $TeamID . '","TournamentID":"'.$_REQUEST['TournamentID'].'"}');
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-8">
                <div class="page-header">
                    <h2>Team</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li class="active"><?php echo ($_REQUEST['method'] == 'edit') ? 'Edit Team' : 'View Team'; ?></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-4"><br><br>
                <div class='panel-header'>
                    <div class="form-group">
                        <div class="col-lg-12 padding-0">
                            <div class="col-lg-4 padding-0">
                                 <?php
                            $TournamentData = $fn->TournamentDropDown('{"TeamID":"' . $TeamID . '"}');
                            ?>
                            <label for="TournamentName" class="control-label pull-right" style="margin-top: 3px;"><?php echo TournamentName; ?> <span style="color: red;">*</span> </label></div>
                        <div class="col-lg-8">
                             <span id="TournamentSpan" style="color: red"></span>
                             <select name="Tournament" id="Tournament" class="form-control" onchange="GetTournamentDetails(this.value)">
                                 <option value="">Select Tournament</option>
                                 <?php 
                                 foreach ($TournamentData['GetApplyTournamentWiseData'] AS $key => $ValTournament ){ ?>
                                 <option value="<?php echo $ValTournament['TournamentID'];?>" <?php if($_REQUEST['TournamentID'] == $ValTournament['TournamentID']){ ?> selected="" <?php } ?>><?php echo $ValTournament['TournamentName'];?></option>
                                <?php }  ?>
                             </select>                           
                        </div>
                        </div>                        
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <?php if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != ''){ ?>
        <div class='panel-body'>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert-info" id="TournamentDetails">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert-info" id="TournamentDetails">
                        <div class="col-lg-6 padding-0">
                            <div class="col-lg-6 padding-0">
                            <label for="StateName" class="control-label pull-right" style="margin-top: 3px;"><?php echo SelectStateToTournament; ?> <span style="color: red;">*</span> </label></div>
                        <div class="col-lg-6">
                             <span id="TournamentSpan" style="color: red"></span>
                            <?php
                            if(isset($AppliedTournamentData['GetAppliedTournamentData']['StateID']) && $AppliedTournamentData['GetAppliedTournamentData']['StateID'] != ''){
                            $Selected = isset($_REQUEST['StateID']) ? $_REQUEST['StateID'] : $AppliedTournamentData['GetAppliedTournamentData']['StateID'];
                            $db_array = array("tbl_name" => 'v_state', "condition" => "is_active='Y' AND StateID=".$AppliedTournamentData['GetAppliedTournamentData']['StateID']);
                            $select_array = array("name" => "StateID", "id" => "StateID", "class" => "required form-control", "onchange" => "GetTournamentCities(this.value,\"" . $AppliedTournamentData['GetAppliedTournamentData']['TournamentID']. "\",\"" . $AppliedTournamentData['GetAppliedTournamentData']['CityID']. "\")");
                            $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $Selected);
                            $fn->dropdown($db_array, $select_array, $option_array);    
                            }else{
                            $Selected = isset($_REQUEST['StateID']) ? $_REQUEST['StateID'] : $AppliedTournamentData['GetAppliedTournamentData']['StateID'];
                            $db_array = array("tbl_name" => 'v_state', "condition" => "is_active='Y'");
                            $select_array = array("name" => "StateID", "id" => "StateID", "class" => "required form-control", "onchange" => "GetTournamentCities(this.value,\"" . $AppliedTournamentData['GetAppliedTournamentData']['TournamentID']. "\",\"" . $AppliedTournamentData['GetAppliedTournamentData']['CityID']. "\")");
                            $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $Selected);
                            $fn->dropdown($db_array, $select_array, $option_array);
                            }
                            ?>
                        </div>
                        </div>
                        <div class="col-lg-6 padding-0">
                            <div class="col-lg-6">
                            <label for="CityName" class="control-label pull-right" style="margin-top: 3px;"><?php echo SelectCityToTournament; ?> <span style="color: red;">*</span> </label></div>
                        <div class="col-lg-6">
                             <span id="TournamentSpan" style="color: red"></span>
                            <?php
                            if(isset($AppliedTournamentData['GetAppliedTournamentData']['CityID']) && $AppliedTournamentData['GetAppliedTournamentData']['CityID'] != ''){
                            $Selected = isset($_REQUEST['CityID']) ? $_REQUEST['CityID'] : $AppliedTournamentData['GetAppliedTournamentData']['CityID'];
                            $db_array = array("tbl_name" => 'v_city', "condition" => "is_active='Y' AND CityID=".$AppliedTournamentData['GetAppliedTournamentData']['CityID']);
                            $select_array = array("name" => "CityID", "id" => "CityID", "class" => "required form-control");
                            $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $Selected);
                            $fn->dropdown($db_array, $select_array, $option_array);    
                            }else{
                            $Selected = isset($_REQUEST['CityID']) ? $_REQUEST['CityID'] : $AppliedTournamentData['GetAppliedTournamentData']['CityID'];
                            $db_array = array("tbl_name" => 'v_city', "condition" => "is_active='Y'");
                            $select_array = array("name" => "CityID", "id" => "CityID", "class" => "required form-control");
                            $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $Selected);
                            $fn->dropdown($db_array, $select_array, $option_array);
                            }
                            ?>
                        </div>
                      </div>
                    </div>
                </div>
            </div><br>
            <?php // if ($iscaptain == 'N') { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6">
                     <?php if (is_array($MyTeamEligiblePlayersData) && !empty($MyTeamEligiblePlayersData)) { ?>
                        <div class="table-responsive">
                            <table id="" class="table-responsive tab-content table-bordered table-hover table table-striped display">
                                <thead>
                                    <tr>
                                        <th style="width: 5%"><?php echo SrNo; ?></th>
                                        <th><?php echo PlayerName; ?></th>
                                        <th><?php echo SelectPlayers; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(count($MyTeamEligiblePlayersData['EligiblePlayers']) > 0){
                                    foreach ($MyTeamEligiblePlayersData['EligiblePlayers'] AS $Key => $data) {?>
                                        <tr>
                                            <td><?php echo ($Key + 1) ?></td>
                                            <td><?php echo $data['PlayerName']; ?></td>
                                            <td><input type="checkbox" id="<?php echo $data['PlayerID'] ?>" name="PlayerID" value="<?php echo $data['PlayerID'] ?>" >
                                            </td>
                                        </tr>
                                    <?php  } } else{ ?>
                                        <tr><td colspan="3"><center><h4 class="text-danger">Add Players In Team To Participate in Tournament</h4></center></td></tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="3" align="center">
                                            <input type="checkbox" id="TournamentRulesCheck" value="1" style="padding-top: 5px;">
                                            <a id="TournamentRules" class="form-group AnchorClass" data-toggle="modal" style=" cursor: pointer !important; " data-target="#MyTorunamnetRuleModal" style="cursor: hand">I as a Captain and on behalf of my entire Team, accepts all the mentioned rules and abide to follow it strictly in order to participate in this Tournament.
</a><br>
                                            <input type="button" id="SendTeamForVerification" class="btn btn-primary" value="Send Team for Approval" onclick="SendTeamToVerification()"><br>
                                            <span id="TournamentRulesCheckErrorSpan" style="color: red "></span>
                                        </td>
                                    </tr>             
                                </tbody>
                                <input type="hidden" name="CaptainID" id="CaptainID" value="<?php echo $UserID?>">
                                <input type="hidden" name="TournamentRulesStatus" id="TournamentRulesStatus" value="Y">
<!--                                <input type="hidden" name="TeamID" id="TeamID" value="<?php echo $MyTeamWiseData['GetMyTeamWiseData']['TeamData'][0]['TeamID']?>">-->
                                <input type="hidden" name="TeamID" id="TeamID" value="<?php echo $TeamID; ?>">
                            </table>
                        </div>
                    <?php } else { ?>
                        <center><h4>Add Players In Team To Participate in Tournament</h4></center>
                    <?php } ?>   
                    </div>
                    
                    <div class="col-lg-6">
                     <?php if (is_array($MyTeamWiseData) && !empty($MyTeamWiseData) && $MyTeamWiseData['Message'] == 'Success') { ?>
                        <div class="table-responsive">
                            <table id="" class="table-responsive tab-content table-bordered table-hover table table-striped display" >
                                <thead>
                                    <tr>
                                        <th style="width: 5%"><?php echo SrNo; ?></th>
                                        <th><?php echo PlayerName; ?></th>
                                        <th><?php echo PlayerStatus; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($MyTeamWiseData['GetMyTeamWiseData']['TeamData'] AS $Key => $data) { 
                                        $TeamTournaTempDataForPlayerCheck = $fn->GetTournamnetReleTeamTempForPlayerCheckData('{"PlayerID":"'.$data['PlayerID'].'","TournamentID":"'.$_REQUEST['TournamentID'].'"}');
                                        
                                        $RelePlayerID = $TeamTournaTempDataForPlayerCheck['GetTournamentTempForPlayerCheckData']['PlayerID'];
                                        $ReleTournamentID =$TeamTournaTempDataForPlayerCheck['GetTournamentTempForPlayerCheckData']['TournamentID'];
                                        if(count($TeamTournaTempDataForPlayerCheck['GetTournamentTempForPlayerCheckData']) > 0){ ?>
                                        <tr>
                                            <td><?php echo ($Key + 1) ?></td>
                                            <td><?php echo $data['PlayerName']; ?></td>
                                            <td>
                                            <?php
                                            if($data['PlayerID'] == $RelePlayerID && $data['AdminStatus'] == 'Y' && $ReleTournamentID == $_REQUEST['TournamentID']){ ?><label style="color: green;">Approved By Admin</label><?php }else if($data['PlayerID'] == $RelePlayerID && $data['AdminStatus'] == 'R' && $ReleTournamentID == $_REQUEST['TournamentID']){ ?><label style="color: red;"> Rejected By Admin</label> <?php }else if($data['PlayerID'] == $RelePlayerID && $data['AdminStatus'] == 'N' && $ReleTournamentID == $_REQUEST['TournamentID']){ ?><label style="color: orange;"> Admin Approval Pending </label> <?php }?>
                                            <?php if($data['PlayerID'] == $RelePlayerID && $data['AdminStatus'] == 'R' && $ReleTournamentID == $_REQUEST['TournamentID']){ ?>
                                            &nbsp;&nbsp;<a class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to view Rejected Reason" onclick="GetReasonCaptain('<?php echo $data['RejectionReason']; ?>')">View Reason</a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <?php }  } ?>              
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <center><h4 class="text-danger">No Player Selected For Tournament</h4></center>
                    <?php } ?>   
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <center><h2 class="text-danger">Please Select Tournament..</h2></center>
        <?php } ?>
    </div>
    
</div>


<div class="modal fade" id="MyTorunamnetRuleModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kamet Sports Event</h4>
        </div>
        <div class="modal-body" >
            <div class="row">
            <div class="col-lg-12" id="TorunamnetRuleModal">
                
            </div>
            </div>
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<div class="modal fade" id="MyTorunamnetLogoModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tournament Logo</h4>
        </div>
        <div class="modal-body" >
            <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <img id="LargerImageDisplay" class="img-thumbnail" style="height:300px;width:300px;">  
                </div>
                <div class="col-lg-2"></div>
            </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<div class="modal fade" id="MyTorunamentRejectReasonCaptainModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Player Rejected Reason</h4>
        </div>
        <div class="modal-body" >
            <div class="row">
            <div class="col-lg-12" id="RejectReasonPlayerID">
                
            </div>
            </div>
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<script>
function GetReasonCaptain(Reason)
{
    $('#RejectReasonPlayerID').html(Reason);
    $('#MyTorunamentRejectReasonCaptainModal').modal('show');
}
</script>

<script>
    function ShowImage(){
        $('#MyTorunamnetLogoModal').modal('show');
    }
    function GetTournamentDetails(e){
        window.location = 'view_team_for_tournament&TournamentID='+e;
    }
    <?php if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != ''){ ?>
        $(document).ready(function(){
            var TournamentID = '<?php echo $_REQUEST['TournamentID']; ?>';
            // Comment ON 05-01-2016
            <?php if(count($AppliedTournamentData['GetAppliedTournamentData']) == 0 || ($AppliedTournamentData['GetAppliedTournamentData']['TournamentID'] != $_REQUEST['TournamentID'])){ ?>
            GetTournamentStates(TournamentID,'<?php echo $AppliedTournamentData['GetAppliedTournamentData']['TournamentID']; ?>','<?php echo $AppliedTournamentData['GetAppliedTournamentData']['StateID']; ?>');
            GetTournamentCities('<?php echo $AppliedTournamentData['GetAppliedTournamentData']['StateID']; ?>','<?php echo $AppliedTournamentData['GetAppliedTournamentData']['TournamentID']; ?>','<?php echo $AppliedTournamentData['GetAppliedTournamentData']['CityID']; ?>');
            <?php } ?>
            GetTournamentDetails_new(TournamentID);  
        });
    <?php } ?>
    function GetTournamentDetails_new(e) {
        var TournamentID = e;
        var TeamID = $("#TeamID").val();
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: {TournamentID: TournamentID,TeamID:TeamID, do: 'GetTournamentDetails'},
            success: function (result) {
                var data = JSON.parse(result);
                if(data.Flag == 'TRUE')
                {
                    $('#SendTeamForVerification').prop('disabled',true);
                    $('#SendTeamForVerification').val('Team Already Sent');
                }else{
                    $('#SendTeamForVerification').prop('disabled',false);
                    $('#SendTeamForVerification').val('Send Team for Approval');
                }
                $("#TournamentDetails").html(data.html);
                $("#TorunamnetRuleModal").html(data.TournamentRule);
                $('#LargerImageDisplay').attr('src',data.TorunamentImage);
            }
        });
    }
    function GetTournamentStates(e,SelectedTournamentID,SelectedStateID) {
        var TournamentID = e;
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: {TournamentID: TournamentID, do: 'GetTournamentStates'},
            success: function (result) {
                $("#StateID").html(result);
                if(TournamentID == SelectedTournamentID){
                $("#StateID").select2('val',SelectedStateID);
                }else{
                $("#StateID").select2("val", "");   
                }
                $("#CityID").select2("val", "");
            }
        });
    }
    function GetTournamentCities(e,SelectedTournamentID,SelectedCityID) {
        var StateID = e;
        var TournamentID = '<?php echo $_REQUEST['TournamentID']?>';   
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: {StateID:StateID, TournamentID: TournamentID, do: 'GetTournamentCities'},
            success: function (result) {
                $("#CityID").html(result);
                if(TournamentID == SelectedTournamentID)
                {
                $("#CityID").select2('val',SelectedCityID);
                }else{
                $("#CityID").select2("val", "");   
                }
                
            }
        });
    }
    function SendTeamToVerification() {
        var PlayerList = '';
        var CaptainID = $("#CaptainID").val();
        var TeamID = $("#TeamID").val();
        var TournamentID = '<?php echo $_REQUEST['TournamentID']; ?>';
        var StateID = $("#StateID").val();
        var CityID = $("#CityID").val();
        var TournamentRulesStatus = $("#TournamentRulesStatus").val();
        
 if($('input[id=TournamentRulesCheck]').is(':checked')){
     $("#TournamentRulesCheckErrorSpan").text('');
     $('input[name=PlayerID]').each(function () {
        if (this.checked) {
//            sList.push(this.id);
            PlayerList +=this.id+',';
                }
            });
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: {TournamentRulesStatus:TournamentRulesStatus,PlayerList: PlayerList,TournamentID:TournamentID,StateID:StateID,CityID:CityID,CaptainID:CaptainID,TeamID:TeamID, do: 'SendTeamToVerification'},
            beforeSend: function () {
                $("#Loading").css("display", "block");
                $("#Loading").css("position", "fixed");
                $("#Loading").css("margin-left", "700px");
                $("#Loading").css("opacity", "1000");
             },
            complete: function () {
                $("#Loading").css("display", "none");
            },
            success: function (result) {
                var data = JSON.parse(result);
                if(data.ResponseCode == '1'){
                alert_message_popup('view_team_for_tournament&TournamentID=<?php echo $_REQUEST['TournamentID']; ?>',data.Message);
                }else{
                alert_message_popup('',data.Message);
               }
            }
        });
        }else{
            $("#TournamentRulesCheckErrorSpan").text('Select Tournament Terms And Condition First');
            return false;
        }      
    }

</script>