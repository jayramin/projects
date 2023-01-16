<html>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
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
	<div id="slider">
	<center>
	<table>
	<div id="line"> Setting </div>
	<table height=150 width=350>
<td><img src="../arrow.png" width="30" height="30" size="6"></td>
<td> <b>
<a href="Change_Password_Design.php"> Change Password </a>
<br> (for change the account password) </b></td>
</tr>
<tr>
<td><img src="../arrow.png" width="30" height="30" size="6"></td>
<td><a href="Faculty_Update_Design.php ?k=$a"><b>Update Account <br> </a>(for update account details)  </b></td>
</tr>
	</table>
	</center>
	</div>
 </div>
</div>
<?php
include "../footer.php";
?>
</div>
</body>
</html>