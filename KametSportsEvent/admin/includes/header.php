
<?php
session_start();
error_reporting(0);
include_once '../includes/labels.php';
include_once '../config/config.php';
//$fn = new functions();


$UserType = isset($_SESSION[SESSION_ALIAS]['session']['RoleID']) ? $_SESSION[SESSION_ALIAS]['session']['RoleID'] : 1;

if (isset($_SESSION[SESSION_ALIAS]['session']['RoleID'])) {
    
    if ($_SESSION[SESSION_ALIAS]['session']['RoleID'] == '1') {
        $Profile = $fn->get_profile_data($_SESSION[SESSION_ALIAS]['session']['RoleID'],'v_users');
       
	} else {
		$Profile = $fn->get_profile_data($_SESSION[SESSION_ALIAS]['session']['RoleID'],'v_users');                
        }
} else {
	echo '<script>window.location="' . SITE_URL . 'login"</script>';
       // print_r($_SESSION);
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no" />

  <title>Kamet sports events | Dashboard</title>

  
  <!--<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">-->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="bower_components/metisMenu/dist/metisMenu.min.css">
  <link rel="stylesheet" href="bower_components/Waves/dist/waves.min.css">
  <link rel="stylesheet" href="bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">

  

  <link rel="stylesheet" href="bower_components/c3/c3.min.css">
  <link rel="stylesheet" href="bower_components/zabuto_calendar/zabuto_calendar.min.css">
    <script src="js/menu/modernizr.custom.js"></script>
<link rel="stylesheet" href="bower_components/DataTables/media/css/jquery.dataTables.css">
  <link rel="stylesheet" href="bower_components/datatables-tabletools/css/dataTables.tableTools.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker3.css">
  
  <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/custom.css">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  <script src="js/jquery.2.1.1.min.js"></script>
  <script src="js/jquery.maskedinput.min.js"></script>
  <script src="js/ckeditor/ckeditor.js"></script>
  
  <link rel="stylesheet" href="css/bootstrap-timepicker.css">
  
  <link rel="stylesheet" href="js/selects/cs-select.css">
  <link rel="stylesheet" href="js/selects/cs-skin-elastic.css">
  <link href="js/select2/select2.css" rel="stylesheet" />
   <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
  <script>
        $(document).ready(function(){
        $.getScript('js/select2/select2.min.js',function(){
        var select = $('select').select2();
        });
        });
  </script>
</head>

<!--<body onload="getDateTime()">-->
<body>
  <div id="preloader_" class="preloader_ table-wrapper">
    <div class="table-row">
      <div class="table-cell">
        <div class="la-ball-scale-multiple la-3x">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </div>
  </div>

  <div id="main-wrapper" class="main-wrapper">
<?php
require_once './includes/menubar.php';