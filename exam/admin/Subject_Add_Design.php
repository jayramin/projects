<html>
<title>::Subject Insert</title>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<script>
function validateform()
{
	var x=document.forms["myform"]["sub_name"].value;
	if(x==null || x=="")
	{
		alert("subject name must be filled out");
		return false;
	}
	var x=document.forms["myform"]["sub_desc"].value;
	if(x==null || x=="")
	{0
		alert("subject description must be filled out");
		return false;
	}
}
</script>
<body>
<form name="myform" action="Subject_Add_Action.php" method="POST" onsubmit="return validateform()">
<?php
include "..\config_db.php";
$que="select * from subject_tbl";
$res=mysql_query($que,$conn);
?>
<div id="bodymain">
	<?php
	include "../menu.php";
	?>
	<div id="frame">
	<div id="submenu">
	<?php
	include "Admin_Menu.php";
	?> </div>
	
	<div id="slider"> <div id="line">Add Subject</div>
	<center>
	<table style="margin-top:30px">
		<tr>
		<td>Stream</td>
		<td>
		<select name="stream_id" id="stream_id">
		<?php
		include "../config_db.php";
		$q="select * from stream_tbl";
		$r=(mysql_query($q,$conn));
		while($s=mysql_fetch_array($r))
		{
		?>
		<option value="<?php echo $s['stream_id']; ?>">
		<?php echo $s['stream_name']; ?>
		<?php } ?>
		
		</option>
		</select></td>
		</tr><tr>
		<td>Semester</td>
		<td>
		<select name="sem_id" id="sem_id">
		<?php
		include "../config_db.php";
		$qu="select * from Semester_tbl";
		$re=(mysql_query($qu,$conn));
		while($ro=mysql_fetch_array($re))
		{
		?>
		<option value="<?php echo $ro['sem_id']; ?>">
		<?php echo $ro['sem_name']; ?>
		<?php } ?>
		
		</option>
		</select></td>
		</tr>
		<tr>
		<td>Subject</td>
		<td><input type="text" name="sub_name" style="width:200px;" "height:50px;">
		</tr><tr>
		<td>Subject Description</td>
		<td><textarea rows="3" cols="25" name="sub_desc"></textarea></td>
		</tr><tr>
		<td><input type="submit" value="Submit"></td>
		<td><input type="reset" value="Reset"></td>	
		</table>
		<table border="1" width="400">
		<tr  style="color:white;  background-color:#008866;">
		<th>Subject Id</th>
		<th>Subject name</th>
		<th>Subject Description</th>
		<th>Stream Id</td>
		<th>Semester Id</td>
		<th>Delete</th>
		<th>Update</th>
		</tr>
		<?php
		while($row=mysql_fetch_array($res))
		{
		$a=$row['sub_id'];
		?>
		<tr align="center">
		<td><?php echo $row['sub_id']; ?></td>
		<td><?php echo $row['sub_name']; ?></td>
		<td><?php echo $row['sub_desc'];?></td>
		<td><?php echo $row['stream_id']; ?></td>
		<td><?php echo $row['sem_id']; ?> </td>
		<td><?php echo ("<a href='Subject_Delete.php ?k=$a'>Delete</a>"); ?></td>
		<td><?php echo ("<a href='Subject_Update_View.php ?k=$a'>Update</a>"); ?></td>
		</tr>
		<?php
		}
		?>
		</table>
		</div>
 </div>
</div>
<?php
include "../Footer.php";
?>
</div>
</body>
</html>