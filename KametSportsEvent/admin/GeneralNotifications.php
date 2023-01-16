<?php
$GeneralNotificationData = $fn->GetGeneralNotificationData('{"ReceiverID":"'.$_SESSION['KametSports']['session']['UserID'].'","NotificationType":"'.$_REQUEST['Type'].'"}');
//echo '<pre>';
//print_r($GeneralNotificationData);
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-10">
                <div class="page-header">
                    <h2>Notification</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li class="active"><?php echo ($_REQUEST['method'] == 'edit') ? 'Edit Notifications' : 'View Notifications'; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-body'>
            <form id="SearchPlayer" name="SearchPlayer">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                                <table id="" class="table table-row table-striped table-condensed table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th style="width: 10%"><?php echo Date; ?></th>
                                            <th><?php echo Message; ?></th>
                                            
                                                <th><?php echo Delete; ?></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(count($GeneralNotificationData['GetGenralNotificationData']) > 0){
                                        foreach ($GeneralNotificationData['GetGenralNotificationData'] AS $key => $Values) { 
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo ($key + 1) ?></td>
                                                <td><?php echo date('d-m-Y',  strtotime($Values['NotificationCreatedDate'])) ?></td>
                                                <td><?php echo $Values['NotificationText'];?></td>
                                                
                                                <td title="<?php echo $Value['RejectedReason']; ?>">
                                                    <input type="hidden" name="DeleteNotificationID" id="DeleteNotificationID" value="<?php echo $Values['NotificationID']; ?>">
                                                    <button type="button" class="btn btn-sm btn-danger" name="NotificationDelete" id="Reason_<?php echo $Key; ?>" onclick='DeleteGeneralNotification()'>Delete</button>
                                                
                                                
                                                
                                                </td>
                                            </tr>
                                        <?php } 
                                        
                                                }else if(isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'UpcomingTournament'){
                                                    
                                                }else { ?>
                                            <tr><td colspan="6"><center>No record Found!!</center></td></tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>        
                </div>  
                <input type="hidden" id="TypeNotification" value="<?php echo $_REQUEST['Type']?>">
            </form>
        </div>
    </div>
</div>
<script>
function DeleteGeneralNotification(e){
    var NotificationID = $("#DeleteNotificationID").val();
    var TypeNotification = $("#TypeNotification").val();
    
    jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: {'NotificationID':NotificationID,'do':'DeleteGeneralNotification' },
            success: function (result) {
//                alert(result);
//                alert_message_popup('',result);
                var data = $.parseJSON(result);
                alert_message_popup('GeneralNotifications&Type='+TypeNotification,data.Message);
            }
        });
}
</script>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p id="RejectReason">Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>