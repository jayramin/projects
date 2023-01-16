<?php

$si=$_GET['sub_id'];
$sn=$_GET['sub_name'];
$sd=$_GET['sub_desc'];
$st=$_GET['stream_id'];
$sem=$_GET['sem_id'];


include "..\config_db.php";
echo $que="update subject_tbl set sub_name='$sn',sub_desc='$sd',stream_id=$st,sem_id=$sem where sub_id=$si";
$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert('success updated');
window.location="Subject_Add_Design.php";
</script>
<?php
}
else
{
?>
<script>
alert('try again');
window.location="Subject_Add_Design.php";
</script>
<?php
}
?>
