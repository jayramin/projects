
<?php
require_once("header.php");
require_once("sidemenu.php"); 
    if (isset($_POST['submit']))
        {
            $isbn = $_POST['isbn_no'];
            $sub = $_POST['sub'];
            $name_of_book = $_POST['name_of_book'];
            $author_name = $_POST['author_name'];
            $publisher = $_POST['publisher'];
            $edition = $_POST['edition'];
            $copies = $_POST['copies'];
            $sql = "insert into book_list values('','" . $isbn . "','" . $sub . "','" . $name_of_book . "','" . $author_name . "','" . $publisher . "','" . $edition . "','" . $copies . "')";
            $conn->query($sql);
        }
?>

<link href="assets/css/new.css" rel="stylesheet" />
<form method="post">
    <br><div class="row ">
        <div class="col-lg-4 pull-right"></div>
        <div class="col-lg-8 " style="margin-left:100px;">
            <div class="panel panel-default" >
                <div class="panel-heading">
                    <h1><center>Add Book Details</center></h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-2 ">
                            <label class="pull-right">ISBN no</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" name="isbn_no" class="textbox"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2 ">
                            <label class="pull-right">Subject</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" name="sub" class="textbox"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 ">
                            <label class="pull-right">Name of Book</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" name="name_of_book" class="textbox"/>
                        </div>
                    </div> <div class="row">
                        <div class="col-lg-2 ">
                            <label class="pull-right">Author Name</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" name="author_name" class="textbox"/>
                        </div>
                    </div> <div class="row">
                        <div class="col-lg-2 ">
                            <label class="pull-right">Publisher</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" name="publisher" class="textbox"/>
                        </div>
                    </div> <div class="row">
                        <div class="col-lg-2 ">
                            <label class="pull-right">Edition</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" name="edition" class="textbox"/>
                        </div>
                    </div> <div class="row">
                        <div class="col-lg-2 ">
                            <label class="pull-right">Copies</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" name="copies" class="textbox"/>
                        </div>

                    </div>
                </div> <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-3" style="margin-bottom:15px;">
                        <input type="submit" name="submit" value="Add" class="btn btn-primary">
                        <input type="reset" value="Cancel" class="btn btn-danger">
                    </div>	
                </div>
            </div> 
        </div> 
    </div> 
</form>
<br>
<br>            
<?php
require_once("footer.php");
?>
