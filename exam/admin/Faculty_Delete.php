<?php
$n=$_GET['k'];
include "..\config_db.php";
$que="delete from faculty_tbl where f_id='$n'";
$res=mysql_query($que,$conn);
if($res)
{
?>
<script>
alert ("success");
window.location="Faculty_Registration.php";
</script>
<?php
}
else
{
?>
<script>
alert ("try again");
window.location="Faculty_Registration.php";
</script>
<?php
}
?>
