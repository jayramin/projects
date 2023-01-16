<?php
$data = $fn->getDataByID('v_set_master', 'SetID', $_REQUEST['SetID']);
//print_r($data);

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
                    <label for="TournamentName" class="control-label"><?php echo TournamentName; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $Selected = isset($data['TournamentID']) ? $data['TournamentID'] : " ";
                    $db_array = array("tbl_name" => 'v_tournaments', "condition" => "is_active='Y' AND $condition");
                    $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "required material form-control","onchange" => "LoadRound(this.value,\"RoundID\",\"IN\");" );
                    $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Select Tournament", 'selected' => $Selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>

                </div>
            </div>
<!--            <div class="col-lg-4">
                <div class="form-group">
                    <label for="RoundID" class="control-label"><?php // echo RoundName; ?> <span style="color: red;">*</span> </label>
                    <?php
//                    $Selected = isset($data['RoundID']) ? $data['RoundID'] : " ";
//                    $db_array = array("tbl_name" => 'v_rounds', "condition" => "is_active='Y'");
//                    $select_array = array("name" => "RoundID", "id" => "RoundID", "class" => "required material form-control");
//                    $option_array = array("value" => "RoundID", "label" => "RoundName", "placeholder" => "Select Round", 'selected' => $Selected);
//                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>

                </div>
            </div>-->
<!--            <div class="col-lg-4">
                <div class="form-group">
                    <label for="SetTitle" class="control-label"><?php echo SetTitle; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="SetTitle" id="SetTitle" value="<?php echo $data['SetTitle']; ?>" placeholder="Enter Set Title...">
                </div>
            </div>-->
             <div class="col-lg-4">
                <div class="form-group">
                    <label for="SetTitle" class="control-label"><?php echo NoOfSets; ?> <span style="color: red;">*</span> </label>
                    <input type="number" class="form-control material required" name="NoOfSets" id="NoOfSets" value="<?php echo $data['NoOfSets']; ?>" placeholder="Enter Number Of Sets..." min="1" max="30">
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <input type="hidden" name="SetID" value="<?php echo $data['SetID']; ?>">
<?php if (isset($_REQUEST['SetID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="UpdateSetData(this.form);" ><?php echo update; ?></button>
<?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="InsertSetData(this.form);" ><?php echo save; ?></button>
<?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_set_master"><?php echo cancel; ?></a>
    </div>
</form>