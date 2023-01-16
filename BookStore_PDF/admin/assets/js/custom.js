
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
//    alert(data);
//    return false;
    if (jQuery('#' + form.id).valid()) {
//         alert(data);
//         return false;
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
                alert(data);
                return false;
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
    var data = $('#' + form.id).serialize();
//    alert(data);
//return false;
//    if (jQuery('#' + form.id).valid()) {  
//(jQuery('#' + form.id).valid());
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&table_name=" + table_name + "&cond_field=" + cond_field + "&cond_value=" + cond_value + "&do=" + "update_data_book",
        success: function (data) {
//                 alert(data);
//                 return false;
            BootstrapDialog.show({
                title: 'Punahal Law House',
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
//    }
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
        title: 'Punhal Law House',
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
//alert("call");
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
                        url: "../class/class.ajaxRequest.php",
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
function DeleteSingleRecord(table, id, status, id_field, status_field, redirect, TablesToCheck, FieldsToCheck) {
//    alert("call");
//    return false;
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
                        url: "../class/class.ajaxRequest.php",
                        data: {"do": "DeleteSingleRecord", "status": status, "id": id, "table": table, "id_field": id_field, "status_field": status_field, "check_page": redirect, "TablesToCheck": TablesToCheck, "FieldsToCheck": FieldsToCheck},
                        success: function (result) {
//                            alert(result);
                            alert_message_popup(redirect, "Record Deleted");
                        }
                    });
                }
            }
            , {
                id: 'btn-cancel',
                label: 'No',
                cssClass: 'btn-warning',
                autospin: false,
                action: function (dialogRef) {
                    dialogRef.close();
                }
            }
        ]
    });
}

function RemoveRetailerBook(table, id, status, id_field, status_field, redirect) {
//    alert("call");
//    return false;

    jQuery.ajax({
        type: "post",
        url: "../class/class.ajaxRequest.php",
        data: {"do": "RemoveRetailerBook", "status": status, "id": id, "table": table, "id_field": id_field, "status_field": status_field, "check_page": redirect},
        success: function (result) {
//                            alert(result);
            alert_message_popup(redirect, result);
        }
    });

//    BootstrapDialog.show({
//        type: BootstrapDialog.TYPE_WARNING,
//        title: 'Confirmation',
//        message: 'Are you sure you want to Delete this record?',
//        closable: false,
//        buttons: [{
//                id: 'btn-ok',
//                icon: 'glyphicon glyphicon-check',
//                label: 'Yes',
//                cssClass: 'btn-warning',
//                autospin: false,
//                action: function (dialogRef) {
//                    
//                }
//            }
//            , {
//                id: 'btn-cancel',
//                label: 'No',
//                cssClass: 'btn-warning',
//                autospin: false,
//                action: function (dialogRef) {
//                    dialogRef.close();
//                }
//            }
//        ]
//    });
}

