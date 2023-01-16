<?php
$CountryList = $fn->GetCountriesData('{"Flag":"All"}');

?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-10">
            <div class="page-header">
                <h2>Country Management</h2>
                <ol class="breadcrumb">
                   <li><a href="home">Dashboard</a></li>
                    <li><a href="view_location">Location Master</a></li>
                    <li><a href="view_country">Country</a></li>
<!--                    <li><a href="class-management">Class Management</a></li>-->
                    <li class="active">
                        <?php
                    if($_REQUEST['method']=='edit'){
                        echo 'Edit Country';
                    }else if($_REQUEST['method']=='add'){
                        echo 'Create Country';
                    }else{
                        echo 'View Country';
                    } ?>
                        
                        </li>
                </ol>
            </div>
            </div>
            <div class="col-lg-2"><br><br>
                <div class='panel-header'>
           
            <?php
            if($_REQUEST['method'] == ''){ ?>
               <a href='view_country&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
            <?php echo $ViewButton; ?>
          <?php } else{ ?>
               <a href='view_country' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
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
                        require_once 'forms/form_create_country.php';
                    } else {
                        if (is_array($CountryList) && !empty($CountryList)) {
                            ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo CountryName; ?></th>
                                            <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($CountryList['GetCountryWiseData'] AS $Key => $Value) {
                                            $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['CountryName']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'v_country'; ?>', '<?php echo $Value['CountryID']; ?>', '<?php echo $NewStatus; ?>','CountryID', 'is_active','view_country');"><i class="fa <?php echo $ICON; ?>"></i></button>                            
                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo $_REQUEST['page'] . '&method=edit&CountryID=' . $Value['CountryID']; ?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_country'; ?>', '<?php echo $Value['CountryID']; ?>', 'D','CountryID', 'is_active','view_country','v_state,v_users,v_city','CountryID,CountryID,CountryID');"><i class="fa fa-trash-o"></i></button>
                                                            
                                                            <!--onclick="delete_single_row_location('<?php echo 'vo_countries'; ?>', '<?php echo $udata[$i]['CountrySrNo']; ?>', 'CountrySrNo', '<?php echo $udata[$i]['CountrySrNo']; ?>', 'vo_client_master,vo_client_master,vo_contact_master,vo_users,vo_cities,vo_states', 'OrganizationCountrySrNo,BillingCountrySrNo,ContactCountrySrNo,CountrySrNo,CountrySrNo,CountrySrNo');"-->
                                                            
                                                            
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