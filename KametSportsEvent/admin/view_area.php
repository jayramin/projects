<?php

$AreaList = $fn->GetAllAreasData('{"Condition":{"CityID":"'.$_REQUEST['CityID'].'"}}');

?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="page-header">
                    <h2>Area Management</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li><a href="view_location">Location Master</a></li>
                        <!--                    <li><a href="class-management">Class Management</a></li>-->
                        <li class="active"><?php echo ($_REQUEST['method'] == 'edit') ? 'Edit Area' : 'View Area'; ?></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-6"><br><br>
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

                    if ($_REQUEST['method'] == '') {
                        ?>
                        <a href='view_area&method=add&StateID=<?php echo $_REQUEST['StateID'];?>&CityID=<?php echo $_REQUEST['CityID'];?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>

                    <?php
                    }

                    echo $ViewButton;
                    if (!isset($_REQUEST['method']) && $_REQUEST['method'] == "") {
                        ?>
                        <div class="col-lg-10">
                            <div class="col-lg-6">
                            <?php
                            $SelectedState = isset($_REQUEST['StateID']) ? $_REQUEST['StateID'] : "";
                            $StateFilter = isset($data['StateID']) ? "is_active='Y' AND CountryID='1'" : "is_active='Y'";
                            $db_array = array("tbl_name" => 'v_state', "condition" => $StateFilter);
                            $select_array = array("name" => "StateID", "id" => "StateID", "class" => "form-control pull-right input-sm chosen-select required", "onchange" => "GetCityList(this.value);");
                            $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $SelectedState);
                            $fn->dropdown($db_array, $select_array, $option_array); ?>
                       </div>
                        <div class="col-lg-6">
                            <?php
                            $SelectedState = isset($_REQUEST['CityID']) ? $_REQUEST['CityID'] : "";
//                            $StateFilter = isset($data['CityID']) ? "is_active='Y'" : "is_active='Y'";
                            $stateId = $_REQUEST['StateID'];
                            $db_array = array("tbl_name" => 'v_city', "condition" => "is_active='Y' AND StateID = '".$stateId."'");
                            $select_array = array("name" => "CityID", "id" => "CityID", "class" => "form-control pull-right input-sm chosen-select required", "onchange" => "GetAreaList(this.value);");
                            $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $SelectedState);
                            $fn->dropdown($db_array, $select_array, $option_array); ?>
                        </div>
                       <?php } else {
                            ?>
                            <a href='view_area' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
<?php } ?>


<?php echo $ViewButton; ?>
                    </div>
                </div>
            </div>
        </div>
    
    
    <div class="row">
        
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        
        <div class='panel-body'>
            <div class="row">
                <div class="col-lg-12">            
                    <?php
                    if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                        require_once 'forms/form_create_area.php';
                    } else {
                        if (is_array($AreaList) && !empty($AreaList)) {
                            ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo AreaName; ?></th>
                                            <th><?php echo CityName; ?></th>
                                            <th><?php echo StateName; ?></th>
                                            <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($AreaList['GetAreaWiseData'] AS $Key => $Value) {
                                            
                                           $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['AreaName']; ?></td>
                                                <td><?php echo $Value['AreaName']; ?></td>
                                                <td><?php echo $Value['AreaName']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'v_area'; ?>', '<?php echo $Value['AreaID']; ?>', '<?php echo $NewStatus; ?>','AreaID', 'is_active','view_area&StateID=<?php echo $_REQUEST['StateID'];?>&CityID=<?php echo $_REQUEST['CityID'];?>');"><i class="fa <?php echo $ICON; ?>"></i></button>
                                                            
                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo $_REQUEST['page'] . '&method=edit&CitySrNo=' . $Value['CitySrNo']; ?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_area'; ?>', '<?php echo $Value['AreaID']; ?>', 'D','AreaID', 'is_active','view_area&StateID=<?php echo $_REQUEST['StateID'];?>&CityID=<?php echo $_REQUEST['CityID'];?>');"><i class="fa fa-trash-o"></i></button>
                                                             
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
    function GetCityList(e){
        window.location.href='view_area&StateID='+e;
    }
    function GetAreaList(e){
        window.location.href='view_area&StateID=<?php echo $_REQUEST['StateID']?>&CityID='+e;
    }
    </script>