<?php
$b=$_GET['stream_name'];
$c=$_GET['stream_desc'];
include "..\config_db.php";
$que="insert into stream_tbl(stream_name,stream_desc)values('$b','$c')";
$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert ('succes');
window.location="Stream_Add_Design.php";
</script>
<?php
}
else 
{

?>
<script>
alert ('try again');
window.location="Stream_Add_Design.php";
</script>
<?php
}
?>