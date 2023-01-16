<?php
$TournamentId = $_REQUEST['TournamentID'];
//echo $TournamentId;
$MyTeam = $fn->MyTeamData('{"UserID":"'.$UserID.'"}');
//$TeamID =$MyTeam['GetMyTeamWiseData'][0]['TeamID'];
if(isset($_REQUEST['TournamentID'])){
    $TeamWiseMatchSchedule = $fn->GetMatchScheduleDataByTournamentID('{"TournamentID":"'.$TournamentId.'"}');
}
//else{
//    $TeamWiseMatchSchedule = $fn->GetMatchScheduleDataByTournamentID('{"TeamID":"'.$TeamID.'"}');
//}

//$TeamWiseMatchSchedule = $fn->GetMatchScheduleDataByTournamentID('{"TournamentID":"19"}');
//echo '<pre>';
//print_r($TeamWiseMatchSchedule);
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="page-header">
                    <h2>Match Schedule</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li><a href="view_team_match_schedule">Match Schedule</a></li>

                        <!--                    <li><a href="class-management">Class Management</a></li>-->

                    </ol>
                </div>
            </div>
            <div class="col-lg-6"><br><br>
                <div class='panel-header'>
                    <div class="col-lg-4 ">
                           
                            <label for="TournamentName" class="control-label" style="margin-top: 3px;"><?php echo TournamentName; ?> <span style="color: red;">*</span> </label><br>
                             
                            <?php
                            $Selected = isset($_REQUEST['TournamentID']) ? $_REQUEST['TournamentID'] : " ";
                            $db_array = array("tbl_name" => 'v_tournaments', "condition" => "is_active='Y'");
                            $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "required form-control");
                            $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Select Tournament", 'selected' => $Selected);
                            $fn->dropdown($db_array, $select_array, $option_array);
                            ?>
                            <span id="TournamentErrorSpan" style="color: red"></span>
                    </div>
                    <div class="col-lg-3">
                            <div class="form-group">
                                <label for="StartDate" class="control-label "><?php echo StartDate; ?> </label>
                                <input type="text" name="StartDate" class="form-control material required" id="StartDate" placeholder="DD-MM-YYYY" value="<?php if($_REQUEST['StartDate'] != ''){ echo $_REQUEST['StartDate']; }?>" >                   
                                <span id="StartDateErrorSpan" style="color: red"></span>
                            </div>
                    </div>
                    <div class="col-lg-3">
                            <div class="form-group">
                                <label for="EndDate" class="control-label "><?php echo EndDate; ?> </label>
                                <input type="text" name="EndDate" class="form-control material required" id="EndDate" placeholder="DD-MM-YYYY" value="<?php if($_REQUEST['EndDate'] != ''){ echo $_REQUEST['EndDate']; }?>">
                                <span id="EndDateErrorSpan" style="color: red"></span>
                                
                            </div>
                    </div>
                    <div class="col-lg-1"><br>
                        <input type="button" class="btn btn-primary" onclick="GetMatchScheduleByDate()" value="Search">
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
                        require_once 'forms/form_create_attack.php';
                    } else {
                        if (is_array($TeamWiseMatchSchedule) && !empty($TeamWiseMatchSchedule)) {
                            ?>
                    <div class="table-responsive" style="overflow-x: hidden;">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><center><?php echo MatchSchedule; ?></center></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($TeamWiseMatchSchedule['GetMatchScheduleDataByTournamentID'] AS $Key => $Value) {
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-3"></div>
                                                            <div class="col-lg-1">
                                                                <img src="<?php echo $Value['FirstTeamLogo']?>" class="img-circle" height="80px" width="80px">
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <center><label><b><h2><?php echo $Value['FirstName']?></h2></b></label><span> VS </span><label><b><h2><?php echo $Value['SecondName']?></h2></b></label><br>
                                                                   <b>Match Date :</b> <span><?php echo $Value['MatchDate']?> </span>
                                                                    <b>Start Time :</b> <span><?php echo $Value['MatchStartTime']?> </span><br>
                                                                   <b>Ground :</b> <span><?php echo $Value['GroundName']?> </span>
                                                                   <b>Court :</b> <span><?php echo $Value['CourtName']?> </span>
                                                               </center>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <img src="<?php echo $Value['SecondTeamLogo']?>" class="img-circle" height="80px" width="80px">
                                                            </div>
                                                            <div class="col-lg-2"></div>
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
    function GetMatchSchedule(e){
        window.location.href='view_team_match_schedule&TournamentID='+e.value;
    }
    function GetMatchScheduleByDate(){
        
        var StartDate = $('#StartDate').val();
        var EndDate = $('#EndDate').val();
        var TournamentID = $('#TournamentID').val();
        if(TournamentID != ''){
            window.location.href='view_team_match_schedule&TournamentID='+TournamentID;
            if(StartDate != ''){
                if(EndDate != ''){
                    $("#EndDateErrorSpan").text('');
                    $("#StartDateErrorSpan").text('');
                window.location.href='view_team_match_schedule&TournamentID='+TournamentID +'&StartDate='+ StartDate +'&EndDate='+EndDate;
                }else{
                    $("#EndDateErrorSpan").text('Select End Date');
                    $("#StartDateErrorSpan").text('');
                }
            }
        }else{
            $("#TournamentErrorSpan").text('Select Tournament');
        }
        
    }
    $(document).ready(function () {
        var StartDate = $('input[name="StartDate"]'); //our date input has the name "date"
        var EndDate = $('input[name="EndDate"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var FromEndDate = new Date();
        StartDate.datepicker({
            format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            startDate: FromEndDate,
        });
        EndDate.datepicker({
            format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            startDate: FromEndDate,
        });
    });
    </script>