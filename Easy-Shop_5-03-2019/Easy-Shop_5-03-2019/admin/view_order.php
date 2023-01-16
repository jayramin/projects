<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>View Order List</title>
	
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
						<a href="#">Order Detail</a>
					</li>
				</ul>
			</div>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Order Detail</h2>
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
								  <th>Order Id</th>
								  <th>User Id</th>
								  <th>Address</th>
								  <th>city</th>
								  <th>Pincod No</th>
								  <th>State</th>
								  <th>contact Number</th>
								  <th>Email Id</th>
								  <th>Product Id</th>
								  <th>Product Quantity</th>
								  <th>Total Amount</th>
								  <th>Order Date</th>
								  <th>Mode Payment</th>
								  
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
                                include('include/config.php');
                                $sql="select * from order_details_tbl";
                                $res=$conn->query($sql);
								$sr=1;
								while($r=$res->fetch_object())
                                {
                                    ?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td class="center"><?php echo $r->order_id; ?></td>
								<td class="center"><?php echo $r->user_id; ?></td>
								<td class="center"><?php echo $r->address; ?></td>
								<td class="center"><?php echo $r->city; ?></td>
								<td class="center"><?php echo $r->pincod; ?></td>
								<td class="center"><?php echo $r->state; ?></td>
								<td class="center"><?php echo $r->contact_number; ?></td>
								<td class="center"><?php echo $r->emailid; ?></td>
								<td class="center"><?php echo $r->product_id; ?></td>
								<td class="center"><?php echo $r->product_quantity; ?></td>
								<td class="center"><?php echo $r->total_amount; ?></td>
								<td class="center"><?php echo $r->order_date; ?></td>
								<td class="center"><?php echo $r->mode_payment; ?></td>
								
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
