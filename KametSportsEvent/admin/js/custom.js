// JavaScript Document
//var site_url = 'http://localhost/KametSportsEvent/';
//jQuery(function() {
//    if (jQuery().dataTable) {
//        jQuery('#master').dataTable();
//    }
//});
// generate random password of given length
//<start of function generate password>
function generatepass(plength) {
    var keylist = "abcdefghijklmnopqrstuvwxyz123456789"
    var temp = ''

    for (i = 0; i < plength; i++) {
        temp += keylist.charAt(Math.floor(Math.random() * keylist.length));
    }
    return temp;
}
//<end of function generate password>
//Start of function login
function PressEnterLogin(e, redirect_url) {
    if (e.which == 13) {
        login(redirect_url);
    }
}

function forgotpassword()
{
    var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var email = $("#email").val();
    var msgbox = $("#status");
    var user_id = $("#user_id").val();


    //alert('if');
    if (reg.test(email)) {
        $("#status").html('<img src="admin/uploads/images/1.gif" align="absmiddle">&nbsp;Checking availability...');
        $.ajax({
            type: 'POST',
            url: 'admin/ajax/email_check.php',
            data: {email: email, do: 'forgotpass'},
            beforeSend: function () {
                $('.alert_box_success').show();
                $('.alert_box_success').html('Please wait...');
            },
            success: function (msg) {
                //alert(msg);
                if (msg.trim() == '0') {
                    msgbox.html('<img src="img/logo/available.png" align="absmiddle">');
                    alert("Error: in Sending Message");
                } else {
                    $('.alert_box_success').html('Message Sent Successfull....');
                    alert("you will get reset password link on your email id ,If you will not get then check again...");
                    $('#myModal').modal("hide");
                    $("#email").removeClass("green");
                    $("#email").addClass("red");
                    msgbox.html(msg);
                    $('#clientsubmit').prop('disabled', true);
                }
            }
        });
    } else {
        alert('OK');
        $("#email").addClass("red");
        $("#status").html('<font color="#cc0000">Email id is invalid</font>');
        $('#clientsubmit').prop('disabled', true);
    }

}
function setpassword()
{
    var password = $('#password').val();
    var CPassword = $('#Cpassword').val();
    var PwdToken = $("#PwdToken").val();


    if (password == "") {
        alert('please enter your password');
        return false;
    }
    if (password != CPassword) {
        alert('Password & Confirm Password Not Matching');
        return false;
    }
    if ((password.length < 4) || (password.length > 8)) {
        alert("Your Password must be 4 to 8 Character");
        return false;
    }
    if (password != "" && password.match(/\ /)) {
        alert("Please enter a password without Spaces");
        return false;
    }
    if (password != "" && !password.match(/\d/)) {
        alert("At least one digit required!");
        return false;
    }
    if (password != "" && !password.match(/[a-z]/i)) {
        alert("At least one letter required!");
        return false;
    }
    if (password != "" && !password.match(/[!@#$%^&*]/)) {
        alert("password should contain atleast one special character");
        return false;
    } else {
        $.ajax({
            type: 'POST',
            url: 'admin/ajax/email_check.php',
            data: {password: password, CPassword: CPassword, PwdToken: PwdToken, do: 'ResetPassword'},
            success: function (msg) {
                //alert(msg);
                if (msg == '1') {
                    alert('Password set Successfully');
                    window.location = 'login';
                } else {
                    alert('Password not set,Please try again ');
                }
            }
        });
    }
}
function changepassword()
{
    var password = $('#password').val();
    var CPassword = $('#Cpassword').val();
//alert(password);
//alert(CPassword);
    if (password == "") {
        alert('please enter your password');
        return false;
    }
    if (password != CPassword) {
        alert('Password & Confirm Password Not Matching');
        return false;
    }
    if ((password.length < 4) || (password.length > 8)) {
        alert("Your Password must be 4 to 8 Character");
        return false;
    }
    if (password != "" && password.match(/\ /)) {
        alert("Please enter a password without Spaces");
        return false;
    }
    if (password != "" && !password.match(/\d/)) {
        alert("At least one digit required!");
        return false;
    }
    if (password != "" && !password.match(/[a-z]/i)) {
        alert("At least one letter required!");
        return false;
    }
    if (password != "" && !password.match(/[!@#$%^&*]/)) {
        alert("password should contain atleast one special character");
        return false;
    } else {
        $.ajax({
            type: 'POST',
            url: 'ajax/email_check.php',
            data: {password: password, do: 'ChangePassword'},
            success: function (msg) {
                //alert(msg);
                if (msg == '1') {
                    alert('Password Changed Successfully');
                    window.location = 'home';
                } else {
                    alert('Password not changed,Please try again ');
                }
            }
        });
    }
}
//end of function login
//display value to user
function populateform(enterlength) {
    document.createuser.user_password.value = generatepass(enterlength);
}
//Check all the checkboxes for menu management BY SANKET
function checkAll(val) {
    var checkboxes = new Array();
    checkboxes = $(val + " input:checkbox");
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].type == 'checkbox') {
            checkboxes[i].checked = true;
        }
    }
}

//Uncheck all the checkboxes for menu management BY SANKET
function uncheckAll(val) {
    var checkboxes = new Array();
    checkboxes = $(val + " input:checkbox");
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].type == 'checkbox') {
            checkboxes[i].checked = false;
        }
    }
}
// to check whether username or email or .. exits in database
function checkfieldvalue(field_value, type, field_name, error_alert) {
    if (field_value != "") {
        jQuery.ajax({
            url: "ajax/check_email.php",
            type: "post",
            data: {"field_value": field_value, "field_name": field_name, "type": type},
            success: function (result) {
                result = result.replace(/[\r\n]/g, "");
                if (result == '1') {
                    jQuery('#' + field_name).val('');
                    jQuery('#' + field_name).focus();
                    //alert(error_alert);
                }
            }
        });
    }
}


