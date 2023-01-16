<html>
<title>Search Student </title>
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
	<div id="line">Search Student</div>
	<form action="Student_Search.php" method="POST">
	<center>
<table style="margin-top:20px;" width=200>
<tr>
<?php
include "../config_db.php";
$que="select * from student_tbl";
$res=(mysql_query($que,$conn));
$row=mysql_fetch_array($res);
{
?>
<td><select name="type" style="width:200px; height:30px; border-radius:5px;">
<option value="<?php $row['stu_rno']; ?>">Roll number</option>
<option value="<?php $row['stu_id']; ?>">ID</option>
<option value="<?php $row['uname']; ?>">User name</option>
</select>
<?php 
}
 ?>
</td>
<td><input type="text" name="search" style="width:200px; height:30px; border-radius:5px;"></td>
</tr>
<tr>
<td><input type="submit" value="Search" style="height:30px; width:90px; b
    color:white; margin-right:-90px"></td>
</tr>
</table><hr>

<?php
$type=$_POST['type'];
$search=$_POST['search'];
?>
<?php 
if($type="stu_id")
{
include "../config_db.php";
$que="select * from student_tbl where stu_id='$search'";
$res=mysql_query($que,$conn);
while($row=mysql_fetch_array($res))
{
?>
<table border=1 style="text-align:center"><tr>
<th width=90 style="color:white;  background-color:#008866;">ID</th>
<th style="color:white;  background-color:#008866;">Roll number</th>
<th style="color:white;  background-color:#008866;">User name</th>
</tr><tr>
<td><?php  echo $row['stu_id']; ?>  </td> 
<td><?php  echo $row['stu_rno']; ?></td>
<td><?php echo $row['uname'];  ?> </td>
</tr>
</table>
 <?php
}
}
?>
<?php
if($type="stu_rno")
{
include "../config_db.php";
$que="select * from student_tbl where stu_rno='$search'";
$res=mysql_query($que,$conn);
while($row=mysql_fetch_array($res))
{
?>
<table border=1 style="text-align:center"><tr>
<th width=90 style="color:white;  background-color:#008866;">ID</th>
<th style="color:white;  background-color:#008866;">Roll number</th>
<th style="color:white;  background-color:#008866;">User name</th>
</tr><tr>
<td><?php  echo $row['stu_id']; ?></td>
<td><?php  echo $row['stu_rno']; ?>  </td> 
<td><?php echo $row['uname'];  ?> </td></tr>
</table>
 <?php
}
}
?>
<?php
if($type="uname")
{
include "../config_db.php";
$que="select * from student_tbl where uname='$search'";
$res=mysql_query($que,$conn);
while($row=mysql_fetch_array($res))
{
?>
<table border=1 style="text-align:center"><tr>
<th width=90 style="color:white;  background-color:#008866;">ID</th>
<th style="color:white;  background-color:#008866;">Roll number</th>
<th style="color:white;  background-color:#008866;">User name</th>
</tr><tr>
<td><?php  echo $row['stu_id']; ?></td>
<td><?php  echo $row['stu_rno']; ?> </td> 
<td><?php echo $row['uname'];  ?> </td></tr>
</table>
 <?php
}
}
?>
</div>
 </div>
</div>
<?php include "../footer.php"; ?>
</div>
</body>
</html>

