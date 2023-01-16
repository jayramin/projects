<?php
require_once("header.php");
require_once("sidemenu.php");

if (isset($_POST['issue'])) {
    $dept = $_POST['dept'];
    $sem = $_POST['Sem'];
    $div = $_POST['div'];
    $regist = $_POST['regist'];
    $book = $_POST['book'];

    $bookstatus = $_POST['book_issue_status'];
}
$sql = "INSERT INTO book_issue VALUES('','$dept','$sem','$div','$regist','$book','$bookstatus')";

$ex = $conn->query($sql);
?>
<br />
<br />
<br />
<br />

<link href="assets/css/new.css" rel="stylesheet" />

<form method="post">
    <div class="row ">
        <div class="col-lg-4 pull-right"></div>
        <div class="col-lg-8 " style="margin-left:100px;">
            <div class="panel panel-default" >
                <div class="panel-heading">
                    <h1><center>Issue Book</center></h1>
                </div>
                <div class="panel-body">
                    <div class="row">

                        <select name="dept" class="textbox" onchange="getsemister(this), getstudents(this)">
                            <option>--Select Department--</option>
                            <?php
                            $sql = "SELECT * FROM department";
                            $ex = $conn->query($sql);
                            while ($r = $ex->fetch_object()) {
                                ?>
                                <option value="<?php echo $r->department_id ?>"><?php echo $r->department; ?>
                                <?php }
                                ?>
                            </option>
                        </select>
                        <select name="Sem" id='Sem' class="textbox" onchange="getdivision(this)">
                            <option>--Select Semister--</option>
                        </select>
                        <select name="div" id="Division" class="textbox" onchange="">
                            <option>--Select Division--</option>
                        </select>
                        <select name="regist" id="user" class="textbox">
                            <option>--Select User--</option>
                            <?php
                            $sql = "SELECT * FROM registration";
                            $ex = $conn->query($sql);
                            while ($r = $ex->fetch_object()) {
                                ?>
                                <option value="<?php echo $r->regist_id ?>"><?php echo $r->name; ?>
                                <?php }
                                ?>
                            </option>
                        </select>

                        <select name="book" class="textbox">
                            <option>--Select Book--</option>
                            <?php
                            $sql = "SELECT * FROM book_list";
                            $ex = $conn->query($sql);
                            while ($r = $ex->fetch_object()) {
                                ?>
                                <option value="<?php echo $r->book_list_id ?>"><?php echo $r->name_of_book ?>
                                <?php }
                                ?>
                            </option>
                        </select>
                        <input type="hidden" name="book_issue_status" value="Y">
                        <input type="submit" name="issue" value="Issue"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    function getsemister(e) {
        var dept_id = e.value;
        $.ajax({
            type: "post",
            url: 'ajax.php',
            data: {"do": "getsemister", "dept_id": dept_id},
            success: function (html) {
                $("#Sem").html(html);
            }
        });
    }

    function getdivision(e) {
        var sem_id = e.value;
        $.ajax({
            type: "post",
            url: 'ajax.php',
            data: {"do": "getdivision", "sem_id": sem_id},
            success: function (html) {
                $("#Division").html(html);
            }
        });
    }

//    function getstudents(e) {
//        var dept_id = e.value;
//        $.ajax({
//            type: "post",
//            url: 'ajax.php',
//            data: {"do": "getstudents", "dept_id": dept_id},
//            success: function (html) {
//                $("#user").html(html);
//            }
//        });
//    }
</script>
<?php
require_once("footer.php");
?>
