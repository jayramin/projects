<?php
include('include/config.php');
	
	if(isset($_REQUEST['add_cat']))
	{
		$pnm=$_REQUEST['pnm'];
		$sdt=$_REQUEST['sdate'];
		$edt=$_REQUEST['tdate'];
		$bprice=$_REQUEST['bprice'];
		$cnm=$_REQUEST['cat_nm'];
		$scnm=$_REQUEST['scat_nm'];
		$bnm=$_REQUEST['brand_nm'];
		$pdesc=$_REQUEST['prod_desc'];
		$psi=$_REQUEST['psize'];
		$psis=implode(",",$psi);
		$pcolo=$_REQUEST['pcolor'];
		$pcol=implode(",",$pcolo);
		$pqu=$_REQUEST['pquan'];
		$i=$_FILES['file1']['name'];
		$path='upload/'.$_FILES['file1']['name'];
		$tmp=$_FILES['file1']['tmp_name'];
	
	move_uploaded_file($tmp,$path);
		
		$cat_in="insert into product_details_tbl (prod_name,sdate,edate,bprice,cat_id,sub_cat_id,brand_id,img_path,prod_desc,prod_size,prod_color,prod_quantity) 
		values('$pnm','$sdt','$edt','$bprice','$cnm','$scnm','$bnm','$path','$pdesc','$psis','$pcol','$pqu')";
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
						<a href="#">Add Product</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
			
	
 
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-envelope"></i> Add new Product</h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" id="frm">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Product Name</label>
							  <div class="controls">
								<input type="text" name="pnm" placeholder="Enter Product Name" id="focusedInput" class="input-xlarge focused"  data-bvalidator="required,alpha">
							  </div>
							</div>
								

							<div class="control-group">
							  <label class="control-label" for="typeahead">Start Date</label>
							  <div class="controls">
								<input type="text" name="sdate" placeholder="Select from Date"  class="input-xlarge focused" id="datepicker" data-bvalidator="required">
								End Date
								<input type="text" name="tdate" placeholder="Select to Date"  class="input-xlarge focused" id="datepicker1" data-bvalidator="required">
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="typeahead">Base Price</label>
							  <div class="controls">
								<input type="text" name="bprice" placeholder="Enter Base Price of Product" id="focusedInput" class="input-xlarge focused" data-bvalidator="required,digit">
							  </div>
							</div>
							
							<?php
							$cat="select * from category_details_tbl";
							$cat_res=$conn->query($cat);
							?>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Category</label>
							  <div class="controls">
								<select name="cat_nm" data-bvalidator="required" id="focusedInput" class="input-xlarge focused" style="width:280px;">
								<option value=""></option>
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
							
						
							<?php
							$cat="select * from sub_category_details_tbl";
							$cat_res=$conn->query($cat);
							?>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Sub Category</label>
							  <div class="controls">
								<select name="scat_nm" data-bvalidator="required"  id="focusedInput" class="input-xlarge focused" style="width:280px;">
								<option value=""></option>
								<?php
								while($row_scat=$cat_res->fetch_object())
								{
								?>
								<option value="<?php echo $row_scat->sub_cat_id?>"><?php echo $row_scat->sub_cat_name?></option>
								<?php
								}
								?>
								</select>
							  </div>
							</div>
							
							<?php
							$cat="select * from brand_details_tbl";
							$cat_res=$conn->query($cat);
							?>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Brand</label>
							  <div class="controls">
								<select name="brand_nm" data-bvalidator="required" id="focusedInput" class="input-xlarge focused" style="width:280px;">
								<option value=""></option>
								<?php
								while($row=$cat_res->fetch_object())
								{
								?>
								<option value="<?php echo $row->brand_id?>"><?php echo $row->brand_name?></option>
								<?php
								}
								?>
								</select>
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="typeahead">Upload Image</label>
							  <div class="controls">
								<input type="file" data-bvalidator="required" accept="image/png, image/jpeg , image/jpg"  name="file1" class="span6 typeahead" id="typeahead">
							
							  </div>
							</div>
							
							
							<div class="control-group">
							  <label class="control-label" for="textarea2"> Product Description </label>
							  <div class="controls">
								<textarea  name="prod_desc" rows="4" id="txtarea" placeholder="Category Description"  style="width:270px;" data-bvalidator="required"></textarea>
							  </div>
							   <div id="textarea_feedback"></div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Product size</label>
							  <div class="controls">
								<input type="checkbox" name="psize[]" value="6"   id="focusedInput" class="input-xlarge focused" style="width:280px"> 6
								<input type="checkbox" name="psize[]" value="7"   id="focusedInput" class="input-xlarge focused" style="width:280px"> 7
								<input type="checkbox" name="psize[]" value="8"   id="focusedInput" class="input-xlarge focused" style="width:280px"> 8
								<input type="checkbox" name="psize[]" value="9"   id="focusedInput" class="input-xlarge focused" style="width:280px"> 9
								<input type="checkbox" name="psize[]" value="10"   id="focusedInput" class="input-xlarge focused" style="width:280px">10
								<input type="checkbox" name="psize[]" value="11"   id="focusedInput" class="input-xlarge focused" style="width:280px">11
							</div>
							  
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Product color</label>
							   <div class="controls">
								<input type="checkbox" name="pcolor[]" value="red"   id="focusedInput" class="input-xlarge focused" style="width:280px">red
								<input type="checkbox" name="pcolor[]" value="white"   id="focusedInput" class="input-xlarge focused" style="width:280px">wehite
								<input type="checkbox" name="pcolor[]" value="black"   id="focusedInput" class="input-xlarge focused" style="width:280px"> black
								<input type="checkbox" name="pcolor[]" value="yellow"   id="focusedInput" class="input-xlarge focused" style="width:280px"> yellow
								<input type="checkbox" name="pcolor[]" value="blue"   id="focusedInput" class="input-xlarge focused" style="width:280px">blue
								<input type="checkbox" name="pcolor[]" value="green"   id="focusedInput" class="input-xlarge focused" style="width:280px">green
								
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead" >Product quantity</label>
							  <div class="controls">
								<input type="text" name="pquan" placeholder="Enter Product quantity" id="focusedInput" class="input-xlarge focused" data-bvalidator="required,digit">
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" name="add_cat" class="btn btn-primary">Add Product</button>
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
