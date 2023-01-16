<?php
$data = $fn->getDataByID('v_tournaments', 'TournamentID', $_REQUEST['TournamentID']);
//$TournamentRulesData = $fn->TournamentRulesData();
$TournamentRulesData = $fn->DataByID('{"Condition":{"table":"v_documents","Key":"DocumentID","value":10}}');
//echo '<pre>';
//print_r($TournamentRulesData['GetData']['DocumentDescription']);

$TournamentRulesDataFromMaster = $TournamentRulesData['GetData']['DocumentDescription'];

$StartDate = str_replace('/', '-', $data['StartDate']);
$EndDate = str_replace('/', '-', $data['EndDate']);
$RegistrationStartDate = str_replace('/', '-', $data['RegistrationStartDate']);
$RegistrationEndDate = str_replace('/', '-', $data['RegistrationEndDate']);
$Start = date("d-m-Y", strtotime($data['StartDate']));
$End = date("d-m-Y", strtotime($EndDate));
$RegistStart = date("d-m-Y", strtotime($RegistrationStartDate));
$RegistEnd = date("d-m-Y", strtotime($RegistrationEndDate));
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="TournamentName" class="control-label"><?php echo TournamentName; ?> <span style="color: red;">*</span> </label><br><br>
                    <input type="text" class="form-control material required" name="TournamentName" id="TournamentName" value="<?php echo $data['TournamentName']; ?>" placeholder="Enter Tournament Name Here...">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="Description" class="control-label"><?php echo Description; ?> <span style="color: red;">*</span> </label>
                    <textarea class="form-control material required"  name="Description" id="Description" placeholder="Enter Description..."><?php echo $data['Description']; ?></textarea>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="TournamentFor" class="control-label"><?php echo TournamentFor; ?> <span style="color: red;">*</span> </label>
                    <select class="form-control required material" name="TournamentFor" id="TournamentFor">
                        <option value="">Select Tournament For</option>
                        <option <?php if ($data['TournamentFor'] == 'Men') { ?>selected="selected" <?php } else {
    
} ?> value="Men">Male</option>
                        <option <?php if ($data['TournamentFor'] == 'Female') { ?>selected="selected" <?php } else {
    
} ?> value="Female">Female</option>
                        <option <?php if ($data['TournamentFor'] == 'All') { ?>selected="selected" <?php } else {
    
} ?> value="All">All</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="TournamentType" class="control-label"><?php echo TournamentType; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $Selected = isset($data['TypeID']) ? $data['TypeID'] : " ";
                    $db_array = array("tbl_name" => 'v_tournament_type', "condition" => "is_active='Y'");
                    $select_array = array("name" => "TypeID", "id" => "TypeID", "class" => "required form-control material");
                    $option_array = array("value" => "SrNo", "label" => "TypeName", "placeholder" => "Select Tournament Type", 'selected' => $Selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="RegistrationFees" class="control-label"><?php echo RegistrationFees; ?> <span style="color: red;">*</span> </label>
                    <input type="number" class="form-control material required" name="RegistrationFees" id="TournamentName" value="<?php echo $data['RegistrationFees']; ?>" placeholder="Enter Registration Fee Here...">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="State" class="control-label"><?php echo State; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $selected = isset($data['StateID']) ? $data['StateID'] : "";
                    $db_array = array("tbl_name" => 'v_state', "condition" => "is_active='Y'");
                    $select_array = array("name" => "StateID[]", "id" => "StateID", "class" => "required form-control material","onchange" => "GetCitiesDataForTournamnet();","multiple" => "1");
                    $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            
            
            
            
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="City" class="control-label"><?php echo City; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $selected = isset($data['CityID']) ? $data['CityID'] : "";
                    $db_array = array("tbl_name" => 'v_city', "condition" => "is_active='Y'");
                    $select_array = array("name" => "CityID[]", "id" => "CityID", "class" => "required form-control material","multiple" => "1");
                    $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                    
                </div>
            </div>
<div class="col-lg-4">
                <div class="form-group">
                    <label for="WinnerPrize" class="control-label"><?php echo WinnerPrize; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="WinnerPrize" id="WinnerPrize" value="<?php echo $data['WinnerPrize']; ?>" placeholder="Enter Winner Prize Here...">

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="RunnerUpsPrize" class="control-label"><?php echo RunnerUpsPrize; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="RunnerUpsPrize" id="RunnerUpsPrize" value="<?php echo $data['RunnerUpsPrize']; ?>" placeholder="Enter Runner Up Prize Here...">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="SecondRunnerUpsPrize" class="control-label"><?php echo SecondRunnerUpsPrize; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="SecondRunnerUpsPrize" id="SecondRunnerUpsPrize" value="<?php echo $data['SecondRunnerUpsPrize']; ?>" placeholder="Enter Second Runner Up Prize Here...">

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="PlayerOfTheTournamnetPrice" class="control-label"><?php echo PlayerOfTheTournamnetPrice; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="PlayerOfTheTournamnetPrice" id="PlayerOfTheTournamnetPrice" value="<?php echo $data['PlayerOfTheTournamnetPrice']; ?>" placeholder="Enter Player Of The Tournamnet Price Here...">
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="StartDate" class="control-label"><?php echo StartDate; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="StartDate" id="StartDate" value="<?php if($Start == '01-01-1970'){ echo date('d-m-Y',strtotime(date('Y-m-d')));}else{ echo $Start;} ?>" placeholder="DD/MM/YYYY" onchange="CheckDates('StartDate', 'EndDate');" >

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="EndDate" class="control-label"><?php echo EndDate; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="EndDate" id="EndDate" value="<?php if($End == '01-01-1970'){ echo date('d-m-Y',strtotime(date('Y-m-d')));}else{ echo $End;} ?>" placeholder="DD/MM/YYYY" onchange="CheckDatesend('StartDate', 'EndDate','DateSpan');">
                    <span id="DateSpan" style="color:red;"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            
            
            
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="RegistrationStartDate" class="control-label"><?php echo RegistrationStartDate; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="RegistrationStartDate" id="RegistrationStartDate" value="<?php if($RegistStart == '01-01-1970'){ echo date('d-m-Y',strtotime(date('Y-m-d')));}else{ echo $RegistStart;} ?>" placeholder="DD/MM/YYYY" onchange="CheckDates('RegistrationStartDate', 'RegistrationEndDate'),CheckRegistrationDate('RegistrationStartDate', 'StartDate','DateSpanRegistrationStart');">
                    <span id="DateSpanRegistrationStart" style="color:red;"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="RegistrationEndDate" class="control-label"><?php echo RegistrationEndDate; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="RegistrationEndDate" id="RegistrationEndDate" value="<?php if($RegistEnd == '01-01-1970'){ echo date('d-m-Y',strtotime(date('Y-m-d')));}else{ echo $RegistEnd;} ?>" placeholder="Enter Runner Up Prize Here..." onchange="CheckDatesendRegistEnd('StartDate', 'RegistrationEndDate','DateSpanRegistrationEnd'),CheckDatesend('RegistrationStartDate', 'RegistrationEndDate','DateSpanRegistration');">
                    <span id="DateSpanRegistration" style="color:red;"></span>
                    <span id="DateSpanRegistrationEnd" style="color:red;"></span>
                </div>
            </div>
             
            
        </div>
    </div>
    <div class="row">
         <div class="col-lg-12">
             <div class="col-lg-4">
                <div class="form-group">
                    <label for="MinimumPlayers" class="control-label"><?php echo MinimumPlayers; ?> <span style="color: red;">*</span> </label>
                    <input type="number" class="form-control material required" name="MinimumPlayers" id="MinimumPlayers" value="<?php echo $data['MinimumPlayers']; ?>" placeholder="Enter Minimum Number Of Players Here..." min="1" >

                </div>
            </div>
             <div class="col-lg-4">
                <div class="form-group">
                    <label for="MaximumPlayers" class="control-label"><?php echo MaximumPlayers; ?> <span style="color: red;">*</span> </label>
                    <input type="number" class="form-control material required" name="MaximumPlayers" id="MaximumPlayers" value="<?php echo $data['MaximumPlayers']; ?>" placeholder="Enter Maximum Number Of Players Here..." min="1" onchange="CheckMinMaxPlayer(this.value)">
                    <span id="MinimumPlayersSpan" style="color: red"></span>

                </div>
            </div>
         </div>
    </div>
    <div class="row">
         <div class="col-lg-12">
            <div class="col-lg-8">
                <div class="form-group">
                    <label name="TournamentRules"><?php echo TournamentRules ?> <span style="color: red;">*</span></label>
                <span id="CKEditorRequired"></span>
                        <textarea name="TournamentRules" id="TournamentRules" class="form-control input-sm required"><?php echo (!empty($data['TournamentRules'])) ? $data['TournamentRules'] : $TournamentRulesDataFromMaster; ?>
                        </textarea>
                </div>
            </div>
             <div class="col-lg-4">
                 <div class="form-group">
                    <div class="featured-service-right-image-area tab-content">
                                                    <div class="form-group">

                                                        <label for="TournamentImage" class="control-label">Upload <?php echo TournamentImage ?> :</label><br>
                                                        <input name="TournamentImage" id="TournamentImage" type="hidden" class="inputFile input-md" value="<?php echo (!empty($data['TournamentImage'])) ? $data['TournamentImage'] : ""; ?>">
                                                        <input name="TournamentImage" id="TournamentImage" type="file" class="inputFile input-md" /><br>

                                                        <span id="TournamentImageupload" ></span>
                                                        <span id="TournamentImageloading" style="display: none;  color: orange">Uploading Please wait</span>
                                                        <div id="TournamentImageresponse"></div>
                                                        <img id="TournamentImagePreview" src="<?php echo (!empty($data['TournamentImage'])) ? SITE_URL . 'admin/uploads/TournamentImage/' . $data['TournamentImage'] : SITE_URL . "admin/uploads/placeholder.png"; ?>" alt="TournamentImage" style="width:100px;height:100px;">
                                                        <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveFile(this.form, 'TournamentImage', 'TournamentImagePreview', 'TournamentImage', 'TournamentImageupload', 'TournamentImageloading', 'TournamentImageresponse','in');">Upload</button>
                                                    </div>
                                                </div>

                </div>
             </div>
         </div>
    </div>
    <div class="row"><hr>
    </div>
    <div class="form-group">

        <input type="hidden" name="OrganizerID" value="1">
        <input type="hidden" name="TournamentID" value="<?php echo (isset($data['TournamentID'])) ? $data['TournamentID'] : "Y"; ?>">
<?php if (isset($_REQUEST['TournamentID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="UpdateTournamentData(this.form);" ><?php echo update; ?></button>
<?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="InsertTournamentData(this.form);" ><?php echo save; ?></button>
<?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_tournament"><?php echo cancel; ?></a>
    </div>
</form>

<script>
    function CheckDates(FirstDateID, SecondDateID)
    {
        var FirstDate = $('#' + FirstDateID).val();
        $('#' + SecondDateID).val(FirstDate);
    }
    
    function CheckDatesend(FirstDateID, SecondDateID,SpanID)
    { 
        var FirstDate = $('#' + FirstDateID).val();
        var SecondDate = $('#' + SecondDateID).val();
        if(SecondDate < FirstDate)
        {
            $("#create").prop('disabled', true);
            $('#'+SpanID).html('End date should be greter than or equal to start date');
            return false;
        }else{
            $("#create").prop('disabled', false);
            $('#'+SpanID).html('');
        }
    }
    function CheckDatesendRegistEnd(FirstDateID, SecondDateID,SpanID)
    { 
        var FirstDate = $('#' + FirstDateID).val();
        var SecondDate = $('#' + SecondDateID).val();
        if(FirstDate < SecondDate)
        {
            $('#'+SpanID).html('End date should be greter than or equal to start date');
            $("#create").prop('disabled', true);
            return false;
        }else{
            $('#'+SpanID).html('');
            $("#create").prop('disabled', false);
        }
    }
    function CheckRegistrationDate(FirstDateID, SecondDateID,SpanID)
    {
        var FirstDate = $('#' + FirstDateID).val();
        var SecondDate = $('#' + SecondDateID).val();
        if(SecondDate < FirstDate)
        {
            $('#'+SpanID).html('End date should be greter than or equal to tournament start date');
            $("#create").prop('disabled', true);
            return false;
        }else{
            $('#'+SpanID).html('');
            $("#create").prop('disabled', false);
        }
    }
    function GetCitiesDataForTournamnet()
    {
        
        var URL = 'ajax/status.php';
        var StateList = $('#StateID').val();
        jQuery.ajax({
        type: 'POST',
        url: URL,
        data: {"do": "GetCitiesDataForTournamnet", "StateList": StateList},
        success: function (data) {
            $("#CityID").html(data);
        }
    });
        
    }
</script>

<script>
    $(document).ready(function () {
        var date_input_StartDate = $('input[name="StartDate"]'); //our date input has the name "date"
        var date_input_EndDate = $('input[name="EndDate"]'); //our date input has the name "date"
        var date_input_RegistrationStartDate = $('input[name="RegistrationStartDate"]'); //our date input has the name "date"
        var date_input_RegistrationEndDate = $('input[name="RegistrationEndDate"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var FromEndDate = new Date();
        date_input_StartDate.datepicker({
            format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            startDate: FromEndDate
            
        });
        date_input_EndDate.datepicker({
            format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            startDate: FromEndDate
        });
        date_input_RegistrationStartDate.datepicker({
            format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            startDate: FromEndDate
        });
        date_input_RegistrationEndDate.datepicker({
            format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            startDate: FromEndDate
        });
        
    });
    
    function CheckMinMaxPlayer(e){
        var MinimumPlayer = $('#MinimumPlayers').val();
//        alert(MinimumPlayer);
//        alert(e);
        if(parseInt(MinimumPlayer) > parseInt(e)){
            $('#MinimumPlayersSpan').text('Maximum Player Should Be Greter Then Minimum Players');
            $('#create').prop('disabled',true);
            return false;
        }else{
            $('#MinimumPlayersSpan').text('');
            $('#create').prop('disabled',false);
        }
    }
</script>

<script>
    CKEDITOR.replace("TournamentRules");
</script>