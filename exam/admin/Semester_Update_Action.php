<?php

$si=$_GET['sem_id'];
$sn=$_GET['sem_name'];
$sd=$_GET['sem_desc'];
$st=$_GET['stream_id'];


include "..\config_db.php";
echo $que="update semester_tbl set sem_id=$si,sem_name='$sn',sem_desc='$sd',stream_id=$st where sem_id=$si";
$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert('success updated');
window.location="Semester_Add_Design.php";
</script>
<?php
}
else
{
?>
<script>
alert('try again');
window.location="Semester_Add_Design.php";
</script>
<?php
}
?>