function RemoveUserBook(table, id, status, id_field, status_field, redirect) {
//    alert("call");
//    return false;

    jQuery.ajax({
        type: "post",
        url: "../class/class.ajaxRequest.php",
        data: {"do": "RemoveRetailerBook", "status": status, "id": id, "table": table, "id_field": id_field, "status_field": status_field, "check_page": redirect},
        success: function (result) {
//                            alert("call");
            alert_message_popup('', result);
//                            alert_message_popup(redirect,result);
        }
    });

//    BootstrapDialog.show({
//        type: BootstrapDialog.TYPE_WARNING,
//        title: 'Confirmation',
//        message: 'Are you sure you want to Delete this record?',
//        closable: false,
//        buttons: [{
//                id: 'btn-ok',
//                icon: 'glyphicon glyphicon-check',
//                label: 'Yes',
//                cssClass: 'btn-warning',
//                autospin: false,
//                action: function (dialogRef) {
//                    
//                }
//            }
//            , {
//                id: 'btn-cancel',
//                label: 'No',
//                cssClass: 'btn-warning',
//                autospin: false,
//                action: function (dialogRef) {
//                    dialogRef.close();
//                }
//            }
//        ]
//    });
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
        data: {"do": "get_city", "StateID": StateID, "CityID": SelectedCityID},
        success: function (data) {
//            alert(CityField);
            $("#" + CityField).select2("val", "");
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
            $("#" + RoundID).select2("val", "");
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
            $("#" + MatchId).select2("val", "");
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

function LoadSets(RoundID, SetID, PATH) {
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
                $("#CityID").select2("val", "");
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
                    if (data.ResponseCode == '1') {
                        alert_message_popup('login', data.Message);
                    } else {
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
function UserLogin(form) {
    alert("call");
    return false;
    var data = $('#' + form.id).serialize();

    jQuery.ajax({
        type: 'POST',
        url: "class/class.ajaxRequest.php",
        data: data + "&do=UserLogin",
        success: function (result) {
            alert(result);
            return false;
            var data = $.parseJSON(result);
            if (data.RedirectMsg == 'Admin' && data.RedirectMsg != 'Agent' && data.RedirectMsg != 'User') {
                window.location = "admin/home";
                return false;
            } else if (data.RedirectMsg == 'Agent' && data.RedirectMsg != 'Admin' && data.RedirectMsg != 'User') {
//                    alert("call");
                window.location = "admin/home";
                return false;
            } else if (data.RedirectMsg == 'User' && data.RedirectMsg != 'Agent' && data.RedirectMsg != 'Admin') {
                window.location = "index.php";
                return false;
            }

        }
    });
//    }
}
//function UserLogin(redirect_url) {
//alert("call");
//return false;
//    var UserName = $("#LoginUserID").val();
//    var Password = $("#LoginPassword").val();
//
////    alert('asdfasdf');
//    if (UserName != '' && Password != '') {
//        $('.alert_box_error').hide();
//        $('.alert_box_error').hide();
//
//        jQuery.ajax({
//            type: 'POST',
//            url: "class/class.ajaxRequest.php",
//            data: {UserName: UserName, Password: Password, do: 'KametLogin'},
//            beforeSend: function () {
//                $('.alert_box_success').show();
//                $('.alert_box_success').html('Please wait...');
//            },
//            success: function (result) {
//                
//                
//                var data = $.parseJSON(result);
//                if (data.RedirectMsg == 'Admin' && data.RedirectMsg != 'Agent' && data.RedirectMsg != 'User') {
//                    window.location = "admin/home";
//                    return false;
//                } else if (data.RedirectMsg == 'Agent' && data.RedirectMsg != 'Admin' && data.RedirectMsg != 'User') {
////                    alert("call");
//                    window.location = "admin/home";
//                    return false;
//                }else if (data.RedirectMsg == 'User' && data.RedirectMsg != 'Agent' && data.RedirectMsg != 'Admin') {
//                    window.location = "index.php";
//                    return false;
//                }
////                alert(result);
////                return false;
//                //alert_message_popup('',result);
////                var data = $.parseJSON(result);
////                $('.alert_box_success').show();
////                $('.alert_box_success').html(data['Message']);
////
////                if (data.ResponseCode == 1) {
////
////                    $('.alert_box_success').show();
////                    $('.alert_box_error').hide();
////                    $('.alert_box_success').html(data.SuccessMessage);
////                    if (redirect_url != '') {
////                        window.location = 'admin/' + redirect_url;
////                    } else {
////                        window.location = 'admin/home';
////                    }
////                } else {
//////                    $('.alert_box_success').hide();
////                    $('.alert_box_error').show();
////                    $('.alert_box_error').html(data.SuccessMessage);
////                }
//            }
//        });
//    } else {
//        $('.alert_box_success').hide();
//        $('.alert_box_error').show();
//        $('.alert_box_error').html('<strong>Sorry...!</strong> Username/Password fields are required');
//    }
//
//}
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
    if (DeclineReason != '') {
        $('#DeclineResonSpan').text('');
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: {TeamID: TeamID, CaptainID: CaptainID, TournamentID: TournamentID, UserID: UserID, EmailID: EmailID, FirstName: FirstName, LastName: LastName, DeclineReason: DeclineReason, TeamTournamentRelationID: TeamTournamentRelationID, do: 'DeclineReason'},
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
                alert_message_popup('view_tournament_teams&method=edit&TeamID=' + TeamID + '&TournamentID=' + TournamentID, "User Request Declined");

            }
        });
    } else {
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
        data: {UserID: UserID, TeamID: TeamID, TournamentID: TournamentID, CaptainID: CaptainID, TeamTournamentRelationID: TeamTournamentRelationID, do: 'AprroveRequest'},
        success: function (result) {
            alert_message_popup('view_tournament_teams&method=edit&' + URL, "Request Approved");
        }
    });
}

function update_user_data(form, Flag) {
    var Redirect;
    if (Flag == 'Admin') {
        Redirect = 'view_users';
    } else {
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
                alert_message_popup('view_groups&TournamentID=' + TournamentID, "Group Created Successfully!");

            }
        });
    }
}

