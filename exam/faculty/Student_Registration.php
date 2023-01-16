<html>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<script>
	function validateForm()
{   
	 var unm = document.forms["myForm"]["uname"].value;
    if (unm == null || unm == "")
	{
        alert("User name must be filled out");
        return false;
    }
	var rno = document.forms["myForm"]["stu_rno"].value;
    if (rno == null || rno == "")
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
	var fe = document.forms["myForm"]["f_email"].value;
    var atpos = fe.indexOf("@");
    var dotpos = fe.lastIndexOf(".");
    if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=e.length) 
	{
        alert("Not a valid e-mail address");
        return false;
    }
	
        var l1 = document.forms["myForm"]["line1"].value;
    if (l1 == null || l1 == "")
	{
        alert("Line 1 must be filled out");
        return false;
    }
    var l2 = document.forms["myForm"]["line2"].value;
    if (l2 == null || l2 == "")
	{
        alert("Line 2 must be filled out");
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
	
	var cn = document.forms ["myForm"].["cn"].value;
			if (cn == null || cn == "")
	{
        alert("Number must be filled out");
        return false;
    }
           if(isNaN(cn)||cn.indexOf(" ")!=-1)
           {
              alert("Enter numeric value")
              return false; 
           }
           if (cn.length!=10)
           {
                alert("enter 10 characters");
                return false;
           }
	var fc = document.forms ["myForm"].["fc"].value;
			if (fc == null || fc == "")
	{
        alert("Number must be filled out");
        return false;
    }
           if(isNaN(fc)||fc.indexOf(" ")!=-1)
           {
              alert("Enter numeric value")
              return false; 
           }
           if (fc.length!=10)
           {
                alert("enter 10 characters");
                return false;
           }
	
}
</script>

<body>
<div id="bodymain">
	<?php
	include "../menu.php";
	?>
	<div id="frame">
	<div id="submenu">
	<?php
	include "faculty_menu.php";
	?>
		</div>
		<div id="slider"><div id="line">Student Registration</div>
			<form name="myForm" action="Student_Insert_action.php" onsubmit="return validateForm()" enctype="multipart/form-data" method="post">
<table width="700">
<tr>
<td>User Name</td>
<td><input type="text" name="uname"></td>
</tr>
<tr>
<td>Roll number</td>
<td><input type="text" name="stu_rno"></td>
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
<td>Contact Number</td>
<td><input type="text" name="c"></td>
<td>Father's Contact Number</td>
<td><input type="text" name="fc"></td>
</tr>
<tr>
<td>E-mail</td>
<td><input type="text" name="email"></td>
<td>Father's E-mail</td>
<td><input type="text" name="f_email"></td>
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
<tr>
<td><center><input type="Submit" value="Submit" style="height:30px; width:100px; background-color:#666;
    color:white; margin-right:-100px"></center><td><center>
	<input type="reset" value="Reset" style="height:30px; width:100px; background-color:#666;
    color:white; margin-right:-100px"></center></td>
</tr>
</table>
</div>
 </div>
</div>
<?php
include "../footer.php";
?>
</div>
</body>
</html>