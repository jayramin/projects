         
<?php
require_once("header.php");
require_once("sidemenu.php");
	

if(isset($_POST['regist']))
	{
		$uname =$_POST['txtname'];
		$pass =$_POST['txtpass'];
		$fname =$_POST['fname'];
		$lname =$_POST['lname'];
		$dob =$_POST['dob'];
		$mobile =$_POST['mobile'];
		$add =$_POST['add'];
		$city =$_POST['city'];
		$state =$_POST['state'];
		$qua =$_POST['qua'];
		$dept =$_POST['dept'];
		$email =$_POST['email'];
		$h=implode(",",$_POST['chk']);
		$utype =$_POST['u_type'];
		
		  $sql="insert into registration(name,password,fname,lname,dob,mobile,address,city_id,state_id,qualification,department_id,email,hobby,user_type)
		values ('$uname','$pass','$fname','$lname','$dob','$mobile','$add','$city','$state','$qua','$dept','$email','$h','$utype')";
		$ex=$conn->query($sql);
		
		
	}
	?>
?>
<!--<h1><center><b><u>Faculty Registration</u></b></center></h1>-->
<link href="assets/css/new.css" rel="stylesheet" />
<form method="post">
<br><div class="row ">
<div class="col-lg-4 pull-right"></div>
	<div class="col-lg-8 " style="margin-left:100px;">
    	<div class="panel panel-default" >
        	<div class="panel-heading">
            	<h1><center>Faculty Registration</center></h1>
            </div>
            <div class="panel-body">
            <div class="row">
            	<div class="col-lg-2 ">
               		<label class="pull-right">User Name</label>
                </div>
                <div class="col-lg-9">
                	<input type="text" name="txtname" class="textbox"/>
                </div>
            </div>
            
             <div class="row">
            	<div class="col-lg-2 ">
               		<label class="pull-right">Password</label>
                </div>
                <div class="col-lg-9">
                	<input type="password" name="txtpass" class="textbox"/>
                </div>
            </div>
             <div class="row">
            	<div class="col-lg-2 ">
               		<label class="pull-right">First Name</label>
                </div>
                <div class="col-lg-9">
                	<input type="text" name="fname" class="textbox"/>
                </div>
            </div> <div class="row">
            	<div class="col-lg-2 ">
               		<label class="pull-right">Last Name</label>
                </div>
                <div class="col-lg-9">
                	<input type="text" name="lname" class="textbox"/>
                </div>
            </div> <div class="row">
            	<div class="col-lg-2 ">
               		<label class="pull-right">DOB</label>
                </div>
                <div class="col-lg-9">
                	<input type="date" name="dob" class="textbox"/>
                </div>
            </div> <div class="row">
            	<div class="col-lg-2 ">
               		<label class="pull-right">Mobile</label>
                </div>
                <div class="col-lg-9">
                	<input type="text" name="mobile" class="textbox"/>
                </div>
            </div> <div class="row">
            	<div class="col-lg-2 ">
               		<label class="pull-right">Address</label>
                </div>
                <div class="col-lg-9">
                	<input type="text" name="add" class="textbox"/>
                </div>
            
            </div>
            
            <div class="row">
            <div class="col-lg-2 ">
             <label class="pull-right">State</label>
            </div>
            <div class="col-lg-9">
            <select name="state" class="textbox">
            <option>--Select State--</option>
			<?php 
				$sql = "SELECT * FROM state";
				$ex = $conn->query($sql);
				while($r = $ex->fetch_object()){ ?>
					<option value="<?php echo $r->state_id?>"><?php echo $r->state_name?>
					<?php }
				
			?>
            </select>
            
            </div>
            </div>
            <div class="row">
            <div class="col-lg-2 ">
             <label class="pull-right">City</label>
            </div>
            <div class="col-lg-9">
            <select name="city" class="textbox">
            <option>--Select City--</option>
			<?php 
				$sql = "SELECT * FROM city";
				$ex = $conn->query($sql);
				while($r = $ex->fetch_object()){ ?>
					<option value="<?php echo $r->city_id?>"><?php echo $r->city_name?>
					<?php }
				
			?>
            </select>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-2 ">
            <label class="pull-right">Qualification</label>
            </div>
            <div class="col-lg-9">
            <select name="qua" class="textbox">
            	<option value="select">---select Qualification---</option>
                <option value="B.sc">---B.sc---</option>
                <option value="M.sc">---M.sc---</option>
                <option value="B.com">---B.com---</option>
                <option value="M.com">---M.com---</option>
            </select>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-2 ">
            	<label class="pull-right">Department</label> 
             </div>
             <div class="col-lg-9">
             <select name="dept" class="textbox">
            <option>--Select Department--</option>
			<?php 
				$sql = "SELECT * FROM department";
				$ex = $conn->query($sql);
				while($r = $ex->fetch_object()){ ?>
					<option value="<?php echo $r->department_id?>"><?php echo $r->department_name?>
					<?php }
					?>
					  </select>
            </div>
            </div>
            
           <!-- <div class="row">
            <div class="col-lg-2">
            	<label class="pull-right">Semister</label>
            </div>
           <div class="col-lg-9">
            	<select name="sem" class="textbox">
            <option>--Select Semister--</option>
			<?php 
				//$sql = "SELECT * FROM sem";
				//$ex = $conn->query($sql);
				//while($r = $ex->fetch_object()){ ?>
					<option value="<?php //echo $r->sem_id?>"><?php //echo $r->sem?>
					<?php //}
					?>
					  </select>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-2">
            	<label class="pull-right">Division</label>
            </div>
           <div class="col-lg-9">
            	<select name="div" class="textbox">
            <option>--Select Division--</option>
			<?php 
				//$sql = "SELECT * FROM division";
				//$ex = $conn->query($sql);
				//while($r = $ex->fetch_object()){ ?>
					<option value="<?php //echo $r->division_id?>"><?php //echo $r->division?>
					<?php //}
					?>
                    
					  </select>
            </div>
            </div>-->
            <div class="row">
            	<div class="col-lg-2 ">
               		<label class="pull-right">E-mail</label>
                </div>
                <div class="col-lg-9">
                	<input type="text" name="email" class="textbox"/>
                </div>
            
            </div>
           
            <div class="row">
            <div class="col-lg-2">
            	<label class="pull-right">Hobby</label>
                
            </div>
            <div class="col-lg-9">
            	<input type="checkbox" name="chk[]" value="Dance" style=" margin:10px 10px 10px 10px;" />Dance
            <input type="checkbox" name="chk[]" value="Traveling"  style=" margin:10px 10px 10px 10px;"/>Traveling
            <input type="checkbox" name="chk[]" value="Acting"  style=" margin:10px 10px 10px 10px;"/>Cooking
            <input type="checkbox" name="chk[]" value="Reading"  style=" margin:10px 10px 10px 10px;"/>Reading
            </div>
            </div>
            <div class="row">
            <div class="col-lg-2">
            	<label class="pull-right">User Type</label>
            </div>
            <div class="col-lg-9">
            <select name="u_type" class="textbox">
        	
            <option value="select">---select User Type---</option>
            <option value="1">---1---</option>
            <option value="2">---2---</option>
            </select>
            </div>
            </div>
            </div> <div class="row">
            	<div class="col-lg-5"></div>
            		<div class="col-lg-3" style="margin-bottom:15px;">
            			<input type="submit" name="regist" value="Regist" class="btn btn-primary">
						<input type="reset" value="Cancel" class="btn btn-danger">
					</div>	
            </div>
        </div> 
    </div> 
    
