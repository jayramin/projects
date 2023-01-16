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
						<a href="#">Add Questions</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
			
	
 
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-envelope"></i> Add Questions to Different Category</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Exam Name</label>
							  <div class="controls">
								<input type="text" name="file_name"  class="span6 typeahead" id="typeahead">
							  </div>
							</div>
							
							<div class="control-group">
								<label for="focusedInput" class="control-label">Select Categories and Weightage</label>
								
                                <div class="controls">
								
                                 Maths
                                 <input type="checkbox" name="file_name"  class="span6 typeahead" id="typeahead">
                          	 <select name="weight" style="width:70px;">
								    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    </select>
                          		
                                 Political Science
                                 <input type="checkbox" name="file_name"  class="span6 typeahead" id="typeahead">
                          	 <select name="weight" style="width:70px;">
								    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    </select>
                          		</div>
                          	  </div>
							
							     
							<div class="control-group">
							  <label class="control-label" for="textarea2">Description </label>
							  <div class="controls">
								<textarea class="cleditor" name="que_desc" id="txtarea" rows="3" placeholder="One Message Contains 160 Charactors and More then 160 Consider as Two Message"></textarea>
							  </div>
							   <div id="textarea_feedback"></div>
							</div>
							<div class="form-actions">
							  <button type="submit" name="add_que" class="btn btn-primary">Add Question</button>
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
