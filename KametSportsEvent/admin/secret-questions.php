<?php
//$SQList = $fn->get_secret_questions();

$SQList = $fn->getDataByID("t4m_secret_question_master", "SQSrNo", '1');
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h2>Secret Questions</h2>
                <ol class="breadcrumb">
                    <li><a href="general-masters">General Masters</a></li>
                    <li class="active">Secret Questions</li>
                </ol>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <?php
            $ViewButton="<a href='secret-questions' class='btn btn-sm btn-primary btn-labeled  text-uppercase waves pull-right waves-effect waves-float' title='Click here to view all records'><span class='btn-label'><i class='fa fa-eye'></i></span> View All</a>";
            if ($_REQUEST['method'] == 'add') {
                $PageName = 'Add New Record';                
            } else if ($_REQUEST['method'] == 'edit') {
                $PageName = 'Edit Record';
            } else {
                $PageName = 'View Records';
                $ViewButton='';
            }
            ?>
            <h4 class="panel-title pull-left"><strong><?php echo $PageName; ?></strong></h4>
            <a href='secret-questions&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
            <?php echo $ViewButton; ?>
        </div>
        <div class='panel-body'>
            <div class="row"><hr>
                <div class="col-lg-12">            
                    <?php
                    if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                        require_once 'forms/secret-questions-form.php';
                    } else {
                        if (is_array($SQList) && !empty($SQList)) {
                            ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo SQuestion; ?></th>
                                            <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($SQList AS $Key => $Value) {
                                            $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['SQuestion']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry"><i class="fa <?php echo $ICON; ?>"></i></button>
                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo $_REQUEST['page'] . '&method=edit&SQSrNo=' . $Value['SQSrNo']; ?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <center><h4>No Records Found</h4></center>
                            <?php
                        }
                    }
                    ?>
                </div>        
            </div>   
        </div>
    </div>
</div>