<?php
$users = new users();
$data = $users->get_usersbyfields(@$_REQUEST['user_id']);
//print_r($data);
?>
<!-- Content Start -->
<form action="" id="form_salesman" name="form_salesman" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="prefix_status" class="control-label">Prefix</label>
                <select name="prefix_status" id="prefix_status" class="form-control input-sm required" >
                    <option value="">Select Prefix</option>
                    <option value="Mr" <?php if ($data['prefix_status'] == 'Mr') { ?>selected <?php } ?>>Mr</option>
                    <option value="Mrs" <?php if ($data['prefix_status'] == 'Mrs') { ?>selected <?php } ?>>Mrs</option>
                    <option value="Sr" <?php if ($data['prefix_status'] == 'Sr') { ?>selected <?php } ?>>Sr</option>
                    <option value="Jr" <?php if ($data['prefix_status'] == 'Jr') { ?>selected <?php } ?>>Jr</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <input type = "hidden" name = "user_id" id = "user_id" value = "<?php echo $data['user_id']; ?>" class = "form-control input-sm required">
                <input type="hidden" id="salesman_email" name="salesman_email" value="yes">
                <label for="first_name" class="control-label">First Name</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo $data['first_name']; ?>" class="form-control input-sm required">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="middle_name" class="control-label">Middle Name</label>
                <input type="text" name="middle_name" id="middle_name" value="<?php echo $data['middle_name']; ?>" class="form-control input-sm">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="last_name" class="control-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo $data['last_name']; ?>" class="form-control input-sm required">
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-3">
            <div class="form-group">
                <label for="dob" class="control-label">Date of Birth</label>
                <div class="bfh-datepicker" data-format="y-m-d" data-name="dob" data-date="today" data-align="right"  data-input ="form-control input-sm" data-date="<?php
                if (isset($data['dob'])) {
                    if ($data['dob'] == '0000-00-00') {
                        echo date("Y-m-d");
                    } else {
                        echo $data['dob'];
                    }
                }
                ?>">
                    <input type="text" name="dob" id="dob" value="<?php echo $data['dob']; ?>" class="form-control input-sm">
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="username" class="control-label">Username</label>
                <input type="text" name="username" id="username" data-toggle="tooltip" data-placement="bottom" title="Require Minimum Six Character & Unique" value="<?php echo $data['username']; ?>" class="form-control input-sm required">
                <span id="userunique"></span>
            </div>
        </div>

        <div class="col-lg-3">
            <label class="control-label" for="password">Password</label>
            <div class="form-group">
                <input type="password" class="form-control input-sm required" data-toggle="tooltip" data-placement="bottom" title="Require One Special Character & one number & Minimum Six Character" oncopy="return false" onpaste="return false" id="password" name="password" onblur="length_password();" value="<?php echo $data['password']; ?>">
                <span id="passlength"></span>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="email" class="control-label">Email</label>
                <input type="email" name="email" id="email" oncopy="return false" oncut="return false" onpaste="return false" value="<?php echo $data['email']; ?>" class="form-control input-sm required">
                <span id="alert"></span>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="citizen_status" class="control-label">Citizen Status</label>
                <select name="citizen_status" id="citizen_status" class="form-control input-sm">
                    <option value="">Select Citizen Status</option>
                    <option value="Us Citizen" <?php if ($data['citizen_status'] == 'Us Citizen') { ?>selected <?php } ?>>US Citizen</option>
                    <option value="Greencard" <?php if ($data['citizen_status'] == 'Greencard') { ?>selected <?php } ?>>Green Card</option>

                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="address" class="control-label">Address</label>
                <input type="text" name="address" id="address" value="<?php echo $data['address']; ?>" class="form-control input-sm required">
            </div>
        </div>
        <div class="col-lg-3">
            <div class = "form-group">
                <label for="country_id" class="control-label"><?php echo $lang->lang['Country_Name'] ?></label>
                <?php
                $selected_cntry = isset($data['country_id']) ? $data['country_id'] : "";
                $db_array_cntry = array("tbl_name" => TBL_COUNTRIES, "is_active=Y");
                $select_array_cntry = array("name" => "country_id", "id" => "country_id", "class" => "form-control input-sm required");
                $option_array_cntry = array("value" => "country_id", "label" => "country_name", "placeholder" => "Select Country", 'selected' => $selected_cntry);
                $db->dropdown($db_array_cntry, $select_array_cntry, $option_array_cntry);
                ?>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="state_id" class="control-label"><?php echo $lang->lang['state_name'] ?></label>
                <?php
                $selected_stt = isset($data['state_id']) ? $data['state_id'] : "";
                $db_array_stt = array("tbl_name" => TBL_STATE, "is_active=Y");
                $select_array_stt = array("name" => "state_id", "id" => "state_id", "class" => "form-control input-sm required");
                $option_array_stt = array("value" => "state_id", "label" => "state_name", "placeholder" => "Select State", 'selected' => $selected_stt);
                $db->dropdown($db_array_stt, $select_array_stt, $option_array_stt);
                ?>
                <script src="./jquery.min.js"></script>
                <script>
                    $(document).ready(function() {

                        var c_id = '<?php echo $data['country_id']; ?>';
                        var s_id = '<?php echo $data['state_id']; ?>';
                        $.ajax({
                            type: "post",
                            url: "ajax/status.php",
                            data: {'do': 'get_state', country_id: c_id, state_id: s_id},
                            success: function(data) {

                                $("#state_id").html(data);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(jqXHR + "  " + textStatus + "  " + errorThrown);
                            }
                        });
                        $("#country_id").change(function() {
                            $("#state_id").html("");
                            var country_id = $("#country_id").val();

                            $.ajax({
                                type: "post",
                                url: "ajax/status.php",
                                data: {'do': 'country_id', country_id: country_id},
                                success: function(data) {
                                    //alert(data);
                                    $("#state_id").html(data);
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    alert(jqXHR + "  " + textStatus + "  " + errorThrown);
                                }
                            });
                        });
                    });</script>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class = "form-group">
                <label for="city_id" class="control-label"><?php echo $lang->lang['City_Name'] ?></label>
                <?php
                $selected_ct = isset($data['city_id']) ? $data['city_id'] : "";
                $db_array_ct = array("tbl_name" => TBL_CITY, "is_active=Y");
                $select_array_ct = array("name" => "city_id", "id" => "city_id", "class" => "form-control input-sm required");
                $option_array_ct = array("value" => "city_id", "label" => "city_name", "placeholder" => "Select City", 'selected' => $selected_ct);
                $db->dropdown($db_array_ct, $select_array_ct, $option_array_ct);
                ?>
                <script src="./jquery.min.js"></script>
                <script>
                    $(document).ready(function() {
                        var ct_id = '<?php echo $data['city_id']; ?>';
                        var st_id = '<?php echo $data['state_id']; ?>';
                        $.ajax({
                            type: "post",
                            url: "ajax/status.php",
                            data: {'do': 'get_city', state_id: st_id, city_id: ct_id},
                            success: function(data) {
                                //alert(data);
                                $("#city_id").html(data);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(jqXHR + "  " + textStatus + "  " + errorThrown);
                            }
                        });
                        $("#state_id").change(function() {
                            $("#city_id").html("");
                            var state_id = $("#state_id").val();
                            $.ajax({
                                type: "post",
                                url: "ajax/status.php",
                                data: {'do': 'state_id', state_id: state_id},
                                success: function(data) {
                                    $("#city_id").html(data);
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    alert(jqXHR + "  " + textStatus + "  " + errorThrown);
                                }
                            });
                        });
                    });</script>
            </div>
        </div>
        <div class="col-lg-3">
            <div class = "form-group">
                <label for="area_id" class="control-label"><?php echo $lang->lang['Area_Name'] ?></label>
                <?php
                $selected_area = isset($data['area_id']) ? $data['area_id'] : "";
                $db_array_area = array("tbl_name" => TBL_AREA, "is_active=Y");
                $select_array_area = array("name" => "area_id", "id" => "area_id", "class" => "form-control input-sm",);
                $option_array_area = array("value" => "area_id", "label" => "area_name", "placeholder" => "Select Area", 'selected' => $selected_area);
                $db->dropdown($db_array_area, $select_array_area, $option_array_area);
                ?>
                <script src="./jquery.min.js"></script>
                <script>
                    $(document).ready(function() {
                        var ar_id = '<?php echo $data['area_id']; ?>';
                        var ct_id = '<?php echo $data['city_id']; ?>';
                        $.ajax({
                            type: "post",
                            url: "ajax/status.php",
                            data: {'do': 'get_area', city_id: ct_id, area_id: ar_id},
                            success: function(data) {
                                //alert(data);
                                $("#area_id").html(data);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(jqXHR + "  " + textStatus + "  " + errorThrown);
                            }
                        });
                        $("#city_id").change(function() {
                            $("#area_id").html("");
                            var city_id = $("#city_id").val();
                            $.ajax({
                                type: "post",
                                url: "ajax/status.php",
                                data: {'do': 'city_id', city_id: city_id},
                                success: function(data) {
                                    $("#area_id").html(data);
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    alert(jqXHR + "  " + textStatus + "  " + errorThrown);
                                }
                            });
                        });
                    });

                </script>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="zipcode" class="control-label">Zip Code</label>
                <input type="text" name="zipcode" id="zipcode" onblur="IsValidZipCode();" data-toggle="tooltip" data-placement="bottom" title="Require Five Digits" value="<?php echo $data['zipcode']; ?>" class="form-control input-sm required">
                <span id="zip"></span>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="cell_number" class="control-label">Mobile</label>
                <input type="text" name="cell_number" id="cell_number" value="<?php echo $data['cell_number']; ?>" class="form-control input-sm required" data-toggle="tooltip" data-placement="bottom" title="Require Ten Digits" onblur="mobilevalid();">
                <span id="mno"></span>
            </div>
        </div></div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="land_number" class="control-label">Phone No</label>
                <input type="text" name="land_number" id="land_number" data-toggle="tooltip" data-placement="bottom" title="Require Eleven Digits" value="<?php echo $data['land_number']; ?>" class="form-control input-sm required" onblur="landvalid();">
                <span id="lno"></span>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="user_role" class="control-label">User Role</label>
                <?php
                $selected_role = isset($data['role_id']) ? $data['role_id'] : "";
                $db_array_role = array("tbl_name" => TBL_ROLES, "is_active=Y");
                $select_array_role = array("name" => "role_id", "id" => "role_id", "class" => "form-control input-sm required",);
                $option_array_role = array("value" => "role_id", "label" => "name", "placeholder" => "Select Role", 'selected' => $selected_role);
                $db->dropdown($db_array_role, $select_array_role, $option_array_role);
                ?>
                <span id="lno"></span>
            </div>
        </div>
    </div>
