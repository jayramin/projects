
<html>
<title> ::Admin home</title>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<body>
<div id="bodymain">
	<?php
	include "../menu.php";
	?>
	<div id="frame">
	<div id="body">
		<div id="submenu">
<?php include "admin_menu.php"; ?>
</div>
	<div id="slider">
	<?php
	session_start();
include "../config_db.php";
$unm=$_SESSION['uname']; ?>
		Welcome <?php  echo $unm; ?>
	</div>
 </div>
</div>
<?php include "../footer.php"; ?>
</div>
</body>
</html>