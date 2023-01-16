<?php
if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != ''){
$TaxData = $fn->RevenueAndTaxReportByTournament('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$TournamentNameData = $fn->TournamentStartDateByTournamentID('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$Tournaments = $TournamentNameData['TournamentStartDateData'];
}
?>
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-7">
            <div class="page-header">
                <h2>Revenue And Tax Report</h2>
                <ol class="breadcrumb">
                   <li><a href="home">Dashboard</a></li>
                   <li><a href="reports">Reports</a></li>
                   <li><a href="revenue_tax_report">Revenue And Tax Report</a></li>
                </ol>
            </div>
            </div>
            <div class="col-lg-5"><br><br>
                <div class='panel-header'>
                    <div class="col-lg-12">
                        <div class="col-lg-5" style="padding-right: 1px;padding-top:5px;">
                            <label for="TournamentName" class="control-label" style="font-weight: 700;"><?php echo SelectTournament; ?> </label>
                        </div>
                        <div class="col-lg-7">
                            <?php
                            $Selected = isset($_REQUEST['TournamentID']) ? $_REQUEST['TournamentID'] : '';
                            $db_array = array("tbl_name" => 'v_tournaments', "condition" => "is_active='Y'");
                            $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "required form-control", "onchange" => "GetTournament(this.value);");
                            $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Search Tournament", 'selected' => $Selected);
                            $fn->dropdown($db_array, $select_array, $option_array);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Revenue And Tax Report For Tournament:-> &nbsp;<span class="text-success"><?php echo $Tournaments['TournamentName']; ?></span></h1>
        </div>
        <div class='panel-body'>
            <?php if (isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != '') { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="CreatePDF/examples/revenue_tax_report_pdf.php?TournamentID=<?php echo $_REQUEST['TournamentID'] ?>" class="btn btn-sm btn-danger pull-right">Download</a>
                    </div>
                </div>
                <br>
            <?php } ?>
             <div class="row">
                <div class="col-lg-12">            
                    <?php
                        if (is_array($TaxData) && !empty($TaxData)) { ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo TeamName; ?></th>
                                            <th>Basic Amount</th>
                                            <th>Tax Amount</th>
                                            <th>Net Amount</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($TaxData['RevenueAndTaxReportByTournament'] AS $Key => $Value) { ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['TeamName']; ?></td>
                                                <td><?php echo $Value['BasicAmount']; ?></td>
                                                <td><?php echo $Value['TaxAmount']; ?></td>
                                                <td><?php echo $Value['AmountPaid']; ?></td>
                                                <td><?php echo $Value['EMail']; ?></td>
                                            </tr>
                                            <?php } ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <center><h4>No Records Found</h4></center>
                            <?php
                        }
                    ?>
                </div>        
            </div>  
        </div>
    </div>
</div>
<script>
function GetTournament(e)
{
    window.location = 'revenue_tax_report&TournamentID='+e;
}
</script>