function SaveFinalTeamForTournament(TeamID, TournamentID) {

    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
//            data: data + "&do=InsertGroupData",
        data: {"TeamID": TeamID, "TournamentID": TournamentID, "do": "SaveFinalTeamForTournament"},
        success: function (result) {
//                alert_message_popup('',result);
            var data = JSON.parse(result);
            alert_message_popup('view_tournament_teams&TournamentID=' + TournamentID, data.Message);

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

function InsertStateData(form) {

    var data = $('#' + form.id).serialize();
//    alert(data);
    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertStateData",
            success: function (result) {
//                alert(result);
//                return false;
                alert_message_popup('view_state', "Data Save Successfully");

            }
        });
    }
}

function InsertCityData(form) {

    var data = $('#' + form.id).serialize();
//    alert(data);
//    if ($('#' + form.id).valid()) {
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertCityData",
        success: function (result) {
            alert(result);
            return false;
            alert_message_popup('view_city', "Data Save Successfully");

        }
    });
//    }
}

function InsertAreaData(form) {

    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertAreaData",
        success: function (result) {
            alert(result);
            alert_message_popup('view_area', "Data Save Successfully");
        }
    });
//    }
}

function InsertBookData(form) {

    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertBookData",
        success: function (result) {
//                alert_message_popup('',result);
            alert_message_popup('view_book_master', "Data Save Successfully");
        }
    });
//    }
}
function InsertBookQuantityData(form) {

    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertBookQuantityData",
        success: function (result) {
//                alert(result);
            alert_message_popup('view_book_quantity', "Data Save Successfully");
        }
    });
//    }
}
function InsertAgentBookStockData(form) {
    var Price = $('#BookPrice').val();
    var AgentID = $('#AgentID').val();
    if (Price != '') {
        var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertAgentBookStockData",
            success: function (result) {
//                alert_message_popup('',result);
//                return false;
                alert_message_popup('view_agent_books_orders&method=sendbook&AgentID=' + AgentID, "Book Added To Agent Stock");
            }
        });
//    }
    } else {
        alert_message_popup('view_agent_books_orders&method=sendbook&AgentID=' + AgentID);
    }

}
function InsertOnBehalfOFAgentBookStockData(form) {
    var Price = $('#BookPrice').val();
    var AgentID = $('#AgentID').val();
//    if(Price != ''){
    var data = $('#' + form.id).serialize();
//        alert(data);
//    if ($('#' + form.id).valid()) {
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertOnBehalfOFAgentBookStockData",
        success: function (result) {
//                alert_message_popup('',result);
//                return false;
            alert_message_popup('view_sell_books_behalf_of_agent&AgentID=' + AgentID, "Book Sell On Behalf Of Agent");
        }
    });
//    }
//    }else{
//        alert_message_popup('view_agent_books_orders&method=sendbook&AgentID='+AgentID);
//    }

}
function InsertAgentData(form, Flag) {
//alert("call");
//return false;
    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertAgentData&Flag=" + Flag,
        success: function (result) {
//                alert(result);
//                alert_message_popup('',result);
            if (Flag == 'Retailer') {
                alert_message_popup('view_retailers_details', "Data Save Successfully");
            } else {
                alert_message_popup('view_agents_details', "Data Save Successfully");
            }

        }
    });
//    }
}

function SendSMSUsers() {
//alert("call");
    $("#UserRoleID").val();
    $("#UserMsg").val();
//    $("#Userchk").val();
//    var users = $('#Userchk').prop('checked').val();
//    var users =  $('#Userchk:checked').val();
    var users = $('#Userchk').attr('checked').val();
    alert(users);
    return false;
    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertSMSData&Flag=" + Flag,
        success: function (result) {
//                alert(result);
//                alert_message_popup('',result);
            if (Flag == 'Retailer') {
                alert_message_popup('view_retailers_details', "Data Save Successfully");
            } else {
                alert_message_popup('view_agents_details', "Data Save Successfully");
            }

        }
    });
//    }
}

