<?php
require_once("header.php");
require_once("sidemenu.php");
	{
		if(isset($_POST['submit']))
		$city = $_POST['city'];
		$state = $_POST['state'];
	   
	   $sql="insert into city values('','".$city."','".$state."')";
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
            	<h1><center>City Details</center></h1>
            </div>
            <div class="panel-body">
            <div class="row">
            <div class="col-lg-7">
            <div>
            <select name="state" class="pull-right">
            <option>--Select State--</option>
			<?php 
				$sql = "SELECT * FROM state";
				$ex = $conn->query($sql);
				while($r = $ex->fetch_object()){ ?>
					<option value="<?php echo $r->state_id?>"><?php echo $r->state_name?>
					<?php }
				
			?>
            </option>
</select>
            </div>
            </div>
            </div>
            </div>
            
            <div class="row">
            <div class="col-lg-3"></div>
            	<div class="col-lg-2 ">
               		<label class="pull-right">City Title</label>
                </div>
                <div class="col-lg-5">
                	<input type="text" name="city">
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
<div class="box-head " ><b>City</b></div>
<div class="box-content">

    <select name="state" >
            <option>--Select State--</option>
			<?php 
				//$sql = "SELECT * FROM state";
				//$ex = $conn->query($sql);
				//while($r = $ex->fetch_object()){ ?>
					<option value="<?php //echo $r->state_id?>"><?php //echo $r->state_name?>
					<?php// }
				
			?>
</select>
<input type="text" name="city" />

<input type="submit" name="submit" value="Add" />
<input type="reset" value="Cancel">
</div>

</div>-->
</form>
<br>
<br>            

<?php
require_once("footer.php");
?>
