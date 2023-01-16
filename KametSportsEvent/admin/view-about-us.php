<?php
$data = $fn->getDataByID("t4m_about_us", "about_id", '1');
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h2>About Us</h2>
                <ol class="breadcrumb">
                    <li><a href="home">Dashboard</a></li>
                    <li><a href="content-management">Content Management</a></li>
<!--                    <li class="active">Slider Management</li>-->
                    <li class="active"><?php echo ($_REQUEST['method']=='edit')?'Edit About Us':'View Abut Us'; ?></li>
                </ol>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        
        <div class='panel-body'>
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
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace("about_description");
</script>