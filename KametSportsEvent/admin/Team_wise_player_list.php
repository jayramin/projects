<?php
if(isset($_REQUEST['TeamID']) && $_REQUEST['TeamID'] != ''){
$data = $fn->GetTeamWisePlayerList('{"TeamID":"'.$_REQUEST['TeamID'].'"}');
$Tdetal = $fn->DataByID('{"Condition":{"table":"v_teams","Key":"TeamID","value":"'.$_REQUEST['TeamID'].'"}}');
$Tdetails = $Tdetal['GetData'];
}
?>
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-7">
            <div class="page-header">
                <h2>Team Wise Player List</h2>
                <ol class="breadcrumb">
                   <li><a href="home">Dashboard</a></li>
                   <li><a href="reports">Reports</a></li>
                   <li><a href="Team_wise_player_list">Team Wise Player List</a></li>
                </ol>
            </div>
            </div>
            <div class="col-lg-5"><br><br>
                <div class='panel-header'>
                    <div class="col-lg-12">
                        <div class="col-lg-5" style="padding-right: 1px;padding-top:5px;">
                            <label for="TeamName" class="control-label" style="font-weight: 700;">Select Team</label>
                        </div>
                        <div class="col-lg-7">
                            <?php
                            $Selected = isset($_REQUEST['TeamID']) ? $_REQUEST['TeamID'] : '';
                            $db_array = array("tbl_name" => 'v_teams', "condition" => "is_active='Y'");
                            $select_array = array("name" => "TeamID", "id" => "TeamID", "class" => "required form-control", "onchange" => "GetPlayerList(this.value);");
                            $option_array = array("value" => "TeamID", "label" => "TeamName", "placeholder" => "Select Team", 'selected' => $Selected);
                            $fn->dropdown($db_array, $select_array, $option_array);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Player List For:-> &nbsp;<span class="text-success"><?php echo ucwords($Tdetails['TeamName']); ?></span></h1>
        </div>
        <div class='panel-body'>
            <?php if(isset($_REQUEST['TeamID']) && $_REQUEST['TeamID'] != ''){ ?>
            <div class="row">
                <div class="col-lg-12">
                    <a href="CreatePDF/examples/Team_wise_player_list_pdf.php?TeamID=<?php echo $_REQUEST['TeamID']; ?>" class="btn btn-sm btn-danger pull-right">Download</a>
                </div>
            </div>
            <br>
            <?php } ?>
             <div class="row">
                <div class="col-lg-12">            
                    <?php
                        if (is_array($data) && !empty($data)) { ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th>Profile Picture</th>
                                            <th><?php echo PlayerName; ?></th>
                                            <th>Height</th>
                                            <th>Weight</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['PlayerListByTeam'] AS $Key => $Value) { ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><img src="uploads/ProfilePic/<?php echo $Value['ProfilePicture']; ?>" class="img-thumbnail" style="height:70px;width:70px;"></td>
                                                <td><?php echo $Value['PlayerName']; ?></td>
                                                <td><?php echo $Value['Height']; ?></td>
                                                <td><?php echo $Value['Weight']; ?></td>
                                                <td><?php echo $Value['EmailID']; ?></td>
                                                <td><?php echo $Value['MobileNumber']; ?></td>
                                            </tr>
                                            <?php } ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <center><h4>No Records Found</h4></center>
                            <?php
                        }
                    ?>
                </div>        
            </div>  
        </div>
    </div>
</div>
<script>
function GetPlayerList(e)
{
    window.location = 'Team_wise_player_list&TeamID='+e;
}
</script>