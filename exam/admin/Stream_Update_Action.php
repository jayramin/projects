<?php

$si=$_GET['stream_id'];
$sn=$_GET['stream_name'];
$sd=$_GET['stream_desc'];

include "..\config_db.php";
echo $que="update stream_tbl set stream_name='$sn',stream_desc='$sd' where stream_id=$si";
$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert('success updated');
window.location="Stream_Add_Design.php";
</script>
<?php
}
else
{
?>
<script>
alert('try again');
window.location="Stream_Add_Design.php";
</script>
<?php
}
?>
