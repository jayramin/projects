<?php
	session_start();
	include("config.php");
	if(isset($_POST['login']))
	{
		
//		$u=$_POST['txtuname'];
//		$p=$_POST['txtpass'];
		
		$sql="select * from user where username='".$_POST['txtuname']."' AND password='".$_POST['txtpass']."'";
		$ex=$conn->query($sql);
		$data=$ex->fetch_assoc();
		if(mysqli_num_rows($ex)>0)
		{
			$_SESSION['userdata']=$data;
                        echo '<script>window.location="chat.php"</script>';
                        
                        
			//header("location:menu.php");
			//echo "data match";
		}
		else
		{
			echo "unauthorise user";
		}
	}
	

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style> 
.textbox { 
     border: 1px solid #848484; 
    -webkit-border-radius: 30px; 
    -moz-border-radius: 30px; 
    border-radius: 30px; 
    outline:0; 
    height:25px; 
    width: 275px; 
    padding-left:10px; 
    padding-right:10px; 

  } 
</style> 
</head>


    <div style="height: 40px;">
        
    </div><div style="height:200px;">
        <form method="post">
	<table border="1" align="center">
    	<tr>
        	<td>
                    <center>User Name</center>
            </td>
            <td><input type="text" name="txtuname" class="textbox" /></td>
        </tr>
        <tr>
        	<td><center>Password</center></td>
            <td><input type="password" name="txtpass" class="textbox" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
            <input type="submit" name="login" value="Login" />
            <input type="reset" value="Calncel" />
            </td> 
        </tr>
    </table>
</form>
        
    </div>
<div style="height:40px;">
        
    </div>
       

</html>
