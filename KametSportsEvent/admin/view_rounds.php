<?php
$data = $fn->GetAllRoundsData();
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-10">
            <div class="page-header">
                <h2>Tournament</h2>
                <ol class="breadcrumb">
                   <li><a href="home">Dashboard</a></li>
                   <li><a href="Tournament_Management">Tournament Management</a></li>
                   <li><a href="view_rounds">Rounds</a></li>
                    <li class="active">
                       <?php
                    
                    if($_REQUEST['method']=='edit'){
                        echo 'Edit Round';
                    }else if($_REQUEST['method']=='add'){
                        echo 'Create Round';
                    }else{
                        echo 'View Round';
                    } ?> 
                        
                       </li>
                </ol>
            </div>
            </div>
            <div class="col-lg-2"><br><br>
                <div class='panel-header'>
           
            <?php
            if($_REQUEST['method'] == ''){ ?>
               <a href='view_rounds&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
            <?php echo $ViewButton; ?>
          <?php } else{ ?>
               <a href='view_rounds' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
          <?php }?>
               
            <?php echo $ViewButton; ?>
        </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Rounds</h1>
        </div>
        <div class='panel-body'>
             <div class="row">
                <div class="col-lg-12">            
                    <?php
                    if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                        require_once 'forms/form_create_rounds.php';
                    } else {
                        if (is_array($data) && !empty($data)) { ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo RoundName; ?></th>
                                            <th><?php echo TournamentName; ?></th>
                                            <th><?php echo PlayMatchType; ?></th>
                                            <th><?php echo NumberOfGamesToPlay; ?></th>
                                            <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['GetRoundWiseData'] AS $Key => $Value) {
                                            $TournamentStartDateData = $fn->TournamentStartDateByTournamentID($Value['TournamentID']);
                                            $TournamentStartDate = $TournamentStartDateData['TournamentStartDateData']; 
                                            $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['RoundName']; ?></td>
                                                <td><?php echo $Value['TournamentName']; ?></td>
                                                <td><?php echo $Value['PlayMatchType']; ?></td>
                                                <td><?php echo $Value['NumberOfGamesToPlay']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'v_rounds'; ?>', '<?php echo $Value['RoundID']; ?>', '<?php echo $NewStatus; ?>','RoundID', 'is_active','view_rounds');"><i class="fa <?php echo $ICON; ?>"></i></button>                            
                                                        </div>
                                                        <?php if($TournamentStartDate['StartDate'] < date('Y-m-d')){ }else{ ?>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo $_REQUEST['page'] . '&method=edit&RoundID=' . $Value['RoundID']; ?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <?php } ?>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_rounds'; ?>', '<?php echo $Value['RoundID']; ?>', 'D','RoundID', 'is_active','view_rounds');"><i class="fa fa-trash-o"></i></button>
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