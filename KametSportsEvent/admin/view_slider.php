<?php
$data = $fn->get_all_slider();
//print_r($data);
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-10">
            <div class="page-header">
                <h2>Privacy Policy</h2>
                <ol class="breadcrumb">
                    <li><a href="home">Dashboard</a></li>
                    <li><a href="view_cms">Content Management</a></li>
                    <li><a href="view_slider">Slider</a></li>
                    <li class="active"><?php echo ($_REQUEST['method']=='edit')?'Edit Slider':'View Slider'; ?></li>
                </ol>
            </div>
            </div>
            <div class="col-lg-2"><br><br>
                <div class='panel-header'>
           
            <?php
            if($_REQUEST['method'] == ''){ ?>
               <a href='view_slider&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
            <?php echo $ViewButton; ?>
          <?php } else{ ?>
               <a href='view_slider' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
          <?php }?>
               
            <?php echo $ViewButton; ?>
        </div>
            </div>
        </div>
    </div>
    <div class='content-box panel-box panel-gray'>        
        <div class='panel-body'>
            <div class="row">
                <div class="col-lg-12">            
                    <?php
                    if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                        require_once 'forms/form_create_slider.php';
                    } else {
                        if (is_array($data) && !empty($data)) {
                            ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo SliderTitle; ?></th>
                                            <th><?php echo SliderDescription; ?></th>
                                            <th><?php echo Image; ?></th>
                                            <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data AS $Key => $Value) {
//                                            echo '<pre>';
//                                            print_r($Value);
                                            $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['SliderTitle']; ?></td>
                                                <td><?php echo $Value['SliderDescription']; ?></td>
                                                <td><img src="<?php echo SITE_URL;?>admin/uploads/Slider/<?php echo $Value['SliderImage']; ?>" height="50px"/></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'v_sliders'; ?>', '<?php echo $Value['SliderID']; ?>', '<?php echo $NewStatus; ?>','SliderID', 'is_active','view_slider&SliderID=<?php echo $_REQUEST['SliderID'];?>&SliderID=<?php echo $_REQUEST['SliderID'];?>');"><i class="fa <?php echo $ICON; ?>"></i></button>
<!--                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeColumnStatus('<?php echo 'v_sliders'; ?>', '<?php echo $Value['SliderID']; ?>', 'SliderID', 'is_active','<?php echo $NewStatus; ?>','UPDATE');"><i class="fa <?php echo $ICON; ?>"></i></button>-->
                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo $_REQUEST['page'] . '&method=edit&SliderID=' . $Value['SliderID']; ?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="ChangeColumnStatus('<?php echo 'v_sliders'; ?>', '<?php echo $Value['SliderID']; ?>', 'SliderID', 'is_active', 'D', 'DELETE');"><i class="fa fa-trash-o"></i></button>
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