<?php
error_reporting(0);
?>
<html>
    <title>Paper</title>
    <link rel="stylesheet" type="text/css" href="../css/quetionpaper.css">
    <script src="jquery-1.9.1.min.js"></script>
    <body>
        <div id="bodymain">
            <?php
            include "../menu.php";
            $sub = $_GET['sub'];
            $mark = $_GET['mark'];
            $limit = $mark / 2;
            ?>
            <div id="frame">
                <div id="slider">
                    <div id="line">Your Time starts now &nbsp; <span id="countdown">00:<?php echo $limit; ?>:00</span></div>

                    <script>
                        (function() {
                            $(document).ready(function() {
                                var time = "00:<?php echo $limit; ?>:00",
                                        parts = time.split(':'),
                                        hours = +parts[0],
                                        minutes = +parts[1],
                                        seconds = +parts[2],
                                        span = $('#countdown');

                                function correctNum(num) {
                                    return (num < 10) ? ("0" + num) : num;
                                }

                                var timer = setInterval(function() {
                                    seconds--;
                                    if (seconds == -1) {
                                        seconds = 59;
                                        minutes--;

                                        if (minutes == -1) {
                                            minutes = 59;
                                            hours--;

                                            if (hours == -1) {
                                                alert("time Over");
                                                window.location = "../logout.php";
                                                clearInterval(timer);
                                                return;
                                            }
                                        }
                                    }
                                    span.text(correctNum(hours) + ":" + correctNum(minutes) + ":" + correctNum(seconds));
                                }, 1000);
                            });
                        })()
                    </script>
                    <style>
                        #countdown
                        {
                            color:red !important;
                            float:right;
                            font-size: xx-large;
                        }
                    </style>
                    <center>

                        <form action="insert_exam_que.php?limit=<?php echo $mark; ?>" method="post">
                            <table width=1000>
                                <?php
                                include "../config_db.php";
                                $que = "select id,que,op1,op2,op3,op4 from tbl_mcq where subject='$sub' ORDER BY RAND() LIMIT $mark";
                                $res = (mysql_query($que, $conn));
                                $no = 1;
                                while ($row = mysql_fetch_array($res)) {
                                    ?>
                                    <tr>
                                        <td colspan=2><b>
                                                <?php echo $no; ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php echo $row['que']; ?></b></td>
                                    </tr>
                                    <tr>
                                    <input type="hidden" value="<?php echo $row['id']; ?>" name="que[]">
                                    <td><input type="radio" value="<?php echo $row['op1'] ?>" name="option_<?php echo $row['id']; ?>">
                                        <?php echo $row['op1']; ?></td>
                                    <td><input type="radio" value="<?php echo $row['op2'] ?>" name="option_<?php echo $row['id']; ?>">
                                        <?php echo $row['op2']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" value="<?php echo $row['op3'] ?>" name="option_<?php echo $row['id']; ?>">
                                            <?php echo $row['op3']; ?></td>
                                        <td><input type="radio" value="<?php echo $row['op4'] ?>" name="option_<?php echo $row['id']; ?>">
                                            <?php echo $row['op4']; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2><hr></td></tr>
                                    <?php
                                    $no++;
                                }
                                ?>
                                <tr><td></td><td><input type="submit" value="SUBMIT" style="background-color:maroon; color:#fff; height:30px;width:100px;">
                                        <input type="reset" value="RESET" style="background-color:maroon; color:#fff; height:30px;width:100px;"></td></tr>
                            </table>
                        </form>
                    </center>
                </div>
            </div>
            <?php
            include "../footer.php";
            ?>
        </div>
    </body>
</html>