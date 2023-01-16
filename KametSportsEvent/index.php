<?php
error_reporting(0);
require_once 'includes/header.php';
$PageName=(isset($_REQUEST['page']))?$_REQUEST['page'].'.php':'home.php';
require_once $PageName;
include 'includes/footer.php'
?>