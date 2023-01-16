<?php
error_reporting(0);
ob_start();
$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//require_once '../class/class.DataTransaction.php';
//require_once '../class/class.functions.php';
//$fn = new functions($db);
//$mysql = new DataTransaction($db);
?>