<?php
require_once './includes/header.php';
?>
<div id="section_blur">
<div class="signUp-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="sign-up-content-inner-area">
                    <div class="sign-up-bar">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="sign-up-bar-left">
                                    <center><p>
                                            Create An Account
                                        </p></center>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <form method="POST" name="Registration" id="Registration">
                        <div class="col-lg-12">
                            <div class="col-lg-8">
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f1">
                                                    <span>
                                                        First Name<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <input type="text" class="required" id="FirstName" name="FirstName" placeholder="First Name" maxlength="32" onchange="lettersOnly(this.value,'FirstNameError','FirstName')">
                                                <span id="FirstNameError" style="color: red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f2">
                                                    <span>
                                                        Middle Name
                                                    </span>
                                                </label><br>
                                                <input type="text" id="MiddleName" name="MiddleName" placeholder="Middle Name" maxlength="32" onchange="lettersOnly(this.value,'MiddleNameError','MiddleName')">
                                                <span id="MiddleNameError"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f2">
                                                    <span>
                                                        Last Name<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <input type="text" class="required" id="LastName" name="LastName" placeholder="Last Name" maxlength="32" onchange="lettersOnly(this.value,'LastNameError','LastName')">
                                                <span id="LastNameError" style="color: red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f2">
                                                    <span>
                                                        Nick Name
                                                    </span>
                                                </label><br>
                                                <input type="text" id="NickName" name="NickName" placeholder="Nick Name" maxlength="32">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6"><br>
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f2">
                                                    <span>
                                                        Gender <span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label>
                                                <input type="radio" class="radiobuttoncss" name="Gender" value="M" checked="checked">Male
                                                <input type="radio" class="radiobuttoncss" name="Gender" value="F">Female
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group col-md-6" style="margin-left: -15px !important;">
                                                <label for="f2">
                                                    <span>
                                                        Height<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <input style="width: 100% !important" type="text" class="required" id="Height" name="Height" placeholder="eg : 5'10&quot;" onchange="HeightValidation(this.value,'HeightError','Height')">
                                                <span id="HeightError" class="ColorRed"></span>
                                            </div>       
                                            <div class="form-group col-md-6">
                                                <label for="f2" style="width: 90px !important">
                                                    <span>
                                                        Weight<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <input style="width: 100% !important" type="number" id="Weight" name="Weight" placeholder="50 Kg"  min="30" max="150" class="required">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f2">
                                                    <span>
                                                        Date Of Birth<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <!--<input type="date" class="required" id="DOB" name="DOB">-->

                                                <input class="form-control" id="DOB" name="DOB" placeholder="DD/MM/YYYY" type="text"/>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f3">
                                                    <span>
                                                        Mobile Number<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <input type="text" class="required" id="MobileNumber" name="MobileNumber" placeholder="Mobile Number"><span id="MobileNumberError" style="color: red"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f3">
                                                    <span>
                                                        Email Address<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <input type="text" class="required" id="EmailID" name="EmailID" placeholder="Email Address" maxlength="64">
                                                <span id="EmailIDError" style="color: red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f3">
                                                    <span>
                                                        User Name<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <input type="text" class="required" id="UserName" name="UserName" placeholder="User Name" maxlength="64">
                                                <span id="UserNameError" style="color: red"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f4">
                                                    <span>
                                                        Password<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <input type="password" class="required" id="Password" name="Password" placeholder="Password" maxlength="16">
                                                <span id="PasswordWrrorSpan" style="color: red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f5">
                                                    <span>
                                                        Confirm Password<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <input type="password" class="required" id="Cpassword" placeholder="Confirm Password" onchange="ConfirmPassword()" maxlength="16">
                                                <span id="PasswordSpan" style="color: red"></span>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f5">
                                                    <span>
                                                        Address<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <textarea class="required" name="AddressLine1" id="AddressLine1" placeholder="Address" rows="3" maxlength="150"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f3">
                                                    <span>
                                                       About Me
                                                    </span>
                                                </label><br>
                                                 <textarea class="" name="AboutMe" id="AboutMe" placeholder="About Me" rows="3" ></textarea>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f5">
                                                    <span>
                                                        Land Mark
                                                    </span>
                                                </label><br>
                                                <input type="text" name="LandMark" id="LandMark" placeholder="Land Mark" maxlength="64">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f5">
                                                    <span>
                                                        State <span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <?php
                                                $selected = isset($StateList['StateID']) ? $StateList['StateID'] : "";
                                                $db_array = array("tbl_name" => 'v_state', "condition" => "is_active='Y'");
                                                $select_array = array("name" => "StateID", "id" => "StateID", "class" => "required", "onchange" => "GetCities(this);");
                                                $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $selected);
                                                $fn->dropdown($db_array, $select_array, $option_array);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f5">
                                                    <span>
                                                        City<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <select name="CityID" id="CityID" class="required" onchange="GetAreas(this)">
                                                    <option value="">Select City</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f5">
                                                    <span>
                                                        Security Question<span class="ColorRed">&nbsp;* </span>
                                                    </span>
                                                </label><br>
                                                <?php
                                                $db_array = array("tbl_name" => 'v_security_question', "condition" => "is_active='Y'");
                                                $select_array = array("name" => "SecurityQuestionID", "id" => "SecurityQuestionID", "class" => "required");
                                                $option_array = array("value" => "SecurityQuestionID", "label" => "Question", "placeholder" => "Select Question");
                                                $fn->dropdown($db_array, $select_array, $option_array);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-12">
                                   <div class="col-lg-6">
                                    <div class="single-field-container">
                                        <div class="form-group">
                                            <label for="f5">
                                                <span>
                                                    Answer<span class="ColorRed">&nbsp;* </span> 
                                                </span>
                                            </label><br>
                                            <input type="text" class="required" id="SecretAnswer" name="SecretAnswer" placeholder="Answer" maxlength="32">
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f5">
                                                    <span>
                                                        Body Type<span class="ColorRed">&nbsp;* </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="pull-right" src="admin/image/help.png" style="height:25px;width:25px;cursor: pointer" title="Click Here to see details" data-toggle="modal" data-target="#BodyTypePopUp">
                                                    </span>
                                                </label><br>
                                                <select class="required" id="BodyType" name="BodyType">
                                                    <option value="">Select body Type</option>
                                                    <option value="Ectomorph">Ectomorph</option>
                                                    <option value="Mesomorph">Mesomorph</option>
                                                    <option value="Endomorph">Endomorph</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="single-field-container">
                                            <div class="form-group">
                                                <label for="f5">
                                                    <span>
                                                        Favorite Position<span class="ColorRed">&nbsp;* </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="pull-right" src="admin/image/help.png" style="height:25px;width:25px;cursor: pointer" title="Click Here to see details" data-toggle="modal" data-target="#FavoritePositionPopUp">
                                                    </span>
                                                </label><br>
                                                <select class="required" id="FavoritePosition" name="FavoritePosition">
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="sign-up-field-container col-md-12">
                                    <div class="featured-inner-image-area featured-shadow">
                                        <div class="row ">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="featured-service-right-image-area tab-content">
                                                    <div class="form-group">
                                                        <label for="ProfilePicture" class="control-label">Upload <?php echo ProfilePicture ?> :</label><br>
                                                        <input name="ProfilePicture" id="ProfilePicture" type="hidden" class="inputFile input-md" >
                                                        <input name="ProfilePicture" id="ProfilePicture" type="file" class="inputFile input-md" /><br>
                                                        <span id="profilepicupload" ></span>
                                                        <span id="profilepicloading" style="display: none;  color: orange">Uploading Please wait</span>
                                                        <div id="profilepicresponse"></div>
                                                        <img id="ProfilePreview" src="<?php echo (!empty($data['ProfilePicture'])) ? SITE_URL . 'admin/admin/uploads/ProfilePic/' . $data['ProfilePicture'] : SITE_URL . "admin/uploads/placeholder.png"; ?>" alt="ProfilePicture" style="width:100px;height:100px;">
                                                        <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveFile(this.form, 'ProfilePicture', 'ProfilePreview', 'ProfilePic', 'profilepicupload', 'profilepicloading', 'profilepicresponse');">Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="featured-inner-image-area featured-shadow">
                                        <div class="row ">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="featured-service-right-image-area tab-content">
                                                    <div class="form-group">
                                                        <?php
                                                        $db_array = array("tbl_name" => 'v_proof_type', "condition" => "is_active='Y' AND ProofType='ID' OR ProofType='ALL'");
