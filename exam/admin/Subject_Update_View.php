
<html>
<title>::Subject Update View</title>
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
	<div id="line">Update Subject </div>
<form action="Subject_Update_Action.php" method="GET">
<?php
$n=$_GET['k'];
include "../config_db.php";
$que="select * from subject_tbl where sub_id='$n'";
$res=mysql_query($que,$conn);
while($row=mysql_fetch_array($res))
{
?><center>
<table><tr>
<input type="hidden" name="sub_id" value="<?php echo $row['sub_id']; ?>"><br/>
<td>Name:</td>
<td> <input type="text" name="sub_name" value="<?php echo $row['sub_name']; ?>"></td>
</tr><tr>
<td>Description :</td>
<td><input type="text" name="sub_desc" value="<?php echo $row['sub_desc']; ?>"></td>
</tr><tr>
<td>Stream</td>
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
</tr><tr>
<td>Semester</td>
<td>
<select name="sem_id" id="sem_id">
		<?php
		include "../config_db.php";
		$qu="select * from semester_tbl";
		$re=(mysql_query($qu,$conn));
		while($ro=mysql_fetch_array($re))
		{
			$s1=$row['sem_id'];
			$s2=$ro['sem_id'];
			if((isset($s1) && $s1 == $s2))
			{
		?>
		<option value="<?php echo $ro['sem_id']; ?>" selected>
		<?php echo $ro['sem_name']; 
		}
		else
		{
		?>
		<option value="<?php echo $ro['sem_id']; ?>">
		<?php echo $ro['sem_name'];
		}
		?>
		<?php } ?>
		</option>
		</select>
		</td>
</tr><tr>
<?php 
}
?></td><td rowspan=2 align="center">
<input type="submit" value="Update"></tr>
</table></center>
</form>
</div>
 </div>
</div>
<?php include "../footer.php"; ?>
</div>
</body>
</html>
