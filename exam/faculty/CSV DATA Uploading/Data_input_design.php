<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::CSV Data Insert Design </title>
</head>
<body>
<form method="POST" action="another_action.php" name="myform" enctype="multipart/form-data">  
<table>
<caption>Upload Questions</caption>
<tr>
<td>Select Stream</td> 
<td>
<select name="stream">
<option>-----select -----</option>
<option value="BCA">BCA</option>
<option value="MCA">MCA</option>
<option value="BSC IT">BSC IT</option>
<option value="MSC IT">MSC IT</option>
</select>
</td>
</tr>
<tr>
<td>Select Semister</td>
<td>
<select name="semister">
<option>-----select -----</option>
<option value="SEM-1">SEM-1</option>
<option value="SEM-2">SEM-2</option>
<option value="SEM-3">SEM-3</option>
<option value="SEM-4">SEM-4</option>
<option value="SEM-5">SEM-5</option>
<option value="SEM-6">SEM-6</option>
</select>
</td>
</tr>
<td>Select Subject</td>
<td>
<select name="subject">
<option>-----select -----</option>
<option value="NETWORK">NETWORK</option>
<option value="DATABASE">DATABASE</option>
<option value="SOFTWARE">SOFTWARE</option>
<option value="HARDWARE">HARDWARE</option>
</select>
</td>
</tr>
<tr>
<td></td>
<td><input type="file" name="userfile" /></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Submit"/></td>
</tr>
</table>
</form>
</body>
</html>