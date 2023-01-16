<?php
$UserID = $_SESSION['KametSports']['session']['UserID'];
$RoleID = $_SESSION['KametSports']['session']['RoleID'];
$data = $fn->GetAllTeamJoinRequest('{"UserID":"'.$UserID.'"}');
$DataForCaptainRequest = $fn->GetAllTeamCaptainRequest('{"UserID":"'.$UserID.'"}');

?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-10">
                <div class="page-header">
                    <h2>Request To Join A Team</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li class="active"><?php echo ($_REQUEST['method'] == 'edit') ? 'Edit Accept Request' : 'View Request'; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-body'>
            <form id="SearchPlayer" name="SearchPlayer">
                <div class="row">
                   <?php if (is_array($data['GetTeamJoinRequestWiseData']) && !empty($data['GetTeamJoinRequestWiseData']) && $data['GetTeamJoinRequestWiseData']['Message'] != 'No Record Found') { 
                       ?> 
                    <div class="col-lg-12">
                        <div class="table-responsive">
                                <table id="" class="table table-striped table-condensed table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><?php echo NotificationsToJoinTeam; ?></th>
                                            <th style="width: 10%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['GetTeamJoinRequestWiseData'] AS $Key => $Value) {
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['NotificationText']; ?><label class="pull-right">
                                                        <a  onclick="TeamDetails('<?php echo $Value['TeamID'];?>','myModalTeamDetails')">Details</a></label></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                       
                                                        <div class="btn-group">
                                                            <input type="hidden" id="PlayerID" value="<?php echo $Value['PlayerID'];?>"> 
                                                            <input type="hidden" id="RelationID" value="<?php echo $Value['RelationID'];?>"> 
                                                            <input type="hidden" id="TournamentID" value="<?php echo $Value['TournamentID'];?>"> 
                                                            <input type="hidden" id="CaptainID" value="<?php echo $Value['CaptainID'];?>"> 
                                                            <input type="hidden" id="TeamID" value="<?php echo $Value['TeamID'];?>"> 
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to approve this request" onclick="ApproveTeamJoinRequest('<?php echo $Value['RelationID'];?>','<?php echo $Value['NotificationID'];?>','<?php echo $Value['PlayerID'];?>','<?php echo $Value['CaptainID'];?>','<?php echo $Value['TeamID'];?>');"><label>Accept</label></button>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button  id="decline" class="btn btn-danger btn-sm waves" onclick="RejectFunction('<?php echo $Value['RelationID'];?>','<?php echo $Value['NotificationID'];?>','RelationIDToPut','NotificationIDToPut','myModalRejectTeamJoinRequest');"><label>Reject</label></button>
                                                             
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>                                    
                                    </tbody>
                                </table>
                            </div>
                    </div>     
                    <?php }else if (is_array($DataForCaptainRequest['GetBecomeCaptainData']) && !empty($DataForCaptainRequest['GetBecomeCaptainData']) && $DataForCaptainRequest['GetBecomeCaptainData']['Message'] != 'No Record Found'){ 
                        ?>
                        
                        <div class="col-lg-12">
                                <center><label>Request To Become a Captain </label></center>
                        <div class="table-responsive">
                            
                                <table id="" class="table table-striped table-condensed table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><?php echo CaptainName; ?></th>
                                            <th style="width: 10%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($DataForCaptainRequest['GetBecomeCaptainData'] AS $Key => $Value) {
//                                            echo '<pre>';
//                                            print_r($Value);
//                                            $DataForCaptainRequest['GetBecomeCaptainData']
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['CaptainName']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                       
                                                        <div class="btn-group">
                                                            <input type="hidden" id="PlayerID" value="<?php echo $Value['PlayerID'];?>"> 
                                                            <input type="hidden" id="SwitchCaptainshipID" value="<?php echo $Value['RelationID'];?>"> 
                                                            <input type="hidden" id="CaptainID" value="<?php echo $Value['CaptainID'];?>"> 
                                                            <input type="hidden" id="TeamID" value="<?php echo $Value['TeamID'];?>"> 
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to approve this request" onclick="AcceptBecomeCaptainRequest('<?php echo $Value['SwitchCaptainshipID'];?>','<?php echo $Value['PlayerID'];?>','<?php echo $Value['CaptainID'];?>','<?php echo $Value['TeamID'];?>');"><label>Accept</label></button>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button  id="decline" class="btn btn-danger btn-sm waves" onclick="CaptainshipRejectFunction('<?php echo $Value['SwitchCaptainshipID'];?>','SwitchCaptainshipIDID','<?php echo $Value['PlayerID'];?>','PlayerIDID','<?php echo $Value['TeamID'];?>','TeamIDID','myModalRejectReasonToTeamCaptainRequest');"><label>Reject</label></button>
                                                             
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>                                    
                                    </tbody>
                                </table>
                            </div>
                    </div> 
                        
                        
                        
                  <?php  } else { ?>
                    <div class="row">
                        <div class="col-lg-12" style="margin-top: 20px;">
                            <center><h4>No Record Found</h4></center>
                        </div>
                    </div>  
                     <?php } ?>
                </div>  
                <div class="row">
                    <div class="col-lg-12" name="PlayerData" id="PlayerData">
                        <table name="PlayerDataTable" id="PlayerDataTable">
                            
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="myModalTeamDetails" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kamet Sports Event</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div id="TeamDetails"></div>
                </div>
            </div>
            
        </div>
       
      </div>
      
    </div>
  </div>


