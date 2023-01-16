<?php
//DB details
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'masterdatabase';

//Create connection and select DB
$con = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if($con->connect_error){
    die("Unable to connect database: " . $con->connect_error);
}