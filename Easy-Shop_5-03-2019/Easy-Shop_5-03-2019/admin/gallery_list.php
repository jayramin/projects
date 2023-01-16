<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shreeji Kelavani Mandal Register User List</title>
	
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
						<a href="#">Register User List</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">				
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Register User List</h2>
						<a class="btn btn-setting" href="#" style="float:right;background-color:green">
						<i class="icon-upload icon-red" style="color:green"></i>
						<span style="color:green">Upload gallery </span>                                    
						</a>
						
					</div>
					
					<div class="box-content">
					
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Sr No</th>
								  <th>Image Title</th>
								  <th>Image</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						   <?php
                                include('include/config.php');
                                $sql="select * from gallery";
                                $res=$conn->query($sql);
								$sr=1;
								while($r=$res->fetch_object())
                                {
                                    ?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td class="center"><?php echo $r->title; ?></td>								
								<td class="center"><img class="grayscale" src="uploads/<?php echo $r->image; ?>" style="border:1px solid #888;border-radius:5px;height:100px;widht:100px;"></td>								
								
								<td class="center">
									<!--a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a-->
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
			
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-picture"></i> Gallery</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<p class="center">
							<button id="toggle-fullscreen" class="btn btn-large btn-primary visible-desktop" data-toggle="button">Toggle Fullscreen</button>
						</p>
						<br/>
						<ul class="thumbnails gallery">
						<?php
                                include('include/config.php');
                                $sql="select * from gallery";
                                $res=$conn->query($sql);
								$sr=1;
								while($r=$res->fetch_object())
                                {
                                    ?>
							<li id="image-1" class="thumbnail">
								<a style="background:url('img/kk/logo.png');" title="<?php echo $r->title; ?>" href="uploads/<?php echo $r->image; ?>">
								<img class="grayscale" src="uploads/<?php echo $r->image; ?>" alt="<?php echo $r->title; ?>">
								</a>
							</li>
							<?php
								}
								?>
						</ul>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>
		  <?php
                include('include/config.php');
				if(isset($_REQUEST['save']))
				{
					$title=$_REQUEST['title'];
					
					$fileName = time() . '-' . $_FILES["image"]["name"];
					move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $fileName);
					$sql="insert into gallery(title,image) values('$title','$fileName')";
					$res=$conn->query($sql);
					if(count($res)>0)
					{
						header('location:gallery_list.php');
					}
					else
					{
						echo'Not uploaded Successfully';
					}
				}
                
			?>
								
		<div class="modal hide fade" id="myModal">
			 <form method="post" enctype="multipart/form-data" action="">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h3>Upload Images</h3>
				</div>
				
				<div class="modal-body">
					<fieldset>
					
							<div class="form-group">
                                <input class="form-control" name="title" type="text" placeholder="Enter Image Title Here..." required="required">
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" required="required">
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
