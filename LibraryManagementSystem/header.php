


<?php 
error_reporting(0);
$url = $_SERVER['REQUEST_URI'];

//echo $url;


include("conn.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Library Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Career Builder Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- css links -->

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/slider.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="../../../Users/Bhumi Raval/Documents/Unnamed Site 2/css/facultystyle.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
<!-- /css links -->
 <link href='//fonts.googleapis.com/css?family=Dancing+Script:400,700' rel='stylesheet' type='text/css'>
 <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
 <link href='//fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800' rel='stylesheet' type='text/css'>
<script src="js/SmoothScroll.min.js"></script>
<script type="text/javascript" src="js/modernizr.custom.js"></script> 
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">


<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">KSV LIBRARY</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="#myPage">HOME</a></li>
				<li><a href="<?php if($url == '/LibraryManagementSystem/login.php') {?>index.php<?php } ?>#about">ABOUT</a></li>
				<li><a href="<?php if($url == '/LibraryManagementSystem/login.php') {?>index.php<?php } ?>#gallery">GALLERY</a></li>
				<li><a href="<?php if($url == '/LibraryManagementSystem/login.php') {?>index.php<?php } ?>#faculty">FACULTY</a></li>
				<li><a href="<?php if($url == '/LibraryManagementSystem/login.php') {?>index.php<?php } ?>#events">EVENTS</a></li>
				<li><a href="<?php if($url == '/LibraryManagementSystem/login.php') {?>index.php<?php } ?>#contact">CONTACT</a></li> 
				<li><a href="login.php">LOGIN</a></li>
                
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<!-- /Fixed navbar -->	
	
<!-- Banner -->
	
<!-- /Banner -->