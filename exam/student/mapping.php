<a href='../logout.php'>Logout</a>
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include "../config_db.php";
$que = "select * from student_answer where user_id='" . $_SESSION['user'] . "' AND answer!=''";
$res = (mysql_query($que, $conn));
$total_questions = mysql_num_rows($res);
while ($row = mysql_fetch_array($res)) {
    $question_id = $row['question_id'];
    $answer = $row['answer'];
    $query = "select * from tbl_mcq where id='" . $question_id . "'";
    $res1 = (mysql_query($query, $conn));
    while ($row1 = mysql_fetch_array($res1)) {
        $que = $row1['id'];
        if ($answer == $row1['ans']) {
            $right_que[] = $que;
        } else {
            $wrong_que[] = $que;
        }
    }
}
if (!empty($wrong_que)) {
    $wrong_count = sizeof($wrong_que);
} else {
    $wrong_count = 0;
}
if (!empty($right_que)) {
    $right_count = sizeof($right_que);
} else {
    $right_count = 0;
}
?>
<br>
<center>
    <h1>Exam Result:</h1>
    <br>
    <h3>Total Attempt: &nbsp;<font color="blue"><?php echo $total_questions; ?></font></h3>
    <h3>Right Answers: &nbsp;<font color="green"><?php echo $right_count; ?></font></h3>
    <h3>Wrong Answers: &nbsp;<font color="red"><?php echo $wrong_count; ?></font></h3>
</center>
<br>
<?php
/* echo "<center><h1>Qestions That You Select Wrong Answers</h1></center><br>";
  for ($i = 0; $i < sizeof($wrong_que); $i++) {
  echo "<center>" . $wrong_que[$i] . "<br><br></center>"; // it will print those question who have wrong answered by user who loged in...
  } */
?>

