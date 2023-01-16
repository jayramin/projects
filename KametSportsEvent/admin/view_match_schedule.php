<?php
$data = $fn->GetAllMacthScheduleData();
//echo '<pre>';
//print_r($data);
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-10">
            <div class="page-header">
                <h2>Tournament</h2>
                <ol class="breadcrumb">
                   <li><a href="home">Dashboard</a></li>
                   <li><a href="Tournament_Management">Tournament Management</a></li>
                   <li><a href="view_match_schedule">Match Schedule</a></li>
                    <li class="active">
                        <?php
                    if($_REQUEST['method']=='edit'){
                        echo 'Edit Match Schedule';
                    }else if($_REQUEST['method']=='add'){
                        echo 'Create Match Schedule';
                    }else{
                        echo 'View Match Schedule';
                    } ?> 
                        </li>
                </ol>
            </div>
            </div>
            <div class="col-lg-2"><br><br>
                <div class='panel-header'>
           
            <?php
            if($_REQUEST['method'] == ''){ ?>
               <a href='view_match_schedule&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
            <?php echo $ViewButton; ?>
          <?php } else{ ?>
               <a href='view_match_schedule' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
          <?php }?>
               
            <?php echo $ViewButton; ?>
        </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Match Schedule</h1>
        </div>
        <div class='panel-body'>
             <div class="row">
                <div class="col-lg-12">            
                    <?php
                    if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                        require_once 'forms/form_create_match_schedule.php';
                    } else {
                        if (is_array($data) && !empty($data)) { ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;"><?php echo SrNo; ?></th>
                                            <th><?php echo Teams; ?></th>
                                            <th><?php echo GroundName; ?></th>
                                            <th><?php echo CourtName; ?></th>
                                            <th><?php echo RoundName; ?></th>
                                            <th><?php echo TournamentName; ?></th>
                                            <th style="width: 15%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['GetMatchScheduleData'] AS $Key => $Value) {
//                                            $TournamentStartDateData = $fn->TournamentStartDateByTournamentID($Value['TournamentID']);
//                                            $TournamentStartDate = $TournamentStartDateData['TournamentStartDateData']; 
                                            $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><label><?php echo $Value['FirstName'] ?> </label> Vs <label><?php echo $Value['SecondName'] ; ?></label></td>
                                                <td><?php echo $Value['GroundName']; ?></td>
                                                <td><?php echo $Value['CourtName']; ?></td>
                                                <td><?php echo $Value['RoundName']; ?></td>
                                                <td><?php echo $Value['TournamentName']; ?></td>
                                                <td>
                                                                <div class="">
                                                                    <?php if($Value['MatchStatus'] == 'Incomplete'){ ?>
                                                                    <div class="btn-group">
                                                                        <button class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'v_match_schedule'; ?>', '<?php echo $Value['MatchId']; ?>', 'abandoned','MatchId', 'MatchStatus','view_match_schedule');">Mark as Abandoned</button>                            
                                                                    </div>
                                                                    
                                                                    <div class="btn-group">
                                                                        <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_match_schedule'; ?>', '<?php echo $Value['MatchId']; ?>', 'D','MatchId', 'is_active','view_match_schedule');"><i class="fa fa-trash-o"></i></button>
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </td>
                                            </tr>
                                        <?php } ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <center><h4>No Records Found</h4></center>
                            <?php
                        }
                    }
                    ?>
                </div>        
            </div>  
        </div>
    </div>
</div>