<?php
$data = $fn->GetAllTournaments();

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
                   <li><a href="view_tournaments_for_users">Tournament</a></li>
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
<!--            <div class="col-lg-2"><br><br>
                
            </div>-->
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
                        if (is_array($data) && !empty($data) && $_REQUEST['TournamentID'] == '') { ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><?php echo TournamentName; ?></th>
                                            <th><?php echo TournamentFor; ?></th>
                                            <th><?php echo ViewDetails; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['GetTournamentDateWiseData'] AS $Key => $Value) { ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['TournamentName']; ?></td>
                                                <td><?php echo $Value['TournamentFor']; ?></td>
                                                <td><a href="view_tournaments_for_users&TournamentID=<?php echo $Value['TournamentID'];?>">View Details</a></td>
                                                
                                            </tr>
                                        <?php } ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        <?php }else if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != ''){
                            $DataByTournamentID = $fn->getDataByID('v_tournaments', 'TournamentID', $_REQUEST['TournamentID']); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <center>  <img id="TournamentImagePreview" src="<?php echo (!empty($DataByTournamentID['TournamentImage'])) ?   SITE_URL . 'admin/uploads/TournamentImage/' .$DataByTournamentID['TournamentImage'] : SITE_URL . "admin/uploads/placeholder.png"; ?>" alt="TournamentImage" style="width:100px;height:100px;"></center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <center><h3><b><?php echo $DataByTournamentID['TournamentName'] ?></b></h3></center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <label><h4><b>Tournament Start Date  </b></h4> </label>
                                    </div>
                                <div class="col-lg-4">
                                        <label><h3 style="margin-top: 9px !important; "><?php echo  date('d-m-Y', strtotime($DataByTournamentID['StartDate'])) ?></h3> </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <label><h4><b>Tournament End Date</b></h4> </label>
                                    </div>
                                <div class="col-lg-4">
                                        <label><h3 style="margin-top: 9px !important; ">
                                            <?php echo date('d-m-Y', strtotime($DataByTournamentID['EndDate']));?></h3> </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <label><h4><b>Registration Start Date  </b></h4> </label>
                                    </div>
                                <div class="col-lg-4">
                                    <label><h3 style="margin-top: 9px !important; "><?php echo date('d-m-Y', strtotime($DataByTournamentID['RegistrationStartDate']));?></h3> </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <label><h4><b>Registration End Date</b></h4> </label>
                                    </div>
                                <div class="col-lg-4">
                                        <label><h3 style="margin-top: 9px !important; "><?php echo  date('d-m-Y', strtotime($DataByTournamentID['RegistrationEndDate'])) ?></h3> </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <label><h4><b>Registration Fees </b></h4> </label>
                                    </div>
                                <div class="col-lg-4">
                                    <label><h3 style="margin-top: 9px !important; "><?php echo $DataByTournamentID['RegistrationFees'] ?></h3> </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <label><h4><b>Winner Prize</b></h4> </label>
                                    </div>
                                <div class="col-lg-4">
                                        <label><h3 style="margin-top: 9px !important; "><?php echo $DataByTournamentID['WinnerPrize'] ?></h3> </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <label><h4><b>Runner Ups Prize</b></h4> </label>
                                    </div>
                                <div class="col-lg-4">
                                    <label><h3 style="margin-top: 9px !important; "><?php echo $DataByTournamentID['RunnerUpsPrize'] ?></h3> </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <label><h4><b>Second Runner Ups Prize</b></h4> </label>
                                    </div>
                                <div class="col-lg-4">
                                    <label><h3 style="margin-top: 9px !important; "><?php echo $DataByTournamentID['SecondRunnerUpsPrize'];?></h3> </label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                       <label><h4><b>Maximum Players</b></h4> </label>
                                    </div>
                                <div class="col-lg-4">
                                    <label><h3 style="margin-top: 9px !important; "><?php echo $DataByTournamentID['MaximumPlayers'] ?></h3> </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <label><h4><b>Minimum Players</b></h4> </label>
                                    </div>
                                <div class="col-lg-4">
                                        <label><h3 style="margin-top: 9px !important; "><?php echo $DataByTournamentID['MinimumPlayers'] ?></h3> </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <center><h2>Description</h2><?php echo $DataByTournamentID['Description'] ?></center>
                            </div>
                        </div>
                    </div>
                         <?php } else { ?>
                            <center><h4>No Records Found</h4></center>
                            <?php } ?>
                </div>        
            </div>  
        </div>
    </div>
</div>

<script>
    function GetTournamentDetails(e){
        window.location.href='view_Tournament_for_users&TournamentID=<?php echo $_REQUEST['CountryID'];?>&StateID='+e.value;
    }
    </script>