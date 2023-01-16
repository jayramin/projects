<?php require_once 'Header.php';?>
<body>
    <section class=""><br>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="card">
                    <center> <h3 class="card-title">Register</h3></center>
              <div class="card-body">
                <form class="form-horizontal"  action="" id="form" name="form" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                      <label class="control-label col-md-3">User Name <span style="color: red"> * </span>   </label> 
                    <div class="col-md-8">
                        <input class="form-control required" type="text" name="UserName" id="UserName" placeholder="Enter full name">
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="control-label col-md-3">Password <span style="color: red"> * </span></label>
                    <div class="col-md-8">
                        <input class="form-control required" type="password" name="Password" id="Password" placeholder="Enter Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Email <span style="color: red"> * </span></label>
                    <div class="col-md-8">
                        <input class="form-control col-md-8 required" type="email" name="Email" id="Email" placeholder="Enter email address">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Address</label>
                    <div class="col-md-8">
                        <textarea class="form-control" rows="4" placeholder="Enter your address" name="Address" id="Address"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Gender</label>
                    <div class="col-md-9">
                      <div class="radio-inline">
                        <label>
                            <input type="radio" name="Gender" value="Male" checked="checked"> Male
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="Gender" value="Female">Female
                        </label>
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Profile Picture</label>
                    <div class="col-md-8">
                        <div class="featured-service-right-image-area tab-content">
                                                    <div class="form-group">
                                                        <div class="col-lg-8">
                                                        <input name="ProfilePicture" id="ProfilePicture" type="hidden" class="inputFile input-md" value="<?php echo (!empty($data['ProfilePicture'])) ? $data['ProfilePicture'] : ""; ?>">
                                                        <input name="ProfilePicture" id="ProfilePicture" type="file" class="inputFile input-md" /><br>
                                                        <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveFile(this.form, 'ProfilePicture', 'ProfilePicturePreview', 'ProfilePicture', 'ProfilePictureupload', 'ProfilePictureloading', 'ProfilePictureresponse','Out');">Upload</button>
                                                        <span id="ProfilePictureupload" ></span>
                                                        <span id="ProfilePictureloading" style="display: none;  color: orange">Uploading Please wait</span>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div id="ProfilePictureresponse"></div>
                                                        <img id="ProfilePicturePreview" src="<?php echo (!empty($data['ProfilePicture'])) ? SITE_URL . 'admin/uploads/ProfilePicture/' . $data['ProfilePicture'] : SITE_URL . "admin/uploads/placeholder.png"; ?>" alt="ProfilePicture" style="width:100px;height:100px;">
                                                        
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                    </div>
                    

                </div>
                    
                    
<!--                  <div class="form-group">
                    <label class="control-label col-md-3">Identity Proof</label>
                    <div class="col-md-8">
                        <input class="form-control" type="file" name="ProfilePicture" id="ProfilePicture">
                    </div>
                  </div>-->
                  <div class="form-group">
                    <div class="col-md-8 col-md-offset-3">
                        <div class="col-lg-1">
                            <input type="checkbox" name="Terms" id="Terms" checked='checked'>
                        </div>
                        <div class="col-lg-10">
                            <div class="checkbox" style="padding-top: 0px; padding-left: 0px ">
                        <label>
                            I accept the terms and conditions
                        </label>
                      </div>
                        </div>
                      
                        
                    </div>
                  </div>
                    <div class="card-footer text-center">
                        <input type="hidden" name="is_active" value="Y">
                        <input type="hidden" name="RoleID" value="4">
<!--                  <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary icon-btn" onclick="InsertRegistrationData(this.form);" >-->
                <button class="btn btn-primary icon-btn" type="button" onclick="InsertRegistrationData(this.form);" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-default icon-btn" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
              </div>
                </form>
              </div>
              
            </div>
            </div>
        </div>
        
    </section>
</body>

<script>
function InsertRegistrationData(form) {
    var data = $('#' + form.id).serialize();
        jQuery.ajax({
            type: 'POST',
            url: "class/class.ajaxRequest.php",
            data: data + "&do=InsertRegistrationData",
            success: function (result) {
//                alert(result);
                window.location = "Login.php";
//                alert_message_popup('Login', "Data Save Successfully");
            }
        });
//    }
}


function SaveFile(form, FileID, placement, directory, SpanID, Loading, Response, flag) {
    var url;
    var src;
    var previewpath;
    if (placement == '') {
        $('#' + SpanID).css('display', 'block');
        $('#' + SpanID).html('<strong>Oops !!</strong> Please First Upload Image.');
        $('input[type=file]').val('');
    } else {
            url = "admin/upload.php";
            src = "admin/uploads/ajax_loading.gif";
            previewpath = "admin/uploads/";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData(form),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#' + SpanID).html('');
                $("#" + Loading).show();
                $('#' + Response).html("<img src='" + src + "'/>");
            },
            complete: function () {
                $("#" + Loading).hide();
                $('#' + Response).html("");
            },
            success: function (data) {
//                alert(data);
            if (data == 0) {
                    $('#' + SpanID).css('display', 'block');
                    $('#' + SpanID).html('<strong>Oops !!</strong> Please First Upload Image.');
                    $('input[type=file]').val('');
                    return false;
                }
                var savedata = $.parseJSON(data);
                $("#" + Loading).hide();
                $('#' + Response).html("");

                if (savedata.ResponseCode == 0) {
                    $('#' + SpanID).css('display', 'block');
                    $('#' + SpanID).html('<strong>Oops !!</strong> Please First Upload Image.');
                    $('input[type=file]').val('');
                }
                else if (savedata.ResponseCode == 1) {
                    $("#ImageSpan").html('');
                    $("#SecondImageSpan").html('');
                    $('#' + SpanID).css('display', 'none');
                    $('#' + SpanID).html('');
                    $("#" + placement).attr('src', previewpath + directory + '/' + savedata.FileName);
                    $('#' + FileID).val(savedata.FileName);
                    $('input[type=file]').val('');
                }
            },
            error: function ()
            {
            }
        });
    }
}
</script>
<?php require_once 'Footer.php';?>