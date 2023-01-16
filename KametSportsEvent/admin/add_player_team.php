<?php
$caprainID = $_SESSION['KametSports']['session']['UserID'];
$RoleID = $_SESSION['KametSports']['session']['RoleID'];
$Age = $_SESSION['KametSports']['session']['Age'];
$Gender = $_SESSION['KametSports']['session']['Gender'];
$MyTeam = $fn->MyTeamData('{"CaptainID":"' . $caprainID . '"}');
$MyTeamID = $_REQUEST['TeamID'];
$MyTeamName = $fn->MyTeamNameData('{"CaptainID":"' . $caprainID . '"}');

$MyCaptainShipStatusData = $fn->MyCaptainData('{"UserID":"' . $caprainID . '"}');
$CaptainShipStatus = $MyCaptainShipStatusData['GetMyCaptainWiseData']['CaptainshipStatus'];
$MyTeamDataWithoutCaptain = $fn->MyTeamDataWithoutCaptain('{"CaptainID":"' . $caprainID . '","TeamID":"' . $MyTeamID . '"}');
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-9">
                <div class="page-header">
                    <h2>Team</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li class="active"><?php echo ($_REQUEST['method'] == 'edit') ? 'Edit Team' : 'View Team'; ?></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-3"><br><br>
                <div class='panel-header'>
                    <div class="col-lg-7">
                        <?php if(count($MyTeam['GetMyTeamWiseData']['TeamData']) > 1){ ?>
                            <button type="button" class=" btn btn-success btn-xs pull-right" name="ChnageCaptainship" id="ChnageCaptainship" title="Click here to switch captainship" href=""  data-toggle="modal" data-target="#myModalSwitchCaptainship" style="padding: 4px 10px 4px 10px;">Switch Captainship</button>
                       <?php }?>
                        
                    </div>
                    <?php if ($_REQUEST['TeamID'] == '') { ?>

                        <div class="col-lg-5">
                            <a href='view_team' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
                        </div>

                        <?php echo $ViewButton; ?>

                    <?php } else { ?>
                        <a href='view_team' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
                    <?php } ?>

                    <?php echo $ViewButton; ?>
                </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-body'>
            
            <div class="row" style="border: 2px solid black;margin-top: 20px;"> 
                <div class="col-lg-12" style="background-color: lightgray;  ">
                    <center><h2>Add Player To Team</h2></center>
                </div>
            <form id="SearchPlayer" name="SearchPlayer">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="City" class="control-label"><?php echo City; ?> </label>
                                <?php
                                $selected = isset($data['CityID']) ? $data['CityID'] : "";
                                $db_array = array("tbl_name" => 'v_city', "condition" => "is_active='Y'");
                                $select_array = array("name" => "CityID", "id" => "CityID", "class" => "required form-control", "onchange" => "GetAreas(this,\"in\");");
                                $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $selected);
                                $fn->dropdown($db_array, $select_array, $option_array);
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="PlayerName" class="control-label"><?php echo PlayerName; ?></label>
                                <input name="PlayerName" id="PlayerName" placeholder="Player Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="PlayerName" class="control-label">Body Type <img class="pull-right" src="image/help.png" style="height:25px;width:25px;cursor: pointer" title="Click Here to see details" data-toggle="modal" data-target="#BodyTypePopUp"></label>
                                <select class="required" id="BodyTypeSelection" name="BodyType">
                                    <option value="">Select body Type</option>
                                    <option value="Ectomorph">Ectomorph</option>
                                    <option value="Mesomorph">Mesomorph</option>
                                    <option value="Endomorph">Endomorph</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="PlayerName" class="control-label">Favorite Position <img class="pull-right" src="image/help.png" style="height:25px;width:25px;cursor: pointer" title="Click Here to see details" data-toggle="modal" data-target="#FavoritePositionPopUp"></label>
                                <select class="required" id="FavoritePositionSelection" name="FavoritePosition">
                                    <option value="">Select Position</option>
                                    <option value="Right Back">Right Back</option>
                                    <option value="Center Back">Center Back</option>
                                    <option value="Left Back">Left Back</option>
                                    <option value="Right Forward">Right Forward</option>
                                    <option value="Center Forward">Center Forward</option>
                                    <option value="Left Forward">Left Forward</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <br>
                                <input type="hidden" id="TeamIDToJoin" value="<?php echo $MyTeamID ?>">
                                <input type="hidden" id="CaptainID" value="<?php echo $caprainID; ?>">
                                <input type="hidden" id="RoleID" value="<?php echo $RoleID; ?>">
                                <input type="hidden" id="CaptainAge" value="<?php echo $Age; ?>">
                                <input type="hidden" id="CaptainGender" value="<?php echo $Gender; ?>">
                                <input type="button" class="btn btn-success" style="margin-top: 6px;" name="Search" value="Search" onclick="SearchPlayersData()">
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>        
                </div>  
                <div class="row">
                    <div class="col-lg-12" name="PlayerData" id="PlayerData">
                        <table name="PlayerDataTable" id="PlayerDataTable">

                        </table>
                    </div>
                    <div id="Loading" style="display: none; z-index: 1000; ">
                        <img src="uploads/ajax_loading.gif">
                    </div>
                </div>
            </form>
            </div>


            <div class="row" style="border: 2px solid black;margin-top: 20px;"> 
                <div class="col-lg-12" style="background-color: lightgray;  ">
                    <center><h2>My Team - <?php echo $MyTeamName['GetMyTeamNameWiseData']['TeamName']; ?></h2></center>
                </div>
                <?php
                if (is_array($MyTeam) && !empty($MyTeam) && $MyTeam['Message'] == 'Success') {
//                           echo '<pre>';
//                           print_r($MyTeam['GetMyTeamWiseData']['TeamData']);
                    ?>
                    <div class="col-lg-12">            
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
                                    $i = 1;
                                    foreach ($MyTeam['GetMyTeamWiseData']['TeamData'] AS $Key => $data) {
//                                            echo $data['PlayerName']; 
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td  <?php if ($data['PlayerName'] == $MyTeam['GetMyTeamWiseData']['CaptainData']['CaptainName']) { ?>style="background-color: #daf5b1"<?php } ?>><?php echo $data['PlayerName']; ?></td>
                                        </tr>
                                        <?php $i++;
                                    } ?>                                    
                                </tbody>
                            </table>
                        </div>
<?php } else { ?>
                        <div class="row">
                            <div class="col-lg-12" style="margin-top: 20px;">
                                <center><h4>No Players Found</h4></center>
                            </div>
                        </div>   

<?php } ?>
                </div>

            </div>


