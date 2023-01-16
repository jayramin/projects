
<html>
<title>::Stream Update View</title>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
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
	<div id="slider">
	<div id="line">Update Stream </div>
<form action="Stream_Update_Action.php" method="GET">
<center><table>
<tr><td>
<?php
$n=$_GET['k'];
include "../config_db.php";
$que="select * from stream_tbl where stream_id='$n'";
$res=mysql_query($que,$conn);
while($row=mysql_fetch_array($res))
{
?>
<td><input type="hidden" name="stream_id" value="<?php echo $row['stream_id']; ?>"></td>
<tr><td>Stream name </td><td>
<input type="text" name="stream_name" value="<?php echo $row['stream_name']; ?>"></td></tr><tr>
<td>Stream Description</td><td>
<input type="text" name="stream_desc" value="<?php echo $row['stream_desc']; ?>"></td></tr>
<?php
}
?>
<tr><td><input type="submit" value="Update"></td></tr>
</table></center>
</form>
	</div>
 </div>
</div>
<?php include "../footer.php"; ?>
</div>
</body>
</html>