//                                                        $select_array = array("name" => "ProofID", "id" => "ProofID", "class" => "required maxwidth", "onchange" => "GetRemainingIdType(this.value);");
                                                        $select_array = array("name" => "ProofID", "id" => "ProofID", "class" => "required maxwidth");
                                                        $option_array = array("value" => "ProofID", "label" => "DocumentName", "placeholder" => "Select ID Type");
                                                        $fn->dropdown($db_array, $select_array, $option_array);
                                                        ?><span class="ColorRed">&nbsp;* </span><br><br>
                                                        <label for="ProofIDImage" class="control-label">Upload <?php echo IDProof ?> :</label><span class="ColorRed">&nbsp;* </span><br>
                                                        <input name="ProofIDImage" id="ProofIDImage" type="hidden" class="inputFile input-md" >
                                                        <input name="ProofIDImageUpload" id="ProofIDImage" type="file" class="inputFile input-md" /><br>
                                                        <span id="ImageSpan" style="color: red"></span>
                                                        
                                                        <span id="IDProofupload" ></span>
                                                        <span id="IDProofloading" style="display: none;  color: orange">Uploading Please wait</span>
                                                        <div id="IDProofresponse"></div>
                                                        <img id="IDProofPreview" src="<?php echo (!empty($data['ProofIDImage'])) ? SITE_URL . 'admin/admin/uploads/IDProofImage/' . $data['ProofIDImage'] : SITE_URL . "admin/uploads/placeholder3.png"; ?>" alt="ProfilePicture" style="width:100px;height:100px;">
                                                        <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveFile(this.form, 'ProofIDImage', 'IDProofPreview', 'IDPreoofImage', 'IDProofupload', 'IDProofloading', 'IDProofresponse');">Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="featured-inner-image-area featured-shadow">
                                        <div class="row ">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="featured-service-right-image-area tab-content">
                                                    <div class="form-group">
