<?php 
$page = explode('/', $_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Home</title>
        <style type='text/css'>

            /*<![CDATA[*/
            @charset "utf-8";
            /* CSS Document */
            /* ---------- ENTYPO ---------- *//* ---------- Digital Hub Inc : http://www.digitalhubinc.com/---------- */
            /* ---------- http://weloveiconfonts.com/ ---------- */
            @import url(http://weloveiconfonts.com/api/?family=entypo);
            [class*="entypo-"]:before {
                font-family: 'entypo', sans-serif;
            }
            /* ---------- GENERAL ---------- */
            .navbar-right .dropdown-menu{
                right:auto !important;
            }

        </style>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/prettyPhoto.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
       
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/social_navbar.css" rel="stylesheet">
        <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
            <script src="js/respond.min.js"></script>
            <![endif]-->
        <!--<link rel="shortcut icon" href="images/ico/favicon.ico">-->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
         <link href="css/custom.css" rel="stylesheet">
    </head> 
    <body>
        <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logo/Eduroute logo.png" style="height: 40px;"></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="<?php if($page[2] == 'index.php'){  ?>active<?php }else{ echo ' ';}?>"><a href="index.php">Home</a></li>
                        <li class="<?php if($page[2] == 'aboutus.php'){  ?>active<?php }else{ echo ' ';}?>"><a href="aboutus.php">About Us</a></li>
                        <li class="<?php if($page[2] == 'index.php#services'){  ?>active<?php }else{ echo ' ';}?>"><a href="<?php if($page[2] == 'index.php'){?>#services<?php  }else{ ?>index.php#services<?php } ?>">Services</a></li>
                        <li class="dropdown <?php if($page[2] == 'Student_Facts.php' || $page[2] == 'Student_Scholarship.php' || $page[2] == 'Student_EducationalLoan.php'){  ?>active<?php }else{ echo ' ';}?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Student Desk</a>
                            <ul class="dropdown-menu" >
                                <li><a href="Student_Desk_Facts.php">Facts</a></li>
                                <li><a href="Student_Desk_Scholarship.php">Scholarship</a></li>
                                <li><a href="Student_Desk_Education_loan.php">Educational Loan</a></li>
                                <li><a href="Student_Desk_Resume.php">Resume</a></li>
                            </ul>
                        </li>
                        <li class="dropdown <?php if($page[2] == 'Country_USA.php' || $page[2] == 'Country_Canada.php' || $page[2] == 'Country_Australia.php' || $page[2] == 'Counrty_Newzeland.php' || $page[2] == 'Country_Germany.php'){  ?>active<?php }else{ echo ' ';}?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Countries</a>
                            <ul class="dropdown-menu">
                                <li><a href="Country_USA.php">USA</a></li>
                                <li><a href="Country_Canada.php">CANADA</a></li>
                                <li><a href="Country_Australia.php">AUSTRALIA</a></li>
                                <li><a href="Counrty_Newzeland.php">NEW ZEALAND</a></li>
                                <li><a href="Country_Germany.php">GERMANY</a></li>
                            </ul>
                        </li>
                        <li class="<?php if($page[2] == 'events.php'){  ?>active<?php }else{ echo ' ';}?>"><a href="events.php">Events</a></li>
                        <li class="<?php if($page[2] == 'contactus.php'){  ?>active<?php }else{ echo ' ';}?>"><a href="contactus.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </header> 