//show wait popup
function unloadPopupBox() {    // TO Unload the Popupbox
    jQuery('.progress').fadeOut("slow").addClass('hide');
}
function loadPopupBox() {    // To Load the Popupbox
    jQuery('.progress').removeClass('hide').fadeOut("slow");
}

//To change the status of table fields

function date_range_activation(table, vsc_id, status, id_field, status_field, redirect) {
    jQuery.ajax({
        type: "post",
        url: "ajax/status_change.php",
        data: {"status": status, "id": vsc_id, "table": table, "do": "status", "id_field": id_field, "status_field": status_field},
        success: function (result) {
            alert('Status Modified');
            if (redirect != '') {
                window.location = redirect;
            }
        }
    });
}

//General function to insert data
//start of function insert data
function insert_data(table_name, redirect, form) {


//    alert(table_name);
//    alert(jQuery('#' + form.id).serialize());
//    exit;
    if (table_name == 't4m_branch_master') {
        if (CKEDITOR.instances.BranchAboutUs.getData() == '') {
            $('#CKEditorRequiredBranchAboutUs').html('<b>This field is required</b>');
            $("#CKEditorRequiredBranchAboutUs").show().delay(3000).fadeOut();
            return false;
        }
        if (CKEDITOR.instances.AboutContent.getData() == '') {
            $('#CKEditorRequiredAboutContent').html('<b>This field is required</b>');
            $("#CKEditorRequiredAboutContent").show().delay(3000).fadeOut();
            return false;
        }
    }

    if (table_name == 't4m_documents') {
        var value = $('.nicEdit-main').html();
        data += "&DocText=" + encodeURIComponent(value);
    } else if (table_name == 't4m_faq') {
        var value = $('.nicEdit-main').html();
        data += "&faq_answer=" + encodeURIComponent(value);
    } else if (table_name == 't4m_class') {
        CKEDITOR.instances.ClassDescription.updateElement();
        CKEDITOR.instances.ShortDescription.updateElement();
        CKEDITOR.instances.LongDescription.updateElement();
        CKEDITOR.instances.AboutOwner.updateElement();
        CKEDITOR.instances.AboutUs.updateElement();
        CKEDITOR.instances.OwnerSpeech.updateElement();
    }

    var data = jQuery('#' + form.id).serialize();
    if (jQuery('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: 'ajax/insert_data.php',
            data: data + "&table_name=" + table_name,
            beforeSend: function () {
                jQuery(".progress").removeClass('hide');
            },
            complete: function () {
                jQuery(".progress").addClass('hide');
            },
            success: function (data) {
//                alert(data);
                jQuery('#message').addClass('info');
                jQuery("#message").html(data).fadeIn(500).delay(5000).fadeOut();

                BootstrapDialog.show({
                    title: 'Kamet Sports Event',
                    message: data,
                    closable: false,
                    buttons: [
                        {
                            id: 'btn-add-more',
                            icon: 'fa fa-check',
                            label: 'Add More',
                            cssClass: 'btn-primary',
                            autospin: false,
                            action: function (dialogRef) {
                                dialogRef.close();
                                window.location = redirect + '&method=add';
                            }
                        }, 
                        {
                            id: 'btn-ok',
                            icon: 'fa fa-check',
                            label: 'OK',
                            cssClass: 'btn-success',
                            autospin: false,
                            action: function (dialogRef) {
                                dialogRef.close();
                                if (redirect != '') {
                                        window.location = redirect;
                                }
                            }
                        }]
                });
                unloadPopupBox();
            }
        });
    }
}
//end of function insert data
//following function redirect to update page
//start of function update data
function update(url) {
    window.location = url;
}

