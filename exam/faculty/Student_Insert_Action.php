<?php
$unm=$_POST['uname'];echo $unm;
$r=$_POST['stu_rno'];echo $r;
$p=$_POST['pass'];echo $p;
$fn=$_POST['fname'];echo $fn;
$ln=$_POST['lname'];echo $ln;
$g=$_POST['gender'];echo $g;
$cno=$_POST['c']; echo $cno;
$e=$_POST['email'];echo $e;
$fc=$_POST['fc'];echo $fc;
$fe=$_POST['f_email'];echo $fe;
$sti=$_POST['stream_id'];echo $sti;
$si=$_POST['sem_id']; echo $si;
$l1=$_POST['line1'];echo $l1;
$l2=$_POST['line2'];echo $l2;
$c=$_POST['city'];echo $c;
$d=$_POST['dis'];echo $d;
$s=$_POST['state'];echo $s;
$pin=$_POST['pin']; echo $pin;

include "../config_db.php";
$que="insert into student_tbl (uname,stu_rno,pass,fname,lname,gender,c,email,fc,f_email,stream_id,sem_id,line1,line2,city,dis,state,pin)
values('$unm','$r','$p','$fn','$ln','$g',$cno,'$e',$fc,'$fe',$sti,$si,'$l1','$l2','$c','$d','$s','$pin')";

$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert ('succes');
window.location="Student_Registration.php";
</script>
<?php
}
else 
{

?>
<script>
alert ('Try again');
window.location="Student_Registration.php";
</script>
<?php
}
?>
