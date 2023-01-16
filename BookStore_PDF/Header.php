<?php
error_reporting(0);
require_once 'includes/labels.php';   
include_once 'config/config.php';
require_once 'class/class.DataTransaction.php';
require_once 'class/class.functions.php';


$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$fn = new functions($db);
$mysql = new DataTransaction($db);
$AllNotesData = json_decode($NotesData,true);
$Notes = $AllNotesData['NotesList'];
session_start();
$UserID = $_SESSION['BookStore']['session']['UserID'];
$UserWiseCartData = $fn->GetCartData($UserID);
//echo "<pre>";
//print_r($_SESSION['BookStore']['session']);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Punahal Law House</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Fashionpress Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href="assets/css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!-- Custom Theme files -->
        <link href="assets/css/style.css" rel='stylesheet' type='text/css' />
        <!-- Custom Theme files -->
        <!--webfont-->
        <link href='http://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/js/responsiveslides.min.js"></script>
        <link rel="stylesheet" href="assets/css/etalage.css">
        <script src="assets/js/jquery.etalage.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
        <script type="text/javascript" src="assets/js/hover_pack.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/css/dataTables.bootstrap.min.css"></script>
        
        <script>
            $(function () {
                $("#slider").responsiveSlides({
                    auto: true,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    pager: true,
                });
            });
        </script>
        
        <script>
            jQuery(document).ready(function ($) {

                $('#etalage').etalage({
                    thumb_image_width: 300,
                    thumb_image_height: 400,
                    source_image_width: 900,
                    source_image_height: 1200,
                    show_hint: true,
                    click_callback: function (image_anchor, instance_id) {
                        alert('Callback example:\nYou clicked on an image with the anchor: "' + image_anchor + '"\n(in Etalage instance: "' + instance_id + '")');
                    }
                });
            });
        </script>
        <script src="assets/js/easyResponsiveTabs.js" type="text/javascript"></script>
        <script type="text/javascript">
$(document).ready(function () {
$('#horizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion           
width: 'auto', //auto or any width like 600px
fit: true   // 100% fit in a container
});
});
        </script>
        <link href="assets/css/custom.css" rel='stylesheet' type='text/css' />
       
    </head>
    <body>
        <div class="header">
            <div class="header_top">
                <div class="container">
                    <div class="logo">
                        <a href="index.php"><h1 style="color: red"><img src="assets/images/Logo/Logo.jpeg" style="height: 70px; width: 200px "></h1></a>
                    </div>
                    <ul class="shopping_grid">
                        <?php if(!empty($_SESSION['BookStore']['session'])) { ?>
                        <li>Hello <?php echo $_SESSION['BookStore']['session']['UserName'];?>
                            <img src="admin/uploads/ProfilePicture/<?php if($_SESSION['BookStore']['session']['Image'] != '' ){ echo $_SESSION['BookStore']['session']['Image'];}else{ echo "placeholder1.png"; }?>" class="img-circle" style="width: 25px;height: 25px">
                        </li>
                            <a href="Logout.php"><li>Logout</li></a>
                        <?php }else{ ?>
                            <a href="Registration.php"><li>Join</li></a>
                        <a href="Login.php"><li>Sign In</li></a>
                       <?php }?>
                        <a href="MyCart.php"><li><span class="m_1">Shopping Bag</span>&nbsp;&nbsp;(<?php echo count($UserWiseCartData['GetSelectedCartData'])?>) &nbsp;<img src="assets/images/bag.png" alt=""/></li></a>
                        <div class="clearfix"> </div>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="h_menu4"><!-- start h_menu4 -->
                <div class="container">
                    <a class="toggleMenu" href="#">Menu</a>
                    <ul class="nav">
                        <li class="<?php if(basename($_SERVER['PHP_SELF']) == 'index.php'){ echo "active" ; }else{}?>"><a href="index.php" data-hover="Home">Home</a></li>
                        <li class="<?php if(basename($_SERVER['PHP_SELF']) == 'AboutUs.php'){ echo "active" ; }else{}?>"><a href="AboutUs.php" data-hover="About Us">About Us</a></li>
                        <!--<li><a href="#" data-hover="Return Policy">Return Policy</a></li>-->
                        <li class="<?php if(basename($_SERVER['PHP_SELF']) == 'ContactUs.php'){ echo "active" ; }else{}?>"><a href="ContactUs.php" data-hover="Contact Us">Contact Us</a></li>
<!--                  <li><a href="404.html" data-hover="Company Profile">Company Profile</a></li>
                        <li><a href="register.html" data-hover="Company Registration">Company Registration</a></li>
                        <li><a href="wishlist.html" data-hover="Wish List">Wish List</a></li>-->
                    </ul>
                    <script type="text/javascript" src="assets/js/nav.js"></script>
                </div><!-- end h_menu4 -->
            </div>
        </div>