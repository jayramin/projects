<?php
$TeamID = $_REQUEST['TeamID'];
$data = $fn->GetAllTournamentTeamData('{"Flag":"TeamPlayersData","TeamID":"'.$TeamID.'","TournamentID":"'.$_REQUEST['TournamentID'].'"}');
//echo '<pre>';
//print_r($data);
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">            
                    <?php
                        if (is_array($data) && !empty($data)) { ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><?php echo PlayerName; ?></th>
                                            <th><?php echo EmailID; ?></th>
                                            <th><?php echo MobileNumber; ?></th>
                                            <th><?php echo Height; ?></th>
                                            <th><?php echo Weight; ?></th>
                                            <th><?php echo dob; ?></th>
                                            <th style="width: 5%;"><?php echo AdminApproval; ?></th>
                                            <th style="width: 10%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['GetTournamentTeamData'] AS $Key => $Value) {  
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['FullName']; ?></td>
                                                <td><?php echo $Value['EmailID']; ?></td>
                                                <td><?php echo $Value['MobileNumber']; ?></td>
                                                <td><?php echo $Value['Height']; ?></td>
                                                <td><?php echo $Value['Weight']; ?></td>
                                                <td><?php echo $Value['DOB']; ?></td>
                                                <td <?php if($Value['AdminStatus'] == 'Y'){ ?> style="color: green"<?php }else{ ?>style="color: red" <?php } ; ?>><?php if($Value['AdminStatus'] == 'Y'){ ?> <label>Yes</label> <?php }else if($Value['AdminStatus'] == 'R'){ ?><label> Rejected</label> <?php }else{ ?><label> No</label> <?php } ?></td>
                                                <td >
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <?php if($Value['AdminStatus'] != 'R'){ ?>
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to view Player details" href="<?php echo 'view_users&method=edit&UserID=' . $Value['UserID'].'&TeamID=' . $Value['TeamID']; ?>&CaptainID=<?php echo $Value['CaptainID']; ?>&TournamentID=<?php echo $_REQUEST['TournamentID'];?>&TeamTournamentRelationID=<?php echo $Value['TeamTournamentRelationID']; ?><?php if($Value['AdminStatus'] == 'Y'){ ?>&Verify=Yes<?php } else { ?>&Verify=No<?php } ?>">Verify Player</a>
                                                            <?php } else { ?>
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to view Rejected Reason" onclick="GetReason('<?php echo $Value['RejectionReason']; ?>')">View Reason</a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>     
                                            <tr>
                                                <?php 
//                                                $TeamTournaTempData = $fn->GetTournamnetReleTeamTempData('{"TeamTournamentRelationID":"'.$Value['TeamTournamentRelationID'].'","TournamentID":"'.$Value['TournamentID'].'","TeamID":"'.$Value['TeamID'].'"}');
                                                $TeamTournaTempData = $fn->GetTournamnetReleTeamTempData('{"TeamTournamentRelationID":"'.$Value['TeamTournamentRelationID'].'","TournamentID":"'.$_REQUEST['TournamentID'].'","TeamID":"'.$_REQUEST['TeamID'].'"}');
                                                $TeamTournaTempPlayerData = $fn->GetTournamnetReleTeamTempForCheckPlayerData('{"TeamTournamentRelationID":"'.$Value['TeamTournamentRelationID'].'","TournamentID":"'.$_REQUEST['TournamentID'].'","TeamID":"'.$_REQUEST['TeamID'].'"}');
                                                
                                                $TotalApprovedPlayers = $TeamTournaTempData['GetTournamentTempData']['AdminStatusCount'];
                                                $MinimumPlayersRequired = $TeamTournaTempPlayerData['GetTournamentTempPlayerData']['MinimumPlayers'];
                                                $MaximumPlayersRequired = $TeamTournaTempPlayerData['GetTournamentTempPlayerData']['MaximumPlayers'];
//                                                echo $TotalApprovedPlayers;
//                                                echo $MinimumPlayersRequired;
                                                ?>
                                                
                                                <td colspan="9" align="center">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-2" >
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <?php
//                                                            echo $TotalApprovedPlayers;
//                                                            echo $MinimumPlayersRequired;
                                                            ?>
                                                            <?php if((isset($_REQUEST['Approved']) && $_REQUEST['Approved'] == 'Yes')){ ?>
                                                            <button type="button" class="btn waves waves-effect waves-float btn-sm btn-success" title="Click here to final approval" disabled="">Team Already Approved</button>    
                                                            <?php }else{ ?>
                                                            <button type="button" class="btn waves waves-effect waves-float btn-sm btn-primary" title="Click here to final approval" <?php if($TotalApprovedPlayers < $MinimumPlayersRequired){ ?> disabled="" <?php } ?> onclick="SaveFinalTeamForTournament('<?php echo $Value['TeamID']?>','<?php echo $Value['TournamentID']?>')">Approve Team</button>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <center><h4>No Records Found</h4></center>
                            <?php
                        }
//                    }
                    ?>
                </div>  
    </div>

</form>

<div class="modal fade" id="MyTorunamentRejectReasonModal" role="dialog">
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
function GetReason(Reason)
{
    $('#RejectReasonPlayerID').html(Reason);
    $('#MyTorunamentRejectReasonModal').modal('show');
}
</script>