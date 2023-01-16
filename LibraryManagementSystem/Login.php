<?php

require_once("header.php");
	if(isset($_POST['Login']))
	{
		echo '<br><br><br><br><br><br>';
		$u=$_POST['txtname'];
		$p=$_POST['pass'];
		
		$sql="select * from registration where name = '".$_POST['txtname']."' AND password = '".$_POST['pass']."'";
		$result=$conn->query($sql);	
		//echo '<pre>';
		//print_r($result);
		if($result->num_rows > 0){

			echo 'Login Success'; 
			?>
			<script>window.location.href='admin/index.php';</script> <?php
		}else{
			echo 'User name or password incorrect';
		}
	}

?>

<style>
.body {
	/*background-image:url(images/clientbg.jpg);*/
}

</style>
<br>
    <br>
    <br>
<body class="body">

<form method="post">
 <br>
    <table align="center" border="2" width="40%">
     <tr>
    	<thead><th colspan="2"><center><h1>Login</h1></center></th></thead>
    </tr> 
    <tr>
      <td class="field">User Name</td>
      <td><input type="text" name="txtname" placeholder="User Name"/></td>
    </tr>
    <tr>
      <td class="field">Password</td>
      <td><input type="password" name="pass" placeholder="Password"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <input type="submit" name="Login" value="Login" class="btn btn-success"/>
      <input type="reset" name="cancel" value="Cancel" class="btn btn-danger" />
       <li><a href="Regist.php">SIGN UP</a></li>	</td>
    </tr>
    
	</table>
    
          </ul>	
          </ul>
  <br>

  </form>
</body>
</html>
<?php

require_once("footer.php");

?>