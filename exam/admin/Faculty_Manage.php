<html>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<body>
<div id="bodymain">
	<?php
	include "../menu.php";
	?>
	<div id="frame">
	<div id="body">
	<div id="submenu">
		<?php include "Admin_Menu.php"; ?>
		</div>
	<div id="slider">
<center>
<div id="line">Manage Faculty</div>
<table border=1>
<tr>
<td style="width=6px">User Name</td>
<td>First name</td>
<td>Last name</td>
<td>Qualification</td>
<td>Stream</td>
<td>Subject 1</td>
<td>Subject 2</td>
<td>Subject 3</td>
</tr>
<?php
include "../config_db.php";
$que="select * from faculty_tbl";
$res=mysql_query($que,$conn);
while($row=mysql_fetch_array($res))
{
	$a=$row['f_id'];
?>
<tr>
<td><?php echo $row['uname']; ?> </td>
<td><?php echo $row['fname']; ?></td>
<td><?php echo $row['lname']; ?></td>
<td><?php echo $row['qua']; ?></td>
<td><?php echo $row['stream_id']; ?></td>
<td><?php echo $row['sub1']; ?></td>
<td><?php echo $row['sub2']; ?></td> 	
<td><?php echo $row['sub3']; ?></td>
<td><?php echo "<a href='Faculty_Update_View.php ?k=$a'>Update</a>"; ?></td>
<td><?php echo "<a href='Faculty_Delete.php ?k=$a'>Delete</a>"; ?></td>
<?php } ?>
</tr>
</table> 
	</div>
 </div>
</div>
<?php include "../Footer.php"; ?>
</div>
</body>
</html>