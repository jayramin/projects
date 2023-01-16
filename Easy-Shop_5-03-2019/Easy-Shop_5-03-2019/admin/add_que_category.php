<?php
 include('include/config.php'); 
if(isset($_REQUEST['add_cat']))
{
	$cnm=$_REQUEST['cnm'];
	$cdesc=$_REQUEST['cdesc'];
	
	$sq="insert into que_category (cat_name,cat_desc) values ('$cnm','$cdesc')";
	$res=$conn->query($sq);
	if($res)
	{
		?>
        <script>
		alert('Category Successfully Inserted');
		window.location="cat_que_view.php";
        </script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('Sorry , Category not Inserted');
		window.location="add_que_category.php";
        </script>
        <?php
	}
}

if(isset($_REQUEST['did']))
{
	$id=$_REQUEST['did'];
	
	$sq="delete from que_category  where cat_id=$id";
	$res=$conn->query($sq);
	if($res)
	{
		?>
        <script>
		window.location="cat_que_view.php";
        </script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('Sorry , Category not Deleted');
		window.location="cat_que_view.php";
        </script>
        <?php
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shreeji Kelavani Mandal Send Single SMS</title>
	
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
						<a href="#">Send Single SMS</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
			
	
 
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-envelope"></i> Send Single SMS</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="" method="post">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Category Name</label>
							  <div class="controls">
								<input type="text" name="cnm" placeholder="Enter Sender Mobile Number" id="focusedInput" class="input-xlarge focused">
							  </div>
							</div>
							     
							<div class="control-group">
							  <label class="control-label" for="textarea2">Description </label>
							  <div class="controls">
								<textarea class="cleditor" name="cdesc" id="txtarea" rows="3" placeholder="One Message Contains 160 Charactors and More then 160 Consider as Two Message"></textarea>
							  </div>
							   <div id="textarea_feedback"></div>
							</div>
							<div class="form-actions">
							  <button type="submit" name="add_cat" class="btn btn-primary">Add Category</button>
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
