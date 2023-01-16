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
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
         <link href="css/custom.css" rel="stylesheet">
         
         
         
         <!--For news Feeds-->
<!--         <link href="assets/css/animate.css" rel="stylesheet">
         <link href="assets/css/bootstrap.min.css" rel="stylesheet">
         <link href="assets/css/font-awesome.min.css" rel="stylesheet">
         <link href="assets/css/font.css" rel="stylesheet">
         <link href="assets/css/jquery.fancybox.css" rel="stylesheet">
         <link href="assets/css/jquerysctipttop.css" rel="stylesheet">
         <link href="assets/css/li-scroller.css" rel="stylesheet">
         <link href="assets/css/slick.css" rel="stylesheet">
         <link href="assets/css/style.css" rel="stylesheet">
         <link href="assets/css/theme.css" rel="stylesheet">-->

         <!--For News Feeds End-->
         
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
                    <a class="navbar-brand" href="index.php"><img src="images/logo/Eduroute logo.png" class="LogoHeight"></a>
                </div>
                <div class="col-lg-3 pull-right MarginTop">
                    
                 <span style="color: black"><b>Call:</b> 7575006757/079-48905333/2</span><br>
                 <span style="color: black"><b>Email : </b>info.eduroute@gmail.com</span>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 MenuBackcolor">
                    <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="<?php if($page[2] == 'index.php'){  ?>active<?php }else{ echo ' ';}?>"><a href="index.php">Home</a></li>
                        <li class="<?php if($page[2] == 'aboutus.php'){  ?>active<?php }else{ echo ' ';}?>"><a href="aboutus.php">About Us</a></li>
                        <li class="<?php if($page[2] == 'Services.php' || $page[2] == 'Services_Career_Counseling.php' || $page[2] == 'Services_Country_Selection.php' || $page[2] == 'Services_Country_Selection.php' || $page[2] == 'Services_University_Selection.php' || $page[2] == 'Services_Coaching.php' || $page[2] == 'Services_Applications_And_Documentations.php' || $page[2] == 'Services_Bank_Loan_And_Assistance.php' || $page[2] == 'Services_VISA_Interview_Preparation.php' || $page[2] == 'Services_Foreign_Exchange.php' || $page[2] == 'Services_Student_Insurance.php' || $page[2] == 'Services_Air_Ticket.php' || $page[2] == 'Services_Pre_Departure_Briefings.php' || $page[2] == 'Services_Coaching_IELTS.php' || $page[2] == 'Services_Coaching_PTE.php' || $page[2] == 'Services_Coaching_TOFEL.php' || $page[2] == 'Services_Coaching_GRE.php' || $page[2] == 'Services_Coaching_GMAT.php' || $page[2] == 'Services_Coaching_SAT.php' ){  ?>active<?php }else{ echo ' ';}?>"><a href="Services.php">Services</a></li>
                        
<!--                        <li class="<?php if($page[2] == 'index.php#services'){  ?>active<?php }else{ echo ' ';}?>"><a href="<?php if($page[2] == 'index.php'){?>#services<?php  }else{ ?>index.php#services<?php } ?>">Services</a></li>-->
                        
                        <li class="dropdown <?php if($page[2] == 'Student_Desk_Facts.php' || $page[2] == 'Student_Desk_Scholarship.php' || $page[2] == 'Student_Desk_Education_loan.php' || $page[2] == 'Student_Desk_Resume.php'){  ?>active<?php }else{ echo ' ';}?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Student Desk</a>
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
                                <li><a href="Country_Newzeland.php">NEW ZEALAND</a></li>
                                <li><a href="Country_Germany.php">GERMANY</a></li>
                            </ul>
                        </li>
                        <li class="<?php if($page[2] == 'events.php'){  ?>active<?php }else{ echo ' ';}?>"><a href="events.php">Events</a></li>
                        <li class="<?php if($page[2] == 'contactus.php'){  ?>active<?php }else{ echo ' ';}?>"><a href="contactus.php">Contact Us</a></li>
                    </ul>
                </div>
                </div>
                
                
            </div>
        </header> 