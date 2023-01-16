<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shreeji Kelavani Mandal Send Single SMS</title>
	
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


function ValidateMobNumber(mno) {
	
  var fld = document.getElementById(mno);

  if (fld.value == "") {
  alert("Please Enter Mobile Number");
  fld.value = "";
  fld.focus();
  return false;
 }
  else if (isNaN(fld.value)) {
  alert("The Mobile number contains illegal characters.");
  fld.value = "";
  fld.focus();
  return false;
 }
 else if (!(fld.value.length == 10)) {
  alert("The phone number is the wrong length.\nPlease enter 10 digit mobile no.");
  fld.value = "";
  fld.focus();
  return false;
 }

}

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
						<a href="#">Send Single SMS</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
			
			
			<?php
if(isset($_REQUEST['send_single']))
{
		$mono=$_REQUEST['mno'];
		$msg=$_REQUEST['bulk_sms_content'];
		$from=$_REQUEST['sender_id'];
		

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
	
	 if((postdata($url,$data)==true))
	{
		?>
         
            <script>
			alert('1 Message Successfully Sent , 1 Deducted from Account');
			window.location="send_single_sms.php";
			</script>
			<?php
	}
	else 
	{
		?>
           >
			alert('Sorry !! Message Send Fails ! Please Try Again');
			window.location="send_single_sms.php";
			</script>
            <?php
	}
}
 ?>
 
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
						<form class="form-horizontal">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Sender ID</label>
							  <div class="controls">
								<select name="sender_id" placeholder="Select Sender ID">
									<option value="SHRIJI">SHRIJI</option>
								</select><br>
								<button type="submit" class="btn btn-primary" style="margin-top: 10px;font-weight:bold">
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
    <?php echo getcredit($url,$data);?>
    </b>
								
								</button>
							  </div>
							</div>
							
							<div class="control-group">
								<label for="focusedInput" class="control-label">Enter Mobile Number</label>
								<div class="controls">
								  <input type="text" name="mno" placeholder="Enter Sender Mobile Number" id="focusedInput" class="input-xlarge focused">
								</div>
							  </div>

							     
							<div class="control-group">
							  <label class="control-label" for="textarea2">SMS Content </label>
							  <div class="controls">
								<textarea class="cleditor" name="bulk_sms_content" id="txtarea" rows="3" placeholder="One Message Contains 160 Charactors and More then 160 Consider as Two Message"></textarea>
							  </div>
							   <div id="textarea_feedback"></div>
							</div>
							<div class="form-actions">
							  <button type="submit" name="send_single" class="btn btn-primary">Send SMS it As Single</button>
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
