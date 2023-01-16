<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shreeji Kelavani Mandal Send Bulk SMS</title>	
	<?php include('include/alllink.php'); ?>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var text_max = 0;
	var msg=1;
    $('#textarea_feedback').html('Message Contains '+text_max + ' characters of '+msg+' Message ');

    $('#txtarea').keyup(function() {
        var text_length = $('#txtarea').val().length;
        var text_remaining = text_max +text_length;
		
		if(text_remaining>=160)
		{
			alert('you exced the limit of one message');
			msg++;
		}

      $('#textarea_feedback').html('Message Contains '+text_remaining + ' characters of '+msg+' Message ');
	  msg=1;
    });
});
</script>

    <script type="text/javascript">
        $(function () {
            $("#fileUpload").bind("change", function () {
                var val='';
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
                if (regex.test($("#fileUpload").val().toLowerCase())) {
                    if (typeof (FileReader) != "undefined") {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var rows = e.target.result.split("\n");
							var count=-1;
                            for (var i = 0; i < rows.length; i++) {
                                var cells = rows[i];
                                for (var j = 0; j < cells.length; j++) {
                                    cells[j].split(",");
                                    val+=cells[j];
                                }
								count++;
							}
                            alert(' Total '+ count +' Mobile Number Fetch From CSV File');
                            //$("#dvCSV").html('');
                            //$("#dvCSV").append(table);
                            $("#new_area").val(val);
							 $("#count").val(count);
                        }
                        reader.readAsText($("#fileUpload")[0].files[0]);
                    } else {
                        alert("This browser does not support HTML5.");
                    }
                } else {
                    alert("Please upload a valid CSV file.");
                }
            });
        });
    </script>
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
			
			
			 <?php
  if(isset($_REQUEST['send_bulk']))
{
		$mono=$_REQUEST['mno'];
		$msg=$_REQUEST['bulk_sms_content'];
		$from=$_REQUEST['sender_id'];
		$total=$_REQUEST['all_no'];

	$url="http://nimbusit.net/api.php";
$data="username=t4miteshdarji232&password=gopi@23293&sender=$from&sendto=$mono&message=$msg";

	
  function postdata($url,$data)
    {
    //The function uses CURL for posting data to server
        $objURL = curl_init($url);
        curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($objURL,CURLOPT_POST,1);
        curl_setopt($objURL, CURLOPT_POSTFIELDS,$data);
        $retval = trim(curl_exec($objURL));
        curl_close($objURL);
        return $retval;
    }
	
	if(postdata($url,$data)==true)
	{
		?>
        <script>
		alert('Message Successfully Sent! ,Deducted from your Account');
		window.location="send_bulk_sms.php";
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
						<form class="form-horizontal">
						  <fieldset>
						  <button type="submit" class="btn btn-primary" style="float:right;font-weight:bold">
						   <?php
$url="http://nimbusit.net/api.php/creditstatus.jsp";
$data="username=t4miteshdarji232&password=gopi@23293";

  function getcredit($url,$data)
    {
    //The function uses CURL for posting data to server
        $objURL = curl_init($url);
        curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($objURL,CURLOPT_POST,1);
        curl_setopt($objURL, CURLOPT_POSTFIELDS,$data);
        $retval = trim(curl_exec($objURL));
        curl_close($objURL);
        return $retval;
    }
	echo "Your SMS Credits is"."<br/>";
	?>
	
    <b style=" font-size:24px;">
    <?php 
	echo getcredit($url,$data);
	?></button>
	
						 <form action="" method="POST" enctype="multipart/form-data">
							
							<div class="control-group">
							  <label class="control-label" for="typeahead">Select CSV File </label>
							  <div class="controls">
								<input type="file"  class="span6 typeahead" id="typeahead" >
								
							  <button type="submit" value="Upload FIle" name="upload" class="btn btn-primary" style="font-weight:bold">Upload File</button>
							
							  </div>
							</div>
							
							 </form>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Sender ID</label>
							  <div class="controls">
								<select class="form-control" name="sender_id" placeholder="Select Sender ID" required="required">
									<option value="SHRIJI">SHRIJI</option>
								</select>
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="textarea2">Mobile No's From CSV  </label>
							  
							  <?php
							if (isset($_REQUEST['upload'])) 
							{
								
$target_dir = "csv/";
$target_file = $target_dir . basename($_FILES["file1"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if file already exists
if (file_exists($target_file)) {
	?>
    <script>
    alert('Sorry, file already exists.');
    </script>
	<?php
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file1"]["size"] > 500000) {
	
	?>
    <script>
    alert('Sorry, your file is too large.');
    </script>
	<?php
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "csv") {
    
	?>
    <script>
    alert('Sorry, only CSV files are allowed.');
    </script>
	<?php
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	?>
    <script>
    alert('Sorry, your file was not uploaded.');
    </script>
	<?php
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file)) {
		?>
        <script>
		alert('file uploaded successfully');
		</script>
        <?php
    } else {
			?>
        <script>
		alert('Sorry, there was an error uploading your file.');
		</script>
        <?php
    }
}

								
								
      								 $file="csv/".$_FILES['file1']['name'];
									 
									 $row = 0;
if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        for ($c=0; $c < $num; $c++) {
            $arr[]=$data[$c] . ",";
        }
		
    }
	$row;
	$str=implode($arr);
	
    fclose($handle);
}
    						}
							
							?>
							
							
							<input type="text" name="all_no"  id="all_no" value="<?php 
							if(isset($row))
							{ echo $row;}else
							{
								echo "0";
							}?>" style="width:100px; height:30px; font-family:Tahoma, Geneva, sans-serif; font-size:18px;text-align:center;background-color:#096; color:#fff; float:right;"  readonly="readonly"x`/>
							  <div class="controls">
								<textarea rows="9" cols="10" class="form-control input-sm required" name="mno" placeholder="All Mobile Numbers From CSV File" readonly="readonly" style="font-size:14px; font-family:Tahoma, Geneva, sans-serif; font-size:17px; color:#000" id="new_area"><?php if(isset($str))
									{ echo $str; }?></textarea>
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="textarea2">SMS Content </label>
							  <div class="controls">
								<textarea rows="9" cols="10" 
									class="form-control input-sm required" 
									name="bulk_sms_content" 
									placeholder="One Message Contains 160 Charactors and More then 160 Consider as Two Message" 
									id="txtarea" style="font-size:15px; font-family:Tahoma, Geneva, sans-serif;"></textarea>
									 <div id="textarea_feedback"></div>
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" name="send_bulk" value="Send It as Bulk" class="btn btn-primary">Send SMS it As Bulk</button>
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
