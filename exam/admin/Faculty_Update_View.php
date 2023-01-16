<html>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<form action="Faculty_Update_Action.php" method="POST" name="myform">
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
	<div id="line">Faculty Update View</div>
	<center>
<?php

$a=$_GET['k'];
include "../config_db.php";
$que="select * from faculty_tbl where f_id=$a";
$res=(mysql_query($que,$conn));
while($row=mysql_fetch_array($res))
{
	
?>
<table width="700">
<input type="hidden" name="f_id" value="<?php echo $row['f_id']; ?>"><br/>
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
Female <input type="radio" name="gender" value="<?php echo $row['gender'];?>">
Male &nbsp;<input type="radio" name="gender" value="<?php echo $row['gender'];?>">
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
				$strm1=$row['stream_id'];
				$strm2=$s['stream_id'];
			if((isset($strm1) && $strm1 == $strm2))
			{
		?>
		<option value="<?php echo $s['stream_id']; ?>" selected="selected">
		<?php echo $s['stream_name']; 
		}
		else
		{
		?>
		<option value="<?php echo $s['stream_id']; ?>" >
		<?php echo $s['stream_name'];
		}
		?>
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
		$qu="select * from subject_tbl";
		$re=(mysql_query($qu,$conn));
		while($ro=mysql_fetch_array($re))
		{
			$s1=$row['sub1'];
			$s2=$ro['sub_id'];
			if((isset($s1) && $s1 == $s2))
			{
		?>
		<option value="<?php echo $ro['sub_id']; ?>" selected>
		<?php echo $ro['sub_name']; 
		}
		else
		{
		?>
		<option value="<?php echo $ro['sub_id']; ?>">
		<?php echo $ro['sub_name'];
		}
		?>
		<?php } ?>
		</option>
		</select>
		</td>
		</tr>
<td>Subject 2</td>
<td>
<select name="sub2" id="sub2">
		<?php
		include "../config_db.php";
		$qu="select * from subject_tbl";
		$re=(mysql_query($qu,$conn));
		while($ro=mysql_fetch_array($re))
		{
			$s1=$row['sub2'];
			$s2=$ro['sub_id'];
			if((isset($s1) && $s1 == $s2))
			{
		?>
		<option value="<?php echo $ro['sub_id']; ?>" selected>
		<?php echo $ro['sub_name']; 
		}
		else
		{
		?>
		<option value="<?php echo $ro['sub_id']; ?>">
		<?php echo $ro['sub_name'];
		}
		?>
		<?php } ?>
		</option>
		</select>
</td>
<td>Subject 3</td>
<td>
<select name="sub3" id="sub3">
		<?php
		include "../config_db.php";
		$qu="select * from subject_tbl";
		$re=(mysql_query($qu,$conn));
		while($ro=mysql_fetch_array($re))
		{
			$s1=$row['sub3'];
			$s2=$ro['sub_id'];
			if((isset($s1) && $s1 == $s2))
			{
		?>
		<option value="<?php echo $ro['sub_id']; ?>" selected>
		<?php echo $ro['sub_name']; 
		}
		else
		{
		?>
		<option value="<?php echo $ro['sub_id']; ?>">
		<?php echo $ro['sub_name'];
		}
		?>
		<?php } ?>
		</option>
		</select>
</td>
</tr>
<tr>
<td>Line 1</td>
<td><input type="text" name="line1" value="<?php echo $row['line1'];?>"></td>
<td >Line 2</td>
<td><input type="text" name="line2" value="<?php echo $row['line2'];?>"> </td>
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
</tr>
<?php
}
?>
<td><center><input type="Submit" value="Submit" style="height:30px; width:100px; background-color:#666;
    color:white; margin-right:-100px" value="POST Selected Values"></center></td>
	<td></td>
    <td><center><input type="Reset" value="Reset" style="height:30px; width:100px; background-color:#666;
    color:white;"></center></td>
	</tr>
</table>
</center>
	</div>
 </div>
</div>
<?php
include "../Footer.php";
?>
</div>
</body>
</html>