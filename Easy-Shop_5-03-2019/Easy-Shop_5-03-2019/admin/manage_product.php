<?php
include('include/config.php');
	
	if(isset($_REQUEST['pid']))
	{
		$id=$_REQUEST['pid'];
		
		$del="delete from product_details_tbl where prod_id=$id";
		$res_in=$conn->query($del);
		if($res_in)
		{
			?>
			<script>
			alert('Product Delete success');
			window.location="manage_product.php";
			</script>
			<?php 
		}
		else
		{
			?>
			<script>
			alert('Sorry,Product not Added.');
			window.location="manage_product.php";
			</script>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>columbus</title>
	
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
						<a href="#">Products List</a>
					</li>
				</ul>
			</div>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Products List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
<a href="add_new_product.php"><button type="submit" class="btn btn-primary" style="float:right;font-weight:bold; margin-right:20px;">Add Product
		</button></a>
		
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>No</th>
								  <th>Product Name</th>
								  <th>Start Date</th>
								  <th>End Date</th>
								  <th>Base Price</th>
								  <th>Category</th>
								  <th>Sub Category</th>
								  <th>Brand</th>								 
								  <th style="width:100px;">Image</th>
								  <th style="width:200px;">Product Description</th>
								  <th>Product size</th>
								  <th>Product Color</th>
								  <th>Product quantity</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
                                include('include/config.php');
                                $sql="select * from product_details_tbl join category_details_tbl on category_details_tbl.cat_id=product_details_tbl.cat_id join sub_category_details_tbl on sub_category_details_tbl.sub_cat_id=product_details_tbl.sub_cat_id join brand_details_tbl on brand_details_tbl.brand_id=product_details_tbl.brand_id";
                                $res=$conn->query($sql);
								$sr=1;
								while($r=$res->fetch_object())
                                {
                                    ?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td class="center"><?php echo $r->prod_name; ?></td>
								<td class="center"><?php echo $r->sdate; ?></td>
								<td class="center"><?php echo $r->edate; ?></td>
								<td class="center"><?php echo $r->bprice; ?></td>
								<td class="center"><?php echo $r->cat_name; ?></td>
								<td class="center"><?php echo $r->sub_cat_name; ?></td>
								<td class="center"><?php echo $r->brand_name; ?></td>
								<td class="center"><img src="<?php echo $r->img_path; ?>" style="border:1px solid #888;border-radius:5px;height:100px;widht:100px;">								</td>								
								<td class="center"><?php echo $r->prod_desc; ?></td>
								<td class="center"><?php echo $r->prod_size; ?></td>
								<td class="center"><?php echo $r->prod_color; ?></td>
								<td class="center"><?php echo $r->prod_quantity; ?></td>
								
								<td class="center">									
									<a class="btn btn-info" href="#">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn btn-danger" href="manage_product.php?pid=<?php echo $r->prod_id;?>">
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
