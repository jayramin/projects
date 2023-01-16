<?php
$data = $fn->getDataByID("t4m_about_us", "about_id", '1');
?>
<!--<script type="text/javascript" src="js/nicEdit.js"></script>-->
<!--<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>-->
<style>
/*    .nicEdit-main{
        height:200px;
    }*/
</style>
<!--Content-->

<section class="panel-body">
    <!-- Content Start -->
    <form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <textarea name="about_description" id="about_description" class="form-control input-sm required"><?php echo $data['about_description']; ?>
                        </textarea>
                    </div>        
                </div>
                <div class="row"><hr>
                </div>
                <div class="form-group">
                    <input type="hidden" name="is_active" id="is_active" value="Y">
                    
                    <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 't4m_about_us'; ?>', 'about_id', '1', 'view-about-us', this.form);" ><?php echo save; ?></button>
                    <a class="btn btn-warning text-uppercase waves" href="home"><?php echo cancel; ?></a>
                </div>
            </form>
</section>

<script>
    CKEDITOR.replace("about_description");
</script>