<?php
$data = $fn->getDataByID('v_rounds', 'RoundID', $_REQUEST['RoundID']);
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
                    $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "required material form-control");
                    $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Select Tournament", 'selected' => $Selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="RoundName" class="control-label"><?php echo RoundName; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="RoundName" id="RoundName" value="<?php echo $data['RoundName']; ?>" placeholder="Enter Round Name...">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="GroupDescription" class="control-label"><?php echo PlayMatchType; ?> <span style="color: red;">*</span> </label><br><br>
                    <input type="radio" class="radiobuttoncss" name="PlayMatchType" value="within" <?php if($data['PlayMatchType'] == 'within'){ ?>checked="checked" <?php } ?> checked="checked">&nbsp; Within Group &nbsp;
                    <input type="radio" class="radiobuttoncss" name="PlayMatchType" value="cross" <?php if($data['PlayMatchType'] == 'cross'){ ?>checked="checked" <?php } ?>>&nbsp;Cross Group

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="NumberOfGamesToPlay" class="control-label"><?php echo NumberOfSetsToPlay; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $Selected = isset($data['SetID']) ? $data['SetID'] : " ";
                    $db_array = array("tbl_name" => 'v_set_master', "condition" => "is_active='Y'");
                    $select_array = array("name" => "SetID", "id" => "SetID", "class" => "required material form-control");
                    $option_array = array("value" => "SetID", "label" => "NoOfSets", "placeholder" => "Select Set", 'selected' => $Selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            
<!--            <div class="col-lg-4">
                <div class="form-group">
                    <label for="NumberOfGamesToPlay" class="control-label"><?php echo NumberOfGamesToPlay; ?> <span style="color: red;">*</span> </label>
                    <input type="number" class="form-control material required" name="NumberOfGamesToPlay" id="NumberOfGamesToPlay" value="<?php echo $data['NumberOfGamesToPlay']; ?>" placeholder="Enter Number Of Games To Play..." min="1" max="30">

                </div>
            </div>-->
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="MatchType" class="control-label"><?php echo MatchType; ?> <span style="color: red;">*</span> </label>
                    <select name="MatchType" class="form-control material required">
                        <option value="">Select Match Type</option>
                        <option value="General" <?php if($data['MatchType'] == 'General'){ ?>selected="selected" <?php } ?>>Group Match</option>
                        <option value="QuarterFinal" <?php if($data['MatchType'] == 'QuarterFinal'){ ?>selected="selected" <?php } ?> >Quarter Final</option>
                        <option value="SemiFinal" <?php if($data['MatchType'] == 'SemiFinal'){ ?>selected="selected" <?php } ?> >SemiFinal</option>
                        <option value="Final" <?php if($data['MatchType'] == 'Final'){ ?>selected="selected" <?php } ?> >Final</option>
                    </select>

                </div>
            </div>
        </div>
    </div>
    
    
    
    <div class="form-group">
        
<?php if (isset($_REQUEST['RoundID'])) { ?>
        <input type="hidden" id="RoundID" name="RoundID" value="<?php echo $data['RoundID']?>">
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="UpdateRoundData(this.form);" ><?php echo update; ?></button>
<?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="InsertRoundData(this.form);" ><?php echo save; ?></button>
<?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_rounds"><?php echo cancel; ?></a>
    </div>
</form>