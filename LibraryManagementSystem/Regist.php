<?php
	
	include("header.php");
	if(isset($_POST['Regist']))
	
	{
		$uname=$_POST['txtname'];
		$pass=$_POST['txtpass'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$dob=$_POST['dob'];
		$mobile=$_POST['mobile'];
		$add=$_POST['add'];
		$qua=$_POST['qua'];
		$dept=$_POST['dept'];
		$email=$_POST['email'];
		$h=implode(",",$_POST['chk']);
		$utype=$_POST['u_type'];
			{
		 $sql="insert into registration(name,password,fname,lname,dob,mobile,address,qualification,department_id,email,hobby,user_type) values ('$uname','$pass','$fname','$lname','$dob','$mobile','$add','$qua','$dept','$email','$h','$utype')"; 	
		$ex=$conn->query($sql);	
		
			}
	}
	
?>
<style>
4
</style>
<body >
<form method="post"><br><br><br><br>
<h1>Student Registration</h1><br>
	<table border="2" align="center" style="height:400px; width:60%; ">
		<tr>
        	<td><label>User Name</label></td>
            <td><input type="text" name="txtname"/></td>
        </tr>
        <tr>
        	<td><label>Password</label></td>
            <td><input type="password" name="txtpass"/></td>
        </tr>
        <tr>
        	<td><label>First Name</label></td>
            <td><input type="text" name="fname"/></td>
        </tr>
        <tr>
        	<td><label>Last Name</label></td>
            <td><input type="text" name="lname"/></td>
        </tr>
        <tr>
        	<td><label>Dob</label></td>
            <td><input type="Date" name="dob"/></td>
        </tr>
        <tr>
        	<td><label>Mobile</label></td>
            <td><input type="text" name="mobile"/></td>
        </tr>
        <tr>
        	<td><label>Address</label></td>
            <td><input type="text" name="add"/></td>
        </tr>
        <tr>
        	<td><label>City</label></td>
            <td>
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
            	
            </td>
        </tr>
        <tr>
        	<td><label>State</label></td>
            <td>
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
            	
            </td>
        </tr>
        
        <tr>
        	<td><label>Qualification</label></td>
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
        <tr>
        	<td><label>Department_id</label></td>
            <td><input type="text" name="dept"/></td>
        </tr>
        <tr>
        	<td><label>E-mail</label></td>
            <td><input type="text" name="email"/></td>
        </tr>
        <tr>
        	<td><label>Hobby</label></td>
            <td><input type="checkbox" name="chk[]" value="Dance" style=" margin:10px 10px 10px 10px;"/>Dance
            <input type="checkbox" name="chk[]" value="Traveling"  style=" margin:10px 10px 10px 10px;"/>Traveling
            <input type="checkbox" name="chk[]" value="Acting"  style=" margin:10px 10px 10px 10px;"/>Cooking
            <input type="checkbox" name="chk[]" value="Reading"  style=" margin:10px 10px 10px 10px;"/>Reading</td>
        </tr>
        <tr>
        	<tr>
            <td>User_type</td>
            <td><select name="u_type">
        	
            <option value="select">---select---</option>
            <option value="1">---1---</option>
            <option value="2">---2---</option>
            </select>
            </td>
        </tr>
    	</tr>
        <tr>
        	<td colspan="2" align="center">
            	
                <input type="submit" name="Regist" value="Regist"/>
                <input type="reset" name="Cancel" value="Cancel"/>
            </td>
        </tr>
        
	</table><br><br>
</form>
</body>
</html>
<?php 
	include("footer.php");
?>