</div> 
<!--<table border="2" align="center" style="height:400px; width:60%; margin-top:3% ">
		<tr align="center">
        	<td><label><b>User Name</b></label></td>
            <td><input type="text" name="txtname" class="textbox"/></td>
        </tr>
        <tr align="center">
        	<td><label><b>Password</b></label></td>
            <td><input type="password" name="txtpass" class="textbox"/></td>
        </tr>
        <tr align="center">
        	<td><label><b>First Name</b></label></td>
            <td><input type="text" name="fname" class="textbox"/></td>
        </tr>
        <tr align="center">
        	<td><label><b>Last Name</b></label></td>
            <td><input type="text" name="lname" class="textbox"/></td>
        </tr>
        <tr align="center">
        	<td><label><b>Dob</b></label></td>
            <td><input type="Date" name="dob" class="textbox"/></td>
        </tr>
        <tr align="center">
        	<td><label><b>Mobile</b></label></td>
            <td><input type="text" name="mobile" class="textbox"/></td>
        </tr>
        <tr align="center">
        	<td><label><b>Address</b></label></td>
            <td><input type="text" name="add" class="textbox"/></td>
        </tr>
        <tr align="center">
        	<td><label><b>City</b></label></td>
            <td>
            <select name="city" class="textbox">
            <option>--Select City--</option>
			<?php 
				//$sql = "SELECT * FROM city";
				//$ex = $conn->query($sql);
				//while($r = $ex->fetch_object()){ ?>
					<option value="<?php //echo $r->city_id?>"><?php //echo $r->city_name?>
					<?php //}
				
			?>
            </select>
            	
            </td>
        </tr>
        <tr align="center">
        	<td><label><b>State</b></label></td>
            <td>
            <select name="state" class="textbox">
            <option>--Select State--</option>
			<?php 
				//$sql = "SELECT * FROM state";
				//$ex = $conn->query($sql);
				//while($r = $ex->fetch_object()){ ?>
					<option value="<?php //echo $r->state_id?>"><?php //echo $r->state_name?>
					<?php //}
				
			?>
            </select>
            	
            </td>
        </tr>
        
        <tr align="center">
        	<td><label><b>Qualification</b></label></td>
            <td>
            
            <select name="qua" class="textbox">
            	<option value="select">---select---</option>
                <option value="B.sc">---B.sc---</option>
                <option value="M.sc">---M.sc---</option>
                <option value="B.com">---B.com---</option>
                <option value="M.com">---M.com---</option>
            </select>
            </td>
        </tr>
        <tr align="center">
        <td><label><b>Department</b></label></td>
        <td>
        <select name="dept" class="textbox">
            <option>--Select Department--</option>
			<?php 
				//$sql = "SELECT * FROM department";
				//$ex = $conn->query($sql);
				//while($r = $ex->fetch_object()){ ?>
					<option value="<?php //echo $r->department_id?>"><?php //echo $r->department_name?>
					<?php //}
					?>
					  </select>
					</td>
				</tr>
        <tr align="center">
        	<td><label><b>E-mail</b></label></td>
            <td><input type="text" name="email" class="textbox"/></td>
        </tr>
        <tr align="center">
        	<td><label><b>Hobby</b></label></td>
            <td><input type="checkbox" name="chk[]" value="Dance" style=" margin:10px 10px 10px 10px;"/>Dance
            <input type="checkbox" name="chk[]" value="Traveling"  style=" margin:10px 10px 10px 10px;"/>Traveling
            <input type="checkbox" name="chk[]" value="Acting"  style=" margin:10px 10px 10px 10px;"/>Cooking
            <input type="checkbox" name="chk[]" value="Reading"  style=" margin:10px 10px 10px 10px;"/>Reading</td>
        </tr>
        <tr>
        	<tr align="center">
            <td><b>User_type</b></td>
            <td><select name="u_type" class="textbox">
        	
            <option value="select">---select---</option>
            <option value="1">---1---</option>
            <option value="2">---2---</option>
            </select>
            </td>
        </tr>
    	</tr>
        <tr>
        	<td colspan="2" align="center" class="textbox">
            	
                <input type="submit" name="regist" value="Add" />
                <input type="reset" name="Cancel" value="Cancel"/>
            </td>
        </tr>
        
	</table><br><br>
</form>

<?php
require_once("footer.php");
?>

<script>
$(function ($) {
	alert('asdf');
        $("#mobile").mask("999-999-9999");
       
    });
</script>