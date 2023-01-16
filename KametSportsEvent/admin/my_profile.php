<?php
$UserID = $_SESSION['KametSports']['session']['UserID'];
//echo $UserID; 
$data = $fn->GetUserProfileData('{"UserID":"' . $UserID . '"}');
$data = $data['UserWiseData'];
$DOB = str_replace('/', '-', $data['DOB']);
$DateOfBirth = date("d-m-Y", strtotime($DOB));
//echo "<pre>";
//print_r($data);
//echo $data['BodyType'];
?>
<!-- Content Start -->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <div class="page-header">
                    <h2>Profile Management</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li class="active"><?php echo ($_REQUEST['method'] == 'edit') ? 'Edit Profile' : 'Profile'; ?></li>
                    </ol>
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
                                            <label for="UserName" class="control-label"><?php echo UserName; ?></label> :
                                            <label><?php echo $data['UserName']; ?></label>
                                            <input type="hidden" name="UserName" value="<?php echo $data['UserName']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="FirstName" class="control-label"><?php echo FirstName; ?></label> :
                                            <label><?php echo $data['FirstName']; ?></label>
                                            <input type="hidden" name="FirstName" value="<?php echo $data['FirstName']; ?>">

                                        </div>
                                        <!--                                        <div class="form-group">
                                                                                    <label for="FirstName" class="control-label"><?php echo FirstName; ?></label><span style="color: red"> * </span>
                                                                                    <input type="text" class="form-control material required" name="FirstName" id="FirstName" value="<?php echo $data['FirstName']; ?>" placeholder="First Name">
                                                                                </div>-->
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="MiddleName" class="control-label"><?php echo MiddleName; ?></label> :
                                            <label><?php echo $data['MiddleName']; ?></label>
                                            <input type="hidden" name="MiddleName" value="<?php echo $data['MiddleName']; ?>">
                                        </div>
                                        <!--                                        <div class="form-group">
                                                                                    <label for="MiddleName" class="control-label"><?php echo MiddleName; ?></label>
                                                                                    <input type="text" class="form-control material" name="MiddleName" id="MiddleName" value="<?php echo $data['MiddleName']; ?>" placeholder="Middle Name">
                                                                                </div>-->
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="LastName" class="control-label"><?php echo LastName; ?></label> :
                                            <label><?php echo $data['LastName']; ?></label>
                                            <input type="hidden" name="LastName" value="<?php echo $data['LastName']; ?>">
                                        </div>
                                        <!--                                        <div class="form-group">
                                                                                    <label for="LastName" class="control-label"><?php echo LastName; ?></label><span style="color: red"> * </span>
                                                                                    <input type="text" class="form-control material required" name="LastName" id="LastName" value="<?php echo $data['LastName']; ?>" placeholder="Last Name">
                                                                                </div>-->
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="Gender" class="control-label"><?php echo Gender; ?></label>&nbsp;:
                                            <label>
                                                <?php
                                                if ($data['Gender'] == 'M') {
                                                    echo 'Male';
                                                } else if ($data['Gender'] == 'F') {
                                                    echo 'Female';
                                                }
                                                ?>
                                            </label>
                                            <input type="hidden" name="Gender" value="<?php echo $data['Gender']; ?>">
<!--                                            <input type="radio" class="radiobuttoncss required" name="Gender" id="Weight" <?php if ($data['Gender'] == 'M') { ?>checked="checked" <?php } else { ?> <?php } ?> value="M">Male
                                            <input type="radio" class="radiobuttoncss required" name="Gender" id="Weight" <?php if ($data['Gender'] == 'F') { ?>checked="checked" <?php } else {
                                                    
                                                }
                                                ?>  value="F">Female-->
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="Weight" class="control-label"><?php echo MobileNumber; ?> : </label>
                                            <label><?php echo $data['MobileNumber']; ?></label>
                                            <!--<input type="text" class="form-control material required" name="MobileNumber" id="MobileNumber" value="<?php echo $data['MobileNumber']; ?>" placeholder="Mobile Number">-->
                                            <input type="hidden" name="MobileNumber" id="MobileNumber" value="<?php echo $data['MobileNumber']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="DateOfBirth" class="control-label"><?php echo dob; ?> : </label>
                                            <!--<label><?php // echo $DateOfBirth; ?></label>-->
                                            <input type="text" class="form-control material required" name="DOB" id="Weight" value="<?php echo $DateOfBirth; ?>" placeholder="Date Of Birth">
                                            <!--<input type="hidden" name="DOB" value="<?php echo $DateOfBirth; ?>">-->
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="EmailID" class="control-label"><?php echo email; ?> : </label>
                                            <label><?php echo $data['EmailID'] ?></label>
