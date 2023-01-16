<?php
error_reporting(0);
session_start();
$limit = $_REQUEST['limit'];
//echo $limit;
include "../config_db.php";
//print_r($_REQUEST);
//echo $_SESSION['user'];
for ($i = 0; $i < $limit; $i++) {
    $qid = $_REQUEST['que'][$i];
    if ($_REQUEST['option_' . $qid] != '') {
        $query = "insert into student_answer(user_id,question_id,answer) values('" . $_SESSION['user'] . "','" . $_REQUEST['que'][$i] . "','" . $_REQUEST['option_' . $qid] . "')";
        mysql_query($query);
    } else {

    }
    $qid = '';
}
?>
<script>
    window.location = "mapping.php";
</script>