function InsertRetailerOpeningBalanceData(form) {
    var CheckBox = $('input[id=BalanceType1]:checked').val();
    var ChequeNo = $('#ChequeNo').val();
    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {

    if (CheckBox == 'Cheque') {
        if (ChequeNo != '') {
            jQuery.ajax({
                type: 'POST',
                url: "../class/class.ajaxRequest.php",
                data: data + "&do=InsertRetailerOpeningBalanceData",
                success: function (result) {
                    alert_message_popup('view_retailers_balance_details', "Data Save Succesfully");
                    return false;
                }
            });
        } else {
            alert_message_popup('', "Cheque No is Required");
            return false;
        }
    } else {
//        alert("yes");
//        return false;
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertRetailerOpeningBalanceData",
            success: function (result) {
                alert_message_popup('view_retailers_balance_details', "Data Save Succesfully");
                return false;
            }
        });
    }
//    }
}


function InsertRetailerOpeningBalance(form) {
    var CheckBox = $('input[id=BalanceType1]:checked').val();
    var ChequeNo = $('#ChequeNo').val();
    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {

    if (CheckBox == 'Cheque') {
        if (ChequeNo != '') {
            jQuery.ajax({
                type: 'POST',
                url: "../class/class.ajaxRequest.php",
                data: data + "&do=InsertRetailerOpeningBalanceData",
                success: function (result) {
                    alert_message_popup('view_retailers_balance_details', "Data Save Succesfully");
                    return false;
                }
            });
        } else {
            alert_message_popup('', "Cheque No is Required");
            return false;
        }
    } else {

        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertRetailerOpeningBalance",
            success: function (result) {
//                alert_message_popup('',result );
//                return false;
                alert_message_popup('view_retailers_opening_balance_details', "Data Save Succesfully");
                return false;
            }
        });
    }
//    }
}


function InsertGeneralUserBalanceData(form) {
    var CheckBox = $('input[id=BalanceType1]:checked').val();
    var ChequeNo = $('#ChequeNo').val();
    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {

    if (CheckBox == 'Cheque') {
        if (ChequeNo != '') {
            jQuery.ajax({
                type: 'POST',
                url: "../class/class.ajaxRequest.php",
                data: data + "&do=InsertGeneralUserBalanceData",
                success: function (result) {
                    alert_message_popup('view_general_user_make_payment', "Data Save Succesfully");
                    return false;
                }
            });
        } else {
            alert_message_popup('', "Cheque No is Required");
            return false;
        }
    } else {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertGeneralUserBalanceData",
            success: function (result) {
                alert_message_popup('view_general_user_make_payment', "Data Save Succesfully");
                return false;
            }
        });
    }
//    }
}
function Call() {
    $('input:radio').click(function () {
//        alert('call');
        $("#ChequeNo").prop("disabled", true);
        $("#BankName").prop("disabled", true);
        if ($(this).hasClass('enable_tb')) {
            $("#ChequeNo").prop("disabled", false);
            $("#BankName").prop("disabled", false);
        }
    });
}
function InsertRetailerBookStockData(form) {
    var Price = $('#BookPrice').val();
    var RetailerID = $('#RetailerID').val();
//    alert(AgentID);
//    return false;
    if (Price != '') {
        var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertRetailerBookStockData",
            success: function (result) {
//                alert_message_popup('',result);
//                return false;
                alert_message_popup('view_retailer_books_orders&method=sendbook&RetailerID=' + RetailerID, "Book Added To Agent Stock");
            }
        });
//    }
    } else {
        alert_message_popup('view_retailer_books_orders&method=sendbook&RetailerID=' + RetailerID);
    }

}

function InsertUserBookStockData(form) {
    var Price = $('#BookPrice').val();
    if (Price != '') {
        var data = $('#' + form.id).serialize();
//        alert(data);
//        return false;
//    if ($('#' + form.id).valid()) {
//        alert("call");
//        return false;
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            data: data + "&do=InsertUserBookStockData",
            success: function (result) {
//                alert("call");
//                alert_message_popup('',result);
//                return false;
                var resultdata = $.parseJSON(result);
//                 console.log(resultdata.UserID);
                alert_message_popup('view_general_user_details&method=add&UserID=' + resultdata.UserID, "Book Added To User Stock");
            }
        });
//    }
    } else {
        alert_message_popup('view_general_user_details&method=add');
    }

}

function InsertClientData(form, Flag) {

    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertClientData&Flag=" + Flag,
        success: function (result) {
//                alert(result);
            alert_message_popup('view_add_clients', "Data Save Successfully");
        }
    });
//    }
}
function InsertExpenseData(form) {

    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertExpenseData",
        success: function (result) {
//                alert(result);
            alert_message_popup('view_expense_details', "Data Save Successfully");
        }
    });
