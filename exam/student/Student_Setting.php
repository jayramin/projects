<html>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<form action="sub/insert_action_sub.php" method="GET" >
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
<div id="line"> Setting </div><center>
	<table height=150 width=350>
<td><img src="../arrow.png" width="30" height="30" size="6"></td>
<td> <a href="Change_Password_Design.php"><b> Change Password <br> </a>(for change the account password) </b></td>
</tr>
<tr>
<td><img src="../arrow.png" width="30" height="30" size="6"></td>
<td><a href="Student_Update_Design.php"><b>Update Account <br> </a>(for update account details)  </b></td>
</tr>
</table></center>
</div>
</div>
</div>
<?php include "../footer.php"; ?>
</body>
</html>