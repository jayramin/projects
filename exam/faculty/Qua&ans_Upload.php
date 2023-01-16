<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/comman_css.css">
<script>
function select_stream(str) {
    if (str == "") {
        document.getElementById("txtHint1").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint1").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","semester_ajax.php?q="+str,true);
        xmlhttp.send();
    }
}

function select_subject(str) {
    if (str == "") {
        document.getElementById("txtHint2").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint2").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","subject_ajax.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
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
	<div id="slider"><div id="line">Upload Question Paper</div>
	<center>
	<form method="POST" action="Qua&ans_Upload_Action.php" name="myform" enctype="multipart/form-data">  <center>
<table style="margin-top:25px;" height=150px;>
<tr>
<td>Select Stream</td> 
<td>
<select name="stream"  onchange="select_stream(this.value)" style="width:150px; height:25px; border-radius:5px;">
<option>select the stream</option>
<?php
include "../config_db.php";
$que="select * from stream_tbl";
$res=mysql_query($que,$conn);
while($row=(mysql_fetch_array($res))){
?>
<option value="<?php echo $row['stream_id']?>"><?php echo $row['stream_name']; ?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>Select Semester</td>
<td>
<select id="txtHint1" name="semester" onchange="select_subject(this.value)" style="width:150px; height:25px; border-radius:5px;">
<option></option>
</select>
</td>
</tr>
<td>Select Subject</td>
<td>
<select id="txtHint2" name="subject" style="width:150px; height:25px; border-radius:5px;">
<option ></option>
</select>
</td>
</tr>
<tr>
<td></td>
<td><input type="file" name="userfile" style="width:150px; height:25px; border-radius:5px;"></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Submit"style="width:75px; height:25px; border-radius:5px;"></td>
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