<!--                                            <input type="text" class="form-control material required" name="DOB" id="Weight" value="" placeholder="Date Of Birth">-->
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="Height" class="control-label"><?php echo Height; ?></label><span style="color: red"> * </span>
                                            <input style="width: 100% !important" type="text" class="form-control material required" id="Height" name="Height" placeholder="eg : 5'10&quot;" onchange="HeightValidation(this.value, 'HeightError', 'Height')" value="<?php echo htmlspecialchars($data['Height']) ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="Weight" class="control-label"><?php echo Weight; ?></label><span style="color: red"> * </span>
                                            <input type="number" class="form-control material required" name="Weight" id="Weight" value="<?php echo $data['Weight']; ?>" placeholder="Weight">
                                        </div>
                                    </div><br><br>

                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="button" class="waves waves-effect waves-float btn btn-primary btn-xs" onclick="EmailChangeToken('<?php echo $UserID; ?>', 'EmailOTPModal')" />Change Email
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f5">
                                                    <span>
                                                        Body Type<span class="ColorRed">&nbsp;* </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="pull-right" src="image/help.png" style="height:25px;width:25px;cursor: pointer" title="Click Here to see details" data-toggle="modal" data-target="#BodyTypePopUp">
                                                    </span>
                                                </label><br>
                                                <select class="required" id="BodyType" name="BodyType">
                                                    <option>Select body Type</option>
                                                    <option value="Ectomorph" <?php if($data['BodyType'] == 'Ectomorph'){?> Selected="Selected" <?php } ?>>Ectomorph</option>
                                                    <option value="Mesomorph" <?php if($data['BodyType'] == 'Mesomorph'){?> Selected="Selected" <?php } ?>>Mesomorph</option>
                                                    <option value="Endomorph" <?php if($data['BodyType'] == 'Endomorph'){?> Selected="Selected" <?php } ?>>Endomorph</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">


                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="NickName" class="control-label"><?php echo NickName; ?></label>
                                            <input type="text" class="form-control material" name="NickName" id="NickName" value="<?php echo $data['NickName']; ?>" placeholder="Nick Name" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="AboutMe" class="control-label"><?php echo AboutMe; ?></label>
                                            <input type="text" class="form-control material" name="AboutMe" id="AboutMe" value="<?php echo $data['AboutMe']; ?>" placeholder="About Me" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="Address" class="control-label"><?php echo AddressLine1; ?></label><span style="color: red"> * </span>
                                            <textarea class="form-control material required" name="AddressLine1" id="AddressLine1" placeholder="Address"><?php echo $data['AddressLine1']; ?></textarea>
                                            <!--<input type="text"  >-->
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="f5">
                                                <span>
                                                    State <span class="ColorRed" style="color: red">&nbsp;* </span>
                                                </span>
                                            </label>
                                            <?php
                                            $selected = isset($data['StateID']) ? $data['StateID'] : "";
                                            $db_array = array("tbl_name" => 'v_state', "condition" => "is_active='Y'");
                                            $select_array = array("name" => "StateID", "id" => "StateID", "class" => "required material form-control", "onchange" => "GetCities(this,\"in\");");
                                            $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $selected);
                                            $fn->dropdown($db_array, $select_array, $option_array);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12"><br>
                                        <div class="form-group">
                                            <label for="f5">
                                                <span>
                                                    City<span class="ColorRed" style="color: red">&nbsp;* </span>
                                                </span>
                                            </label>
                                            <?php
                                            $selected = isset($data['CityID']) ? $data['CityID'] : "";
                                            $db_array = array("tbl_name" => 'v_city', "condition" => "is_active='Y'");
                                            $select_array = array("name" => "CityID", "id" => "CityID", "class" => "required material form-control", "onchange" => "GetAreas(this,\"in\");");
                                            $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $selected);
                                            $fn->dropdown($db_array, $select_array, $option_array);
                                            ?>


                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="SQuestion" class="control-label"><?php echo SQuestion; ?></label><span style="color: red"> * </span><br>
                                            <?php
                                            $SelectedState = isset($data['SecurityQuestionID']) ? $data['SecurityQuestionID'] : " ";
                                            $db_array = array("tbl_name" => 'v_security_question', "condition" => "is_active='Y'");
                                            $select_array = array("name" => "SecurityQuestionID", "id" => "SecurityQuestionID", "class" => "required form-control material");
                                            $option_array = array("value" => "SecurityQuestionID", "label" => "Question", "placeholder" => "Select Question", 'selected' => $SelectedState);
                                            $fn->dropdown($db_array, $select_array, $option_array);
                                            ?><br><br>
                                            <label for="SQuestion" class="control-label"><?php echo Answer; ?></label><br>
                                            <input type="text" name="SecretAnswer" class="required material form-control" id="SecretAnswer" value="<?php echo $data['SecretAnswer'] ?>" maxlength="32">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f5">
                                                    <span>
                                                        Favorite Position<span class="ColorRed">&nbsp;* </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="pull-right" src="image/help.png" style="height:25px;width:25px;cursor: pointer" title="Click Here to see details" data-toggle="modal" data-target="#FavoritePositionPopUp">
                                                    </span>
                                                </label><br>
                                                <select class="required" id="FavoritePosition" name="FavoritePosition">
                                                    <option>Select Position</option>
                                                    <option value="Right Back" <?php if($data['FavoritePosition'] == 'Right Back'){?> Selected="Selected" <?php } ?>>Right Back</option>
                                                    <option value="Center Back" <?php if($data['FavoritePosition'] == 'Center Back'){?> Selected="Selected" <?php } ?>>Center Back</option>
                                                    <option value="Left Back" <?php if($data['FavoritePosition'] == 'Left Back'){?> Selected="Selected" <?php } ?>>Left Back</option>
                                                    <option value="Right Forward" <?php if($data['FavoritePosition'] == 'Right Forward'){?> Selected="Selected" <?php } ?>>Right Forward</option>
                                                    <option value="Center Forward" <?php if($data['FavoritePosition'] == 'Center Forward'){?> Selected="Selected" <?php } ?>>Center Forward</option>
                                                    <option value="Left Forward" <?php if($data['FavoritePosition'] == 'Left Forward'){?> Selected="Selected" <?php } ?>>Left Forward</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="col-lg-12">
                                        <div class="form-group">
