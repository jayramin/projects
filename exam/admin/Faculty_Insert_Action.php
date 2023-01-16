<?php
$fu=$_POST['uname'];
$p=$_POST['pass'];
$fn=$_POST['fname']; 
$ln=$_POST['lname'];
$g=$_POST['gender']; 
$e=$_POST['email'];
$cn=$_POST['cno'];
$q=$_POST['qua'];
$py=$_POST['passyear']; 
$jy=$_POST['joinyear']; 
$te=$_POST['totalexp'];
$sti=$_POST['stream_id'];
$s1=$_POST['sub1'];
$s2=$_POST['sub2'];
$s3=$_POST['sub3'];
$l1=$_POST['line1'];
$l2=$_POST['line2'];
$d=$_POST['dis'];
$pin=$_POST['pin'];
$city=$_POST['city'];
$s=$_POST['state']; 

include "../config_db.php";

$que="insert into faculty_tbl(uname,pass,fname,lname,gender, email,cno,qua,passyear,joinyear,totalexp,stream_id,sub1,sub2,sub3, line1,line2,dis,pin,city,state) 
values('$fu','$p','$fn','$ln','$g','$e','$cn','$q','$py','$jy','$te',$sti,$s1,$s2,$s3,'$l1','$l2','$d','$pin','$city','$s')";

$res=mysql_query($que,$conn);
if($res)
{
?>
<script>
alert ("succes");
window.location="Faculty_Registration.php";
</script>
<?php
}
else 
{

?>
<script>
alert ("try again");
window.location="Faculty_Registration.php";
</script>
<?php
}
?>