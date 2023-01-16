<html>
<title>Faculty update view</title>
<body>
<?php
session_start();
include "../config_db.php";
$unm=$_SESSION['uname']; 
$que="select * from faculty_tbl where uname='$unm'";
$res=(mysql_query($que,$conn));
while($row=mysql_fetch_array($res))
{
?>
<table>
<td>User Name</td>
<td><input type="text" name="uname" value="<?php echo $row['uname'];?>"></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="pass" value="<?php echo $row['pass'];?>"></td>
</tr>
<tr>
<td>First Name</td>
<td><input type="text" name="fname" value="<?php echo $row['fname'];?>"></td>
<td>Last Name</td>
<td><input type="text" name="lname" value="<?php echo $row['lname'];?>"></td>
</tr>
<tr>
<td>Gender</td>
<td>
Female <input type="radio" name="gender" value="<?php echo $row['female'];?>">
Male &nbsp;<input type="radio" name="gender" value="<?php echo $row['male'];?>">
</td>
</tr>
<tr>
<td>E-mail</td>
<td><input type="text" name="email" value="<?php echo $row['email'];?>"></td>
<td>Contact Number</td>
<td><input type="text" name="cno" value="<?php echo $row['cno'];?>"></td>
</tr>
<tr>
<td>Qualification</td>
<td><input type="text" name="qua" value="<?php echo $row['qua'];?>"></td>
</tr>
<tr>
<td>Passing Year</td>
<td><input type="text" name="passyear" value="<?php echo $row['passyear'];?>"></td>
<td>Join Year</td>
<td><input type="text" name="joinyear" value="<?php echo $row['joinyear'];?>"></td>
</tr>
<tr>
<td>Total Experience</td>
<td><input type="text" name="totalexp" value="<?php echo $row['totalexp'];?>"></td>
</tr>
<tr>
<td>Stream</td>
<td><select name="stream_id" id="stream_id">
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
<td>Subject 1</td>
<td>
<select name="sub1" id="sub1">
		<?php
		include "../config_db.php";
		$qu="select * from Subject_tbl";
		$re=(mysql_query($qu,$conn));
		while($ro=mysql_fetch_array($re))
		{
		?>
		<option value="<?php echo $ro['sub_id']; ?>">
		<?php echo $ro['sub_name']; ?>
		<?php } ?>
		</option>
		</select>
</td><td>Subject 2</td>
<td>
<select name="sub2" id="sub2">
		<?php
		include "../config_db.php";
		$qu="select * from Subject_tbl";
		$re=(mysql_query($qu,$conn));
		while($ro=mysql_fetch_array($re))
		{
		?>
		<option value="<?php echo $ro['sub_id']; ?>">
		<?php echo $ro['sub_name']; ?>
		<?php } ?>
		</option>
		</select>
</td></tr>
<tr><td>Subject 3</td>
<td>
<select name="sub3" id="sub3">
		<?php
		include "../config_db.php";
		$qu="select * from Subject_tbl";
		$re=(mysql_query($qu,$conn));
		while($ro=mysql_fetch_array($re))
		{
		?>
		<option value="<?php echo $ro['sub_id']; ?>">
		<?php echo $ro['sub_name']; ?>
		<?php } ?>
		</option>
		</select>
</td>
</tr>
<tr>
<td>Line 1</td>
<td><input type="text" name="line1" value="<?php echo $row['line1'];?>"></td>
<td >Line 2</td>
<td><input type="text" name="line2" value="<?php echo $row['line2'];?>"></td>
</tr>
<tr>
<td>District</td>
<td><input type="text" name="dis" value="<?php echo $row['dis'];?>"></td>
<td>Pin code</td>
<td><input type="text" name="pin" value="<?php echo $row['pin'];?>"></td>
</tr>
<tr>
<td>City</td>
<td><input type="text" name="city" value="<?php echo $row['city'];?>"></td>
<td>State</td>
<td><input type="text" name="state" value="<?php echo $row['state'];?>"></td>
<?php
}
?>
</tr>
<td><center><input type="Submit" value="Submit" style="height:30px; width:100px; background-color:#666;
    color:white; margin-right:-100px" value="POST Selected Values"></center></td>
	</body>
	</html>