<!--                                            <label for="ProfilePreview" class="control-label"><?php echo ProfilePicture; ?></label><br>
                                            <img id="ProfilePreview" src="<?php echo (!empty($data['ProfilePicture'])) ? $data['ProfilePicture'] : SITE_URL . "admin/uploads/placeholder.png"; ?>" alt="ProfilePicture" style="width:100px;height:100px;">-->



                                            <label for="ProfilePicture" class="control-label">Upload <?php echo ProfilePicture ?> :</label><br>
                                            <input name="ProfilePicture" id="ProfilePicture" type="hidden" class="inputFile input-md" value="<?php echo (!empty($data['ProfilePicName'])) ? $data['ProfilePicName'] : ""; ?>" alt="ProfilePicture" style="width:100px;height:100px;" >
                                            <input name="ProfilePicture" id="ProfilePicture" type="file" class="inputFile input-md" /><br>

                                            <span id="profilepicupload" ></span>
                                            <span id="profilepicloading" style="display: none;  color: orange">Uploading Please wait</span>
                                            <div id="profilepicresponse"></div>
<?php // echo $data['ProfilePicture']  ?>
                                            <img id="ProfilePreview" src="<?php echo (!empty($data['ProfilePicName'])) ? SITE_URL . "admin/uploads/ProfilePic/" . $data['ProfilePicName'] : SITE_URL . "admin/uploads/placeholder.png"; ?>" alt="ProfilePicture" style="width:100px;height:100px;">
                                            <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveFile(this.form, 'ProfilePicture', 'ProfilePreview', 'ProfilePic', 'profilepicupload', 'profilepicloading', 'profilepicresponse', 'in');">Upload</button>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="ProfilePreview" class="control-label"><?php echo IDProof; ?></label><span style="color: red"> * </span><br>
                                            <?php
                                            $SelectedState = isset($data['ProofID']) ? $data['ProofID'] : " ";
                                            $db_array = array("tbl_name" => 'v_proof_type', "condition" => "is_active='Y' AND ProofType='ID' OR ProofType='ALL'");
                                            $select_array = array("name" => "ProofID", "id" => "ProofID", "class" => "required form-control", "onchange" => "GetRemainingIdType(this.value);");
                                            $option_array = array("value" => "ProofID", "label" => "DocumentName", "placeholder" => "Select ID Type", 'selected' => $SelectedState);
                                            $fn->dropdown($db_array, $select_array, $option_array);
                                            ?><br><br>                                            
                                            <label for="ProofIDImage" class="control-label">Upload <?php echo IDProof ?> :</label><span class="ColorRed">&nbsp;* </span><br>
                                            <input name="ProofIDImage" id="ProofIDImage" type="hidden" class="inputFile input-md"  value="<?php echo (!empty($data['ProofIDImageName'])) ? $data['ProofIDImageName'] : ""; ?>">
                                            <input name="ProofIDImageUpload" id="ProofIDImage" type="file" class="inputFile input-md" /><br>
                                            <span id="ImageSpan" style="color: red"></span>

                                            <span id="IDProofupload" ></span>
                                            <span id="IDProofloading" style="display: none;  color: orange">Uploading Please wait</span>
                                            <div id="IDProofresponse"></div>
                                            <img id="IDProofPreview" src="<?php echo (!empty($data['ProofIDImage'])) ? $data['ProofIDImage'] : SITE_URL . "uploads/placeholder3.png"; ?>" alt="ProfilePicture" style="width:100px;height:100px;">
                                            <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveFile(this.form, 'ProofIDImage', 'IDProofPreview', 'IDPreoofImage', 'IDProofupload', 'IDProofloading', 'IDProofresponse', 'in');">Upload</button>


                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">View</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="ProfilePreview" class="control-label"><?php echo IDProof; ?></label><span style="color: red"> * </span><br>
                                            <?php
                                            $SelectedState = isset($data['ProofID1']) ? $data['ProofID1'] : " ";
                                            $db_array = array("tbl_name" => 'v_proof_type', "condition" => "is_active='Y' AND ProofType='ADDRESS' OR ProofType='ALL'");
                                            $select_array = array("name" => "ProofID1", "id" => "ProofID1", "class" => "form-control");
                                            $option_array = array("value" => "ProofID", "label" => "DocumentName", "placeholder" => "Select ID Type", 'selected' => $SelectedState);
                                            $fn->dropdown($db_array, $select_array, $option_array);
                                            ?><br><br>
                                            <label for="ProofIDImage1" class="control-label">Upload <?php echo IDProof ?> :</label><span class="ColorRed">&nbsp;* </span><br>
                                            <?php
