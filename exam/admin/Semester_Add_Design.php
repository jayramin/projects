<html>
<title>::Semester Insert</title>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<script>
function validateform()
{
	var x=document.forms["myform"]["sem_name"].value;
	if(x==null || x=="")
	{
		alert("semester name must be filled out");
		return false;
	}
	var x=document.forms["myform"]["sem_desc"].value;
	if(x==null || x=="")
	{
		alert("semester description must be filled out");
		return false;
	}
}
</script>

<body>
<?php
include "..\config_db.php";
$que="select * from semester_tbl";
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
	
<form name="myform" action="Semester_Add_Action.php" method="POST" onsubmit="return validateform()">
	<div id="slider"> <div id="line">Add Semesters</div>
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
		</tr>
		<tr>
		<td>Semester</td>
		<td><input type="text" name="sem_name" style="width:200px;" "height:50px;">
		</tr><tr>
		<td>Semester Description</td>
		<td><textarea rows="3" cols="25" name="sem_desc"></textarea></td>
		</tr><tr>
		<td><input type="submit" value="Submit"></td>
		<td><input type="reset" value="Reset"></td>	
		</table>
		<table border="1" width="400">
		<tr  style="color:white;  background-color:#008866;">
		<th>Semester Id</th>
		<th>Semester name</th>
		<th>Semester Description</th>
		<th>Stream ID</td>
		<th>Delete</th>
		<th>Update</th>
		</tr>
		<?php
		while($row=mysql_fetch_array($res))
		{
		$a=$row['sem_id'];
		?>
		<tr align="center">
		<td><?php echo $row['sem_id']; ?></td>
		<td><?php echo $row['sem_name']; ?></td>
		<td><?php echo $row['sem_desc'];?></td>
		<td><?php echo $row['stream_id']; ?></td>
		<td><?php echo ("<a href='Semester_Delete.php ?k=$a'>Delete</a>"); ?></td>
		<td><?php echo ("<a href='Semester_Update_View.php ?k=$a'>Update</a>"); ?></td>
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