//General function to update data
function update_data(table_name, cond_field, cond_value, redirect, form) {

    if (table_name == 'v_documents') {
        if (CKEDITOR.instances.DocumentDescription.getData() == '') {

            $('#CKEditorRequired').html('<b>This field is required</b>');
            $("#CKEditorRequired").show().delay(3000).fadeOut();
            return false;
        } else {
            CKEDITOR.instances.DocumentDescription.updateElement();
        }
    }
    var data = $('#' + form.id).serialize();
    if (jQuery('#' + form.id).valid()) {
//(jQuery('#' + form.id).valid());
        jQuery.ajax({
            type: 'POST',
            url: "ajax/update_data.php",
            data: data + "&table_name=" + table_name + "&cond_field=" + cond_field + "&cond_value=" + cond_value,
            success: function (data) {
                // alert(data);
                BootstrapDialog.show({
                    title: 'Kamet Sports Event',
                    message: data,
                    closable: false,
                    buttons: [
//                    {
//                            id: 'btn-add-more',
//                            icon: 'fa fa-check',
//                            label: 'Add New',
//                            cssClass: 'btn-primary',
//                            autospin: false,
//                            action: function (dialogRef) {
//                                dialogRef.close();
//                                window.location = redirect + '&method=add';
//                            }
//                        }, 
                            {
                            id: 'btn-ok',
                            icon: 'fa fa-check',
                            label: 'OK',
                            cssClass: 'btn-success',
                            autospin: false,
                            action: function (dialogRef) {
                                dialogRef.close();
                                window.location = redirect;
                            }
                        }]
                });
            }
        });
    }
}
//function for check uncheck checkboxes
function check_uncheck(id, name) {
    if (jQuery('#' + id).is(':checked')) {
        jQuery('input[name=' + name + '\\[\\]]').each(function () {
            if (!jQuery(this).is(':disabled')) {
                this.checked = true;
            }
        });
    } else {
        jQuery('input[name=' + name + '\\[\\]]').each(function () {
            if (!jQuery(this).is(':disabled')) {
                this.checked = false;
            }
        });
    }
}
function alert_message_popup(redirect, data) {
    BootstrapDialog.show({
        title: 'Kamet Sports Event',
        message: data,
        closable: false,
        buttons: [{
                id: 'btn-ok',
                icon: 'glyphicon glyphicon-check',
                label: 'OK',
                cssClass: 'btn-info',
                autospin: false,
                action: function (dialogRef) {
                    dialogRef.close();
                    if (redirect != '') {
                        window.location = redirect;
                    }
                }
            }]
    });
}
//start of function change column status and delete single record
function ChangeColumnStatus(table, RecordID2Delete, FieldName2Check4Delete, Column2Change, Value2Change, Mode) {

    if (Mode == 'UPDATE') {
        var Type = 'Are you sure you want to change status for this record?';
    } else if (Mode == 'DELETE') {
        var Type = 'Are you sure you want to delete this record?';
    }

    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_WARNING,
        title: 'Confirmation',
        message: Type,
        closable: false,
        buttons: [{
                id: 'btn-ok',
                icon: 'glyphicon glyphicon-check',
                label: 'Yes',
                cssClass: 'btn-warning',
                autospin: false,
                action: function (dialogRef) {
                    jQuery.ajax({
                        type: "post",
                        url: "ajax/update_data.php",
                        data: {"RowID": RecordID2Delete, "table_name": table, "do": "DeleteRecord", "FieldName2Check4Delete": FieldName2Check4Delete, "Column2Change": Column2Change, "Value2Change": Value2Change, "Mode": Mode},
                        success: function (result) {
//                            alert(result);
                            BootstrapDialog.show({
                                title: 'Kamet Sports Event',
                                message: result,
                                closable: false,
                                buttons: [{
                                        id: 'btn-ok',
                                        icon: 'fa fa-check',
                                        label: 'OK',
                                        cssClass: 'btn-success',
                                        autospin: false,
                                        action: function (dialogRef) {
                                            dialogRef.close();
                                            window.location.reload();
                                        }
                                    }]
                            });

                        }
                    });
                }
            }, {
                id: 'btn-cancel',
                label: 'No',
                cssClass: 'btn-warning',
                autospin: false,
                action: function (dialogRef) {
                    dialogRef.close();
                }
            }]
    });
}

//end of function change column status and delete single record


function ChangeStatus(table, id, status, id_field, status_field, redirect) {

    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_WARNING,
        title: 'Confirmation',
        message: 'Are you sure you want to change status for this record?',
        closable: false,
        buttons: [{
                id: 'btn-ok',
                icon: 'glyphicon glyphicon-check',
                label: 'Yes',
                cssClass: 'btn-warning',
                autospin: false,
                action: function (dialogRef) {
                    jQuery.ajax({
                        type: "post",
                        url: "ajax/update_data.php",
                        data: {"do": "ChangeStatus", "status": status, "id": id, "table": table, "id_field": id_field, "status_field": status_field, "check_page": redirect},
                        success: function (result) {
//                            alert(result);
                            BootstrapDialog.show({
                                title: 'Kamet Sports Event',
                                message: result,
                                closable: false,
                                buttons: [{
                                        id: 'btn-ok',
                                        icon: 'fa fa-check',
                                        label: 'OK',
                                        cssClass: 'btn-success',
                                        autospin: false,
                                        action: function (dialogRef) {
                                            dialogRef.close();
                                            window.location.reload();
                                        }
                                    }]
                            });

                            if (redirect != '') {
                                window.location = redirect;
                            }
                        }
                    });
                }
            }, {
                id: 'btn-cancel',
                label: 'No',
                cssClass: 'btn-warning',
                autospin: false,
                action: function (dialogRef) {
                    dialogRef.close();
                }
            }]
    });
}
function DeleteSingleRecord(table, id, status, id_field, status_field, redirect,TablesToCheck,FieldsToCheck) {
    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_WARNING,
        title: 'Confirmation',
        message: 'Are you sure you want to Delete this record?',
        closable: false,
        buttons: [{
                id: 'btn-ok',
                icon: 'glyphicon glyphicon-check',
                label: 'Yes',
                cssClass: 'btn-warning',
                autospin: false,
                action: function (dialogRef) {
                    jQuery.ajax({
                        type: "post",
                        url: "ajax/update_data.php",
                        data: {"do": "DeleteSingleRecord", "status": status, "id": id, "table": table, "id_field": id_field, "status_field": status_field, "check_page": redirect,"TablesToCheck":TablesToCheck,"FieldsToCheck":FieldsToCheck},
                        success: function (result) {
                            alert_message_popup(redirect,result);
                        }
                    });
                }
            }, {
                id: 'btn-cancel',
                label: 'No',
                cssClass: 'btn-warning',
                autospin: false,
                action: function (dialogRef) {
                    dialogRef.close();
                }
            }]
    });
}
function edited_fields() {
    $(".edited").css("display", "block");
    $(".view").css("display", "none");
    return false;
}

