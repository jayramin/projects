<?php

session_start();

require './config_db.php';

$query = "delete from student_answer where user_id='" . $_SESSION['user'] . "'";
mysql_query($query);


session_unset();
session_destroy();
?>
<script>
    window.location = "homepage.php";
</script>
<?php

exit();
?>
