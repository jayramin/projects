<?php
$sn=$_POST['sub_name'];
$sd=$_POST['sub_desc'];
$st=$_POST['stream_id'];
$sem=$_POST['sem_id'];

include "../config_db.php";
$que="insert into subject_tbl(sub_name,sub_desc,stream_id,sem_id)
 values('$sn','$sd',$st,$sem)";
$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert ("succes");
window.location="Subject_Add_Design.php";
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