<div class="modal fade" id="myModalRejectReasonToTeamCaptainRequest" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kamet Sports Event</h4>
        </div>
        <div class="modal-body">
            <label>Reason For Reject Captainship Request</label><span style="color: red">&nbsp;*&nbsp;</span><span id="RejectReason" style="color: red"></span>
            <textarea name="CaptainshipRejectRejectReason" id="CaptainshipRejectRejectReason" class="form-control required"></textarea>
            <span id="CaptainshipRejectRejectReasonErrorSpan" style="color: red"></span>
        </div>
        <div class="modal-footer">
            <div id="common_wait" style="display:none;width:50px;height:50px;position:absolute;top:40%;right:50%;padding:2px;" ><img src='uploads/ajax_loading.gif' width="50" height="50" /></div>
            <input type="hidden" id="SwitchCaptainshipIDID" value="">
            <input type="hidden" id="PlayerIDID" value="">
            <input type="hidden" id="TeamIDID" value="">
            <button type="button" class="btn btn-primary" onclick="RejectBecomeCaptainRequest('SwitchCaptainshipIDID','PlayerIDID','CaptainshipRejectRejectReason','TeamIDID')">Send Message</button>  
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



<div class="modal fade" id="myModalRejectTeamJoinRequest" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kamet Sports Event</h4>
        </div>
        <div class="modal-body">
            <label>Reason For Reject Team Request</label><span id="RejectReason" style="color: red"></span>
            <textarea name="RejectReason" id="TeamRejectReason" class="form-control"></textarea>
            <span id="RejectReasonErrorSpan" style="color: red"></span>
        </div>
        <div class="modal-footer">
            <div id="common_wait" style="display:none;width:50px;height:50px;position:absolute;top:40%;right:50%;padding:2px;" ><img src='uploads/ajax_loading.gif' width="50" height="50" /></div>
            <input type="hidden" id="RelationIDToPut" value="">
            <input type="hidden" id="NotificationIDToPut" value="">
            <button type="button" class="btn btn-primary" onclick="RejectTeamJoinRequest('RelationIDToPut','NotificationIDToPut','TeamRejectReason')">Send Message</button>  
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script>
    function RejectFunction(RelationID,NotificationID, RelationIDToPut,NotificationIDToPut, ModelToOpen)
    {
        $('#'+RelationIDToPut).val(RelationID);
        $('#'+NotificationIDToPut).val(NotificationID);
        $('#'+ModelToOpen).modal('show');
    }
    function CaptainshipRejectFunction(SwitchCaptainshipID,SwitchCaptainshipIDID,PlayerID,PlayerIDID,TeamID,TeamIDID, ModelToOpenForReason)
    {
        $('#'+SwitchCaptainshipIDID).val(SwitchCaptainshipID);
        $('#'+PlayerIDID).val(PlayerID);
        $('#'+TeamIDID).val(TeamID);
        $('#'+ModelToOpenForReason).modal('show');
    }
    function TeamDetails(TeamID)
    {
//        alert(TeamID);
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: {'TeamID':TeamID,'do':'TeamDetails'},
            success: function (result) {
                alert_message_popup('',result);
                $('#TeamDetails').html(result);
//                alert_message_popup('view_tournament', "Data Save Successfully");

            }
        });
        
//        $('#'+ModelToTeamDetails).modal('show');
    }
</script>