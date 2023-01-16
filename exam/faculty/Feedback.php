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
	include "faculty_menu.php";
	?> </div>
		<div id="slider">
		<form method="post" action="sendmail.php">
  Email: <input name="email" type="text" /><br />
  Message:<br />
  <textarea name="message" rows="15" cols="40">
  </textarea><br />
  <input type="submit" />
</form>		
		<div id="line">Feedback</div>
		</div>
 </div>
</div>
<?php
include "../footer.php";
?>
</div>
</body>
</html>