//    }
}
function InsertCreditNoteData(form) {

    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {
//        alert(data);
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertCreditNoteData",
        success: function (result) {
//            alert(result);
            alert_message_popup('view_credit_note', "Data Save Successfully");
        }
    });
//    }
}

function InsertCategoryData(form) {

    var data = $('#' + form.id).serialize();
//    if ($('#' + form.id).valid()) {
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertCategoryData",
        success: function (result) {
//                alert(result);
            window.location = "view_category_master"
//                alert_message_popup('view_category_mastster', "Data Save Successfully");
        }
    });
//    }
}

function InsertRegistrationData(form) {
//    alert("call");
    return false;
    var data = $('#' + form.id).serialize();
//    alert(data);
//    if ($('#' + form.id).valid()) {
    jQuery.ajax({
        type: 'POST',
        url: "../class/class.ajaxRequest.php",
        data: data + "&do=InsertRegistrationData",
        success: function (result) {
//                alert(result);
            alert_message_popup('Login', "Data Save Successfully");
        }
    });
//    }
}


function SaveFile(form, FileID, placement, directory, SpanID, Loading, Response, flag) {
//    alert("call");
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


function SaveImageFile(form, FileID, placement, directory, SpanID, Loading, Response, flag) {
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
                } else if (savedata.ResponseCode == 1) {
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


function AgentPlaceOrder() {

    var BookID = $('#BookIDs').val();
    var AgentID = $('#AgentID').val();
    var TotalBookQuantity = $('#TotalBookQuantity').val();
    var AgentBookStockID = $('#AgentBookStockID').val();
    var PayableAmount = $('#PayableAmount').val();
//    var PayableAmount = $('#PayableAmount').val();
    var AddressLine1 = $('#AddressLine1').val();
    var AddressLine2 = $('#AddressLine2').val();
    var Area = $('#Area').val();
    var CityID = $('#CityID').val();
    var Pincode = $('#Pincode').val();
    var MobileNumber = $('#MobileNumber').val();


    jQuery.ajax({
        type: "post",
        url: "../class/class.ajaxRequest.php",
        data: {BookID: BookID, AgentID: AgentID, AgentBookStockID: AgentBookStockID, TotalBookQuantity: TotalBookQuantity, PayableAmount: PayableAmount, AddressLine1: AddressLine1, AddressLine2: AddressLine2, Area: Area, CityID: CityID, Pincode: Pincode, MobileNumber: MobileNumber, do: 'AgentPlaceOrder'},
        success: function (result) {
//                            alert(result);
//                            window.location = "PlacedOrderDetails.php";
            alert_message_popup('view_agent_books_orders&method=OrderDetalis&AgentID=' + AgentID, "Order Placed Successfully");
        }
    });
}

function ClientPlaceOrder() {

    var BookID = $('#BookIDs').val();
    var AgentID = $('#AgentID').val();
    var TotalBookQuantity = $('#TotalBookQuantity').val();
    var AgentBookStockID = $('#AgentBookStockID').val();
    var PayableAmount = $('#PayableAmount').val();
//    var PayableAmount = $('#PayableAmount').val();
    var AddressLine1 = $('#AddressLine1').val();
    var AddressLine2 = $('#AddressLine2').val();
    var Area = $('#Area').val();
    var CityID = $('#CityID').val();
    var Pincode = $('#Pincode').val();
    var MobileNumber = $('#MobileNumber').val();


    jQuery.ajax({
        type: "post",
        url: "../class/class.ajaxRequest.php",
        data: {BookID: BookID, AgentID: AgentID, AgentBookStockID: AgentBookStockID, TotalBookQuantity: TotalBookQuantity, PayableAmount: PayableAmount, AddressLine1: AddressLine1, AddressLine2: AddressLine2, Area: Area, CityID: CityID, Pincode: Pincode, MobileNumber: MobileNumber, do: 'AgentPlaceOrder'},
        success: function (result) {
//                            alert(result);
//                            window.location = "PlacedOrderDetails.php";
            alert_message_popup('view_agent_books_orders&method=OrderDetalis&AgentID=' + AgentID, "Order Placed Successfully");
        }
    });
}

function RetailerPlaceOrder() {

    var BookID = $('#BookIDs').val();
    var RetailerID = $('#RetailerID').val();
    var TotalBookQuantity = $('#TotalBookQuantity').val();
    var RetailerBookStockID = $('#RetailerBookStockID').val();
    var PayableAmount = $('#PalyableAmount').val();
    var AddressLine1 = $('#AddressLine1').val();
    var AddressLine2 = $('#AddressLine2').val();
    var Area = $('#Area').val();
    var CityID = $('#CityID').val();
    var Pincode = $('#Pincode').val();
    var MobileNumber = $('#MobileNumber').val();
    var ChequeNo = $('#ChequeNo').val();
    var BankName = $('#BankName').val();
    var Type = $('#Type').val();
    if (Type != '') {
//                alert(Type);
//return false;   
        if (Type == "Cheque") {

            if (ChequeNo != '') {
//            alert(ChequeNo);
                return false;
                jQuery.ajax({
                    type: "post",
                    url: "../class/class.ajaxRequest.php",
                    data: {BookID: BookID, RetailerID: RetailerID, RetailerBookStockID: RetailerBookStockID, TotalBookQuantity: TotalBookQuantity, PayableAmount: PayableAmount, AddressLine1: AddressLine1, AddressLine2: AddressLine2, Area: Area, CityID: CityID, Pincode: Pincode, MobileNumber: MobileNumber, ChequeNo: ChequeNo, BankName: BankName, Type: Type, do: 'RetailerPlaceOrder'},
                    success: function (result) {
//                            alert("call");
//                            alert_message_popup('',result);
//                            return false;
                        alert_message_popup('view_retailer_books_orders&method=OrderDetalis&RetailerID=' + RetailerID, 'Book added in bill successful');
                        return false;
                    }
                });
            } else {
                alert_message_popup('', "Check No. Required");
                return false;
            }
        } else {
//            alert("call");
//            return false;
            jQuery.ajax({
                type: "post",
                url: "../class/class.ajaxRequest.php",
                data: {BookID: BookID, RetailerID: RetailerID, RetailerBookStockID: RetailerBookStockID, TotalBookQuantity: TotalBookQuantity, PayableAmount: PayableAmount, AddressLine1: AddressLine1, AddressLine2: AddressLine2, Area: Area, CityID: CityID, Pincode: Pincode, MobileNumber: MobileNumber, Type: Type, do: 'RetailerPlaceOrder'},
                success: function (result) {
//                            window.location = "PlacedOrderDetails.php";
//                            alert_message_popup('',result);
//                            return false;
                    alert_message_popup('view_retailer_books_orders&method=OrderDetalis&RetailerID=' + RetailerID, 'Bill Generate successfully');
                    return false;
                }
            });
        }
    } else {
        alert_message_popup('', "Please Select Payment Method ");
        return false;
    }

}

function UserPlaceOrder() {

    var BookID = $('#BookIDs').val();
    var UserID = $('#UserID').val();

    var TotalBookQuantity = $('#TotalBookQuantity').val();
    var UserBookStockID = $('#UserBookStockID').val();
    var UserBookStockIDs = $('#UserBookStockIDs').val();
    //alert(UserBookStockIDs);
    var PayableAmount = $('#PalyableAmount').val();
    var AddressLine1 = $('#AddressLine1').val();
    var AddressLine2 = $('#AddressLine2').val();
    var Area = $('#Area').val();
    var CityID = $('#CityID').val();
    var Pincode = $('#Pincode').val();
    var MobileNumber = $('#MobileNumber').val();
    var ChequeNo = $('#ChequeNo').val();
    var BankName = $('#BankName').val();
    var Type = $('#Type').val();
    var TransactionType = '';
    var check = $('#TransactionType1').val();
    if ($('#TransactionType1').is(":checked")) {
        TransactionType = 'Debit';
    } else {
        TransactionType = 'Credit';
    }
    if (Type != '') {

        jQuery.ajax({
            type: "post",
            url: "../class/class.ajaxRequest.php",
            data: {BookID: BookID, UserID: UserID, TransactionType: TransactionType, UserBookStockIDs: UserBookStockIDs, TotalBookQuantity: TotalBookQuantity, PayableAmount: PayableAmount, AddressLine1: AddressLine1, AddressLine2: AddressLine2, Area: Area, CityID: CityID, Pincode: Pincode, MobileNumber: MobileNumber, ChequeNo: ChequeNo, BankName: BankName, Type: Type, do: 'UserPlaceOrder'},
            success: function (result) {
//                            alert_message_popup('',result);
                alert_message_popup('view_general_user_details', 'Bill Generate Successful');
                return false;
            }
        });
    } else {
        alert_message_popup('', "Please Select Payment Method ");
        return false;
    }

}
