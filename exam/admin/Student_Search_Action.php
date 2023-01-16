<?php
$type=$_POST['type'];
$search=$_POST['search'];

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
<td>Rollnumber</td>
<td><?php  echo $row['stu_rno']; ?></td>
<td>ID</td>
 <td><?php  echo $row['stu_id']; ?>  </td>
 <td>Username</td>
 <td><?php echo $row['uname'];  ?> </td>
 <tr>
 <?php
}
}
?>
<?php
include "../config_db.php";
if($type="uname")
{
$que="select * from student_tbl where uname='$search'";
$res=mysql_query($que,$conn);
while($row=mysql_fetch_array($res))
{
?>
<table border=1>
<tr>
<td>Rollnumber</td>
<td><?php  echo $row['stu_rno']; ?></td>
</tr><tr>
<tr>
<td>ID</td>
<td><?php  echo $row['stu_id']; ?> </td>
</tr><tr>
<td>User name</td>
<td><?php echo $row['uname'];  ?> </td>
</tr>
<?php
}
}
?>
<?php
include "../config_db.php";
if($type="stu_rno")
{
$que="select * from student_tbl where stu_rno='$search'";
$res=mysql_query($que,$conn);
while($row=mysql_fetch_array($res))
{
?>
<table border=1>
<tr>
<td>Rollnumber</td>
<td><?php  echo $row['stu_rno']; ?></td>
</tr><tr>
<tr>
<td>ID</td>
<td><?php  echo $row['stu_id']; ?> </td>
</tr><tr>
<td>User name</td>
<td><?php echo $row['uname'];  ?> </td>
</tr>
 <?php
}
}
?>
</body>
</html>
