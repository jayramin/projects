<?php
$UserID = $_REQUEST['UserID'];
$TeamID = $_REQUEST['TeamID']; 
$data = $fn->GetUserProfileData('{"UserID":"' . $UserID . '"}');
$data = $data['UserWiseData'];
$DOB = str_replace('/', '-', $data['DOB']);
$DateOfBirth = date("d-m-Y", strtotime($DOB));
?>
<!-- Content Start -->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-10">
            <div class="page-header">
                <h2>Profile Management</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li class="active"><?php echo ($_REQUEST['method'] == 'edit') ? 'Profile' : 'Player Profile'; ?></li>
                    </ol>
            </div>
            </div>
            <div class="col-lg-2"><br><br>
                <div class='panel-header'>
                    <a href='add_player_team'class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
         
        </div>
            </div>
        </div>
    </div>

    <div class='content-box big-box box-shadow panel-box panel-gray'>

        <div class='panel-body'>        
            <form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <img id="ProfilePreview" src="<?php echo $data['ProfilePicture']; ?>" alt="ProfilePicture" style="width:100px;height:100px;">
                                    </div>

                                </div>
                            </div><br><br>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label for="Name" class="control-label"><b><?php echo Name; ?></b></label> 
                                    </div>
                                    <div class="col-lg-8">
                                        <label><?php echo $data['FirstName'] . ' ' . $data['MiddleName'] . ' ' . $data['LastName']; ?></label>
                                    </div>
                                </div>                              
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label for="Gender" class="control-label"><b><?php echo Gender; ?></b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label>
                                            <?php
                                            if ($data['Gender'] == 'M') {
                                                echo 'Male';
                                            } else if ($data['Gender'] == 'F') {
                                                echo 'Female';
                                            }
                                            ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label for="DateOfBirth" class="control-label"><b><?php echo dob; ?> </b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label><?php echo $DateOfBirth; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label for="EmailID" class="control-label"><b><?php echo email; ?> </b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label><?php echo $data['EmailID'] ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label for="Height" class="control-label"><b><?php echo Height; ?></b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label><?php echo htmlspecialchars($data['Height']) ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label for="Weight" class="control-label"><b><?php echo Weight; ?></b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label><?php echo $data['Weight']; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label for="NickName" class="control-label"><b><?php echo NickName; ?></b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label><?php echo $data['NickName']; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label for="StateName" class="control-label"><b><?php echo StateName; ?></b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label><?php echo $data['StateName']; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label for="CityName" class="control-label"><b><?php echo CityName; ?></b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label><?php echo $data['CityName']; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="common_wait" style="display:none;width:69px;height:89px;position:absolute;top:35%;left:50%;padding:2px;" ><img src='uploads/ajax_loading.gif' width="64" height="64" /></div>

<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Kamet Sports Event</h4>
            </div>
            <div class="modal-body">
                <img id="ProfilePreview" src="<?php echo (!empty($data['ProofIDImage1'])) ? $data['ProofIDImage1'] : SITE_URL . "admin/uploads/placeholder3.png"; ?>" alt="ProofIDImage1" style="width:550px;height:500px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">    
    $(document).ready(function () {
        var date_input = $('input[name="DOB"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var FromEndDate = new Date();
        date_input.datepicker({
            format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            endDate: FromEndDate
        });
    });
</script>
