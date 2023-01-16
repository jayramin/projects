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
	<div id="slider"><div id="line">Quetion paper</div>
	<center>
	<table width=90%>
	<tr>
	<td colspan=2 height=40>1. What does PHP stand for?</td></tr>
	<tr>
	<td><input type="radio" name="ans"></td>
	<td>Preprocessed Hypertext Page</td>
	<td><input type="radio" name="ans"></td>
	<td>Hypertext Markup Language</td>
	</tr>
	<tr>
	<td><input type="radio" name="ans"></td>
	<td> PHP: Hypertext Preprocessor</td>
	<td><input type="radio" name="ans"></td>
	<td> Hypertext Transfer Protocol</td>
	</tr>
	</table></center>
	</div>
 </div>
</div>
<?php
include "../footer.php";
?>
</div>
</body>
</html>