<html>
<title>Student Search</title>
<body>
<center>
<form action="Student_Search_Design.php" method="POST">
<table>
<tr>
<?php
include "../config_db.php";
$que="select * from student_tbl";
$res=(mysql_query($que,$conn));
while($row=mysql_fetch_array($res))
{
?>
<td><select name="type">
<option value="<?php $row['stu_rno']; ?>">Roll number</option>
<option value="<?php $row['stu_id']; ?>">ID</option>
<option value="<?php $row['uname']; ?>">User name</option>
</select>
<?php } ?>
</td>
<td><input type="text" name="search"></td>
</tr>
<tr>
<td><input type="submit" value="submit"></td>
</tr>
</table>
</center>

<?php
$type=$_POST['type'];
$search=$_POST['search'];

if($type="stu_rno")
{
include "../config_db.php";
$que="select * from student_tbl where stu_rno='$search'";
$res=mysql_query($que,$conn);
while($row=mysql_fetch_array($res))
{
?>
<table border=1>
<tr>
<td><?php  echo $row['stu_rno']; ?></td>
 <td><?php  echo $row['stu_id']; ?>  </td>
 <td><?php echo $row['uname'];  ?> </td>
 <tr>
 <?php
}}
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
<table border=1>
<tr>
<td><?php  echo $row['stu_rno']; ?></td>
 <td><?php  echo $row['stu_id']; ?>  </td>
 <td><?php echo $row['uname'];  ?> </td>
 <tr>
 <?php
}}
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
<table border=1>
<tr>
<td><?php  echo $row['stu_rno']; ?></td>
 <td><?php  echo $row['stu_id']; ?>  </td>
 <td><?php echo $row['uname'];  ?> </td>
 <tr>
 <?php
}}
?>

</body>
</html>