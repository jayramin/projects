<html>
<title>::Semester Update View</title>
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
	<div id="line"> Update Semester </div>
<form action="Semester_Update_Action.php" method="GET">
<center><table><tr>
<?php
$n=$_GET['k'];
include "../config_db.php";
$que="select * from semester_tbl where sem_id='$n'";
$res=mysql_query($que,$conn);
while($row=mysql_fetch_array($res))
{
?>
<td><input type="hidden" name="sem_id" value="<?php echo $row['sem_id']; ?>"></td></tr><tr><td>Semester Name</td><td>
<input type="text" name="sem_name" value="<?php echo $row['sem_name']; ?>"></td></tr><tr><td>Semester Discription</td><td>
<input type="text" name="sem_desc" value="<?php echo $row['sem_desc']; ?>"></td></tr><tr><td>Stream</td>
<td><select name="stream_id" id="stream_id">
		<?php
		include "../config_db.php";
		$q="select * from stream_tbl";
		$r=(mysql_query($q,$conn));
		while($s=mysql_fetch_array($r))
		{
				$strm1=$row['stream_id'];
				$strm2=$s['stream_id'];
			if((isset($strm1) && $strm1 == $strm2))
			{
		?>
		<option value="<?php echo $s['stream_id']; ?>" selected="selected">
		<?php echo $s['stream_name']; 
		}
		else
		{
		?>
		<option value="<?php echo $s['stream_id']; ?>" >
		<?php echo $s['stream_name'];
		}
		?>
		<?php } ?>
		
		</option>
		</select></td>
</tr>
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