function number_only(ids, e) {
    if (e.which != 8 && e.which != 9 && e.which != 0 && e.which != 110 && e.which != 13 && e.which != 144 && (e.which < 16 || e.which > 18) && (e.which < 45 || e.which > 57) && (e.which < 96 || e.which > 105) && (e.which < 33 || e.which > 41)) {
        $("#" + ids.name + "_err").text("Numeric Value Only").show().fadeOut("slow");
        var vals = ids.value.substr(0, ids.value.length - 1);
        $("#" + ids.id).val(vals);
    }
}
function add_to_cart(product_id)
{
    jQuery.ajax({
        type: 'POST',
        url: 'admin/ajax/status_change.php',
        data: {"do": "add_product_cart", "product_id": product_id},
        success: function (data) {
            window.location = "cart.php?payment=1";

        }
    });
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0)
        return '0 Bytes';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
//function to check file size before uploading.
function beforeSubmit() {
    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob) {

        if (!$('#id-input-file-2').val()) { //check empty input filed        
            $("#output").html("Are you kidding me?");
            return false
        }
        var fsize = $('#id-input-file-2')[0].files[0].size; //get file size
        var ftype = $('#id-input-file-2')[0].files[0].type; // get file type

        //allow only valid image file types 
        switch (ftype) {
            case 'image/png':
            case 'image/gif':
            case 'image/jpeg':
            case 'image/pjpeg':
                break;
            default:
                $("#output").html("<b>" + ftype + "</b> Unsupported file type!");
                return false
        }
        //Allowed file size is less than 1 MB (1048576)
        if (fsize > 1048576) {
            $("#output").html("<b>" + bytesToSize(fsize) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
            return false
        }
        $('#submit-btn').hide(); //hide submit button
        $('#loading-img').show(); //hide submit button
        $("#output").html("");
    } else {
        //Output error to older browsers that do not support HTML5 File API
        $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
        return false;
    }
}
function afterSuccess() {
    $('#submit-btn').show(); //hide submit button
    $('#loading-img').hide(); //hide submit button
    var field = $('#existing_images #MainField').text();
    $('#' + field).val('');
    $("#existing_images tbody tr").map(function (e) {
        var replacement = $(this).find('span').text();
        $('#' + field).val($('#' + field).val() + replacement + ',');
    });
    var row_id = $('#existing_images tbody').children('tr').length;
    $("#existing_images tbody tr:last").attr("id", row_id);
    $("#existing_images tbody tr:last .SaveButton").attr("id", 'save_' + row_id);
    $("#existing_images tbody tr:last .DeleteButton").attr("id", 'delete_' + row_id);
}

//start of function load state from countryid
function LoadState(CountryID, SelectedStateID, StateField, CityField, AreaField, PATH) {

    if (PATH == 'IN') {
        var URL = 'ajax/status.php';
    } else if (PATH == 'OUT') {
        var URL = 'admin/ajax/status.php';
    } else {
        var URL = 'ajax/status.php';
    }
    jQuery.ajax({
        type: 'POST',
        url: URL,
        data: {"do": "get_state", "CountryID": CountryID, "StateID": SelectedStateID},
        success: function (data) {

            $("#" + StateField).html(data);
            $("#" + CityField).html('<option value="">Select City</option>');
            $("#" + AreaField).html('<option value="">Select Area</option>');
        }
    });
}
//end of function load states by countryid

//start of function load city by stateid
function LoadCity(StateID, SelectedCityID, CityField, AreaField, PATH) {
//    alert('asdfadsf');
    var URL ;
    if (PATH == 'IN') {
         URL = 'ajax/status.php';
    } else if (PATH == 'OUT') {
         URL = 'admin/ajax/status.php';
    } else {
         URL = 'ajax/status.php';
    }
    jQuery.ajax({
        type: 'POST',
        url: URL,
        data: {"do": "get_city", "StateID": StateID, "CityID": SelectedCityID},
        success: function (data) {
//            alert(CityField);
            $("#" + CityField).select2("val","");
            $("#" + CityField).html(data);
            $("#" + AreaField).html('<option value="">Select Area</option>');
//            $("#" + CityField).select2("val", "");
        }
    });
}

//end of function load city by state id

function LoadRound(TournamentID, RoundID, PATH) {
    
    if (PATH == 'IN') {
        var URL = 'ajax/status.php';
    } else if (PATH == 'OUT') {
        var URL = 'admin/ajax/status.php';
    } else {
        var URL = 'ajax/status.php';
    }
    jQuery.ajax({
        type: 'POST',
        url: URL,
        data: {"do": "LoadRound", "TournamentID": TournamentID},
        success: function (data) {
            
            $("#" + RoundID).html(data);
            $("#" + RoundID).select2("val","");
        }
    });
}

