<?php //
if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != ''){
$data = $fn->GetTeamWisePlayerData('{"TournamentID":"'.$_REQUEST['TournamentID'].'","MatchId":"'.$_REQUEST['MatchId'].'"}');
$dataByMatchID = $fn->GetTeamDataByMatchID('{"TournamentID":"'.$_REQUEST['TournamentID'].'","MatchId":"'.$_REQUEST['MatchId'].'"}');
$Team1_ID = $dataByMatchID['GetTeamIDByMatchID']['GroupTeamRelationID1'];
$Team2_ID = $dataByMatchID['GetTeamIDByMatchID']['GroupTeamRelationID2'];

$MatchDetails = $fn->MatchDetailsByMatchID('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$MatchName = $MatchDetails['MatchNameByMatchID'];   
}
?>

<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="TournamentID" class="control-label"><?php echo Tournament; ?> <span style="color: red;">*</span> </label>&nbsp;
                    <span id="TournamentError" style="color: red"></span>
                    <?php
                    $Selected = isset($_REQUEST['TournamentID']) ? $_REQUEST['TournamentID'] :$_REQUEST['TournamentID'];
                    $Condition = "is_active = 'Y' AND StartDate >= '".date("Y-m-d")."' ";
                    $db_array = array("tbl_name" => 'v_tournaments', "condition" => $Condition);
                    $select_array = array("name" => "TournamentID", "id" => "TournamentIDSelected", "class" => "form-control chosen-select required", "onchange" => "LoadMatch(this.value,\"MatchIdSelected\",\"IN\");");
                    $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Select Tournament", 'selected' => $Selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="Match" class="control-label"><?php echo Match; ?> <span style="color: red;">*</span> </label>&nbsp;
                    <span id="RoundError" style="color: red"></span>
                    <?php if(isset($_REQUEST['MatchId']) && $_REQUEST['MatchId'] != ''){ ?>
                        <select id="MatchIdSelected" name="MatchId" class="form-control chosen-select">
                            <option value="<?php echo $_REQUEST['MatchId']?>"><?php echo $MatchName; ?></option>
                    </select>
                   <?php  }else{ ?>
                        <select id="MatchIdSelected" name="MatchId" class="form-control chosen-select">
                        <option value="">Select Match</option>
                    </select>
                  <?php  }?>
                    
                </div>
            </div>
            <div class="col-lg-1">
                <div class="form-group">
                    <br>
                    <input type="button" class="btn btn-primary pull-right" id="Search" name="Search" value="Search" onclick="GetTeamPlayer()">
                </div>
            </div>
            <div class="col-lg-2"></div>
           
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
<div class="col-lg-6 col-sm-6">       
    <div class="well">
      <div class="tab-content">
         <table id="" class="display table table-bordered table-hover table-responsive table-striped">
          <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><?php echo PlayerName; ?></th>
                                        </tr>
                                    </thead>
                                    
                                    <center><label><?php  
                                    $flag = 1;
                                    foreach ($data['GetMatchPlayerDataByTeamID'] AS $Key => $Value) { 
                                        if($Value['TeamID'] ==  $Team1_ID && $flag == 1){
                                            $Team1_Name = $Value['TeamName'];
                                            $flag = 0;
                                        }
                                    }
                                        echo $Team1_Name;?></label></center>
          <tbody>
          
                                        <?php
                                       $ie=1;
                                        foreach ($data['GetMatchPlayerDataByTeamID'] AS $Key => $Value) {
                                            if($Value['TeamID'] ==  $Team1_ID){ ?>
                                              <tr>
                                                <td><?php echo $ie; ?></td>
                                                <td><label><?php echo $Value['PlayerName'];?></label></td>
                                                
                                            </tr>
                                        <?php   $ie++; } ?>
                                            
                                        <?php   } ?>                                    
                                    </tbody>
                                     </table>
          </div>
          <?php // } ?> 
      </div>
    </div>
    <div class="col-lg-6 col-sm-6">       
    <div class="well">
      <div class="tab-content">
         <table id="" class="display table table-bordered table-hover table-responsive table-striped">
          <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><?php echo PlayerName; ?></th>
                                        </tr>
                                    </thead>
                                    <center><label><?php  
                                    $flag = 1;
                                    foreach ($data['GetMatchPlayerDataByTeamID'] AS $Key => $Value) { 
                                        if($Value['TeamID'] ==  $Team2_ID && $flag == 1){
                                            $Team2_Name = $Value['TeamName'];
                                            $flag = 0;
                                        }
                                    }
//                                    echo $flag;
                                        echo $Team2_Name;?></label></center>
          <tbody>
                                        <?php
                                        $i=1;
                                        foreach ($data['GetMatchPlayerDataByTeamID'] AS $Key => $Value) { 
                                            
                                          if($Value['TeamID'] ==  $Team2_ID){ ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><label><?php echo $Value['PlayerName'];?></label></td>
                                                
                                            </tr>
                                          <?php $i++; }  } ?>                                    
                                    </tbody>
                                     </table>
          </div>
          <?php // } ?> 
      </div>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
            <div class="col-lg-2">
                <label class="text-danger"><b>Set</b> </label>
            </div>
            <div class="col-lg-2">
                <label class="text-danger"><b>Winning Team</b> </label>
            </div>
            <div class="col-lg-2">
                <label class="text-danger"><b>Winning Points</b> </label>
            </div>
            <div class="col-lg-2">
                <label class="text-danger"><b>Losing Team</b> </label>
            </div>
            <div class="col-lg-2">
                <label class="text-danger"><b>Losing Points</b> </label>
            </div>
            <div class="col-lg-2">
                <label class="text-danger"><b>Deference</b> </label>
            </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
             
            <?php for($loopdata=1; $loopdata <= 5; $loopdata++){ ?>
            <div class="col-lg-2">
                <label class="text-success">Set <?php echo $loopdata?> </label>
                <input type="hidden" name="SetNo[]" value="<?php echo $loopdata?>">
            </div>
            <div class="col-lg-2">
                <select name="SetWinningTeam[]" id="Set<?php echo $loopdata;?>WinningTeam" class="form-control" onchange="LosingTeam(this.value,'<?php echo $dataByMatchID['GetTeamIDByMatchID']['GroupTeamRelationID1']; ?>','<?php echo $dataByMatchID['GetTeamIDByMatchID']['GroupTeamRelationID2']; ?>','Set<?php echo $loopdata;?>LosingTeam')">
                    <option value="">Select Winning Team</option>
                    <option value="<?php echo $dataByMatchID['GetTeamIDByMatchID']['GroupTeamRelationID1']?>"><?php echo $dataByMatchID['GetTeamIDByMatchID']['FirstTeamName'];?></option>
                    <option value="<?php echo $dataByMatchID['GetTeamIDByMatchID']['GroupTeamRelationID2']?>"><?php echo $dataByMatchID['GetTeamIDByMatchID']['SecondTeamName'];?></option>
                </select>
            </div>
            <div class="col-lg-2">
                <input type="number" name="Setwon[]" id="Set<?php echo $loopdata;?>won" class="form-control" min="1" max="25" onkeypress="return is_number(event)">
            </div>
            <div class="col-lg-2">
                <select name="SetLosingTeam[]" id="Set<?php echo $loopdata;?>LosingTeam" class="form-control" onchange="">
                    <option value="">Select Losing Team</option>
                    <option value="<?php echo $dataByMatchID['GetTeamIDByMatchID']['GroupTeamRelationID1']?>"><?php echo $dataByMatchID['GetTeamIDByMatchID']['FirstTeamName'];?></option>
                    <option value="<?php echo $dataByMatchID['GetTeamIDByMatchID']['GroupTeamRelationID2']?>"><?php echo $dataByMatchID['GetTeamIDByMatchID']['SecondTeamName'];?></option>
                </select>
            </div>
            <div class="col-lg-2">
                <input type="number" name="Setlose[]" id="Set<?php echo $loopdata;?>lose" class="form-control" min="1" max="25" onblur="GetDeferenceOfScore('Set<?php echo $loopdata;?>won','Set<?php echo $loopdata;?>lose','Set<?php echo $loopdata;?>Deference')">
            </div>
            <div class="col-lg-2">
                <input type="number" name="SetDeference[]" id="Set<?php echo $loopdata;?>Deference" class="form-control" min="1" max="25">
            </div>
           <?php }?>
            
        </div>
        <div class="col-lg-1"></div>
    </div><br>
    </div><br>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-1"></div>
            <div class="col-lg-2" style="padding-top: 5px;">
                <label class="text-danger">Select Player Of The Match:</label>
            </div>
           <div class="col-lg-3">
               <select id="TeamsIDs" name="PlayerOfTheMatchTeamID" class="form-control" onchange="GetTeamlayersForPlayerOfTheMatch(this.value)">
                   <option value="">Select Team</option>
                   <option value="<?php echo $dataByMatchID['GetTeamIDByMatchID']['GroupTeamRelationID1'] ?>"><?php echo $dataByMatchID['GetTeamIDByMatchID']['FirstTeamName']; ?></option>
                   <option value="<?php echo $dataByMatchID['GetTeamIDByMatchID']['GroupTeamRelationID2'] ?>"><?php echo $dataByMatchID['GetTeamIDByMatchID']['SecondTeamName']; ?></option>
               </select>
           </div>
           <div class="col-lg-3">
               <select id="PlayerOfTheMatch" name="PlayerOfTheMatch" class="form-control">
                   <option>Select Player</option>
               </select>
           </div>
           <div class="col-lg-2"></div>
        </div>
    </div>
    <br>
    <?php if(isset($_REQUEST['TournamentID']) && isset($_REQUEST['MatchId']) && $_REQUEST['TournamentID'] != '' && $_REQUEST['MatchId'] != ''){ ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-5"></div>
            <div class="col-lg-2"><br>
                <button type="button" id="Save" class="btn btn-primary" onclick="InsertMatchScore(this.form,'<?php echo $_REQUEST['TournamentID']; ?>')">Save</button>
                <button type="reset" class="btn btn-danger" >Cancel</button>
            </div>
        </div>
    </div>
    <?php } ?>
</form>
<br><br>
<script>
function GetTeamlayersForPlayerOfTheMatch(TeamID)
{
    var TournamentID = '<?php echo $_REQUEST['TournamentID']; ?>';
    jQuery.ajax({
        type: 'POST',
        url: '../class/class.ajaxRequest.php',
        data: {"do": "GetTeamPlayersForPlayerOfTheMatch", "TeamID": TeamID, "TournamentID":TournamentID},
        success: function (data) {
            $("#PlayerOfTheMatch").html(data);
            $("#PlayerOfTheMatch").select2('val','');
        }
    });
}
function GetTeamPlayer(){
    var TournamentID = $('#TournamentIDSelected').val();
    var MatchId = $('#MatchIdSelected').val();
    if(TournamentID != '' && MatchId != '')
    {
    window.location.href='view_match_score_entry&method=add&TournamentID='+TournamentID+'&MatchId='+MatchId;
    }else{
        alert_message_popup('','Please Select Tournament And Match');
    }
}
function GetDeferenceOfScore(WonScorePoint,LoseScorePoint,DeferecePoint){   
    var WonScore = $('#' + WonScorePoint).val();
    var LoseScore = $('#' + LoseScorePoint).val();
    if(parseInt(WonScore) > 25 || parseInt(LoseScore) > 25)
    {
      alert_message_popup('','Maximum Points Cannot be more then 25');
      return false;
    }else{
    if(WonScore < LoseScore){
        alert_message_popup('','Winning Team Score Should Be Greater Then Loosing Team Score');
        $('#' + WonScorePoint).focus();
    }else{
        var Deference = WonScore-LoseScore;
        $('#' + DeferecePoint).val(Deference);
    }
  }
}
function LosingTeam(e,value1,value2,ID){
    if(e == value1)
    {
        $('#'+ID).select2('val',value2);
    }else if(e == value2)
    {
        $('#'+ID).select2('val',value1);
    }
}

function is_number(e)
{
    if((e.charCode >= 48 && e.charCode <= 57) || e.charCode == 46)
    {}else{
        return false;
    }
}
</script>