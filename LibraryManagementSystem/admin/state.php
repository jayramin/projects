<?php
require_once("header.php");
require_once("sidemenu.php");


{
		if(isset($_POST['submit']))
		$state = $_POST['state'];
		
					 $sql="insert into state values('','".$state."')";
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
            	<h1><center>State Details</center></h1>
            </div>
            <div class="panel-body">
            <div class="row">
            <div class="col-lg-3"></div>
            	<div class="col-lg-2 ">
               		<label class="pull-right">State Title</label>
                </div>
                <div class="col-lg-6">
                	<input type="text" name="state">
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
</div>    
<!--<div style="width: 50%; margin-left:200px; margin-top:50px; border-style:solid; border-radius:10px;" class="textbox">
<div class="box-head"><b>State</b></div>
<div class="box-content">
<input type="text" name="state">
<input type="submit" name="submit" value="Add">
<input type="reset" value="Cancel">
</div>

</div>-->
</form>
<br>
<br>                
 <?php
 require_once("footer.php");
 ?>
