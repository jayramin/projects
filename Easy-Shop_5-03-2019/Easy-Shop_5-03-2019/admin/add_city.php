
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add City</title>
	
	<?php include('include/alllink.php'); ?>
	<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
   $(function() {
    $( "#datepicker1" ).datepicker();
  });
  </script>
<script src="js/jquery.bvalidator.js" type="text/javascript"></script>

<script type="text/javascript"> 
    $(document).ready(function () {
	
   
   $('#frm').bValidator();
   });
</script> 
	<link href="css/bvalidator.css" type="text/css" rel="stylesheet"/>
		
</head>
<?php
include('include/config.php');
	
	if(isset($_REQUEST['add_city']))
	{
		$cnm=$_REQUEST['ci_nm'];
	
		
		$cat_in="insert into city (city_name) values('$cnm')";
		$res_in=$conn->query($cat_in);
		if($res_in)
		{
			?>
			<script>
			alert('city success Added.');
			window.location="add_city.php";
			</script>
			<?php 
		}
		else
		{
			?>
			<script>
			alert('Sorry,city not Added.');
			window.location="add_city.php";
			</script>
			<?php 
			
		}
	}
?>
<body>
		<!-- topbar starts -->
			<?php include('include/topheader.php'); ?>
		<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
				<?php include('include/leftmenu.php'); ?>
			<!-- left menu ends -->
			
		
			
			<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add City</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
			
	
 
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-envelope"></i> Add new City</h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">City Name</label>
							  <div class="controls">
								<input type="text" name="ci_nm" placeholder="Enter City Name" id="focusedInput" class="input-xlarge focused" data-bvalidator="required">
							  </div>
							</div>
							     
							
							<div class="form-actions">
							  <button type="submit" name="add_city" class="btn btn-primary">Add</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->
				
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> City List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>ID</th>
								 <th>City Name</th>							 
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
                                
                                $sql="select * from city";
                                $res=$conn->query($sql);
								$sr=1;
								while($r=$res->fetch_object())
                                {
                                    ?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td class="center"><?php echo $r->city_name; ?></td>
								
								
								<td class="center">									
									<a class="btn btn-info" href="#">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
								</td>
							</tr>	
								<?php
								$sr++;
								}
								?>	
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

			</div><!--/row-->

					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
				
		<hr>
		

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>
		

		<?php include('include/footer.php'); ?>
		
	</div><!--/.fluid-container-->

		
</body>
</html>