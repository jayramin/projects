<?php

$data = $fn->getDataByID("v_users", "UserID", @$_REQUEST['UserID']);

?>
<!-- Content Start -->

 
<form class="content-form" id="UpdateForm" name="UpdateForm" method="post" enctype="multipart/form-data">
    <div class="row">
        <?php if($_REQUEST['method'] == 'edit' && $_REQUEST['TeamID'] == ''){?>
<!--        <div class="col-lg-1 pull-right">
    <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_user_data(this.form,'Admin');" ><?php echo Update; ?></button>
</div>-->
        <?php } ?>
        <div class="col-lg-12">
            <div class="col-lg-2 pull-right">
                <input type="hidden" name="UserID" id="UserID" value="<?php echo $data['UserID'];?>">
            </div>
            <div class="col-lg-8">
                <div class="col-lg-12">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="UserName" class="control-label"><?php echo UserName; ?></label>
                        <input type="text" class="form-control material required" name="UserName" id="UserName" value="<?php echo $data['UserName']; ?>" placeholder="User Name" readonly="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="FirstName" class="control-label"><?php echo FirstName; ?></label>
                        <input type="text" class="form-control material required" name="FirstName" id="FirstName" value="<?php echo $data['FirstName']; ?>" placeholder="First Name">
                    </div>
                </div>
                </div>
                <div class="col-lg-12">
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label for="MiddleName" class="control-label"><?php echo MiddleName; ?></label>
                        <input type="text" class="form-control material required" name="MiddleName" id="MiddleName" value="<?php echo $data['MiddleName']; ?>" placeholder="Middle Name">
                    </div>
                    </div>
                    <div class="col-lg-6">
                         <div class="form-group">
                        <label for="LastName" class="control-label"><?php echo LastName; ?></label>
                        <input type="text" class="form-control material required" name="LastName" id="LastName" value="<?php echo $data['LastName']; ?>" placeholder="Last Name">
                    </div>
                    </div>
                </div>
                <div class="col-lg-12">
                   
                   <div class="col-lg-6">
                       <div class="form-group">
                        <label for="Height" class="control-label"><?php echo Height; ?></label>
                        <input style="width: 100% !important" type="text" class="form-control material required" id="Height" name="Height" placeholder="eg : 5'10&quot;" onchange="HeightValidation(this.value,'HeightError','Height')" value="<?php echo $data['Height']; ?>">
                                                <span id="HeightError" class="ColorRed"></span>
