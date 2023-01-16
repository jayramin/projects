<?php
include('include/config.php');
	
	if(isset($_REQUEST['add_cat']))
	{
		$pnm=$_REQUEST['pnm'];
		$sdt=$_REQUEST['sdate'];
		$edt=$_REQUEST['edate'];
		$bprice=$_REQUEST['bprice'];
		$cnm=$_REQUEST['cat_nm'];
		$scnm=$_REQUEST['scat_nm'];
		$bnm=$_REQUEST['brand_nm'];
		$path=$_REQUEST['path'];
		$pdesc=$_REQUEST['prod_desc'];
		
		$cat_in="insert into product_details_tbl (prod_name,sdate,edate,bprice,cat_id,sub_cat_id,brand_id,img_path,prod_desc) 
		values('$pnm','$sdt','$edt','$bprice','$cnm','$scnm','$bnm','$path','$pdesc')";
		$res_in=$conn->query($cat_in);
		if($res_in)
		{
			?>
			<script>
			alert('Product success Added.');
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
	<title>Add Category</title>
	
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
								  <th>First Name</th>
								  <th>Last Name</th>
								  <th>Email</th>
								  <th>Mobile Number</th>
								  <th>Gender</th>
								  <th>Pass</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
                                include('include/config.php');
                                $sql="select * from user_details_tbl";
                                $res=$conn->query($sql);
								$sr=1;
								while($r=$res->fetch_object())
                                {
                                    ?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td class="center"><?php echo $r->fname; ?></td>
								<td class="center"><?php echo $r->lname; ?></td>
								<td class="center"><?php echo $r->email; ?></td>
								<td class="center"><?php echo $r->mobile; ?></td>
								<td class="center"><?php echo $r->gen; ?></td>
								<td class="center"><?php echo $r->pass; ?></td>
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
