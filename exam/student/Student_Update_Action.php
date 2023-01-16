<?php
$a=$_POST['stu_id'];
$unm=$_POST['uname'];
$rno=$_POST['stu_rno'];
$p=$_POST['pass'];
$fn=$_POST['fname'];
$ln=$_POST['lname'];
$g=$_POST['gender'];
$cno=$_POST['cno'];
$e=$_POST['email'];
$fc=$_POST['f_cno'];
$fe=$_POST['f_email'];
$sti=$_POST['stream_id'];
$si=$_POST['sem_id'];
$l1=$_POST['line1'];
$l2=$_POST['line2'];
$c=$_POST['city'];
$d=$_POST['dis'];
$s=$_POST['state'];
$pin=$_POST['pin'];

include "../config_db.php";
echo $que="update student_tbl set stu_id=$a,
uname='$unm',
stu_rno='$rno',
pass='$p',
fname='$fn',
lname='$ln',
gender='$g',
cno='$cno',
email='$e',
f_cno='$fc',
f_email='$fe',
stream_id=$sti,
sem_id=$si,
line1=$l1,
line2=$l2,
city='$c',
dis=$d,
state='$s',
pin=$pin,where stu_id=$a";
$res=mysql_query($que,$conn);

if($res)
{
?>
<script>
alert('success updated');
window.location="Student_Update_Design.php";
</script>
<?php
}
else
{
?>
<script>
alert('try again');
window.location="Student_Update_Design.php";
</script>
<?php
}
?>
