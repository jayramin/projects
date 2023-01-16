<html>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<form action="Student_Insert_Action.php" method="GET" >
<body>
<div id="bodymain">
	<?php
	include "../menu.php";
	?>
	<div id="frame">
	<div id="submenu">
	<?php
	include "Faculty_Menu.php";
	?> </div>
	<div id="slider"><div id="line">Manage Students</div>
<table border="1" align="center">
<td>User name</td>
<td>Roll_No</td>
<td>First Name</td>
<td>Last Name</td>
<td>Stream</td>
<td>Semester</td>
</tr>
<?php 
include "../config_db.php";
$que="select * from student_tbl";
$res=(mysql_query($que,$conn));
while($row=mysql_fetch_array($res))
{
	$a=$row['stu_id'];
?>
<tr>
<td><?php echo $row['uname']; ?></td>
<td><?php echo $row['stu_rno']; ?></td>
<td><?php echo $row['fname']; ?></td>
<td><?php echo $row['lname']; ?></td>
<td><?php echo $row['stream_id']; ?></td>
<td><?php echo $row['sem_id']; ?></td>
<td><?php echo "<a href='Student_View.php ?k=$a'> View </a>" ?></td>
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