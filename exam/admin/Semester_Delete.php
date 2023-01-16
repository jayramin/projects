<?php
$n=$_GET['k'];
include "..\config_db.php";
$que="delete from semester_tbl where sem_id='$n'";
$res=mysql_query($que,$conn);
if($res)
{
?>
<script>
alert ("success");
window.location="Semester_Add_Design.php";
</script>
<?php
}
else
{
?>
<script>
alert ("try again");
window.location="Semester_Add_Design.php";
</script>
<?php
}
?>
