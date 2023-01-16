<html>
<title>Faculty Registration</title>
<script>

	function validateForm()
{   
	 var unm = document.forms["myForm"]["uname"].value;
    if (unm == null || unm == "")
	{
        alert("User name must be filled out");
        return false;
    }
	
    var fn = document.forms["myForm"]["fname"].value;
    if (fn == null || fn == "")
	{
        alert("First name must be filled out");
        return false;
    }
	
	var ln = document.forms["myForm"]["lname"].value;
    if (ln == null || ln == "")
	{
        alert("Last name must be filled out");
        return false;
    }
	
	    var g = document.forms["myForm"]["gender"].value;
    if (g == null || g == "")
	{
        alert("Gender is not selected");
        return false;
    }
	
	 var e = document.forms["myForm"]["email"].value;
    var atpos = e.indexOf("@");
    var dotpos = e.lastIndexOf(".");
    if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=e.length) 
	{
        alert("Not a valid e-mail address");
        return false;
    }
	
	var q = document.forms["myForm"]["qua"].value;
    if (q == null || q == "")
	{
        alert("Qulification must be entered");
        return false;
    }
	
	    var py = document.forms["myForm"]["passyear"].value;
    if (py == null || py == "")
	{
        alert("Pass year must be filled out");
        return false;
    }
	    var jy = document.forms["myForm"]["joinyear"].value;
    if (jy == null || jy == "")
	{
        alert("Join year must be filled out");
        return false;
    }
	
	    var te = document.forms["myForm"]["totalexp"].value;
    if (te == null || te == "")
	{
        alert("Total expirience must be enter");
        return false;
    
	}
        var l1 = document.forms["myForm"]["line1"].value;
    if (l1 == null || l1 == "")
	{
        alert("Line 1 must be filled out");
        return false;
    }
	    var d = document.forms["myForm"]["dis"].value;
    if (d == null || d == "")
	{
        alert("District must be filled out");
        return false;
    }
	    var p = document.forms["myForm"]["pin"].value;
    if (p == null || p == "")
	{
        alert("Pin must be filled out");
        return false;
    }
	    var c = document.forms["myForm"]["city"].value;
    if (c == null || c == "")
	{
        alert("City must be filled out");
        return false;
    }
	    var s = document.forms["myForm"]["state"].value;
    if (s == null || s == "")
	{
        alert("State name must be filled out");
        return false;
    }
	
	var x = document.myForm.cno.value;
 
           if(isNaN(x)||x.indexOf(" ")!=-1)
           {
              alert("Enter numeric value")
              return false; 
           }
           if (x.length!=10)
           {
                alert("enter 10 characters");
                return false;
           }
	
}
</script>
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
	<div id="line">Faculty Registration</div>
	<center>
	<form name="myForm"  action="Faculty_Insert_Action.php" onsubmit="return validateForm()" method="post">
	
<table width="700">
<tr>
<td>User Name</td>
<td><input type="text" name="uname"></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="pass"></td>
</tr>
<tr>
<td>First Name</td>
<td><input type="text" name="fname"></td>
<td>Last Name</td>
<td><input type="text" name="lname"></td>
</tr>
<tr>
<td>Gender</td>
<td>
Female <input type="radio" name="gender" value="female">
Male &nbsp;<input type="radio" name="gender" value="male">
</td>
</tr>
<tr>
<td>E-mail</td>
<td><input type="text" name="email"></td>
<td>Contact Number</td>
<td><input type="text" name="cno"></td>
</tr>
<tr>
<td>Qualification</td>
<td><input type="text" name="qua"></td>
</tr>
<tr>
<td>Passing Year</td>
<td><input type="text" name="passyear"></td>
<td>Join Year</td>
<td><input type="text" name="joinyear"></td>
</tr>
<tr>
<td>Total Experience</td>
<td><input type="text" name="totalexp"></td>
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
<td><input type="text" name="line1"></td>
<td >Line 2</td>
<td><input type="text" name="line2"></td>
</tr>
<tr>
<td>District</td>
<td><input type="text" name="dis"></td>
<td>Pin code</td>
<td><input type="text" name="pin"></td>
</tr>
<tr>
<td>City</td>
<td><input type="text" name="city"></td>
<td>State</td>
<td><input type="text" name="state"></td>
</tr>
<td><center><input type="Submit" value="Submit" style="height:30px; width:100px; background-color:#666;
    color:white; margin-right:-100px"></center></td>
	<td></td>
    <td><center><input type="Reset" value="Reset" style="height:30px; width:100px; background-color:#666;
    color:white;"></center></td>
	</tr>
</table></center>
	</div>
 </div>
</div>
<?php
include "../Footer.php";
?>
</div>
</body>
</html>