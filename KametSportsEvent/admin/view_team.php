<?php

$UserID = $_SESSION['KametSports']['session']['UserID'];
$data = $fn->GetAllTeamData('{"UserID":"'.$UserID.'"}');
$iscaptain=$data['GetMyCaptainWiseData']['CaptainshipStatus'];
if($iscaptain == 'Y'){
    $MyTeam = $fn->MyTeamData('{"CaptainID":"'.$UserID.'"}');
}else{
    $MyTeam = $fn->MyTeamData('{"UserID":"'.$UserID.'"}');
}

$TeamID = $MyTeam['GetMyTeamWiseData']['TeamData'][0]['TeamID'];
//echo '<pre>';
//print_r($MyTeam);
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-10">
            <div class="page-header">
                <h2>Team</h2>
                <ol class="breadcrumb">
                   <li><a href="home">Dashboard</a></li>
                   <li><a href="view_team">Team</a></li>
<!--                    <li><a href="class-management">Class Management</a></li>-->
                    <li class="active"><?php echo ($_REQUEST['method']=='edit')?'Edit Team':'View Team'; ?></li>
                </ol>
            </div>
            </div>
            <div class="col-lg-2"><br><br>
                <div class='panel-header'>
           
            <?php
            if(is_array($data) && !empty($data) && $data['Message'] == 'Success'){ ?>
                    <a href='add_player_team&TeamID=<?php echo $data['GetTeamWiseData']['TeamID']; ?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to manage a team"><span class="btn-label"><i class="fa fa-plus-square"></i></span> Manage Team</a>
            <?php echo $ViewButton; ?>
          <?php } else if($MyTeam['Message'] != 'Success'){ 
              if($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit') { ?>
                  <a href='view_team' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>  Back</a>
             <?php }else if($_REQUEST['method'] != 'add' || $_REQUEST['method'] != 'edit'){ ?>
                  <a href='view_team&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
               <?php }?>
               
          <?php }?>
               
            <?php echo $ViewButton; ?>
        </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Team</h1>
        </div>
        <div class='panel-body'>
            <?php 
                if(!isset($_REQUEST['method']) && ($iscaptain == 'N')){
                    ?>
                    <div class="row">
                <div class="col-lg-12"> 
                       <?php if (is_array($MyTeam) && !empty($MyTeam) && $MyTeam['Message'] == 'Success') { 
                           ?>
                            <div class="table-responsive table-bordered table">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><?php echo PlayerName; ?></th>
                                            <th><?php echo TeamName; ?></th>
                                            <th style="width: 10%"><?php echo View; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php 
//                                                echo '<pre>';
//                                                print_r($MyTeam['GetMyTeamWiseData']['TeamData']);
                                                echo $MyTeam['GetMyTeamWiseData']['TeamData'][0]['PlayerName']; ?></td>
                                                <td><?php echo $MyTeam['GetMyTeamWiseData']['TeamData'][0]['TeamName']; ?></td>
                                                <td><a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to open team data" href=""  data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i></a>
                                                    <a class="btn waves waves-effect waves-float btn-sm btn-danger" title="Leave Team" onclick="RemoveYourSelfFromTeam('<?php echo $MyTeam['GetMyTeamWiseData']['TeamData'][0]['TeamID'];?>','TeamIDID','<?php echo $MyTeam['GetMyTeamWiseData']['TeamData'][0]['PlayerID'];?>','PlayerIDID','<?php echo $MyTeam['GetMyTeamWiseData']['TeamData'][0]['RelationID'];?>','RelationIDID','myModalRemoveMyselfFromTeam')"><i class="fa fa-minus-square"></i></a>
                                                </td>
                                            </tr>
                                        <?php // } ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        <?php } else {  ?>
                            <center><h4>No Records Found</h4></center>
                            <?php
                        } ?>
                </div>
                    </div>
               <?php }else{
                   ?>
                    <div class="row">
                <div class="col-lg-12">            
                    <?php
                    if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit' && $iscaptain == 'Y')) {
                        require_once 'forms/form_create_team.php';
                        
                    } else {
                        if (is_array($data) && !empty($data) && $data['Message'] == 'Success' ) {
                            
                            ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><?php echo TeamName; ?></th>
                                            <th><?php echo TeamSlogan; ?></th>
                                            <th><?php echo CaptainName; ?></th>
                                            <th><?php echo CoachName; ?></th>
                                            <th style="width:10%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
//                                        foreach ($data AS $Key => $data) {
                                            
                                            $ICON = ($data['GetTeamWiseData']['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($data['GetTeamWiseData']['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($data['GetTeamWiseData']['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $data['GetTeamWiseData']['TeamName']; ?></td>
                                                <td><?php echo $data['GetTeamWiseData']['TeamSlogan']; ?></td>
                                                <td><?php echo $data['GetTeamWiseData']['CaptainName']; ?></td>
                                                <td><?php echo $data['GetTeamWiseData']['CoachName']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo $_REQUEST['page'] . '&method=edit&TeamID=' . $data['GetTeamWiseData']['TeamID']; ?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_teams'; ?>', '<?php echo $data['GetTeamWiseData']['TeamID']; ?>', 'D','TeamID', 'is_active','view_team');"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php // } ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        <?php } else {  ?>
                            <center><h4>No Records Found</h4></center>
                            <?php
                        }
                    }
                    ?>
                </div>        
            </div>  
             <?php   }     ?>
             
        </div>
    </div>
</div>


<div id="myModalRemoveMyselfFromTeam" class="modal fade" role="dialog">
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
              <label>Reason For Leave Team <span style="color: red"> * </span></label>
              <span style="color: red" id="RemovingReasonErrorSpan"> </span>
              <textarea name="ReasonForLeaveTeam" id="ReasonForLeaveTeam" class="form-control required"></textarea>
              <input type="hidden" value="" id="PlayerIDID">
              <input type="hidden" value="" id="TeamIDID">
              <input type="hidden" value="" id="RelationIDID">
          </div>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="RemoveFromTeam('PlayerIDID','TeamIDID','RelationIDID','ReasonForLeaveTeam')">Confirm</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Kamet Sports Event</h4>
      </div>
      <div class="modal-body">
          <?php 
          $MyTeamWiseDataByTeamID = $fn->MyTeamDataByID('{"TeamID":"'.$TeamID.'"}'); 
//          echo '<pre>';
//          print_r($MyTeamWiseDataByTeamID['GetMyTeamWiseDataByID']['CaptainshipStatus']);
          ?>
          <div class="col-lg-12"> 
                <center><h2>My Team - <?php echo $MyTeamWiseDataByTeamID['GetMyTeamWiseDataByID'][0]['TeamName']; ?></h2></center>
                       <?php if (is_array($MyTeamWiseDataByTeamID) && !empty($MyTeamWiseDataByTeamID)) { ?>
                            <div class="table-responsive">
                                <table id='datatable' class="display tab-content table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%"><?php echo SrNo; ?></th>
                                            <th><?php echo PlayerName; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Keys = 0;
                                        foreach ($MyTeamWiseDataByTeamID['GetMyTeamWiseDataByID'] AS $Key => $data) {
//                                           echo '<pre>';
//                                            print_r($data);
                                            ?>
                                            <tr>
                                                <td><?php echo ($Keys + 1) ?></td>
                                                <td style="<?php if($data['CaptainshipStatus'] == 'Y'){ ?>background-color: #d8f1e6; <?php }?>"><?php echo $data['PlayerName']; if($data['CaptainshipStatus'] == 'Y'){ ?> (C)<?php } ?></td>
                                            </tr>
                                        <?php $Keys++; } ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <center><h4>No Records Found</h4></center>
                        <?php } ?>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
    function RemoveYourSelfFromTeam(TeamID,TeamIDID,PlayerID,PlayerIDID,RelationID,RelationIDID, ModelToOpenForReason)
    {
        $('#'+TeamIDID).val(TeamID);
        $('#'+PlayerIDID).val(PlayerID);
        $('#'+RelationIDID).val(RelationID);
        $('#'+ModelToOpenForReason).modal('show');
    }
    </script>