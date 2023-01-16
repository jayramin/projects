<?php
$data = $fn->DataByID('{"Condition":{"table":"v_documents","Key":"DocumentID","value":10}}');
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h2>Tournament Rules</h2>
                <ol class="breadcrumb">
                    <li><a href="home">Dashboard</a></li>
                    <li><a href="view_cms">Content Management</a></li>
                    <li class="active"><?php echo ($_REQUEST['method']=='edit')?'Edit Tournament Rules':'View Tournament Rules'; ?></li>
                </ol>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        
        <div class='panel-body'>
            <form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <span id="CKEditorRequired"></span>
                        <textarea name="DocumentDescription" id="DocumentDescription" class="form-control input-sm required"><?php echo $data['GetData']['DocumentDescription']; ?>
                        </textarea>
                    </div>        
                </div>
                <div class="row"><hr>
                </div>
                <div class="form-group">
                    
                    <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 'v_documents'; ?>', 'DocumentID', '10', 'view_tournament_rules', this.form);" ><?php echo save; ?></button>
                    <a class="btn btn-warning text-uppercase waves" href="view_cms"><?php echo cancel; ?></a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace("DocumentDescription");
</script>