function LoadMatch(TournamentID, MatchId, PATH) {
    var URL;
    if (PATH == 'IN') {
        URL = 'ajax/status.php';
    } else if (PATH == 'OUT') {
        URL = 'admin/ajax/status.php';
    } else {
        URL = 'ajax/status.php';
    }
    jQuery.ajax({
        type: 'POST',
        url: URL,
        data: {"do": "LoadMatch", "TournamentID": TournamentID},
        success: function (data) {
            $("#" + MatchId).html(data);
            $("#" + MatchId).select2("val","");
        }
    });
}

function LoadGround(CityID, GroundID, PATH) {
   
    if (PATH == 'IN') {
        var URL = 'ajax/status.php';
    } else if (PATH == 'OUT') {
        var URL = 'admin/ajax/status.php';
    } else {
        var URL = 'ajax/status.php';
    }
    jQuery.ajax({
        type: 'POST',
        url: URL,
        data: {"do": "LoadGround", "CityID": CityID},
        success: function (data) {
//            alert_message_popup('',data);
            $("#" + GroundID).html(data);
        }
    });
}

function LoadCourt(GroundID) {
    var URL = 'ajax/status.php';
    jQuery.ajax({
        type: 'POST',
        url: URL,
        data: {"do": "LoadCourt", "GroundID": GroundID},
        success: function (data) {
//            alert_message_popup('',data);
            $("#CourtID").html(data);
        }
    });
}

function LoadSets(RoundID,SetID, PATH) {
//    alert(PATH);
    var URL;
    if (PATH == 'IN') {
        URL = 'ajax/status.php';
    } else if (PATH == 'OUT') {
        URL = 'admin/ajax/status.php';
    } else {
        URL = 'ajax/status.php';
    }
    jQuery.ajax({
        type: 'POST',
        url: URL,
        data: {"do": "LoadSets", "RoundID": RoundID},
        success: function (data) {
//            alert(data);
            $("#" + SetID).html(data);
        }
    });
}

function GetCities(e, flag) {

    var StateID = e.value;
    if (flag == 'in') {
        var url = "../class/class.ajaxRequest.php";
    } else {
        var url = "class/class.ajaxRequest.php";
    }
    if (StateID != '') {
        $.ajax({
            type: 'POST',
            url: url,
            data: {'do': 'GetCities', 'StateID': StateID},
            success: function (result) {
//                alert(result);
                $('#CityID').html(result);
                $('#AreaID').html('<option value="">Select Area</option>');
                $("#CityID").select2("val","");
            }
        });
    } else {
        return false;
    }
}
function GetAreas(e, flag) {

    //var CountrySrNo = $('#CountrySrNo').val();
    var CityID = e.value;
    if (flag == 'in') {
        var url = "../class/class.ajaxRequest.php";
    } else {
        var url = "class/class.ajaxRequest.php";
    }
    if (CityID != '-') {
        $.ajax({
            type: 'POST',
            url: url,
            data: {'do': 'GetAreas', 'CityID': CityID},
            success: function (result) {
//                alert(result);
                $('#AreaID').html(result);
            }
        });
    } else {
        return false;
    }
}

function SendForgotPasswordToken(emailID)
{
    var email = $('#' + emailID).val();
    if (email != '') {
        jQuery.ajax({
            type: 'POST',
            url: "class/class.ajaxRequest.php",
            data: {EmailID: email, do: 'SendForgotPasswordToken'},
            success: function (result) {
                var data = $.parseJSON(result);
                var UserID = data.UserID;
                alert_message_popup('setpassword?UserID=' + UserID, "Token Sent To Your Email Successfully");
            }
        });
    } else {
        alert_message_popup('', 'Email ID cannot be empty');
    }
}

function ChangePassword(NewPasswordID, ConfirmPasswordID, TokenID, UserIDID)
{
    var Password = $('#' + NewPasswordID).val();
    var ConfirmPassword = $('#' + ConfirmPasswordID).val();
    var PasswordToken = $('#' + TokenID).val();
    var UserID = $('#' + UserIDID).val();
    if (Password == ConfirmPassword) {
        if (PasswordToken != '') {
            jQuery.ajax({
                type: 'POST',
                url: "class/class.ajaxRequest.php",
                data: {Password: Password, PasswordToken: PasswordToken, UserID: UserID, do: 'ChangePasswordPassword'},
                success: function (result) {
                    var data = $.parseJSON(result);
                    if(data.ResponseCode == '1'){
                       alert_message_popup('login', data.Message); 
                    }else{
                       alert_message_popup('', data.Message);  
                    }
                }
            });
        } else {
            alert_message_popup('', 'Password Token Cannot Be Empty');
        }
    } else {
        alert_message_popup('', 'Password and Confirm password does not match');
    }
}

