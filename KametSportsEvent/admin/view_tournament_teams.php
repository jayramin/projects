<?php
$data = $fn->GetAllTournamentTeamData('{"Flag":"TeamData","TournamentID":"'.$_REQUEST['TournamentID'].'"}');
//$TeamData = $fn->GetAprrovalTeamData('{"TeamID":"TeamID"}');
//echo '<pre>';
//print_r($data);

?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
            <div class="page-header">
                <h2>Tournament</h2>
                <ol class="breadcrumb">
                   <li><a href="home">Dashboard</a></li>
                   <li><a href="Tournament_Management">Tournament Management</a></li>
                   <li><a href="view_tournament_teams">Team List</a></li>
                   <li class="active"><?php echo ($_REQUEST['method']=='edit')?'Team Players List':'View Team Approval'; ?></li>
                </ol>
            </div>
            </div>
            <div class="col-lg-6"><br><br>
                <div class='panel-header'>
                    <div class="col-lg-10">
                        <div class="col-lg-5" style="padding-right: 1px;padding-top:5px;">
                        <label for="TournamentName" class="control-label"><?php echo SelectTournament; ?> </label>
                        </div>
                        <div class="col-lg-7">
                    <?php
                    $Selected = isset($_REQUEST['TournamentID']) ? $_REQUEST['TournamentID'] :'' ;
                    $db_array = array("tbl_name" => 'v_tournaments', "condition" => "is_active='Y' AND EndDate >= CURDATE()");
                    $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "required form-control", "onchange" => "GetGroupList(this);");
                    $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Search Tournament", 'selected' => $Selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    
                    ?>
                        </div>
                    </div>
            <?php
            if($_REQUEST['method'] == ''){ ?>
            <?php echo $ViewButton; ?>
          <?php } else{ ?>
                    <div class="col-lg-2">
                    <a href='view_tournament_teams&TournamentID=<?php echo $_REQUEST['TournamentID']?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
                    </div>
          <?php }?>
               
            <?php echo $ViewButton; ?>
        </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <?php echo ($_REQUEST['method']=='edit')?'<h1>Team Players List</h1>':'<h1>Team List</h1>'; ?>
            <center><?php if($_REQUEST['method']=='edit'){ ?> <h2><?php echo $data['GetTournamentTeamData'][0]['TeamName']; }?></h2></center>
        </div>
        
        <div class='panel-body'>
             <div class="row">
                <div class="col-lg-12">            
                    <?php
                    if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                        require_once 'forms/form_create_tournament_teams.php';
                    } else {
                        if (is_array($data) && !empty($data)) { ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><?php echo TeamName; ?></th>
                                            <th><?php echo TournamentName; ?></th>
                                            <th><?php echo MaximumPlayers; ?></th>
                                            <th><?php echo MinimumPlayers; ?></th>
                                            <th style="width: 10%"><?php echo Status; ?></th>
                                            <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['GetTournamentTeamData'] AS $Key => $Value) {
                                            
                                           $TeamData = $fn->GetAprrovalTeamData('{"TeamTournamentRelationID":"'.$Value['TeamTournamentRelationID'].'","TournamentID":"'.$Value['TournamentID'].'","TeamID":"'.$Value['TeamID'].'"}');
//                                           echo '<pre>';
//                                           print_r($Value);
                                           ?>
                                        
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['TeamName']; ?></td>
                                                <td><?php echo $Value['TournamentName']; ?></td>
                                                <td><?php echo $Value['MaximumPlayers']; ?></td>
                                                <td><?php echo $Value['MinimumPlayers']; ?></td>
                                                <td <?php 
//                                                echo '<pre>';
//                                                echo $TeamData['GetTournamentAprrovalWiseData']['AdminStatusCount'];
//                                                echo $Value['MinimumPlayers'];
                                                if($TeamData['GetTournamentAprrovalWiseData']['AdminStatusCount'] >= $Value['MinimumPlayers']){ ?>
                                                    style=" color: green"
                                              <?php  }else{ ?>
                                                    style=" color: red"
                                               <?php }?>><?php if($TeamData['GetTournamentAprrovalWiseData']['AdminStatusCount'] >= $Value['MinimumPlayers']){  ?>
                                                    <label>Approved</label>
                                                <?php }else{ ?>
                                                    <label>Not Approved</label>
                                                <?php }?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <?php
                                                            if($Value['StartDate'] <= date('Y-m-d')){ ?>
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to view team details" disabled>Tournament Already Started</a>
                                                            <?php } else { ?>
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to view team details" href="<?php echo $_REQUEST['page'] . '&method=edit&TeamID=' . $Value['TeamID'].'&TournamentID=' . $_REQUEST['TournamentID']; ?><?php if($TeamData['GetTournamentAprrovalWiseData']['AdminStatusCount'] >= $Value['MinimumPlayers']){ ?>&Approved=Yes<?php } ?>">View Team Players</a>
                                                            <?php } ?>
                                                        </div>
<!--                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_groups'; ?>', '<?php echo $Value['GroupID']; ?>', 'D','GroupID', 'is_active','view_tournament_groups');"><i class="fa fa-trash-o"></i></button>
                                                        </div>-->
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

<script>
function GetGroupList(e){
        window.location.href='view_tournament_teams&TournamentID='+e.value;
    }
</script>