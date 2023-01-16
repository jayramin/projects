<?php
$data = $fn->GetAllTournamnetData();
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
                   <li><a href="view_tournament">Tournament</a></li>
                    <li class="active"><?php
                    
                    if($_REQUEST['method']=='edit'){
                        echo 'Edit Tournament';
                    }else if($_REQUEST['method']=='add'){
                        echo 'Create Tournament';
                    }else{
                        echo 'View Tournamnent';
                    } ?></li>
                </ol>
            </div>
            </div>
            <div class="col-lg-2"><br><br>
                <div class='panel-header'>
           
            <?php
            if($_REQUEST['method'] == ''){ ?>
               <a href='view_tournament&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
            <?php echo $ViewButton; ?>
          <?php } else{ ?>
               <a href='view_tournament' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
          <?php }?>
               
            <?php echo $ViewButton; ?>
        </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Tournament</h1>
        </div>
        <div class='panel-body'>
             <div class="row">
                <div class="col-lg-12">            
                    <?php
                    if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                        require_once 'forms/form_create_tournament.php';
                    } else {
                        if (is_array($data) && !empty($data)) { ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo TournamentName; ?></th>
                                            <th><?php echo TournamentFor; ?></th>
                                            <th><?php echo Location; ?></th>
                                            <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['GetTournamentWiseData'] AS $Key => $Value) {
//                            if($Value['EndDate'] <= date('Y-m-d')){
//                                $data = $fn->UpdateTournamnetIsActive();
////                              $query = "UPDATE sp_exam_schedule SET ExamStatus = 0 WHERE ExamSrNo = '".$data[$i]['ExamSrNo']."'";
////                              mysql_query($query);
//                            }                          
                                            $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['TournamentName']; ?></td>
                                                <td><?php echo $Value['TournamentFor']; ?></td>
                                                <td><?php echo $Value['Location']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'v_tournaments'; ?>', '<?php echo $Value['TournamentID']; ?>', '<?php echo $NewStatus; ?>','TournamentID', 'is_active','view_tournament');"><i class="fa <?php echo $ICON; ?>"></i></button>                            
                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo $_REQUEST['page'] . '&method=edit&TournamentID=' . $Value['TournamentID']; ?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_tournaments'; ?>', '<?php echo $Value['TournamentID']; ?>', 'D','TournamentID', 'is_active','view_tournament');"><i class="fa fa-trash-o"></i></button>
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