<?php
$a=$_GET['k'];
include "..\config_db.php";
echo $que="delete from student_tbl where stu_id=$a";
$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert ("success");
window.location="Student_Manage.php";
</script>
<?php
}
else
{
?>
<script>
alert ("try again");
window.location="Stream_Add_Design.php";
</script>
<?php
}
?>
