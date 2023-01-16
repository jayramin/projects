<?php 
	include("config.php");
	//echo $_POST["city_id"];
	
	if($_REQUEST['do']=='get_area')
	{
	
	    $sql="select * from student_regist where suname='".$_SESSION['userdata']['username']."'";
		$ex=$conn->query($sql);
		$data=$ex->fetch_assoc();
	
	
	if(isset($_POST["city_id"]))
	{
			$c=$_POST["city_id"];
			$sql1="select * from area where city_id='$c'";
			$ex1=$conn->query($sql1);
			?>
            
			<option value=" ">--select--</option>
		 
			<?php
			while($r1=$ex1->fetch_object())
			
			{
				?>
                
                <option value="<?php echo $r1->area_id?>" <?php if($data['area_id']==$r1->area_id) {?> selected="selected" <?php } ?>><?php echo $r1->area_name?></option>
                <?php
			}
	}
	}elseif($_REQUEST['do']=='check_user_avaliablity')
	{
		$sql="select ".$_REQUEST['field_name']." from student_regist where ".$_REQUEST['field_name']." = '".$_REQUEST['field_value']."'";
		$ex=$conn->query($sql);
		if(mysqli_num_rows($ex)>0)
		{
			echo "Username Already Exixts";
		}
	}
	
?>