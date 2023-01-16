<?php
include_once 'dbConnection.php';
ob_start();
$name     = $_POST['name'];
$name     = ucwords(strtolower($name));
$gender   = $_POST['gender'];
$username = $_POST['username'];
$phno     = $_POST['phno'];
$password = $_POST['password'];
$branch   = $_POST['branch'];
$rollno   = $_POST['rollno'];
$name     = stripslashes($name);
$name     = addslashes($name);
$name     = ucwords(strtolower($name));
$gender   = stripslashes($gender);
$gender   = addslashes($gender);
$username = stripslashes($username);
$username = addslashes($username);
$phno     = stripslashes($phno);
$phno     = addslashes($phno);
$password = stripslashes($password);
$password = addslashes($password);
$password = md5($password);
$test_password = $_POST['test_password'];

if(!empty($test_password))
{

	$check_test = mysqli_query($con, "SELECT * FROM `quiz` WHERE `test_password` = $test_password ");
	$count = mysqli_num_rows($check_test);
if ($count == 1) {

		$eid = "";
		$total = "";
	 while ($row = mysqli_fetch_array($check_test)) {
        
        $eid = $row['eid'];
        $total = $row['total'];
    }
	$q3 = mysqli_query($con, "INSERT INTO user VALUES  (NULL,'$name', '$rollno','$branch','$gender' ,'$username' ,'$phno', '$password',$test_password)");
if ($q3) {
    session_start();
    $_SESSION["username"] = $username;
    $_SESSION["name"]     = $name;
   echo ("<script language='JavaScript'>
         window.location.href='http://www.svnkonlinetest.com/account.php?q=quiz&step=2&eid=$eid&n=1&t=$total&start=start';</script>");
    //header("location:http://www.svnkonlinetest.com/account.php?q=quiz&step=2&eid=".$eid."&n=1&t=$total&start=start");
} else {
    header("location:index.php?q7=test password is wrong&name=$name&username=$username&gender=$gender&phno=$phno&branch=$branch&rollno=$rollno");
}
   
}else{
	header("location:index.php?q7=Username already exists. Please choose another&name=$name&username=$username&gender=$gender&phno=$phno&branch=$branch&rollno=$rollno");
}



}



ob_end_flush();
?>