<!--                                                        <select id="ProofID1" name="ProofID1" class="required maxwidth">
                                                            <option>Select ID Type</option>
                                                        </select>-->
                                                        <?php
                                                        $db_array = array("tbl_name" => 'v_proof_type', "condition" => "is_active='Y' AND ProofType='ADDRESS' OR ProofType='ALL'");
                                                        $select_array = array("name" => "ProofID1", "id" => "ProofID1", "class" => "maxwidth required");
                                                        $option_array = array("value" => "ProofID", "label" => "DocumentName", "placeholder" => "Select ID Type");
                                                        $fn->dropdown($db_array, $select_array, $option_array);
                                                        ?>
                                                        <span class="ColorRed">&nbsp;* </span><br><br>
                                                        <label for="ProofIDImage1" class="control-label">Upload <?php echo IDProof ?> :</label><span class="ColorRed">&nbsp;* </span><br>
                                                        <input name="ProofIDImage1" id="ProofIDImage1" type="hidden"  class="inputFile input-md required" >
                                                        <input name="ProofIDImage1Upload" id="ProofIDImage1" type="file" class="inputFile input-md" /><br>
                                                        <span id="SecondImageSpan" style="color: red"></span>
                                                        <span id="IDProofupload1" ></span>
                                                        <span id="IDProofloading1" style="display: none;  color: orange">Uploading Please wait</span>
                                                        <div id="IDProofresponse1"></div>
                                                        <img id="IDProofPreview1" src="<?php echo (!empty($data['ProofIDImage1'])) ? SITE_URL . 'admin/admin/uploads/IDProofImage/' . $data['ProofIDImage1'] : SITE_URL . "admin/uploads/placeholder3.png"; ?>" alt="Id Proof Image" style="width:100px;height:100px;">
                                                        <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveFile(this.form, 'ProofIDImage1', 'IDProofPreview1', 'IDPreoofImage', 'IDProofupload1', 'IDProofloading1', 'IDProofresponse1');">Upload</button>
                                                    </div>    

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                </div>
                <div class="sign-up-bottom-content">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <div class="col-lg-12" style="margin-left: 30px; ">
                                    <label>
                                      
                                        <input type="checkbox" name="TermsConditionStatus" id="TermsConditionStatus" class="radiobuttoncss" value="Y"> <a class="AnchorClass" data-toggle="modal" data-target="#TermsAndCondition">Yes, I agree with Terms & Conditions<span style="color: red"> *</span></a> <br>
                                    <span id="TermErrorSpan" style="color: red"></span>
                                </label>
                                    <span id="ErrorSpan" style="color: red"></span>
                                </div>
                                
                            </div>

                            <div class="col-lg-8">

                                <div class="sign-up-submit-btn">
                                    <button type="button" name="create" id="create" class="btn btn-primary" onclick="RegistrationInsert(this.form), AcceptTerms();" ><?php echo save; ?></button>
                                    <span id="termserror"></span>
                                    <button class="btn btn-danger" type="reset">
                                        Cancel
                                    </button>
                                    <div id="RegistrationLoading"></div>
                                    <span id="RegistrationLoad" ></span>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="TermsAndCondition" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kamet Sports Event</h4>
        </div>
        <div class="modal-body" >
            <?php $data = $fn->GetTermsConditionData();
                  $TermsData = $data['GetTermsConditionWiseData']['DocumentDescription'];
            ?>  
            <div class="row">
            <div class="col-lg-12">
                <?php echo $TermsData;?>
            </div>
            </div>
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
                    <img src="admin/image/body-type.jpg" class="img-thumbnail" style="height:300px;width:100%;">
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
                    <img src="admin/image/Positions.png" class="img-thumbnail" style="height:500px;width:100%;">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<div id="common_wait" style="display:none;width:69px;height:89px;position:absolute;top:40%;left:50%;padding:2px;" ><img src='admin/uploads/ajax_loading.gif' width="64" height="64" /></div>
