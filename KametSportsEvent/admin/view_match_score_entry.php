<?php
if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != ''){
$data = $fn->GetScoreData('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
}
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
                        <li><a href="view_match_score_entry">Score Entry</a></li>
                        <li class="active">
                            <?php
                            if ($_REQUEST['method'] == 'edit') {
                                echo 'Edit Score Entry';
                            } else if ($_REQUEST['method'] == 'add') {
                                echo 'Create Score Entry';
                            } else {
                                echo 'View Score Entry';
                            }
                            ?> 
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-6"><br><br>
                <div class='panel-header'>
                    <div class='panel-header'>
                        <div class="col-lg-10">
                            <div class="col-lg-5" style="padding-right: 1px;padding-top:5px;">
                                <label for="TournamentName" class="control-label"><?php echo SelectTournament; ?> </label>
                            </div>
                            <div class="col-lg-7">
                                <?php
                                $Selected = isset($_REQUEST['TournamentID']) ? $_REQUEST['TournamentID'] : '';
                                $db_array = array("tbl_name" => 'v_tournaments', "condition" => "is_active='Y'");
                                $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "required form-control", "onchange" => "GetScroreList(this.value);");
                                $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Search Tournament", 'selected' => $Selected);
                                $fn->dropdown($db_array, $select_array, $option_array);
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-2">                        
                            <?php if ($_REQUEST['method'] == '') { ?>
                                <a href='view_match_score_entry&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
                                <?php echo $ViewButton; ?>
                            <?php } else { ?>
                                <a href='view_match_score_entry' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
                            <?php } ?>
                            <?php echo $ViewButton; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Rounds</h1>
        </div>
        <div class='panel-body'>
            <div class="row">
                <div class="col-lg-12">            
                    <?php
                    if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                        require_once 'forms/form_create_match_score_entry.php';
                    } else {
                        if (is_array($data['GetScoreByMatchID']) && !empty($data['GetScoreByMatchID'])) { ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo TournamentName; ?></th>
                                            <th><?php echo WinningTeamName; ?></th>
                                            <th><?php echo WinningTeamSet; ?></th>
                                            <th><?php echo LosingTeamName; ?></th>
                                            <th><?php echo LosingTeamSet; ?></th>
                                            <th><?php echo Action; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['GetScoreByMatchID'] AS $Key => $Value) { ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['TournamentName']; ?></td>
                                                <td><?php echo $Value['WinningTeamName']; ?></td>
                                                <td><?php echo $Value['WinningTeamSet']; ?></td>
                                                <td><?php echo $Value['LosingTeamName']; ?></td>
                                                <td><?php echo $Value['LosingTeamSet']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                                    <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteScoreCardEntry('<?php echo 'v_result'; ?>', '<?php echo $Value['TournamentID']; ?>','<?php echo $Value['MatchID']; ?>');"><i class="fa fa-trash-o"></i></button>
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
function GetScroreList(TournamentID)
{
    window.location = 'view_match_score_entry&TournamentID='+TournamentID;
}
function DeleteScoreCardEntry(TableName,TournamentID,MatchID)
{
    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_WARNING,
        title: 'Confirmation',
        message: 'Are you sure you want to Delete this record?',
        closable: false,
        buttons: [{
                id: 'btn-ok',
                icon: 'glyphicon glyphicon-check',
                label: 'Yes',
                cssClass: 'btn-warning',
                autospin: false,
                action: function (dialogRef) {
                    jQuery.ajax({
                        type: 'POST',
                        url: "../class/class.ajaxRequest.php",
                        data: {TableName:TableName,TournamentID: TournamentID, MatchID: MatchID, do: 'DeleteScoreCardEntry'},
                        success: function (result) {
                        alert_message_popup('view_match_score_entry','Score Entry Deleted');
                        }
                    });
                }
            }, {
                id: 'btn-cancel',
                label: 'No',
                cssClass: 'btn-warning',
                autospin: false,
                action: function (dialogRef) {
                    dialogRef.close();
                }
            }]
    });
}
</script>