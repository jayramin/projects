<?php
$AgentList = $fn->UserTypeWiseRecordForSMS('{"RoleID":2}');
$RetailerList = $fn->UserTypeWiseRecordForSMS('{"RoleID":3}');
$ClientList = $fn->UserTypeWiseRecordForSMS('{"RoleID":4}');
$UserList = $fn->UserTypeWiseRecordForSMS('{"RoleID":5}');

if(isset($_REQUEST['UserMsgBtn'])){
     $Users = implode(',', $_REQUEST['Userchk']);
}
if(isset($_REQUEST['AgentMsgBtn'])){
     $Agent = implode(',', $_REQUEST['agentchk']);
}
if(isset($_REQUEST['ClientMsgBtn'])){
     $Client = implode(',', $_REQUEST['clientchk']);
}
if(isset($_REQUEST['RetailerMsgBtn'])){
     $Retailer = implode(',', $_REQUEST['retailerchk']);
}
//echo "<pre>";
//exit;
?>
<!--Content-->
<div class="content-wrapper">
    <div class="page-title">
        <!--<div class="row">-->
        <div class="col-lg-5">
            <div>
                <h1><i class="fa fa-dashboard"></i> Credit Note Management</h1>
            </div>
            <div>
                <ul class="breadcrumb pull-left">

                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index">Dashboard</a></li>
                    <li class="active">
                        <?php
                        if ($_REQUEST['method'] == 'edit') {
                            echo 'Edit Retailer';
                        } else if ($_REQUEST['method'] == 'add') {
                            echo 'New Retailer Entry';
                        } else {
                            echo 'View Retailer List';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="cardhome">
                <div class="card-body">
                    <?php 
//                    echo "<pre>";
//                    print_r($ClientList);
                    ?>
                      <form method="post">
                    <table class="table table-hover table-bordered" id="sampleTable">
                      
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="CategoryTitle" class="control-label"><?php echo Agents; ?> <span style="color: red;">*</span> </label>
                                <div style="min-height: 150px; max-height: 400px; overflow-y: scroll">
                                <?php foreach ($AgentList['GetRetailersData'] AS $Key => $AgentValue) { ?>
                                    <input type="checkbox" class="form-control" name="agentchk[]" value="<?php echo $AgentValue['UserID']; ?>"><?php echo $AgentValue['UserName']; ?>
                                <?php }
                                ?>
                                </div>
                                    <div>
                                        <br>
                                        <textarea name="AgentMsg" class="form-control" rows="5"></textarea>
                                    </div>
                                <div >
                                    <br>
                                    <input type="hidden" name="AgentRoleID" value="2">
                                    <!--<input type="button" name="AgentMsgBtn" id="AgentMsgBtn" value="Send SMS to Agent" class="btn btn-primary btn-md" onclick="SendSMSAgent();" >-->
                                    <!--<input type="text" name="AgentIds" value="<?php echo $Users?>">-->
                                    <input type="submit" class="btn-success btn-md btn" name="AgentMsgBtn" value="Send SMS to Agent">
                                    <input type="reset" class="btn-danger btn-md btn"  value="Cancel">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="CategoryTitle" class="control-label"><?php echo Retailers; ?> <span style="color: red;">*</span> </label>
                                <div style="min-height: 150px; max-height: 400px; overflow-y: scroll">
                                <?php foreach ($RetailerList['GetRetailersData'] AS $Key => $RetailerValue) { ?>
                                    <input type="checkbox" class="form-control" name="retailerchk[]" value="<?php echo $RetailerValue['UserID']; ?>"><?php echo $RetailerValue['UserName']; ?>
                                <?php }
                                ?>
                                </div>
                                    <div>
                                        <br>
                                        <textarea name="RetailerMsg" class="form-control" rows="5"></textarea>
                                    </div>
                                <div >
                                    <br>
                                    <input type="hidden" name="RetailerRoleID" value="3">
                                    <!--<input type="button" name="RetailerMsgBtn" id="RetailerMsgBtn" value="Send SMS to Retailer" class="btn btn-primary btn-md" onclick="SendSMSRetailer();" >-->
                                    <input type="submit" class="btn-success btn-md btn" name="RetailerMsgBtn" value="Send SMS to Retailer">
                                    <input type="reset" class="btn-danger btn-md btn"  value="Cancel">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="CategoryTitle" class="control-label"><?php echo Clients; ?> <span style="color: red;">*</span> </label>
                                <div style="min-height: 150px; max-height: 400px; overflow-y: scroll">
                                <?php foreach ($ClientList['GetRetailersData'] AS $Key => $ClientValue) { ?>
                                    <input type="checkbox" class="form-control" name="clientchk[]" value="<?php echo $ClientValue['UserID']; ?>"><?php echo $ClientValue['UserName']; ?>
                                <?php }
                                ?>
                                </div>
                                    <div>
                                        <br>
                                        <textarea name="ClientMsg" class="form-control" rows="5"></textarea>
                                    </div>
                                <div >
                                    <br>
                                    <input type="hidden" name="ClientRoleID" value="4">
                                    <!--<input type="button" name="ClientMsgBtn" id="ClientMsgBtn" value="Send SMS to Client" class="btn btn-primary btn-md" onclick="SendSMSClient();" >-->
                                    <input type="submit" class="btn-success btn-md btn" name="ClientMsgBtn" value="Send SMS to Client">
                                    <input type="reset" class="btn-danger btn-md btn"  value="Cancel">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="CategoryTitle" class="control-label"><?php echo Users; ?> <span style="color: red;">*</span> </label>
                                <div style="min-height: 150px; max-height: 400px; overflow-y: scroll">
                                <?php 
                                $i=0;
                                foreach ($UserList['GetRetailersData'] AS  $UserValue) { 
                                    ?>
                                    <input type="checkbox" class="form-control" name="Userchk[]" value="<?php echo $UserValue['UserID']; ?>"><?php echo $UserValue['UserName']; ?>
                                <?php }
                                ?>
                                </div>
                                    <div>
                                        <br>
                                        <textarea name="UserMsg" class="form-control" rows="5"></textarea>
                                    </div>
                                <div >
                                    <br>
                                    <input type="hidden" name="UserRoleID" value="5">
                                    <!--<input type="button" name="UserMsgBtn" id="UserMsgBtn" value="Send SMS to Users" class="btn btn-primary btn-md" onclick="SendSMSUsers();" >-->
                                    <input type="submit" class="btn-success btn-md btn" name="UserMsgBtn" value="Send SMS to Users">
                                    <input type="reset" class="btn-danger btn-md btn"  value="Cancel">
                                </div>
                            </div>
                        </div>
                      
                    </table> 
                  </form>
                </div>
            </div>
        </div>
    </div>
