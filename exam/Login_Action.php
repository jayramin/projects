<?php

session_start();
include "config_db.php";


$unm = $_POST['uname'];
$pass = $_POST['pass'];
$type = $_POST['type'];

$_SESSION['uname'] = $unm;

if ($type == "Admin") {
    $count = 0;
    $que = "select * from admin_tbl where uname='$unm' AND pass='$pass'";
    $res = mysql_query($que, $conn);
    while ($row = mysql_fetch_array($res)) {
        $count++;
    }
    if ($count > 0) {
        ?>
        <script>
            alert('success');
            window.location = "admin/Admin_Home.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert('not success login');
            window.location = "homepage.php";
        </script>
        <?php

    }
}
//faculty
else if ($type == "Faculty") {
    $count = 0;
    $que = "select * from faculty_tbl where uname='$unm' AND pass='$pass'";
    $res = mysql_query($que, $conn);
    while ($row = mysql_fetch_array($res)) {
        $count++;
    }
    if ($count > 0) {
        ?>
        <script>
            alert('success');
            window.location = "faculty/Faculty_Home.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert('not success login');
            window.location = "homepage.php";
        </script>
        <?php

    }
}
//students
else if ($type == "Student") {
    $_SESSION['user'] = "student";
    $count = 0;
    $que = "select * from student_tbl where uname='$unm' AND pass='$pass'";
    $res = mysql_query($que, $conn);
    while ($row = mysql_fetch_array($res)) {
        $count++;
    }
    if ($count > 0) {
        ?>
        <script>
            alert('success');
            window.location = "student/Student_Home.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert('not success login');
            window.location = "homepage.php";
        </script>
        <?php

    }
} else {
    echo "sorry wrong choice enter bu u";
}
?>