<?php
require_once("header.php");
require_once("sidemenu.php"); 
    if (isset($_POST['submit']))
    {
        $div = $_POST['div'];
        $dept = $_POST['department'];
        $sem = $_POST['sem'];
        $sql = "insert into division values('','$div','$sem','$dept')";
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
                    <h1><center>Division Details</center></h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                       
                        <div class="row">	
                            <div class="col-lg-12">
                                 <div class="col-lg-2">
                                     <label>Department</label> </div>
                                 <div class="col-lg-8">
                                <select name="department" id="department" >
                                    <option>--Select department--</option>
                                    <?php
                                    $sql1 = "select * from department";
                                    $ex = $conn->query($sql1);
                                    while ($r = $ex->fetch_object()) {
                                        ?>
                                        <option value="<?php echo $r->department_id; ?>"><?php echo $r->department; ?></option>
                                    <?php }
                                    ?>
                                </select>
                                 </div>
                            </div>
                            <div class="col-lg-12">
                                 <div class="col-lg-2">
                                <label>Semister</label> 
                                 </div>
                                 <div class="col-lg-8">
                                <select name="sem" id="sem" >
                                    <option>--Select semister--</option>
                                    <?php
                                    $sql2 = "select * from sem";
                                    $ex1 = $conn->query($sql2);
                                    while ($r1 = $ex1->fetch_object()) {
                                        ?>

                                        <option value="<?php echo $r1->sem_id; ?>"><?php echo $r1->sem; ?></option>
                                    <?php }
                                    ?>
                                </select>
                                 </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-2">
                                        <label>Division Title</label>
                                </div>
                                 <div class="col-lg-8">
                                    <input type="text" name="div">  
                                 </div>
                               </div>
                            </div>
                        </div>

                            
                        </div>
                    <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-3" style="margin-bottom:15px;">
                        <input type="submit" name="submit" value="Add" class="btn btn-primary">
                        <input type="reset" value="Cancel" class="btn btn-danger">
                    </div>	
                </div>
                    </div>
                </div>
                
            </div>
        </div>   
    </div>
</div>    
</form>



<?php
require_once("footer.php");
?>