<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shreeji Kelavani Mandal Manage Updates List</title>
	
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
						<a href="#">Manage Updates List</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">				
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Manage Updates List</h2>
						<a class="btn btn-setting " href="#" style="float:right;background-color:green">
						<i class="icon-plus" style="color:green"></i>
						<span style="color:green">Add New Updates</span>                                    
						</a>
						
					</div>
					
					<div class="box-content">
					
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Sr No</th>
								  <th>Update Titles</th>
								  <th>Update Description</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
                                include('include/config.php');
                                $sql="select * from latest_updates";
                                $res=$conn->query($sql);
								$sr=1;
								while($r=$res->fetch_object())
                                {
                                    ?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td class="center"><?php echo $r->title; ?></td>
								<td class="center"><?php echo $r->description; ?></td>
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
			<form method="post" action="">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h3>Add New Updates</h3>
				</div>
				
				<div class="modal-body">
					<fieldset>
					
							<div class="form-group">
                                 <input class="form-control" name="hd" type="text" placeholder="Enter Heading of Updates" required="required">
                            </div>
                            <div class="form-group">
                                <textarea rows="5" class="form-control input-sm required" name="desc" placeholder="Add your Feedback And Comment up to [200] Charactor only"></textarea>
                            </div>
					</fieldset>					
				</div>
				<div class="modal-footer" style="background-color:#f05f40">
							<a href="#" class="btn" data-dismiss="modal">Close</a>							
							<input type="submit" name="save" value="Save" class="btn btn-success">
				</div>				
			 </form>
		</div>

		<?php include('include/footer.php'); ?>
		
	</div><!--/.fluid-container-->

		
</body>
</html>
