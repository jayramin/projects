<?php
$data = $fn->getDataByID('v_groups', 'GroupID', $_REQUEST['GroupID']);

if($_REQUEST['method'] == 'add')
{
    $condition = "EndDate > '".date('Y-m-d')."'";
}else{
    $TournamentStartDateData = $fn->TournamentStartDateByTournamentID($data['TournamentID']);
    $TournamentStartDate = $TournamentStartDateData['TournamentStartDateData'];
    $condition = "TournamentID != ".$TournamentStartDate['StartDate']."";
}
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="TournamentName" class="control-label"><?php echo TournamentName; ?> <span style="color: red;">*</span> </label><br><br>
                    <?php
                    $Selected = isset($data['TournamentID']) ? $data['TournamentID'] : $_REQUEST['TournamentID'] ;
                    $db_array = array("tbl_name" => 'v_tournaments', "condition" => "is_active='Y' AND $condition");
                    $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "required form-control");
                    $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Select Tournament", 'selected' => $Selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="GroupName" class="control-label"><?php echo GroupName; ?> <span style="color: red;">*</span> </label><br><br>
                    <input type="text" class="form-control material required" name="GroupName" id="GroupName" value="<?php echo $data['GroupName']; ?>" placeholder="Enter Group Name...">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="GroupDescription" class="control-label"><?php echo GroupDescription; ?> <span style="color: red;">*</span> </label>
                    <textarea class="form-control material required" name="GroupDescription" id="GroupDescription" placeholder="Enter Group Description Here..."><?php echo $data['GroupDescription']; ?></textarea>

                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <input type="hidden" name="GroupID" value="<?php echo $data['GroupID']; ?>">
        <input type="hidden" name="TournamentID" value="<?php echo $_REQUEST['TournamentID']; ?>">
<?php if (isset($_REQUEST['GroupID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="UpdateGroupData(this.form);" ><?php echo update; ?></button>
<?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="InsertGroupData(this.form);" ><?php echo save; ?></button>
<?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_groups"><?php echo cancel; ?></a>
    </div>
</form>