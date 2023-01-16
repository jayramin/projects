<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$conn=mysql_connect("localhost","root","");
mysql_select_db("exam",$conn);

if (!$conn) 
{
    die('Could not connect: ' . mysql_error());
}
?>