function login(redirect_url) {

    var UserName = $("#LoginUserID").val();
    var Password = $("#LoginPassword").val();

//    alert('asdfasdf');
    if (UserName != '' && Password != '') {
        $('.alert_box_error').hide();
        $('.alert_box_error').hide();

        jQuery.ajax({
            type: 'POST',
            url: "class/class.ajaxRequest.php",
            data: {UserName: UserName, Password: Password, do: 'KametLogin'},
            beforeSend: function () {
                $('.alert_box_success').show();
                $('.alert_box_success').html('Please wait...');
            },
            success: function (result) {
//                alert(result);
//                return false;
                //alert_message_popup('',result);
                var data = $.parseJSON(result);
                $('.alert_box_success').show();
                $('.alert_box_success').html(data['Message']);

                if (data.ResponseCode == 1) {

                    $('.alert_box_success').show();
                    $('.alert_box_error').hide();
                    $('.alert_box_success').html(data.SuccessMessage);
                    if (redirect_url != '') {
                        window.location = 'admin/' + redirect_url;
                    } else {
                        window.location = 'admin/home';
                    }
                } else {
//                    $('.alert_box_success').hide();
                    $('.alert_box_error').show();
                    $('.alert_box_error').html(data.SuccessMessage);
                }
            }
        });
    } else {
        $('.alert_box_success').hide();
        $('.alert_box_error').show();
        $('.alert_box_error').html('<strong>Sorry...!</strong> Username/Password fields are required');
    }

}
function DeclineReason() {
//    alert('asdfasdf');
//    return false;
    var FirstName = $("#FirstName").val();
    var TeamID = $("#TeamID").val();
    var LastName = $("#LastName").val();
    var EmailID = $("#EmailID").val();
    var UserID = $("#UserID").val();
    var CaptainID = $("#CaptainID").val();
    var DeclineReason = $("#DeclineReason").val();
    var TournamentID = $("#TournamentID").val();
    var TeamTournamentRelationID = $("#TeamTournamentRelationID").val();
   if(DeclineReason != ''){
       $('#DeclineResonSpan').text('');
        jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: {TeamID:TeamID, CaptainID:CaptainID,TournamentID:TournamentID, UserID:UserID,EmailID: EmailID, FirstName: FirstName, LastName: LastName, DeclineReason: DeclineReason, TeamTournamentRelationID:TeamTournamentRelationID, do: 'DeclineReason'},

        beforeSend: function () {
            $("#common_wait").css("display", "block");
            $("#common_wait").css("position", "fixed");
            $("#common_wait").css("margin-left", "700px");
            $("#common_wait").css("opacity", "1000");
        },
        complete: function () {
            $("#Loading").css("display", "none");
        },
        success: function (result) {
//            alert('asdfads');
//                    alert_message_popup('',result);
            alert_message_popup('view_tournament_teams&method=edit&TeamID='+TeamID+'&TournamentID='+TournamentID, "User Request Declined");

        }
    });
   }else{
       $('#DeclineResonSpan').text('This Field Is Required');
   }
   
}
function AprroveRequest(URL) {
    var TeamID = $("#TeamID").val();
    var UserID = $("#UserID").val();
    var TournamentID = $("#TournamentID").val();
    var CaptainID = $("#CaptainID").val();
    var TeamTournamentRelationID = $("#TeamTournamentRelationID").val();
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: {UserID: UserID, TeamID:TeamID,TournamentID:TournamentID,CaptainID:CaptainID,TeamTournamentRelationID:TeamTournamentRelationID, do: 'AprroveRequest'},
        success: function (result) {
            alert_message_popup('view_tournament_teams&method=edit&' +URL, "Request Approved");
        }
    });
}

function update_user_data(form,Flag) {
    var Redirect;
    if(Flag == 'Admin'){
        Redirect = 'view_users';
    }else{
        Redirect = 'my_profile';
    }
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=update_user_data",
            success: function (result) {
                var data = $.parseJSON(result);
                alert_message_popup(Redirect, data.Message);
            }
        });
    }
}
function InsertTournamentData(form) {
    CKEDITOR.instances.TournamentRules.updateElement();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: $('#' + form.id).serialize() + "&do=InsertTournamentData",
            success: function (result) {
//                alert_message_popup('',result);
                alert_message_popup('view_tournament', "Tournament Created Successfully!");

            }
        });
    }
}
function UpdateTournamentData(form) {
//    alert('da');
    CKEDITOR.instances.TournamentRules.updateElement();
    var data = $('#' + form.id).serialize();
//    alert(data);
//    return false;
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=UpdateTournamentData",
            success: function (result) {
//                alert(result);
                alert_message_popup('view_tournament', "Tournament Data Updated Successfully!");

            }
        });
    }
}


function InsertGroupData(form) {
    var TournamentID = $("#TournamentID").val();
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertGroupData",
            success: function (result) {
                alert_message_popup('view_groups&TournamentID='+TournamentID, "Group Created Successfully!");

            }
        });
    }
}

function SaveFinalTeamForTournament(TeamID,TournamentID) {
    
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
//            data: data + "&do=InsertGroupData",
            data: {"TeamID": TeamID, "TournamentID": TournamentID, "do": "SaveFinalTeamForTournament"},
            success: function (result) {
//                alert_message_popup('',result);
                var data = JSON.parse(result);
                alert_message_popup('view_tournament_teams&TournamentID='+TournamentID, data.Message);

            }
        });
}

function UpdateGroupData(form) {
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=UpdateGroupData",
            success: function (result) {
                alert_message_popup('view_groups', "Data Save Successfully");

            }
        });
    }
}


function InsertSetData(form) {
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertSetData",
            success: function (result) {
                alert_message_popup('view_set_master', "Data Save Successfully");

            }
        });
    }
}
function UpdateSetData(form) {
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=UpdateSetData",
            success: function (result) {
                alert_message_popup('view_set_master', "Data Save Successfully");

            }
        });
    }
}

function InsertCourtData(form) {
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertCourtData",
            success: function (result) {
//                alert(result);
                alert_message_popup('view_court_master', "Court Data Save Successfully");

            }
        });
    }
}
function UpdateCourtData(form) {
    var data = $('#' + form.id).serialize();
//    alert(data);
//    return false;
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=UpdateCourtData",
            success: function (result) {
//                alert(result);
                alert_message_popup('view_court_master', "Court Data Updated Successfully");

            }
        });
    }
}

