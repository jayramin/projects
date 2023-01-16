<?php
$sn=$_POST['sem_name'];
$sd=$_POST['sem_desc'];
$st=$_POST['stream_id'];

include "../config_db.php";
$que="insert into semester_tbl(sem_name,sem_desc,stream_id)
 values('$sn','$sd',$st)";
$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert ("succes");
window.location="Semester_Add_Design.php";
</script>
<?php
}
else 
{

?>
<script>
alert ("try again");
window.location="Subject_Add_Design.php";
</script>
<?php
}
?>