</div>

<div class="row col-lg-12">
    <div class="col-lg-2">
        <div class="form-group">
            <input type="hidden" name="is_active" value="<?php echo isset($data['is_active']) ? $data['is_active'] : 'Y'; ?>">
            <?php if (isset($_REQUEST['user_id'])) { ?>
                <input type="button" name="update" id="update" value="<?php echo $lang->lang['update']; ?>" class="btn btn-primary btn-sm" onclick="update_data('<?php echo TBL_USERS; ?>', 'user_id', '<?php echo $_REQUEST['user_id'] ?>', 'user_master', this.form);" >
            <?php } else { ?>
                <input type="button" name="add" id="add" value="<?php echo $lang->lang['add']; ?>" class="btn btn-primary btn-sm" onclick="insert_data('<?php echo TBL_USERS; ?>', 'user_master', this.form);
                       ">
                   <?php } ?>
            <a class="btn btn-primary btn-sm pull-right marrig10" href="user_master"><?php echo $lang->lang['cancel']; ?></a>
        </div></div>

</div>
</form>
<style>
    body {
        background-color: transparent;
        color: #656565;
        font-size: 13px;
        overflow-x: visible !important;
    }
</style>
<script>

                    $("#area_id").change(function() {
                        // $("#zip_code").html("");
                        var area_id = $("#area_id").val();
                        $.ajax({
                            type: "post",
                            url: "ajax/status.php",
                            data: {'do': 'zip', area_id: area_id},
                            success: function(data) {
                                $("#zipcode").val(data);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(jqXHR + "  " + textStatus + "  " + errorThrown);
                            }
                        });
                    });
                    $('#zipcode').keyup(function(e) {

                        if (e.which == 13) {
                            $.ajax({
                                type: "post",
                                url: "ajax/status.php",
                                data: {'do': 'get_dd_ids', 'zip_code': $("#zipcode").val()},
                                success: function(data) {
                                    var obj = jQuery.parseJSON(data);

                                    $("#country_id").select2("val", obj[0].country_id);

                                    if (obj[0].country_id != '')
                                    {

                                        state_get(obj[0].country_id, obj[0].state_id);
                                        //$("#state_id").select2("val", obj[0].state_id);
                                        //$("#state_id").select2("val", obj[0].state_id);
                                    }
                                    if (obj[0].state_id != '')
                                    {

                                        city_get(obj[0].state_id, obj[0].city_id);
                                        //$("#city_id").select2("val", obj[0].city_id);
                                    }
                                    if (obj[0].city_id != '')
                                    {

                                        area_get(obj[0].city_id, obj[0].area_id);
                                        //$("#area_id").select2("val", obj[0].area_id);
                                    }

                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    alert(jqXHR + "  " + textStatus + "  " + errorThrown);
                                }
                            });
                        }
                    });
                    function state_get(c_id, s_id)
                    {


                        //alert(s_id);
                        $.ajax({
                            type: "post",
                            url: "ajax/status.php",
                            data: {'do': 'get_state', "country_id": c_id, "state_id": s_id},
                            success: function(data) {
                                //alert(data);
                                $("#state_id").html(data);
                                $("#state_id").select2("val", s_id);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(jqXHR + "  " + textStatus + "  " + errorThrown);
                            }
                        });
                    }
                    function city_get(st_id, ct_id)
                    {

                        $.ajax({
                            type: "post",
                            url: "ajax/status.php",
                            data: {'do': 'get_city', state_id: st_id, city_id: ct_id},
                            success: function(data) {
                                //alert(data);
                                $("#city_id").html(data);
                                $("#city_id").select2("val", ct_id);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(jqXHR + "  " + textStatus + "  " + errorThrown);
                            }
                        });
                    }
                    function area_get(ct_id, ar_id)
                    {

                        $.ajax({
                            type: "post",
                            url: "ajax/status.php",
                            data: {'do': 'get_area', city_id: ct_id, area_id: ar_id},
                            success: function(data) {
                                //alert(data);
                                $("#area_id").html(data);
                                $("#area_id").select2("val", ar_id);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(jqXHR + "  " + textStatus + "  " + errorThrown);
                            }
                        });
                    }
