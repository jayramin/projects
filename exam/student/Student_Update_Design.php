<html>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<form action="Student_Update_Action.php" method="POST" >
<body>
<div id="bodymain">
	<?php
	include "../menu.php";
	?>
	<div id="frame">
	<div id="submenu">
	<?php
	include "student_menu.php";
	?> </div>
	<div id="slider">
		<div id="line">Update Account</div>
		<?php
		session_start();
include "../config_db.php";
$unm=$_SESSION['uname']; 
		$que="select * from student_tbl where uname='$unm'";
		$res=mysql_query($que,$conn);
		while($row=(mysql_fetch_array($res)))
		{
		?>
<table width="700">
<input type="hidden" name="stu_id" value=<?php echo $row['stu_id'];?>>
<tr>
<td>User Name</td>
<td><input type="text" name="uname" value=<?php echo $row['uname'];?>></td>
</tr>
<tr>
<td>Roll number</td>
<td><input type="text" name="stu_rno" value=<?php echo $row['stu_rno'];?>></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="pass" value=<?php echo $row['pass'];?>></td>
</tr>
<tr>
<td>First Name</td>
<td><input type="text" name="fname" value=<?php echo $row['fname'];?>></td>
<td>Last Name</td>
<td><input type="text" name="lname" value=<?php echo $row['lname'];?>></td>
</tr>
<tr>
<td>Gender</td>
<td>
Female <input type="radio" name="gender" value="female">
Male &nbsp;<input type="radio" name="gender" value="male">
</td>
</tr>
<tr>
<td>Contact Number</td>
<td><input type="text" name="cno" value=<?php echo $row['cno'];?>></td>
<td>Father's Contact Number</td>
<td><input type="text" name="f_cno" value=<?php echo $row['f_cno'];?>></td>
</tr>
<tr>
<td>E-mail</td>
<td><input type="text" name="email" value=<?php echo $row['email'];?>></td>
<td>Father's E-mail</td>
<td><input type="text" name="f_email" value=<?php echo $row['f_email'];?>></td>
</tr>
<tr>
<td>Stream</td>
<td><select name="stream_id" id="stream_id">
		<?php
		include "../config_db.php";
		$q="select * from stream_tbl";
		$r=(mysql_query($q,$conn));
		while($o=mysql_fetch_array($r))
		{
		?>
		<option value="<?php echo $o['stream_id']; ?>">
		<?php echo $o['stream_name']; ?>
		<?php } ?>
		</option>
		</select></td>
<td>Semester</td>
<td><select name="sem_id" id="sem_id">
		<?php
		include "../config_db.php";
		$q="select * from semester_tbl";
		$r=(mysql_query($q,$conn));
		while($s=mysql_fetch_array($r))
		{
		?>
		<option value="<?php echo $s['sem_id']; ?>">
		<?php echo $s['sem_name']; ?>
		<?php  } ?>
		</option>
		</select></td>
</tr>
<tr>
<td>Line 1</td>
<td><input type="text" name="line1" value=<?php echo $row['line1'];?>></td>
<td >Line 2</td>
<td><input type="text" name="line2" value=<?php echo $row['line2'];?>></td>
</tr>
<tr>
<td>District</td>
<td><input type="text" name="dis" value=<?php echo $row['dis'];?>></td>
<td>Pin code</td>
<td><input type="text" name="pin" value=<?php echo $row['pin'];?>></td>
</tr>
<tr>
<td>City</td>
<td><input type="text" name="city" value=<?php echo $row['city'];?>></td>
<td>State</td>
<td><input type="text" name="state" value=<?php echo $row['state'];?>></td>
</tr>
<tr>
<td><center><input type="Submit" value="Submit" style="height:30px; width:100px; background-color:#666;
    color:white; margin-right:-100px"></center><td><center>
	<input type="reset" value="Reset" style="height:30px; width:100px; background-color:#666;
    color:white; margin-right:-100px"></center></td>
</tr>
</table>
<?php } ?>
</div>
</div>
<?php
include "../footer.php";
?>
</div>
</body>
</html>