function InsertGroundData(form) {
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertGroundData",
            success: function (result) {
//                alert(result);
                alert_message_popup('view_ground_master', "Ground Data Save Successfully");

            }
        });
    }
}
function UpdateGroundData(form) {
    var data = $('#' + form.id).serialize();
//    alert(data);
//    return false;
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=UpdateGroundData",
            success: function (result) {
//                alert(result);
                alert_message_popup('view_ground_master', "Ground Data Updated Successfully");

            }
        });
    }
}

function InsertMatchScheduleData(form) {
    var TournamentID = $("#TournamentID").val();
    var RoundID = $("#RoundID").val();
    var StateID = $("#StateID").val();
    var CityID = $("#CityID").val();
    var CourtID = $("#CourtID").val();
    var GroundID = $("#GroundID").val();
    var MatchDate = $("#MatchDate").val();
    var Time = $("#MatchTime").val();
    var MatchTime =Time.replace(':', '@');
    var MatchType = $('input[name=MatchType]:checked', '#form').val();
    var Redirect ="view_match_schedule&method=add&TournamentID=" + TournamentID + "&MatchType=" + MatchType + "&RoundID=" + RoundID + "&StateID=" + StateID + "&CityID=" + CityID + "&CourtID=" + CourtID + "&GroundID=" + GroundID + "&MatchDate=" + MatchDate + "&MatchTime=" + MatchTime;
    
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertMatchScheduleData",
            success: function (result) {
                var data = $.parseJSON(result);
//                alert('call');
//                alert_message_popup('',result);data.Message
                alert_message_popup( Redirect, data.Message);

            }
        });
    }
}
function UpdateMatchScheduleData(form) {
    var data = $('#' + form.id).serialize();
//    alert(data);
//    return false;
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=UpdateMatchScheduleData",
            success: function (result) {
                alert(result);
                alert_message_popup('view_court_master', "Data Save Successfully");

            }
        });
    }
}

function InsertRoundData(form) {
    var data = $('#' + form.id).serialize();
//    alert(data);
//    return false;
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertRoundData",
            success: function (result) {
//                alert(result);
                alert_message_popup('view_rounds', "Data Save Successfully");

            }
        });
    }
}
function UpdateRoundData(form) {
//    alert('asdfasdfadsfasdfaf');
//    return false;
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=UpdateRoundData",
            success: function (result) {
//                alert_message_popup('',result);
                alert_message_popup('view_rounds', "Data Save Successfully");

            }
        });
    }
}

function InsertRoundPointsData(form) {
    var TournamentID = $("#TournamentID").val();
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertRoundPointsData",
            success: function (result) {
//                alert(result);
                alert_message_popup('view_rounds_points&TournamentID='+TournamentID, "Data Save Successfully");

            }
        });
    }
}
function UpdateRoundPointsData(form) {
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=UpdateRoundPointsData",
            success: function (result) {
                alert_message_popup('view_rounds_points', "Data Save Successfully");

            }
        });
    }
}

