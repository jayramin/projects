<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
 <!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="button" value="Upload Image" name="upload_file" id="upload_file" onclick="image_upload(this.form);">
    <br><br><img id="view" name="view" width="100" height="100" src="">
</form>

</body>
</html>

<script>
                             function image_upload(form){
                                  
                                    jQuery.ajax({
                                        
                                            type: 'POST',
                                            url: 'upload.php',
                                            data: new FormData(form),
                                            contentType: false,
                                            cache: false,
                                            processData: false,
                                            success: function(result) {
						///alert(result);  
                                                $('#view').attr('src','uploads/'+result);
                                            }
                                        });
                            }
  
    </script>