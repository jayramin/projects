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
	<?php
	session_start();
include "../config_db.php";
$unm=$_SESSION['uname']; ?>
		Welcome <?php  echo $unm; ?>
	
		</div>
</div>
<?php
include "../footer.php";
?>
</div>
</body>
</html>