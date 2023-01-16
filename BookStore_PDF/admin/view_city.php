<?php
$CityList = $fn->GetAllCitiesData('{"StateID":"' . $_REQUEST['StateID'] . '"}');
//echo '<pre>';
//print_r($CityList);
?>
<!--Content-->
<div class="content-wrapper">
    <div class="page-title">
        <!--<div class="row">-->
        <div class="col-lg-5">
            <div>
                <h1><i class="fa fa-dashboard"></i> City Management</h1>
            </div>
            <div>
                <ul class="breadcrumb pull-left">

                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index">Dashboard</a></li>
                    <li><a href="location">Location</a></li>
                    <li class="active">
<?php
if ($_REQUEST['method'] == 'edit') {
    echo 'Edit City';
} else if ($_REQUEST['method'] == 'add') {
    echo 'Create City';
} else {
    echo 'View City';
}
?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-7">


            <?php
//                    print_r($StateList);
//exit;

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
                <div class="col-lg-2 pull-right">
                    <a href='view_city&method=add&StateID=<?php echo $_REQUEST['StateID'] ?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
                </div>
                <?php
            }

            echo $ViewButton;
            if (!isset($_REQUEST['method']) && $_REQUEST['method'] == "") {
                ?>
                <div class="col-lg-6 pull-right">

                    <div class="col-lg-12">
                        <div class="col-lg-5">
                            <label style="margin-top: 5px;"><?php echo SearchState ?></label>
                        </div>
                        <div class="col-lg-7">    
                            <?php
                            $SelectedState = isset($_REQUEST['StateID']) ? $_REQUEST['StateID'] : "1";
                            $StateFilter = isset($data['StateID']) ? "is_active='Y'" : "is_active='Y'";
                            $db_array = array("tbl_name" => 'b_state', "condition" => $StateFilter);
                            $select_array = array("name" => "StateID", "id" => "StateID", "class" => "pull-right input-sm chosen-select required", "onchange" => "GetCityList(this);");
                            $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $SelectedState);
                            $fn->dropdown($db_array, $select_array, $option_array); 
                            ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <a href='view_city&CityID=<?php echo $_REQUEST['CityID'] ?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
                <?php } ?>
<?php echo $ViewButton; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">            
            <?php
            if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                require_once 'forms/form_create_city.php';
            } else {
                if ($CityList['ResponseCode'] != 0 && $CityList['Message'] != 'No Record Found') {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th><?php echo SrNo; ?></th>
                                    <th><?php echo CityName; ?></th>
                                    <th><?php echo StateName; ?></th>
                                    <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($CityList['GetCityWiseData'] AS $Key => $Value) {
//                                            echo '<pre>';
//                                            print_r($Value);
                                    $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                    $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                    $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                    ?>
                                    <tr>
                                        <td><?php echo ($Key + 1) ?></td>
                                        <td><?php echo $Value['CityName']; ?></td>
                                        <td><?php echo $Value['StateName']; ?></td>
                                        <td>
                                            <div class="btn-group btn-group-justified">
                                                <div class="btn-group">

                                                    <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'b_city'; ?>', '<?php echo $Value['CityID']; ?>', '<?php echo $NewStatus; ?>', 'CityID', 'is_active', 'view_city&CityID=<?php echo $_REQUEST['CityID'] ?>');"><i class="fa <?php echo $ICON; ?>"></i></button>
                                                </div>
                                                <div class="btn-group">
                                                    <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo $_REQUEST['page'] . '&method=edit&CityID=' . $Value['CityID'] . '&StateID=' . $_REQUEST['StateID']; ?>"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <div class="btn-group">
                                                    <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_city'; ?>', '<?php echo $Value['CityID']; ?>', 'D', 'CityID', 'is_active', 'view_city&CityID=<?php echo $_REQUEST['CityID'] ?>', 'v_users', 'CityID');"><i class="fa fa-trash-o"></i></button>
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

<script>
    function GetCityList(e){
        window.location.href='view_city&StateID='+e.value;
    }
</script>


