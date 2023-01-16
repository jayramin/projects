<?php
$UserID = $_SESSION['KametSports']['session']['UserID'];
$MyTeamData = $fn->MyTeamData('{"CaptainID":"' . $UserID . '"}');
$MyTeamID = $MyTeamData['GetMyTeamWiseData']['TeamData'][0]['TeamID'];

$MyTeamDataForPayment = $fn->MyTeamDataForPayment('{"TeamID":"' . $MyTeamID . '","CaptainID":"' . $UserID . '","TournamentID":"' . $_REQUEST['TournamentID'] . '"}');
$MyTeamPaymentStatus = $fn->TeamTournamentPaymentDoneCheck('{"TeamID":"' . $MyTeamID . '","CaptainID":"' . $UserID . '","TournamentID":"' . $_REQUEST['TournamentID'] . '"}');

$CheckData = $fn->CheckEligiblityToPay('{"TeamID":"'.$MyTeamID.'"}');
?>
<!-- Content Start -->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <div class="page-header">
                    <div class="col-lg-12">
                        <div class="col-lg-7">
                        <h2>Payment</h2>
                        <ol class="breadcrumb">
                            <li><a href="home">Dashboard</a></li>
                            <li class="active"><?php echo ($_REQUEST['method'] == 'edit') ? 'Edit Payment' : 'Payment'; ?></li>
                        </ol>
                        </div>
                        <div class="col-lg-5">
                        <div class="col-lg-4">
                            <label style="margin-top: 5px;"><?php echo SelectTournament ?></label>
                        </div>
                        <div class="col-lg-8">
                            <select name="TournamentID" id="TournamentID" class="form-control required" onchange="GetGroupsByTournamentID(this.value,'<?php echo $_REQUEST['NotificationID']; ?>')">
                                <option>Select Tournament</option>
                                <?php foreach($CheckData['ApplyData'] as $Key => $Value){ ?>
                                <option value="<?php echo $Value['TournamentID']; ?>" <?php if($_REQUEST['TournamentID'] == $Value['TournamentID']){ ?> selected="selected" <?php } ?>><?php echo $Value['TournamentName']; ?></option>
                                <?php } ?>
                            </select>
                        </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class='content-box big-box box-shadow panel-box panel-gray'>

                <div class='panel-body'>        
                    <form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
                       <?php if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != ''){ ?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="datatable" class="display" class="table table-hover table-bordered table-responsive table-striped table-row">
                                    <thead>
                                        <tr>
                                            <th><?php echo TournamentName; ?></th>
                                            <th><?php echo RegistrationFees; ?></th>
                                            <th><?php echo StartDate; ?></th>
                                            <th><?php echo EndDate; ?></th>
                                            <th><?php echo WinnerPrize; ?></th>
                                            <th><?php echo RunnerUpsPrize; ?></th>
                                            <th><?php echo SecondRunnerUpsPrize; ?></th>
                                            <th><?php echo PlayerOfTheTournamnetPrice; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td><?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['TournamentName']; ?></td>
                                                <td><?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['RegistrationFees']; ?></td>
                                                <td><?php echo date('d-m-Y',  strtotime($MyTeamDataForPayment['GetTeamPaymentData'][0]['StartDate']) ); ?></td>
                                                <td><?php echo date('d-m-Y',  strtotime($MyTeamDataForPayment['GetTeamPaymentData'][0]['EndDate'])); ?></td>
                                                <td><?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['WinnerPrize']; ?></td>
                                                <td><?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['RunnerUpsPrize']; ?></td>
                                                <td><?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['SecondRunnerUpsPrize']; ?></td>
                                                <td><?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['SecondRunnerUpsPrize']; ?></td>
                                            </tr>                                
                                    </tbody>
                                </table>
                                <center>
                                    <!--<label><h2><?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['TeamName'] ?></h2></label><br>-->
                                <!--<label>Registration Fees : <?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['RegistrationFees'] ?></label> <br>-->
                                <input type="hidden" id="PaymentTournamentID" value="<?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['TournamentID']?>">
                                <input type="hidden" id="PaymentRegistrationFees" value="<?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['RegistrationFees']?>">
                                <input type="hidden" id="PaymentTeamID" value="<?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['TeamID']?>">
                                <input type="hidden" id="PaymentCaptainID" value="<?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['CaptainID']?>">
                                <input type="hidden" id="CaptianEmail" value="<?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['EmailID']?>">
                                <?php if(count($MyTeamDataForPayment['GetTeamPaymentData']) > 0){ ?>
                                <button type="button" class="btn btn-primary" name="Payment" id="Payment" onclick="MakePaymentForTeam()" <?php if($MyTeamPaymentStatus['Message'] == 'Success'){ ?> disabled="" <?php } ?> ><?php echo $MyTeamDataForPayment['GetTeamPaymentData'][0]['RegistrationFees']?> Pay</button>
                                <?php } else { ?>
                                <span style="color:red;">Admin Approval is Pending</span> 
                                <?php } ?>
                                </center>
                            </div>
                        </div>
                       <?php }else{ ?> 
                           <div class="row">
                               <div class="col-lg-12">
                                   <center> <label>Select Tournament</label></center>
                               </div>
                           </div>
                       <?php }?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="common_wait" style="display:none;width:69px;height:89px;position:absolute;top:35%;left:50%;padding:2px;" ><img src='uploads/ajax_loading.gif' width="64" height="64" /></div>
<script>
    function GetGroupsByTournamentID(ele,NotificationID)
    {
        window.location = 'make_payment&TournamentID='+ele+'&NotificationID='+NotificationID;
    }
    function MakePaymentForTeam()
    {
        var TournamentID = $("#PaymentTournamentID").val();
        var TeamID = $("#PaymentTeamID").val();
        var CaptainID = $("#PaymentCaptainID").val();
        var CaptianEmail = $("#CaptianEmail").val();
        var RegistrationFees = $("#PaymentRegistrationFees").val();
        var NotificationID = '<?php echo $_REQUEST['NotificationID']; ?>';
            $.ajax({
                    type: 'POST',
                    url: "<?php echo SITE_URL; ?>class/class.ajaxRequest.php",
                    data: {TournamentID: TournamentID, TeamID: TeamID, CaptainID: CaptainID,EmailID:CaptianEmail,RegistrationFees:RegistrationFees, NotificationID:NotificationID, do: 'MakePaymentForTeam'},
                    beforeSend: function () {
                        $("#common_wait").css("display", "block");
                        $("#section_blur").css("opacity", "0.3");
                    },
                    complete: function () {
                        $("#common_wait").hide();
                        $('#RegistrationLoading').html("");
                    },
                    success: function (data) {
                     var result = $.parseJSON(data);
                     alert_message_popup('home', result.Message);
                    }
                });
           
    }
</script>