<?php
$unm=$_POST['uname'];
$ai=$_POST['admin_id'];

include "../config_db.php";
$que="update admin_tbl set uname='$unm' where admin_id=$ai";
$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert ("success");
window.location = "Admin_Setting.php";
</script><?php
}
else 
{
?>
<script>
alert("try again");
window.location = "update_design.php";
</script>
<?php } ?>