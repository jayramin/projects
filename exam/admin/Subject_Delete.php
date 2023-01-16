<?php
$n=$_GET['k'];
include "..\config_db.php";
$que="delete from subject_tbl where sub_id='$n'";
$res=mysql_query($que,$conn);
if($res)
{
?>
<script>
alert ("success");
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
