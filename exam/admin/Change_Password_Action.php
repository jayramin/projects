<?php
session_start();
include "../config_db.php";

echo $unm=$_SESSION['uname']; 
$oldpass=$_POST['pass'];
$newpass=$_POST['pass1']; 

$sql = "update admin_tbl set pass='$newpass' where uname='$unm' AND pass='$oldpass'";

$res=mysql_query($sql,$conn);

if(($res=mysql_affected_rows())==1)
{
	?>
    <script>
	alert('password change successfully');
	window.location="Admin_Home.php";
	</script>
    <?php
}
else
{
	?>
    <script>
	alert('password not change successfully');
	window.location="Change_Password_Design.php";
	</script>
  <?php
}
?>