<?php
require_once './includes/footer.php';
?>
<script type="text/javascript">
function GetRemainingIdType(e){
    var IdType = e;
    $.ajax({
                type: 'POST',
                url: "<?php echo SITE_URL; ?>class/class.ajaxRequest.php",
                data: {IdType: IdType, do: 'GetRemainingIdType'},
                success: function (data) {
//                    alert(data); 
                    $('#ProofID1').html(data);
                }
            });
}    
    jQuery(function ($) {
//        $("#ContactZipcode").mask("*** ***");
        $("#MobileNumber").mask("999-999-9999");
    });

    
//        $('#TermsConditionStatus').click(function () {
//            if ($('#TermsConditionStatus').is(':checked')) {
//                $('#TermErrorSpan').text('');
//                $('#create').prop('disabled',false);
//            } else {
//                $('#TermErrorSpan').text('Teams and condition not accepted');
//                $('#create').prop('disabled',true);
//                return false;
//            }
//        });
function HeightValidation(evt,ErrorSpanId,TextBoxName) {
//    alert('call');
//    var heightExp = /^[0-9]+ ?(\'|ft|cm|meters|feet|in|inches|\")?( *[1-9]+ ?(\"|inches|in|cm)?)?$/;
    var heightExp = /^[0-9]+\' ?[0-9]+\"$/;
    if(evt.match(heightExp))
            {
                $("#" + ErrorSpanId).text('');
            }
            else{
//                alert("Please enter only alphabets");
                $("#" + ErrorSpanId).text('Enter Height in eg:5\'6"');
                $("#" + TextBoxName).val("");
                return false;
            }
}    
function lettersOnly(evt,ErrorSpanId,TextBoxName) {
    var alphaExp = /^([a-zA-Z]+\s)*[a-zA-Z]+$/;
            if(evt.match(alphaExp))
            {
                $("#" + ErrorSpanId).text('');
            }
            else{
                $("#" + ErrorSpanId).text('Please enter only alphabets');
                $("#" + TextBoxName).val("");
                return false;
            }
     }
    function ConfirmPassword() {
        var Password = $("#Password").val();
        var ConfirmPassword = $("#Cpassword").val();
        if (Password == ConfirmPassword) {
            $("#PasswordSpan").text('');
            $("#PasswordSpan").hide();
        } else {
            $("#PasswordSpan").show();
            $("#PasswordSpan").text('Password does not match');
        }
    }
    function RegistrationInsert(form) {
        if ($('#TermsConditionStatus').is(':checked')) {
        var data = $('#' + form.id).serialize();
        if ($('#' + form.id).valid()) {
            $.ajax({
                type: 'POST',
                url: "<?php echo SITE_URL; ?>class/class.ajaxRequest.php",
                data: data + "&do=Registration",
                beforeSend: function () {
                $("#common_wait").css("display", "block");
                $("#section_blur").css("opacity", "0.3");
                },
                complete: function () {
                    $("#RegistrationLoading").hide();
                    $('#RegistrationLoading').html("");
                },
                success: function (data) {
                $("#common_wait").css("display", "none");
                $("#section_blur").css("opacity", "1");
                    var DisplayData = $.parseJSON(data);
                    if (DisplayData.ResponseCode == 0) {
                        if(DisplayData.Message == 'Please Upload Proof Image'){
                            $("#ImageSpan").text('Please Upload Proof Image');
                            return false;
                        }else if(DisplayData.Message == 'Please Upload Second Proof Image'){
                            $("#SecondImageSpan").text('Please Upload Second Proof Image');
                            return false;
                        }else if(DisplayData.Message == 'Please Provide All Required Fields'){
                            $("#ErrorSpan").text('Please Provide All Required Fields');
                            $("#SecondImageSpan").text('');
                            $("#ImageSpan").text('');
                            return false;
                        }else if(DisplayData.Message == 'User Already Registered With This User Name'){
                            $("#UserNameError").text('User Already Registered With This User Name');
                            $("#SecondImageSpan").text('');
                            $("#ImageSpan").text('');
                            return false;
                        }else if(DisplayData.Message == 'Email Already Registred'){
                            $("#EmailIDError").text('Email Already Registred');
                            $("#UserNameError").text('');
                            $("#ErrorSpan").text('');
                            $("#SecondImageSpan").text('');
                            $("#ImageSpan").text('');
                            return false;
                        }else if(DisplayData.Message == 'Mobile Number Already Registered'){
                            $("#MobileNumberError").text('Mobile Number Already Registered');
                            $("#EmailIDError").text('');
                            $("#UserNameError").text('');
                            $("#ErrorSpan").text('');
                            $("#SecondImageSpan").text('');
                            $("#ImageSpan").text('');
                            return false;
                        }else if(DisplayData.Message == 'Password Must Required 1 Capital,Small Charater 1 Number And Not Allow Space'){
                            $("#PasswordWrrorSpan").text('Password Must Required 1 Capital,Small Charater 1 Number And Not Allow Space');
                            $("#EmailIDError").text('');
                            $("#UserNameError").text('');
                            $("#ErrorSpan").text('');
                            $("#SecondImageSpan").text('');
                            $("#ImageSpan").text('');
                            return false;
                        }else{
                            alert_message_popup('', DisplayData.Message);
                            return false;
                        }
                    } else if (DisplayData.ResponseCode == 1) {
                        $("#ErrorSpan").text('');
                        $("#ImageSpan").text('');
                        $("#UserNameError").text('');
                        alert_message_popup('login', DisplayData.Message);
                    }
                }
            });
        }
        }else{
         $('#TermErrorSpan').text('Teams and condition not accepted');
        }
    }
    $(document).ready(function () {
        var date_input = $('input[name="DOB"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var FromEndDate = new Date();
        date_input.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            endDate: FromEndDate,
        })
    });
</script>


