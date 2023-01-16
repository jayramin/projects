<?php
ob_start();
$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//set timezone
date_default_timezone_set('Asia/Kolkata');
//load classes as needed
function __autoload($class) {

    $class = strtolower($class);

    //if call from within assets adjust the path
    $classpath = 'class/class.' . $class . '.php';
    if (file_exists($classpath)) {
        require_once $classpath;
    }

    //if call from within admin adjust the path
    $classpath = '../class/class.' . $class . '.php';
    if (file_exists($classpath)) {
        require_once $classpath;
    }

    //if call from within admin adjust the path
    $classpath = '../../class/class.' . $class . '.php';
    if (file_exists($classpath)) {
        require_once $classpath;
    }
}
//$user = new User($db);
$fn = new functions($db);
$mysql = new DataTransaction($db);