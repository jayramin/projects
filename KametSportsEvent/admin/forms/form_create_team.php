<?php
$CaptainID = $_SESSION['KametSports']['session']['UserID'];
$data = $fn->getDataByID('v_teams', 'TeamID', $_REQUEST['TeamID']);
//echo '<pre>';
//print_r($data);
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="TeamName" class="control-label"><?php echo TeamName; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="TeamName" id="TournamentName" value="<?php echo $data['TeamName']; ?>" placeholder="Enter Team Name Here...">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="TeamSlogan" class="control-label"><?php echo TeamSlogan; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="TeamSlogan" id="TeamSlogan" value="<?php echo $data['TeamSlogan']; ?>" placeholder="Enter Team Slogan Here...">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="TeamDescription" class="control-label"><?php echo TeamDescription; ?>  </label>
                    <textarea class="form-control material"  name="TeamDescription" id="TeamDescription" placeholder="Enter Team Description..."><?php echo $data['TeamDescription']; ?></textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="State" class="control-label"><?php echo State; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $selected = isset($data['StateID']) ? $data['StateID'] : "";
                    $db_array = array("tbl_name" => 'v_state', "condition" => "is_active='Y'");
                    $select_array = array("name" => "StateID", "id" => "StateID", "class" => "required form-control", "onchange" => "GetCities(this,\"in\");");
                    $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <div class="col-lg-6">
            <div class="form-group">
                <label for="TeamSlogan" class="control-label"><?php echo CoachName; ?> <span style="color: red;">*</span> </label>
                <input type="text" class="form-control material required" name="CoachName" id="CoachName" value="<?php echo $data['CoachName']; ?>" placeholder="Enter Coach Name...">
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="City" class="control-label"><?php echo City; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $selected = isset($data['CityID']) ? $data['CityID'] : "";
                    $db_array = array("tbl_name" => 'v_city', "condition" => "is_active='Y'");
                    $select_array = array("name" => "CityID", "id" => "CityID", "class" => "required form-control", "onchange" => "GetAreas(this,\"in\");");
                    $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="col-lg-6">
                        <label for="TeamLogo" class="control-label"><?php echo TeamLogo; ?></label>
                        <input name="TeamLogo" id="TeamLogo" type="hidden" class="inputFile input-md" value="<?php echo (!empty($data['TeamLogo'])) ? $data['TeamLogo'] : ""; ?>">
                        <input name="TeamLogoUpload" id="TeamLogoUpload" type="file" class="inputFile input-md" /><br>
                        <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveFile(this.form, 'TeamLogo', 'TeamLogoPreview', 'TeamLogo', 'TeamLogoupload', 'TeamLogoloading', 'TeamLogo', 'in');">Upload</button>
                    </div>
                    <div class="col-lg-6">
                        <span id="TeamLogoUpload" ></span>
                        <span id="TeamLogoloading" style="display: none;  color: orange">Uploading Please wait</span>
                        <div id="TeamLogoresponse"></div>
                        <img id="TeamLogoPreview" src="<?php echo (!empty($data['TeamLogo'])) ? SITE_URL . 'admin/uploads/TeamLogo/' . $data['TeamLogo'] : SITE_URL . "admin/uploads/TeamLogo/team-placeholder.jpg"; ?>" alt="Team Logo" style="width:100px;height:100px;">

                    </div>
                </div>
            </div> 
        </div>
    </div>
    <input name="CaptainID" id="CaptainID" type="hidden" value="<?php echo $CaptainID; ?>" class="inputFile input-md" >
    <div class="row"><hr>
    </div>
    <div class="form-group">
        <input type="hidden" name="TeamID" id="TeamID" value="<?php echo $_REQUEST['TeamID'];?>">
        <?php if (isset($_REQUEST['TeamID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="UpdateTeamData(this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="InsertTeamData(this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_team"><?php echo cancel; ?></a>
    </div>
</form>