<html>
<title>::Semister Insert</title>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<script>
function validateform()
{
	var x=document.forms["myform"]["stream_name"].value;
	if(x==null || x=="")
	{
		alert("stream name must be filled out");
		return false;
	}
	var x=document.forms["myform"]["stream_desc"].value;
	if(x==null || x=="")
	{
		alert("stream description must be filled out");
		return false;
	}
}
</script>
</head>
<body>
<form name="myform" action="Stream_Add_Action.php" method="GET"  onsubmit="return validateform()" >
<?php
include "..\config_db.php";
$que="select * from stream_tbl";
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
	
	<div id="body">
	<div id="slider"> 
	<div id="line">Add Stream</div>
	<center>
	<table style="margin-top:30px">
	<tr>
	<td>Stream </td>
	<td><input type="text" name="stream_name" value="" style="width:200px;" "height:50px;"></td>
	</tr>
	<tr>
	<td>Stream Description</td>
	<td><textarea rows="3" cols="25" name="stream_desc"></textarea></td>
	</tr><td></td>
	<tr>
	<td><input type="submit" value="Submit"></td>
		<td><input type="reset" value="Reset"></td></tr>
		</table>
		<hr>
		<table border="1" width="400">
		<tr  style="color:white;  background-color:#008866;">
		<th>Id</th>
		<th>Stream Name</th>
		<th>Stream Description</th>
		<th>Delete</th>
		<th>Update</th>
		</tr>
		<?php
		while($row=mysql_fetch_array($res))
		{
		$a=$row['stream_id'];
		?>
		<tr align="center">
		<td><?php echo $row['stream_id']; ?></td>
		<td><?php echo $row['stream_name']; ?></td>
		<td><?php echo $row['stream_desc'];?></td>
		<td><?php echo "<a href='Stream_Delete.php ?k=$a'>Delete</a>"; ?></td>
		<td><?php echo "<a href='Stream_Update_View.php ?k=$a'>Update</a>"; ?></td>
		</tr>
		<?php
		}
		?>
		</table>
		</center>
		</div>
 </div>
</div>
<?php include "../Footer.php";   ?>
</div>
</body>
</html>