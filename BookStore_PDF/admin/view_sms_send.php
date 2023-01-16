<?php
$AgentList = $fn->UserTypeWiseRecordForSMS('{"RoleID":"'.$_REQUEST['RoleID'].'"}');
//$RetailerList = $fn->UserTypeWiseRecordForSMS('{"RoleID":3}');
//$ClientList = $fn->UserTypeWiseRecordForSMS('{"RoleID":4}');
//$UserList = $fn->UserTypeWiseRecordForSMS('{"RoleID":5}');


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
        <div class="col-lg-3">
        <div class="form-group">
                
                <select class="form-control chosen-select required" name="Role" id="Role" onchange="GetUserRoleWiseData(this.value)"> 
                    <option value="">Select Role</option>
                    <option value="2">Agent</option>
                    <option value="3">Retailer</option>
                    <option value="4">Internet User</option>
                    <option value="5">General User</option>
                </select>
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
                      
                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                <label for="CategoryTitle" class="control-label"><?php echo Agents; ?> <span style="color: red;">*</span> </label>
                                <div style="min-height: 150px; max-height: 400px; overflow-y: scroll">
                                    Select All      <input type="checkbox" onclick="toggle(this)" /> <br/>
                                <?php foreach ($AgentList['GetRetailersData'] AS $Key => $AgentValue) { ?>
                                    <input type="checkbox" class="form-control" name="agentchk" value="<?php echo $AgentValue['UserID']; ?>"><?php echo $AgentValue['UserName']; ?>
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
                       
                      
                    </table> 
                  </form>
                </div>
            </div>
        </div>
    </div>
<script>
    function GetUserRoleWiseData(e){
        window.location.href='view_sms_send&RoleID='+e;
    }
    
</script>
<script language="JavaScript">
function toggle(source) {
//    alert('call');
  checkboxes = document.getElementsByName('agentchk');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
