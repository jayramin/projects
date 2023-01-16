<?php
$data = $fn->GetNotificationData('{"Status":"' . $_REQUEST['Status']. '","UserID":"' . $UserID. '"}');
$PendingNotificationCount = $data['GetNotificationCountData']['Pending'];
$AcceptedNotificationCount = $data['GetNotificationCountData']['Accept'];
$RejectedNotificationCount = $data['GetNotificationCountData']['Reject'];
$TotalCount = $PendingNotificationCount + $AcceptedNotificationCount + $RejectedNotificationCount;
$P = $PendingNotificationCount * 100 / $TotalCount;
$A = $AcceptedNotificationCount * 100 / $TotalCount;
$R = $RejectedNotificationCount * 100 / $TotalCount;
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
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <div class="content-box ultra-widget" <?php if ($_REQUEST['Status'] == 'Pending') { ?> style="background-color: #d3f4ff" <?php } ?>>
                                    <a href="RequesToJoinTeam&Status=Pending" style="text-decoration: none"><div class="w-content big-box">
                                            <div class="w-progress">
                                                <span class="w-amount NotificationSpan pull-right"><?php echo $PendingNotificationCount ?></span>
                                                <br>
                                                <span class="text-uppercase w-name">Pending Request</span>
                                            </div>
                                            <div class="progress progress-bar-sm zero-m">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo round($P); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($P); ?>%">
                                                </div>
                                            </div>
                                            <div class="w-status clearfix">
                                                <div class="w-status-title pull-left text-uppercase">Progress</div>
                                                <div class="w-status-number pull-right text-uppercase"><?php echo round($P); ?>%</div>
                                            </div>
                                        </div></a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="content-box ultra-widget" <?php if ($_REQUEST['Status'] == 'Accept') { ?> style="background-color: #d3f4ff" <?php } ?> >
                                    <a href="RequesToJoinTeam&Status=Accept" style="text-decoration: none">
                                        <div class="w-content big-box">
                                            <div class="w-progress">
                                                <span class="w-amount NotificationSpan pull-right"><?php echo $AcceptedNotificationCount ?></span>
                                                <br>
                                                <span class="text-uppercase w-name">Player added in team</span>
                                            </div>
                                            <span class="w-refresh w-p-icon"><i class="fa fa-thumbs-o-up"></i></span>
                                            <div class="progress progress-bar-sm zero-m">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo round($A); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($A); ?>%">
                                                </div>
                                            </div>
                                            <div class="w-status clearfix">
                                                <div class="w-status-title pull-left text-uppercase">Progress</div>
                                                <div class="w-status-number pull-right text-uppercase"><?php echo round($A); ?>%</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="content-box ultra-widget" <?php if ($_REQUEST['Status'] == 'Reject') { ?> style="background-color: #d3f4ff" <?php } ?>>
                                    <a href="RequesToJoinTeam&Status=Reject" style="text-decoration: none">
                                        <div class="w-content big-box">
                                            <div class="w-progress">
                                                <span class="w-amount NotificationSpan pull-right"><?php echo $RejectedNotificationCount ?></span>
                                                <br>
                                                <span class="text-uppercase w-name">Rejected</span>
                                            </div>
                                            <span class="w-refresh w-p-icon"><i class="fa fa-thumbs-o-down"></i></span>
                                            <div class="progress progress-bar-sm zero-m">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo round($R); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($R); ?>%">
                                                </div>
                                            </div>
                                            <div class="w-status clearfix">
                                                <div class="w-status-title pull-left text-uppercase">Progress</div>
                                                <div class="w-status-number pull-right text-uppercase"><?php echo round($R); ?>%</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
      </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                                <table id="" class="table table-striped table-condensed table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><?php echo PlayerName; ?></th>
                                            <th><?php echo NickName; ?></th>
                                            <th><?php echo Height; ?></th>
                                            <th><?php echo Weight; ?></th>
                                            <th><?php echo email; ?></th>
                                            <?php if ($_REQUEST["Status"] == "Reject") { ?>
                                                <th><?php echo Reason; ?></th>
                                            <?php }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(count($data['GetNotificationData']) > 0){
                                        foreach ($data['GetNotificationData'] AS $Key => $Value) { ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['UserName']; ?></td>
                                                <td><?php echo $Value['NickName']; ?></td>
                                                <td><?php echo $Value['Height']; ?></td>
                                                <td><?php echo $Value['Weight'].' Kg'; ?></td>
                                                <td><?php echo $Value['EmailID']; ?></td>
                                                <?php if($_REQUEST["Status"]=="Reject") { ?>
                                                <td title="<?php echo $Value['RejectedReason']; ?>">
                                                    <?php echo substr($Value['RejectedReason'],0,50); ?>
<!--                                                    <button type="button" class="btn btn-sm btn-primary" name="Reason" id="Reason_<?php echo $Key; ?>" data-toggle="modal" data-target="#myModal" onclick='ViewRejectReason("<?php echo str_replace("'","`",$Value['RejectedReason']); ?>")'>Reason</button>-->
                                                </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } }else { ?>
                                            <tr><td colspan="6"><center>No record Found!!</center></td></tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>        
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