</script>
<script>
    jQuery(document).ready(function()
    {
        jQuery("#username").keyup(function()
        {
            var reg = /^[a-zA-Z0-9](_(?!(\.|_))|\.(?!(_|\.))|[a-zA-Z0-9]){4,18}[a-zA-Z0-9]$/;
            var username = $("#username").val();
            var msgbox = $("#userunique");
            if (reg.test(username))
            {
                jQuery("#userunique").html('<img src="img/loaders/1.gif" align="absmiddle">&nbsp;Checking availability...');
                //alert(email);
                jQuery.ajax({
                    type: 'POST',
                    url: 'ajax/email_check.php',
                    data: 'username=' + username,
                    success: function(msg) {
                        if (msg == 'OK') {
                            jQuery("#username").removeClass("red");
                            jQuery("#username").addClass("green");
                            msgbox.html('Available');
                            $('#add').prop('disabled', false);
                        } else {
                            jQuery("#username").removeClass("green");
                            jQuery("#username").addClass("red");
                            msgbox.html(msg);
                            $('#add').prop('disabled', true);
                        }
                    }
                });
            }
            else
            {
                jQuery("#username").addClass("red");
                jQuery("#userunique").html('<font color="red"><b>Username invalid</b></font>');
                $('#add').prop('disabled', true);
            }
            return false;
        });
    });
    jQuery(document).ready(function()
    {
        jQuery("#email").keyup(function()
        {
            var reg = /^[_A-Za-z0-9-]+(\.[_A-Za-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[A-Za-z]{2,})$/;
            var email = $("#email").val();
            var msgbox = $("#alert");
            if (reg.test(email))
            {
                jQuery("#alert").html('<img src="img/loaders/1.gif" align="absmiddle">&nbsp;Checking availability...');
                //alert(email);
                jQuery.ajax({
                    type: 'POST',
                    url: 'ajax/email_check.php',
                    data: 'email=' + email,
                    success: function(msg) {
                        if (msg == 'OK') {
                            jQuery("#email").removeClass("red");
                            jQuery("#email").addClass("green");
                            msgbox.html('<font color="black"><b>Available</b></font>');
                            $('#add').prop('disabled', false);
                        } else {
                            jQuery("#email").removeClass("green");
                            jQuery("#email").addClass("red");
                            msgbox.html(msg);
                            $('#add').prop('disabled', true);
                        }
                    }
                });
            }
            else
            {
                jQuery("#email").addClass("red");
                jQuery("#alert").html('<font color="red"><b>Email id invalid</b></font>');
                $('#add').prop('disabled', true);
            }
            return false;
        });
    });
    function length_password()
    {

        var pass = $('#password').val();
        var reg = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,20}$/;
        if (reg.test(pass))
        {
            //alert('match');
            // $('#password').focus();
            $("#passlength").html('');
            $('#add').prop('disabled', false);
        }
        else {
            $("#passlength").html('<font color="red"><b>Password is Invalid</b></font>');
            $('#add').prop('disabled', true);
        }
    }
    function mobilevalid()
    {
        //alert("hii");
        if ($('#cell_number').val().length == '10' && !isNaN($('#cell_number').val()))
        {
            $("#mno").html('');
            $('#add').prop('disabled', false);
        }
        else
        {
            $("#mno").html('<font color="red"><b>Invalid Mobile no</b></font>');
            $('#add').prop('disabled', true);
        }
    }
    function landvalid()
    {
        //alert("hii");
        if ($('#land_number').val().length == '11' && !isNaN($('#land_number').val()))
        {
            $("#lno").html('');
            $('#add').prop('disabled', false);
        }
        else
        {
            $("#lno").html('<font color="red"><b>Invalid Landline no</b></font>');
            $('#add').prop('disabled', true);
        }
    }
    function IsValidZipCode()
    {
        //alert("hii");
        if ($('#zipcode').val().length == '5' && !isNaN($('#zipcode').val()))
        {
            $("#zip").html('');
            $('#add').prop('disabled', false);
        }
        else
        {
            // $('#zipcode').focus();
            $("#zip").html('<font color="red"><b>Invalid Zipcode</b></font>');
            $('#add').prop('disabled', true);
        }
    }


</script>