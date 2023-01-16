<?php
//
//error_reporting(E_ALL);
//require_once './includes/header.php';
//print_r($_REQUEST);
//echo pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
//$MenuList = $fn->get_menu_file($_REQUEST['page'], $UserType);
//echo '<pre>';
//print_r($MenuList);
//echo $current_page = $functions->get_parent_page($_REQUEST['page']);
//
//$PageName=(isset($_REQUEST['page']))?$_REQUEST['page'].'.php':'home.php';
//require_once $PageName;
?>


<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h2>Change Password</h2>
                <ol class="breadcrumb">
                    <li><a href="home">Dashboard</a></li>
                    <li class="active">Change Password</li>
                </ol>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <!-- <h4 class="panel-title pull-left"><strong><?php echo $PageName; ?></strong></h4> -->
        </div>
        <div class='panel-body'>
            <div class="row">
                <div class="col-lg-12">            
                    <div class="row margin-vert-30">
                        <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                            <form data-toggle="validator" action="" class="login-form form-login" method="post" id="set-password">
                                <div class="login-header margin-bottom-30">
                                    <h2 style="text-align:center;">Change Password</h2>
                                    <span class="alert alert_box_error"></span>
                                    <span class="alert alert_box_success"></span>
                                </div>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input id="password" name="password" placeholder="Enter Password" class="form-control required" required type="password">
                                </div><br>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input id="Cpassword" name="Cpassword" placeholder="Re Enter Password" class="form-control required" required type="password">
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary btn-block pull-right ChocolateColor" type="button" id="sign_in" onclick="changepassword();">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>  
                    </div>        
                </div>   
            </div>
        </div>
    </div>
