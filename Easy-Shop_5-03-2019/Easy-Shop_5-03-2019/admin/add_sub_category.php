<?php
include('include/config.php');
	
	if(isset($_REQUEST['add_cat']))
	{
		$cnm=$_REQUEST['cat_nm'];
		$scnm=$_REQUEST['scat_nm'];
		$cdesc=$_REQUEST['cat_desc'];
		
		$cat_in="insert into sub_category_details_tbl (sub_cat_name,sub_cat_desc,cat_id) values('$scnm','$cdesc','$cnm')";
		$res_in=$conn->query($cat_in);
		if($res_in)
		{
			?>
			<script>
			alert('Sub category success Added.');
			window.location="add_sub_category.php";
			</script>
			<?php 
		}
		else
		{
			?>
			<script>
			alert('Sorry,category not Added.');
			window.location="add_sub_category.php";
			</script>
			<?php 
			
		}
	}
		if(isset($_REQUEST['scatid']))
	{
		$id=$_REQUEST['scatid'];
		
		$del="delete from sub_category_details_tbl where sub_cat_id=$id";
		$res_in=$conn->query($del);
		if($res_in)
		{
			?>
			<script>
			alert('Sub Category Delete success');
			window.location="add_sub_category.php";
			</script>
			<?php 
		}
		else
		{
			?>
			<script>
			alert('Sorry,Sub Category not Added.');
			window.location="add_sub_category.php";
			</script>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Sub Category</title>
	
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
						<a href="#">Add Category</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
			
	
 
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-envelope"></i> Add new Sub Category</h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
							<?php
							$cat="select * from category_details_tbl";
							$cat_res=$conn->query($cat);
							?>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Category Name</label>
							  <div class="controls">
								<select name="cat_nm"  id="focusedInput" class="input-xlarge focused" style="width:280px;">
								<option>----Select category----</option>
								<?php
								while($row=$cat_res->fetch_object())
								{
								?>
								<option value="<?php echo $row->cat_id?>"><?php echo $row->cat_name?></option>
								<?php
								}
								?>
								</select>
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="typeahead">Sub Category Name</label>
							  <div class="controls">
								<input type="text" name="scat_nm" placeholder="Enter Category Name" id="focusedInput" class="input-xlarge focused">
							  </div>
							</div>
							     
							<div class="control-group">
							  <label class="control-label" for="textarea2">Description </label>
							  <div class="controls">
								<textarea  name="cat_desc" rows="4" id="txtarea" placeholder="Category Description"  style="width:270px;"></textarea>
							  </div>
							   <div id="textarea_feedback"></div>
							</div>
							<div class="form-actions">
							  <button type="submit" name="add_cat" class="btn btn-primary">Add</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->
				
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Category List</h2>
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
								<th>Sub Category Name</th>
								<th>Category Name</th>
								<th>Description</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
                                
                                $sql="select * from sub_category_details_tbl join category_details_tbl where category_details_tbl.cat_id=sub_category_details_tbl.cat_id ";
                                $res=$conn->query($sql);
								$sr=1;
								while($r=$res->fetch_object())
                                {
                                    ?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td class="center"><?php echo $r->sub_cat_name; ?></td>
								<td class="center"><?php echo $r->cat_name; ?></td>
								<td class="center"><?php echo $r->sub_cat_desc; ?></td>
								
								<td class="center">									
									<a class="btn btn-info" href="#">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn btn-danger" href="add_sub_category.php?scatid=<?php echo $r->sub_cat_id;?>">
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
				<button type="button" class="close" data-dismiss="modal">??</button>
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
