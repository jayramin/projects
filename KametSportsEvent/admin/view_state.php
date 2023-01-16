<?php
$StateList = $fn->GetAllStateData('{"CountryID":"'.$_REQUEST['CountryID'].'"}');
//print_r($StateList);
?>
<!--Content-->
<div>
    <div class="row">
        <div class="col-lg-12">
         <div class="col-lg-7">
            <div class="page-header">
                <h2>State Management</h2>
                <ol class="breadcrumb">
                    <li><a href="home">Dashboard</a></li>
                    <li><a href="view_location">Location Master</a></li>
                    <li><a href="view_state">State</a></li>
<!--                    <li><a href="class-management">Class Management</a></li>-->
                    <li class="active">
                        <?php
                    if($_REQUEST['method']=='edit'){
                        echo 'Edit State';
                    }else if($_REQUEST['method']=='add'){
                        echo 'Create State';
                    }else{
                        echo 'View State';
                    } ?>
                        
                        </li>
                </ol>
            </div>
         </div>
            <div class="col-lg-5"><br><br>
                <div class='panel-header'>
                    
                    <?php
                    if ($_REQUEST['method'] == 'add') {
                        $PageName = 'Add New Record';
                    } else if ($_REQUEST['method'] == 'edit') {
                        $PageName = 'Edit Record';
                    } else {
                        $PageName = 'View Records';
                        $ViewButton = '';
                    }

                    if ($_REQUEST['method'] == '') { ?>
                    <a href='view_state&method=add&CountryID=<?php echo $_REQUEST['CountryID']?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>

                    <?php
                    }
                    if (!isset($_REQUEST['method']) && $_REQUEST['method'] == "") {
                        ?>
                        <div class="col-lg-7 pull-right">
                            &nbsp; &nbsp; &nbsp;<label><?php echo SearchCountry?></label>
                            <?php
                            $SelectedCountry = isset($_REQUEST['CountryID']) ? $_REQUEST['CountryID'] : "";
                            $StateFilter = isset($data['CountryID']) ? "is_active='Y' AND CountryID = '".$data['CountryID']."'" : "is_active='Y'";
                            $db_array = array("tbl_name" => 'v_country', "condition" => $StateFilter);
                            $select_array = array("name" => "CountryID", "id" => "CountryID", "class" => "pull-right input-sm chosen-select required", "onchange" => "GetStateList(this);");
                            $option_array = array("value" => "CountryID", "label" => "CountryName", "placeholder" => "Select Country", 'selected' => $SelectedCountry);
                            $fn->dropdown($db_array, $select_array, $option_array);
                        } else {
                            ?>
                            <a href='view_state&CounrtyID=<?php echo $_REQUEST['CountryID']?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
<?php } ?>


<?php echo $ViewButton; ?>
                    </div>

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
                        require_once 'forms/form_create_state.php';
                    } else {
                        if (is_array($StateList) && !empty($StateList)) {?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo StateName; ?></th>
                                            <th><?php echo CountryName; ?></th>
                                            <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($StateList['GetStateWiseData'] AS $Key => $Value) {
                                            $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['StateName']; ?></td>
                                                <td><?php echo $Value['CountryName']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'v_state'; ?>', '<?php echo $Value['StateID']; ?>', '<?php echo $NewStatus; ?>','StateID', 'is_active','view_state');"><i class="fa <?php echo $ICON; ?>"></i></button> 
                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo  'view_state&method=edit&StateID=' . $Value['StateID'].'&CountryID='.$_REQUEST['CountryID'] ; ?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_state'; ?>', '<?php echo $Value['StateID']; ?>', 'D','StateID', 'is_active','view_state&CountryID=<?php echo $_REQUEST['CountryID']?>','v_users,v_city','StateID,StateID');"><i class="fa fa-trash-o"></i></button>
                                                            
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
<script>
    function GetStateList(e){
        window.location.href='view_state&CountryID='+e.value;
    }
    </script>