function InsertTeamData() {
//    alert('call');
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertTeamData",
            success: function (result) {
                var savedata = $.parseJSON(result);
//                alert(savedata.Message);
                alert_message_popup('view_team', savedata.Message);

            }
        });
    }
}
function UpdateTeamData() {
//    alert('da');
    var data = $('#' + form.id).serialize();
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=UpdateTeamData",
            success: function (result) {
//                alert(result);
                alert_message_popup('view_team', "Data Save Successfully");

            }
        });
    }
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
        if (flag == 'in') {
            url = "../admin/upload.php";
            src = "../admin/uploads/ajax_loading.gif";
            previewpath = "uploads/";
        } else {
            url = "admin/upload.php";
            src = "admin/uploads/ajax_loading.gif";
            previewpath = "admin/uploads/";
        }
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
//                else if (savedata.trim() == 0) {
//                    //alert(SpanID);
//                    $("#" + Loading).hide();
//                    $('#' + Response).html("");
//                    $('#' + SpanID).html('<strong>Oops !!</strong> Invalid.');
//                    $('input[type=file]').val('');
//
//                } 
//                else if (savedata.trim() == 1) {
//
//                    $('#' + SpanID).html('<strong>Oops !!</strong> maximum upload file size 1mb.');
//                    $('input[type=file]').val('');
//                    $("#" + Loading).hide();
//                    $('#' + Response).hide();
//                }
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
function SearchPlayersData() {
    var CityID = $("#CityID").val();
    var AreaID = $("#AreaID").val();
    var PlayerName = $("#PlayerName").val();
    var CaptainID = $("#CaptainID").val();
    var CaptainAge = $("#CaptainAge").val();
    var CaptainGender = $("#CaptainGender").val();
    var BodyType = $('#BodyTypeSelection').val();
    var FavoritePosition = $('#FavoritePositionSelection').val();
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: {"CityID": CityID, "AreaID": AreaID, "PlayerName": PlayerName, "CaptainID" : CaptainID,"CaptainAge" : CaptainAge,"CaptainGender" : CaptainGender, "BodyType":BodyType, "FavoritePosition":FavoritePosition, "do": "SearchPlayersData"},
            success: function (result) {
                $('#ErrorSpan').text('');
                $('#PlayerData').html(result);
            }
        });
}
function SaveTeamPlayer() {
    var TeamID = $("#TeamIDToJoin").val();
    var CaptainID = $("#CaptainID").val();
    var RoleID = $("#RoleID").val();
    var PlayerList = '';
    $('input[type=checkbox]').each(function () {
        if (this.checked) {
            PlayerList +=this.id+',';
        }
    });
    if(PlayerList != ''){
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: {"PlayerList": PlayerList, "TeamID": TeamID, "RoleID": RoleID, "CaptainID": CaptainID, "do": "SaveTeamPlayer"},
        beforeSend: function () {
            $("#Loading").css("display", "block");
            $("#Loading").css("position", "fixed");
            $("#Loading").css("margin-left", "700px");
            $("#Loading").css("opacity", "1000");
        },
        complete: function () {
            $("#Loading").css("display", "none");
        },
        success: function (result) {
            var savedata = $.parseJSON(result);
            alert_message_popup('view_team', savedata.Message);
        }
    });
   }else{
        alert_message_popup('','Please Select Players First To Send Invitation');
   }
}
function ApproveTeamJoinRequest(RelationIDIDApprove, NotificationIDIDApprove,PlayerIDIDApprove,CaptainIDIDApprove,TeamIDIDApprove) {
//    alert('asdfasdf');
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: {RelationID:RelationIDIDApprove,NotificationID:NotificationIDIDApprove,PlayerID: PlayerIDIDApprove, CaptainID: CaptainIDIDApprove, TeamID: TeamIDIDApprove, do: 'ApproveTeamJoinRequest'},
        success: function (result) {
            var data = $.parseJSON(result);
            alert_message_popup('accept_join_team_request', data.Message);
        }
    });
}
function RejectTeamJoinRequest(RelationIDID, NotificationIDID, TeamRejectReasonID) {
    var RelationID = $("#"+RelationIDID).val();
    var NotificationID = $("#"+NotificationIDID).val();
    var RejectReason = $("#"+TeamRejectReasonID).val();
//    alert(RejectReason);
//    return false;
    if(RejectReason == ''){
        RejectReason = 'Not Interested';
    }
//    if(RejectReason != ''){
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: {RelationID: RelationID, NotificationID:NotificationID, RejectReason: RejectReason, do: 'RejectTeamJoinRequest'},
        success: function (result) {
             var data = $.parseJSON(result);
            alert_message_popup('accept_join_team_request',data.Message);
        }
    });
//    }else{
//        $("#RejectReasonErrorSpan").text('This field is required');
//        return false;
//    }
}

function AcceptBecomeCaptainRequest(SwitchCaptainshipID, BecomeCaptainPlayerID,BecomeCaptainCaptainID,BecomeCaptainTeamID) {

    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: {SwitchCaptainshipID:SwitchCaptainshipID,PlayerID: BecomeCaptainPlayerID, CaptainID: BecomeCaptainCaptainID, TeamID: BecomeCaptainTeamID, do: 'AcceptBecomeCaptainRequest'},
        success: function (result) {
        var data = $.parseJSON(result);
        alert_message_popup('accept_join_team_request', data.Message);
        }
    });
}
function RejectBecomeCaptainRequest(SwitchCaptainshipID, BecomeCaptainPlayerID,BecomeCaptainCaptainshipRejectReason,BecomeCaptainTeamID) {

    var SwitchCaptainshipIDID = $("#"+SwitchCaptainshipID).val();
    var PlayerID = $("#"+BecomeCaptainPlayerID).val();
    var ReajectCaptainshipReason = $("#"+BecomeCaptainCaptainshipRejectReason).val();
    var TeamID = $("#"+BecomeCaptainTeamID).val();
    if(ReajectCaptainshipReason != ''){
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: {SwitchCaptainshipID: SwitchCaptainshipIDID, PlayerID:PlayerID, ReajectCaptainshipReason: ReajectCaptainshipReason,TeamID: TeamID, do: 'RejectBecomeCaptainRequest'},
        success: function (result) {
             var data = $.parseJSON(result);
            alert_message_popup('accept_join_team_request',data.Message);
        }
    });
    }else{
        $("#RejectReasonErrorSpan").text('This field is required');
        return false;
    }
}


function RemoveFromTeam(PlayerIDID,TeamIDID, RelationIDID, ReasonForLeaveTeam) {
    var PlayerID = $("#"+PlayerIDID).val();
    var TeamID = $("#"+TeamIDID).val();
    var RelationID = $("#"+RelationIDID).val();
    var RemovingReason = $("#"+ReasonForLeaveTeam).val();
    if(RemovingReason != ''){
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: {PlayerID: PlayerID, TeamID:TeamID, RelationID: RelationID,RemovingReason:RemovingReason, do: 'RemoveFromTeam'},
        success: function (result) {
//            alert_message_popup('',result);
             var data = $.parseJSON(result);
            alert_message_popup('view_team',data.Message);
        }
    });
    }else{
        $("#RemovingReasonErrorSpan").text('This field is required');
        return false;
    }
}
function InsertMatchScore(form,TournamentID) {
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: jQuery('#' + form.id).serialize() + "&do=InsertMatchScore",
            success: function (result) {
                alert_message_popup('view_match_score_entry', "Match Score Saved Successfully");
            }
        });
    }
}

function ViewRejectReason(Reason) {
    $('#RejectReason').text(Reason);
}