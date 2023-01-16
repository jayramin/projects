<html>
<title> Update account </title>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<form action="update_action.php" method="POST">
<body>
<div id="bodymain">
	<?php
	include "../menu.php";
	?>
	<div id="frame">
	<div id="body">
		<div id="submenu">
<?php include "admin_menu.php"; ?>
</div>
	<div id="slider"><div id="line">Update Account</div>
	<center>	<table>
<tr>
<td><b>User name</b> &nbsp;&nbsp;</td>
<td>
<?php
include "../config_db.php";
$que="select * from admin_tbl";	
$res=mysql_query($que,$conn);
while($row=mysql_fetch_array($res))
{
?>
<input type="hidden" name="admin_id" value="<?php echo $row['admin_id'];?>">
<input type="text" name="uname" value="<?php echo $row['uname'];?>" style="width:150px; height:30px; border-radius:5px;">
<?php } ?>
</td></tr>
<tr height=60>
<td colspan=2><input type="submit" value="submit" style="width:80px; height:25px; border-radius:5px;"></td>
</tr>
</table></center>
	</div>
 </div>
</div>
<?php include "../footer.php"; ?>
</div>
</body>
</html>