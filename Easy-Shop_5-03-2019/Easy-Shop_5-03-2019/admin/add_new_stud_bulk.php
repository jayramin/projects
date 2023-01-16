<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shreeji Kelavani Mandal Send Bulk SMS</title>	
	<?php include('include/alllink.php'); ?>
</head>

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
						<a href="#">Send Bulk SMS</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
            
            <?php include('include/config.php'); ?>

<?php

	if(isset($_REQUEST['add_que']))
	{
		$cat=$_REQUEST['que_cat'];
		$que_desc=$_REQUEST['que_desc'];
		
		$handle = fopen($_FILES['file_name']['tmp_name'], "r");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
	{
       echo $import="INSERT into exam_que(que_cat,que_defi,op1,op2,op3,op4,ans,que_desc) values('$cat','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$que_desc')";
        $res=$conn->query($import);
    }
    fclose($handle);
		
	if($res)
	{
		?>
        <script>
		alert('Questions Successfully Inserted');
		window.location="add_question.php";
        </script>
        <?php
	}
	else
	{
		?>
         <script>
		alert('Sorry,Questions not Inserted');
		window.location="add_question.php";
        </script>
        <?php
	}
	}
?>


				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-envelope"></i> Send Bulk SMS</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
	
						 <form action="" method="POST" enctype="multipart/form-data">
							
							<div class="control-group">
							  <label class="control-label" for="typeahead">Select Student Data CSV File </label>
							  <div class="controls">
								<input type="file"  class="input-file uniform_on" id="fileInput"  >
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" name="send_bulk" value="Send It as Bulk" class="btn btn-primary">Add Data</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

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
