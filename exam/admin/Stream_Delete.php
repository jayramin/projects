<?php
$a=$_GET['k'];
include "..\config_db.php";
echo $que="delete from stream_tbl where stream_id=$a";
$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert ("success");
window.location="Stream_Add_Design.php";
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
