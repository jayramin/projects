<html>
<title>Genrate Exam</title>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<form action="Generate_Exam_Action.php" method="GET">
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
	<div id="slider"><center><table>
	<div id="line">Genarate Exam</div>
	<table border="1" style="margin-top:25px;" height=150 width=250>
	<tr >
	<td>Subject</td>
	<td colspan="2">	
	<select name="sub"  style="width:90px; height:25px; border-radius:5px;">
	<?php
	include "../config_db.php";
	$que="select * from subject_tbl";
	$res=(mysql_query($que,$conn));
	while($row=mysql_fetch_array($res))
	{
	?>
	<option value="<?php echo $row['sub_id'];?>">
	<?php  echo $row['sub_name'];?>
	</option> <?php } ?>
	</select>
	</tr>
	<tr>
	<td>10<input type="radio" value="10" name="mark"></td>
	<td>20<input type="radio" value="20" name="mark"></td>
	<td>30<input type="radio" value="30" name="mark" ></td>
	</tr>
	<tr>
	<td><input type="submit" value="Submit"></td>
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