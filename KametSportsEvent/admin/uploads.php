<style>
    .nicEdit-main{
        height:200px;
    }
</style>
<script type="text/javascript">
    bkLib.onDomLoaded(function() {
        nicEditors.allTextAreas()
    });
    $(document).on("click", "#upload", function() {
        var file_data = $("#avatar").prop("files")[0];   // Getting the properties of file from file field
        var form_data = new FormData();                  // Creating object of FormData class
        form_data.append("file", file_data)              // Appending parameter named file with properties of file_field to form_data
        form_data.append("user_id", 123)                 // Adding extra parameters to form_data
        $.ajax({
            url: "/upload_avatar",
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data, // Setting the data attribute of ajax with file_data
            type: 'post'
        })
    });
</script>
<section class="panel-body">
    <!-- Content Start -->
    <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">
                <label for="ProdDesc" class="control-label"><?php echo $lang->lang['ProdSecondaryImage']; ?></label>
                <input id="avatar" type="file" name="avatar">    
            </div>
        </div>        
        <div class="row">
            <div class="col-lg-1">
                <div class="form-group">
                    <input type="hidden" name="is_active" value="1">
                    <button id="upload" value="Upload">Upload</button>
                </div>
            </div>
        </div>
    </form>
</section>