<?php if ($CaptainShipStatus == 'N') { ?>
                <div class="row">
                    <div class="col-lg-12"> 
                        <div class="alert alert-info">
                            <strong>Info!</strong> Only captain can create a team.
                        </div>
                    </div>
                </div>
            <?php } else { ?>

<?php } ?>
        </div>
    </div>
</div>


<div id="myModalSwitchCaptainship" class="modal fade" role="dialog">
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
                        <?php
                        if (is_array($MyTeamDataWithoutCaptain['GetMyTeamWiseDataWithoutCaptain']) && !empty($MyTeamDataWithoutCaptain['GetMyTeamWiseDataWithoutCaptain'])) {
//                           unset($MyTeamName['GetMyTeamWiseData']['CaptainData']);
                            ?>
                            <div class="table-responsive">
                                <table id='datatable' class="display table tab-content table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%"><?php echo SrNo; ?></th>
                                            <th><?php echo PlayerName; ?></th>
                                            <th style="width: 5%"><?php echo SelectPlayer; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php $i = 1;

    foreach ($MyTeamDataWithoutCaptain['GetMyTeamWiseDataWithoutCaptain'] AS $Key => $data) {
        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $data['PlayerName']; ?></td>
                                                <td><input type="radio" name="Player" id="PlayerID" value="<?php echo $data['PlayerID']; ?>"></td>
                                            </tr>
                                            <?php $i++;
                                        } ?>                                    
                                    </tbody>

                                </table>
                                <span id="NoPlayerErrorSpan" style="color: red"></span>

                            </div>
                        <?php } else { ?>
                            <center><h4>No Records Found</h4></center>
                        <?php } ?>
                        <input type="hidden" id="UserID"  value="<?php echo $caprainID; ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" onclick="ChangeCaptainShip()"><?php echo SendRequestToBecomeCaptain; ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="BodyTypePopUp" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Body Type</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <img src="image/body-type.jpg" class="img-thumbnail" style="height:300px;width:100%;">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<div class="modal fade" id="FavoritePositionPopUp" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Favorite Position</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <img src="image/Positions.png" class="img-thumbnail" style="height:500px;width:100%;">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<script>
    function ChangeCaptainShip() {
        var MyID = $("#UserID").val();
        var TeamID = $("#TeamIDToJoin").val();
        var PlayerID = $("input[type='radio']:checked").val();
        if (PlayerID != undefined) {
            $.ajax({
                type: 'POST',
                url: "../class/class.ajaxRequest.php",
                data: {TeamID: TeamID, CaptainID: MyID, PlayerID: PlayerID, do: 'ChangeCaptainShip'},
                success: function (data) {
//                alert_message_popup('',data);
//                   return false;
                    var result = $.parseJSON(data);
                    alert_message_popup('add_player_team', result.Message);
                }
            });
        } else {
            $("#NoPlayerErrorSpan").text('Select Player To Send Request')
        }
    }
</script>