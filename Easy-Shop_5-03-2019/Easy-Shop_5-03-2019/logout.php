<?php
session_start();
$u=$_SESSION['user'];
session_unset($u);
session_destroy();
header('location:index.php');
?>