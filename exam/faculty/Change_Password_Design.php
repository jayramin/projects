<html>
<title>Change password</title>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<body>
<div id="bodymain">
	<?php
	include "../menu.php";
	?>
	<div id="frame">
	<div id="body">
		<div id="submenu">
<?php include "faculty_menu.php"; ?>
</div>
	<div id="slider">
	<div id="line">Change Password</div>
	<script>
function validateForm() {
    var x = document.forms["myform"]["pass"].value;
    if (x==null || x=="") {
        alert("Old Password must be filled out");
        return false;
    }
	 var y = document.forms["myform"]["pass1"].value;
    if (y==null || y=="") {
        alert("New Password must be filled out");
        return false;
    }
	 var z = document.forms["myform"]["pass2"].value;
    if (z==null || z=="") {
        alert("Confirm Password must be filled out");
        return false;
    }
		if(document.myform.pass1.value != document.myform.pass2.value )
		{
			alert('Sorry !! Password and Confirm Password not match :(');
			return false;
		}
}
function checkPass()
{
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    var message = document.getElementById('confirm Message');
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
        if(pass1.value == pass2.value){
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
		return true;
    }else{
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
	
}
</script>
	<form name="myform" method="POST" onsubmit="return validateForm();" action="Change_Password_Action.php"  >
<table style="margin-top:20px;" align="center"><td>
<tr>
  	<td>Old password</td> <td> <input type="password" name="pass"></td>
  	</tr>
  	<tr>
  	<td>password</td> <td> <input type="password" name="pass1" id="pass1"></td>
  	</tr>
	<tr>
  	<td>Confirm password</td> <td> <input type="password" name="pass2" id="pass2"onkeyup="checkPass(); return false;" onblur="formcheck();"/>
    <span id="confirmMessage" class="confirmMessage"></span>
    </td>
  	</tr>
  	<tr>
    <td><input type="submit" value="Submit" /></td>
    </tr>
  	</table>    
	</div>
 </div>
</div>
<?php include "../footer.php"; ?>
</div>
</body>
</html>