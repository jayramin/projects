<?php

$CityList = $fn->GetAllCitiesData('{"StateID":"'.$_REQUEST['StateID'].'","CountryID":"'.$_REQUEST['CountryID'].'"}');

?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-5">
                <div class="page-header">
                    <h2>City Management</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li><a href="view_location">Location Master</a></li>
                        <li><a href="view_city">City</a></li>
                        <!--                    <li><a href="class-management">Class Management</a></li>-->
                        <li class="active">
                            <?php
                    if($_REQUEST['method']=='edit'){
                        echo 'Edit City';
                    }else if($_REQUEST['method']=='add'){
                        echo 'Create City';
                    }else{
                        echo 'View City';
                    } ?>
                            
                            </li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-7"><br><br>
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
                    <div class="col-lg-2 pull-right">
                    <a href='view_city&method=add&StateID=<?php echo $_REQUEST['StateID']?>&CountryID=<?php echo $_REQUEST['CountryID']?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
                    </div>
                    <?php
                    }

                    echo $ViewButton;
                    if (!isset($_REQUEST['method']) && $_REQUEST['method'] == "") {
                        ?>
                        <div class="col-lg-10 pull-right">
                            <div class="col-lg-6 pull-left">
                            <div class="col-lg-6">
                                <label style="margin-top: 5px;"><?php echo SearchCountry?></label>
                            </div>
                            <div class="col-lg-6">
                            <?php
                            $SelectedCountry = isset($_REQUEST['CountryID']) ? $_REQUEST['CountryID'] : "";
                            $StateFilter = isset($data['CountryID']) ? "is_active='Y' AND CountryID = '".$data['CountryID']."'" : "is_active='Y'";
                            $db_array = array("tbl_name" => 'v_country', "condition" => $StateFilter);
                            $select_array = array("name" => "CountryID", "id" => "CountryID", "class" => "pull-right input-sm chosen-select required", "onchange" => "GetStateList(this);");
                            $option_array = array("value" => "CountryID", "label" => "CountryName", "placeholder" => "Select Country", 'selected' => $SelectedCountry);
                            $fn->dropdown($db_array, $select_array, $option_array);
                            ?>
                            </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="col-lg-6 pull-left">
                                <label style="margin-top: 5px;"><?php echo SearchState?></label>
                                </div>
                                <div class="col-lg-6 pull-left">    
                            <?php
                            $SelectedState = isset($_REQUEST['StateID']) ? $_REQUEST['StateID'] : "0";
                            $StateFilter = isset($data['StateID']) ? "is_active='Y' AND CountryID= '".$_REQUEST['CountryID']."'" : "is_active='Y' AND CountryID= '".$_REQUEST['CountryID']."'";
                            $db_array = array("tbl_name" => 'v_state', "condition" => $StateFilter);
                            $select_array = array("name" => "StateID", "id" => "StateID", "class" => "pull-right input-sm chosen-select required", "onchange" => "GetCityList(this);");
                            $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $SelectedState);
                            $fn->dropdown($db_array, $select_array, $option_array); ?>
                                </div>
                            </div>
                            
                            
                            
                       <?php } else {
                            ?>
                            <a href='view_city&StateID=<?php echo $_REQUEST['StateID']?>&CountryID=<?php echo $_REQUEST['CountryID']?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
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
                        require_once 'forms/form_create_city.php';
                    } else {
                        if (is_array($CityList) && !empty($CityList)) {
                            ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo CityName; ?></th>
                                            <th><?php echo StateName; ?></th>
                                            <th><?php echo CountryName; ?></th>
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
                                                <td><?php echo $Value['CountryName']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">

                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'v_city'; ?>', '<?php echo $Value['CityID']; ?>', '<?php echo $NewStatus; ?>','CityID', 'is_active','view_city&StateID=<?php echo $_REQUEST['StateID']?>');"><i class="fa <?php echo $ICON; ?>"></i></button>
                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo $_REQUEST['page'] . '&method=edit&CityID=' . $Value['CityID'].'&CountryID=' . $_REQUEST['CountryID'].'&StateID=' . $_REQUEST['StateID'];?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_city'; ?>', '<?php echo $Value['CityID']; ?>', 'D','CityID', 'is_active','view_city&CountryID=<?php echo $_REQUEST['CountryID']?>&StateID=<?php echo $_REQUEST['StateID']?>','v_users','CityID');"><i class="fa fa-trash-o"></i></button>
                                                             
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
</div>
    <script>
    function GetCityList(e){
        window.location.href='view_city&CountryID=<?php echo $_REQUEST['CountryID'];?>&StateID='+e.value;
    }
    function GetStateList(e){
        window.location.href='view_city&CountryID='+e.value;
    }
    
    </script>