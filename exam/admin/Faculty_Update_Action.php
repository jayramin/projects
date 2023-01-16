<?php
$fi=$_POST['f_id'];
$fu=$_POST['uname'];
$pas=$_POST['pass'];
$fn=$_POST['fname'];
$ln=$_POST['lname'];
$g=$_POST['gender'];
$e=$_POST['email']; 
$c=$_POST['cno']; 
$q=$_POST['qua'];
$py=$_POST['passyear'];
$jy=$_POST['joinyear'];
$te=$_POST['totalexp'];
$si=$_POST['stream_id'];
$s1i=$_POST['sub1'];
$s2i=$_POST['sub2'];
$s3i=$_POST['sub3'];
$l1=$_POST['line1'];
$l2=$_POST['line2'];
$d=$_POST['dis']; 
$pin=$_POST['pin'];
$city=$_POST['city'];
$state=$_POST['state'];

include "..\config_db.php";
$que="update faculty_tbl set f_id=$fi,uname='$fu',pass='$pas',fname='$fn',lname='$ln',gender='$g',email='$e',cno=$c,qua='$q',passyear='$py',joinyear='$jy',totalexp='$te',stream_id=$si,sub1=$s1i,sub2=$s2i,sub3=$s3i,line1='$l1',line2='$l2',dis='$d',pin='$pin',city='$city',state='$state' where f_id=$fi";
$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert('success updated');
window.location="Faculty_Manage.php";
</script>
<?php
}
else
{
?>
<script>
alert('try again');
window.location="Faculty_Update_View.php";
</script>
<?php
}
?>