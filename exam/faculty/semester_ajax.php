<!DOCTYPE html>
<html>
<head>
</head>
<body>
<select>
<option value="">Select the semester</option>
<?php
$q = intval($_GET['q']);

$con = mysqli_connect("localhost","root");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"exam");
echo $sql="SELECT * FROM semester_tbl WHERE stream_id = '".$q."'";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {

	?>
<option value="<?php echo $row['sem_id'];?>"><?php echo $row['sem_name'];?></option>
	<?php 
  }
mysqli_close($con);
?>
</select>
</body>
</html>