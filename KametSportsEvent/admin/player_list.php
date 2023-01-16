<?php
if (isset($_REQUEST['PlayerName']) && $_REQUEST['PlayerName'] != '') {
    $TDataNew = $fn->GetAllPlayerList('{"PlayerName":"' . $_REQUEST['PlayerName'] . '"}');
} else {
    $TDataNew = $fn->GetAllPlayerList();
}
$PData = $TDataNew['GetPlayerList'];
?>
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-7">
                <div class="page-header">
                    <h2>Player List</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li><a href="reports">Reports</a></li>
                        <li><a href="player_list">Player List</a></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-5"><br><br>
                <div class='panel-header'>
                    <div class="col-lg-10">
                        <div class="col-lg-5" style="padding-right: 1px;padding-top:5px;">
                            <label for="TeamName" class="control-label" style="font-weight: 700;">Player Name</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" name="PlayerName" value="<?php echo $_REQUEST['PlayerName']; ?>" id="PlayerNameToSearch" class="form-control input-sm" placeholder="Enter Keyword" onkeypress="Submitkeyword(event,this)">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-sm btn-primary" onclick="GetplayerDetails('PlayerNameToSearch');">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Player List</h1>
        </div>
        <div class='panel-body'>
            <?php if (isset($_REQUEST['PlayerName']) && $_REQUEST['PlayerName'] != '') { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="CreatePDF/examples/player_list_pdf.php?PlayerName=<?php echo $_REQUEST['PlayerName'] ?>" class="btn btn-sm btn-danger pull-right">Download</a>
                    </div>
                </div>
                <br>
            <?php } else { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="CreatePDF/examples/player_list_pdf.php" class="btn btn-sm btn-danger pull-right">Download</a>
                    </div>
                </div>
                <br>
            <?php } ?>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-condensed table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th><?php echo SrNo; ?></th>
                                    <th>Profile Picture</th>
                                    <th><?php echo PlayerName; ?></th>
                                    <th>Height</th>
                                    <th>Width</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($PData) > 0) {
                                    foreach ($PData AS $Key => $Value) { ?>
                                        <tr>
                                            <td><?php echo ($Key + 1) ?></td>
                                            <td><img src="uploads/ProfilePic/<?php echo $Value['ProfilePicture']; ?>" class="img-thumbnail" style="height:70px;width:70px;"></td>
                                            <td><?php echo $Value['PlayerName']; ?></td>
                                            <td><?php echo $Value['Height']; ?></td>
                                            <td><?php echo $Value['Weight']; ?></td>
                                            <td><?php echo $Value['EmailID']; ?></td>
                                            <td><?php echo $Value['MobileNumber']; ?></td>
                                            <td><a href="View_more_by_Player&PlayerID=<?php echo $Value['UserID']; ?>" class="btn btn-xs btn-success">My Career</a></td>
                                        </tr>
                                    <?php
                                    }
                                } else { ?>
                                    <tr><td colspan="8"><center>No record Found!!</center></td></tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<script>
    function Submitkeyword(e,ID)
    {
        if (e.keyCode == 13) {
          GetplayerDetails(ID.id); 
        }
    }
    function GetplayerDetails(PlayerNameID)
    {
        var PlayerName = $('#' + PlayerNameID).val();
        if (PlayerName != '') {
            window.location = 'player_list&PlayerName=' + PlayerName;
        } else {
            alert_message_popup('', 'Please Enter Player Name');
        }
    }
</script>