<!--                        <input type="number" class="form-control material material required" name="Height" id="Height" value="<?php echo $data['Height']; ?>" placeholder="Height">-->
                    </div>
                   </div>
                    <div class="col-lg-6">
                       <div class="form-group">
                        <label for="Weight" class="control-label"><?php echo Weight; ?></label>
                        <input type="number" class="form-control material required" name="Weight" id="Weight" value="<?php echo $data['Weight']; ?>" placeholder="Weight">
                    </div>
                   </div>
                </div>
                <div class="col-lg-12">
                   
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label for="DateOfBirth" class="control-label"><?php echo dob; ?></label>
                        <input type="date" class="form-control material" name="DOB" id="Weight" value="<?php echo $data['DOB']; ?>" placeholder="Date Of Birth">
                    </div>
                    </div>
                    <div class="col-lg-3">
                       <div class="form-group">
                        <label for="Gender" class="control-label"><?php echo Gender; ?> : </label> <br><br>
                        <input type="radio" class="radiobuttoncss material required" name="Gender" id="Gender" <?php if ($data['Gender'] == 'M') { ?>checked="checked" <?php } else {
    
                            } ?> placeholder="Male" checked="checked" value="M">Male
                        <input type="radio" class="radiobuttoncss material required" name="Gender" id="Gender" <?php if ($data['Gender'] == 'F') { ?>checked="checked" <?php } else {
    
                            } ?> placeholder="Female" value="F">Female
                    </div>
                   </div>
                    <div class="col-lg-3">
                    <div class="form-group">
                        <label for="CaptainshipStatus" class="control-label"><?php echo CaptainshipStatus; ?> : </label><br><br>
                        <input type="radio" class="radiobuttoncss material required" name="CaptainshipStatus" id="Weight" <?php if ($data['CaptainshipStatus'] == 'Y') { ?>checked="checked" <?php } ?> placeholder="CaptainshipStatus">Yes
                        <input type="radio" class="radiobuttoncss material required" name="CaptainshipStatus" id="CaptainshipStatus" <?php if ($data['CaptainshipStatus'] == 'N') { ?>checked="checked" <?php }?> placeholder="CaptainshipStatus">No
                    </div>
                    </div>
                   
                </div>
                <div class="col-lg-12">
                    
                   
                    
                </div>
                <div class="col-lg-12">
                   <div class="col-lg-6">
                    <div class="form-group">
                        <label for="EmailID" class="control-label"><?php echo email; ?></label>
                        <input type="text" class="form-control material required" name="EmailID" id="EmailID" value="<?php echo $data['EmailID']; ?>" placeholder="Email ID" >
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label for="NickName" class="control-label"><?php echo NickName; ?></label>
                        <input type="text" class="form-control material required" name="NickName" id="NickName" value="<?php echo $data['NickName']; ?>" placeholder="Nick Name" >
                    </div>
                    </div>
                </div>
                <div class="col-lg-12">
                   <div class="col-lg-6">
                    <div class="form-group">
                        <label for="Address" class="control-label"><?php echo AddressLine1; ?></label>
                        <input type="text" class="form-control material required" name="AddressLine1" id="AddressLine1" value="<?php echo $data['AddressLine1']; ?>" placeholder="Address" >
                    </div>
                    </div>
                    <div class="col-lg-6">
                   <label for="State" class="control-label"><?php echo State; ?></label>
                        <?php
                   
                    $selected = isset($data['StateID']) ? $data['StateID'] : "";
                    $db_array = array("tbl_name" => 'v_state', "condition" => "is_active='Y'");
                    $select_array = array("name" => "StateID", "id" => "StateID", "class" => "required material form-control", "onchange" => "GetCities(this);" ,"disabled" =>"true");
                    $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                  ?>
                   <input type="hidden" name="StateID" id="StateID" value="<?php echo $data['StateID']?>">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="col-lg-6">
                   <label for="f5">
                    <span>
                        City<span class="ColorRed">&nbsp;* </span>
                    </span>
                        </label>
                        <?php
                   
                    $selected = isset($data['CityID']) ? $data['CityID'] : "";
                    $db_array = array("tbl_name" => 'v_city', "condition" => "is_active='Y'");
                    $select_array = array("name" => "CityID", "id" => "CityID", "class" => "required material form-control" ,"disabled" =>"true");
                    $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select Name", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                  ?>
                        <input type="hidden" name="CityID" id="CityID" value="<?php echo $data['CityID']?>">
                    </div>
                    <div class="col-lg-6">
                   <label for="f5">
                    <span>Security Question<span class="ColorRed">&nbsp;* </span></span>
                        </label>
                        <?php
                   
                    $selected = isset($data['SecurityQuestionID']) ? $data['SecurityQuestionID'] : "";
                    $db_array = array("tbl_name" => 'v_security_question', "condition" => "is_active='Y'");
                    $select_array = array("name" => "SecurityQuestionID", "id" => "SecurityQuestionID", "class" => "required material form-control" ,"disabled" =>"true");
                    $option_array = array("value" => "SecurityQuestionID", "label" => "Question", "placeholder" => "Select Question", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                  ?>
                         <input type="hidden" name="SecurityQuestionID" id="SecurityQuestionID" value="<?php echo $data['SecurityQuestionID']?>">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <label for="SecretAnswer" class="control-label"><?php echo Answer; ?></label>
                        <input type="text" class="form-control material required" name="SecretAnswer" id="SecretAnswer" value="<?php echo $data['SecretAnswer']; ?>" placeholder="SecretAnswer" >
                    </div>
                    <div class="col-lg-6">
                        <label for="MobileNumber" class="control-label"><?php echo MobileNumber; ?></label>
                        <input type="text" class="form-control material required" name="MobileNumber" id="MobileNumber" value="<?php echo $data['MobileNumber']; ?>" placeholder="Mobile Number" >
                    </div>
                </div>
                
            </div>

            <div class="col-lg-4">
                <div class="col-lg-12">
                     <div class="form-group">
                        <label for="ProfilePreview" class="material control-label"><?php echo ProfilePicture; ?></label><br>
                        <img id="ProfilePreview" src="<?php echo (!empty($data['ProfilePicture'])) ? SITE_URL . 'admin/uploads/ProfilePic/' . $data['ProfilePicture'] : SITE_URL . "admin/uploads/placeholder.png"; ?>" alt="ProfilePicture" style="width:100px;height:100px;">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModalProfile">View</button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="ProfilePreview" class="control-label"><?php echo ProofID; ?></label><br>
<?php
$SelectedState = isset($data['ProofID']) ? $data['ProofID'] : " ";
$db_array = array("tbl_name" => 'v_proof_type', "condition" => "is_active='Y'");
$select_array = array("name" => "ProofID", "id" => "ProofID", "class" => "required material form-control","disabled" =>"true");
$option_array = array("value" => "ProofID", "label" => "DocumentName", "placeholder" => "Select ID Type", 'selected' => $SelectedState);
$fn->dropdown($db_array, $select_array, $option_array);
?><br><br>
<input type="hidden" name="ProofID" id="ProofID" value="<?php echo $data['ProofID']?>">
                        <img id="ProfilePreview" src="<?php echo (!empty($data['ProofIDImage'])) ? SITE_URL . 'admin/uploads/IDPreoofImage/' . $data['ProofIDImage'] : SITE_URL . "admin/uploads/placeholder3.png"; ?>" alt="ProofIDImage" style="width:100px;height:100px;" >
                        <input type="hidden" name="ProofIDImage" id="ProofIDImage" value="<?php echo $data['ProofIDImage']?>">
                         <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">View</button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="ProfilePreview" class="control-label"><?php echo ProofID; ?></label><br>
<?php
$SelectedState = isset($data['ProofID1']) ? $data['ProofID1'] : " ";
$db_array = array("tbl_name" => 'v_proof_type', "condition" => "is_active='Y'");
$select_array = array("name" => "ProofID", "id" => "ProofID", "class" => "required material form-control","disabled" =>"true");
$option_array = array("value" => "ProofID", "label" => "DocumentName", "placeholder" => "Select ID Type", 'selected' => $SelectedState);
$fn->dropdown($db_array, $select_array, $option_array);
?><br><br>
<input type="hidden" name="ProofID1" id="ProofID1" value="<?php echo $data['ProofID1']?>">
                        <img id="ProfilePreview" src="<?php echo (!empty($data['ProofIDImage1'])) ? SITE_URL . 'admin/uploads/IDPreoofImage/' . $data['ProofIDImage1'] : SITE_URL . "admin/uploads/placeholder3.png"; ?>" alt="ProofIDImage" style="width:100px;height:100px;">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal1">View</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Kamet Sports Event</h4>
      </div>
      <div class="modal-body">
         <img id="ProfilePreview" src="<?php echo (!empty($data['ProofIDImage'])) ? SITE_URL . 'admin/uploads/IDPreoofImage/' . $data['ProofIDImage'] : SITE_URL . "admin/uploads/placeholder3.png"; ?>" alt="ProofIDImage" style="width:550px;height:500px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModalProfile" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Kamet Sports Event</h4>
      </div>
      <div class="modal-body">
          <img id="ProfilePreview" src="<?php echo (!empty($data['ProfilePicture'])) ? SITE_URL . 'admin/uploads/ProfilePic/' . $data['ProfilePicture'] : SITE_URL . "admin/uploads/placeholder.png"; ?>" alt="ProfilePicture" style="width:550px;height:500px;">
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
         <img id="ProfilePreview" src="<?php echo (!empty($data['ProofIDImage1'])) ? SITE_URL . 'admin/uploads/IDPreoofImage/' . $data['ProofIDImage1'] : SITE_URL . "admin/uploads/placeholder3.png"; ?>" alt="ProofIDImage1" style="width:550px;height:500px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div class="modal fade" id="myModalDecline" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kamet Sports Event</h4>
        </div>
        <div class="modal-body">
            <label>Reason For Decline Request</label><span style="color: red">&nbsp;*&nbsp;</span><span id="DeclineResonSpan" style="color: red"></span>
            <textarea name="DeclineReason" id="DeclineReason" class="form-control"></textarea>
        </div>
        <div class="modal-footer">
            <div id="common_wait" style="display:none;width:50px;height:50px;position:absolute;top:40%;right:50%;padding:2px;" ><img src='uploads/ajax_loading.gif' width="50" height="50" /></div>
            <input type="hidden" name="TeamID" id="TeamID" value="<?php echo $_REQUEST['TeamID']?>">
            <input type="hidden" name="CaptainID" id="CaptainID" value="<?php echo $_REQUEST['CaptainID']?>">
            <input type="hidden" name="TournamentID" id="TournamentID" value="<?php echo $_REQUEST['TournamentID']?>">
            <input type="hidden" name="TeamTournamentRelationID" id="TeamTournamentRelationID" value="<?php echo $_REQUEST['TeamTournamentRelationID']?>">
            <button type="button" class="btn btn-primary" onclick="DeclineReason()">Send Message</button>  
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

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

    $(function AcceptTerms() {
        $('#create').click(function () {
            if ($('#TermsConditionStatus').is(':checked')) {
                $('#TermErrorSpan').text('');
            } else {
                $('#TermErrorSpan').text('Teams and condition not accepted');
            }
        })
    });
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
//                alert("Please enter only alphabets");
                $("#" + ErrorSpanId).text('Please enter only alphabets');
                $("#" + TextBoxName).val("");
                return false;
            }
     }
    function ConfirmPassword() {
        var Password = $("#Password").val();
        var ConfirmPassword = $("#Cpassword").val();
        if (Password == ConfirmPassword) {
            $("#PasswordSpan").hide();
        } else {
            $("#PasswordSpan").show();
            $("#PasswordSpan").text('Password does not match');
        }
    }
</script>