//                                            echo '<pre>';
//                                            print_r($data);
                                            ?>
                                                        <input name="ProofIDImage1" id="ProofIDImage1" type="hidden"  class="inputFile input-md required" value="<?php echo (!empty($data['ProofIDImage1Name'])) ? $data['ProofIDImage1Name'] : ""; ?>">
                                                        <input name="ProofIDImage1Upload" id="ProofIDImage1" type="file" class="inputFile input-md" /><br>
                                                        <span id="SecondImageSpan" style="color: red"></span>
                                                        <span id="IDProofupload1" ></span>
                                                        <span id="IDProofloading1" style="display: none;  color: orange">Uploading Please wait</span>
                                                        <div id="IDProofresponse1"></div>
                                                        <img id="IDProofPreview1" src="<?php echo (!empty($data['ProofIDImage1'])) ?  $data['ProofIDImage1'] : SITE_URL . "admin/uploads/placeholder3.png"; ?>" alt="Id Proof Image" style="width:100px;height:100px;">
                                                        <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveFile(this.form, 'ProofIDImage1', 'IDProofPreview1', 'IDPreoofImage', 'IDProofupload1', 'IDProofloading1', 'IDProofresponse1','in');">Upload</button>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal1">View</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <input type="hidden"  name="UserID" id="UserID" value="<?php echo $UserID; ?>">
                            <center>                <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_user_data(this.form);" ><?php echo Update; ?></button>
                                <button type="reset" class="btn btn-danger text-uppercase waves" ><?php echo Cancel; ?></button></center>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="common_wait" style="display:none;width:69px;height:89px;position:absolute;top:35%;left:50%;padding:2px;" ><img src='uploads/ajax_loading.gif' width="64" height="64" /></div>

