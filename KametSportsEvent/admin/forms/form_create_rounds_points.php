<?php
//print_r($_REQUEST);
$data = $fn->getDataByID('v_round_points_parameters', 'PointParameterID', $_REQUEST['PointParameterID']);
//echo '<pre>';
//print_r($data);
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="TournamentName" class="control-label"><?php echo TournamentName; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $Selected = isset($data['TournamentID']) ? $data['TournamentID'] : $_REQUEST['TournamentID'] ;
                    $db_array = array("tbl_name" => 'v_tournaments', "condition" => "is_active='Y'");
                    $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "required material form-control","onchange" => "LoadRound(this.value,\"RoundID\",\"IN\");");
                    $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Select Tournament", 'selected' => $Selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="RoundName" class="control-label"><?php echo RoundName; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $Selected = isset($data['RoundID']) ? $data['RoundID'] : " ";
                    $db_array = array("tbl_name" => 'v_rounds', "condition" => "is_active='Y'");
                    $select_array = array("name" => "RoundID", "id" => "RoundID", "class" => "required material form-control" ,"onchange" => "LoadSets(this.value,\"SetID\",\"IN\");");
                    $option_array = array("value" => "RoundID", "label" => "RoundName", "placeholder" => "Select Round", 'selected' => $Selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>

                </div>
            </div>
<!--            <div class="col-lg-4">
                <div class="form-group">
                    <label for="NumberOfGamesToPlay" class="control-label"><?php echo NumberOfSetsToPlay; ?> <span style="color: red;">*</span> </label>
                    <?php
//                    $Selected = isset($data['SetID']) ? $data['SetID'] : " ";
//                    $db_array = array("tbl_name" => 'v_set_master', "condition" => "is_active='Y'");
//                    $select_array = array("name" => "SetID", "id" => "SetID", "class" => "required material form-control");
//                    $option_array = array("value" => "SetID", "label" => "NoOfSets", "placeholder" => "Select Set", 'selected' => $Selected);
//                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>-->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="GamesWonPoints" class="control-label"><?php echo GamesWonPoints; ?> <span style="color: red;">*</span> </label>
                    <input type="number" class="form-control material required" name="GamesWonPoints" id="GamesWonPoints" value="<?php echo $data['GamesWonPoints']; ?>" placeholder="Enter Games Won Points..." min="1" max="30">

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="GamesLostPoints" class="control-label"><?php echo GamesLostPoints; ?> <span style="color: red;">*</span> </label>
                    <input type="number" class="form-control material required" name="GamesLostPoints" id="GamesLostPoints" value="<?php echo $data['GamesLostPoints']; ?>" placeholder="Enter Games Lost Points..." min="0" max="30">

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="TotalPoints" class="control-label"><?php echo TotalPoints; ?> <span style="color: red;">*</span> </label>
                    <input type="number" class="form-control material required" name="TotalPoints" id="TotalPoints" value="<?php echo $data['TotalPoints']; ?>" placeholder="Enter Total Points..." min="1" max="30">

                </div>
            </div>
            
        </div>
    </div>
    
    
    <input type="hidden" id="STournamentID" value="<?php echo $_REQUEST['TournamentID']?>">
    <div class="form-group">
        
<?php if (isset($_REQUEST['RoundID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="UpdateRoundPointsData(this.form);" ><?php echo update; ?></button>
<?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="InsertRoundPointsData(this.form);" ><?php echo save; ?></button>
<?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_rounds"><?php echo cancel; ?></a>
    </div>
</form>