<div id="EmailOTPModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Kamet Sports Event</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <label>OTP</label>
                        <input type="text" class="required material form-control" name="EmailOTP" id="EmailOTP" placeholder="OTP From Your Email Address">
                        <span id="OTPErrorSpan" style="color: red"></span>
                    </div>
                    <div class="col-lg-6">
                        <label>New Email </label>
                        <input type="text" class="required material form-control" name="NewEmail" id="NewEmail" placeholder="Email Address" onkeydown="PressEnter(event);">
                        <span id="NewEmailErrorSpan" style="color: red"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary " onclick="ChangeEmail('<?php echo $UserID; ?>')">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Kamet Sports Event</h4>
            </div>
            <div class="modal-body">
                <img id="ProfilePreview" src="<?php echo (!empty($data['ProofIDImage'])) ? $data['ProofIDImage'] : SITE_URL . "admin/uploads/placeholder3.png"; ?>" alt="ProofIDImage" style="width:550px;height:500px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

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


<script type="text/javascript">
    function HeightValidation(evt, ErrorSpanId, TextBoxName) {
        var heightExp = /^[0-9]+\' ?[0-9]+\"$/;
        if (evt.match(heightExp))
        {
            $("#" + ErrorSpanId).text('');
        } else {
            $("#" + ErrorSpanId).text('Enter Height in eg:5\'6"');
            $("#" + TextBoxName).val("");
            return false;
        }
    }
    function EmailChangeToken(UserID, ModalID) {
        $.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: {UserID: UserID, do: 'EmailChangeToken'},
            beforeSend: function () {
                $("#common_wait").css("display", "block");
                $("#section_blur").css("opacity", "0.3");
            },
            complete: function () {
                $("#common_wait").hide();
                $('#RegistrationLoading').html("");
            },
            success: function (data) {
                var result = $.parseJSON(data);
                alert_message_popup('', result.Message);
                $('#' + ModalID).modal('show');
            }
        });
    }
    function PressEnter(e) {
        if (e.which == 13) {
            ChangeEmail();
        }
    }
    function ChangeEmail(UserID) {
        var EmailOTP = $("#EmailOTP").val();
        var NewEmail = $("#NewEmail").val();
        if (EmailOTP != '') {
            if (NewEmail != '') {
                $('#OTPErrorSpan').text('');
                $('#NewEmailErrorSpan').text('');
                $.ajax({
                    type: 'POST',
                    url: "<?php echo SITE_URL; ?>class/class.ajaxRequest.php",
                    data: {UserID: UserID, EmailToken: EmailOTP, EmailID: NewEmail, do: 'ChangeEmail'},
                    beforeSend: function () {
                        $("#common_wait").css("display", "block");
                        $("#section_blur").css("opacity", "0.3");
                    },
                    complete: function () {
                        $("#common_wait").hide();
                        $('#RegistrationLoading').html("");
                    },
                    success: function (data) {
                        var result = $.parseJSON(data);
                        alert_message_popup('logout.php', result.Message);
                    }
                });
            } else {
                $('#OTPErrorSpan').text('');
                $('#NewEmailErrorSpan').text('This field is required');
            }
        } else {
            $('#OTPErrorSpan').text('This field is required');
        }

    }
    $(document).ready(function () {
        var date_input = $('input[name="DOB"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var FromEndDate = new Date();
        date_input.datepicker({
            format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            endDate: FromEndDate,
        })
    });
    jQuery(function ($) {
//        $("#ContactZipcode").mask("*** ***");
        $("#MobileNumber").mask("999-999-9999");
    });
function GetRemainingIdType(e){
    var IdType = e;
    $.ajax({
                type: 'POST',
                url: "<?php echo SITE_URL; ?>class/class.ajaxRequest.php",
                data: {IdType: IdType, do: 'GetRemainingIdType'},
                success: function (data) {
//                    alert(data); 
                    $("#ProofID1").select2("val", "");
                    $('#ProofID1').html(data);
                }
            });
} 
</script>
