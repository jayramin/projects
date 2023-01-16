<?php
// Include the Labels FOR CONSTANTS.
ob_start();
session_start();
require_once('../../../includes/labels.php');
// Create Connection with the database START------------------------------------
$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Create Connection with the database END------------------------------------
// Include TCPDF main library config file..
require_once('../../../class/class.functions.php');
require_once('../../../class/class.DataTransaction.php');
$fn = new functions($db);
$mysql = new DataTransaction($db);
require_once('tcpdf_include.php');

// Fetch required data to create PDF file such as Meeting Room Details or Meeting Room Combination details etc.. START---
if ((isset($_REQUEST['TeamID']) && $_REQUEST['TeamID'] != '') && (isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != '')) {
$TDataNew = $fn->GetTournamentScoreCardDetailsByTeam('{"TournamentID":"' . $_REQUEST['TournamentID'] . '","TeamID":"' . $_REQUEST['TeamID'] . '"}');
$PData = $TDataNew['ScoreCardEntriesByTeam'];
    
$TournamentNameData = $fn->TournamentStartDateByTournamentID('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$Tournaments = $TournamentNameData['TournamentStartDateData'];
$Tdetal = $fn->DataByID('{"Condition":{"table":"v_teams","Key":"TeamID","value":"'.$_REQUEST['TeamID'].'"}}');
$Tdetails = $Tdetal['GetData'];
}


// Fetch required data to create PDF file such as Meeting Room Details or Meeting Room Combination details etc.. END---
// create new PDF document

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$pdf->setPrintHeader(false);
$pdf->SetHeaderMargin(60);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kamet Sports Events');
$pdf->SetTitle(COMPANY_NAME);
$pdf->SetSubject("Team Wise Score Card");
$pdf->SetKeywords('VO, Office, VirtualOffice');
// set default header data

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "", 'KAMET SPORTS EVENTS');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 18));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// set font
$pdf->SetFont('times', '', 10);
// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// create some HTML content
$html = '<h1>Score Card For:-> &nbsp;&nbsp;&nbsp;<span style="color:green;">'.ucwords($Tdetails['TeamName']).'</span> &nbsp; IN &nbsp;&nbsp; <span style="color:green;">'.ucwords($Tournaments['TournamentName']).'</span></h1><table style="width:100%;" cellspacing="0" cellpadding="5" border="1">
                                <thead>
                                    <tr>
                                        <th>'.SrNo.'</th>
                                        <th>'.MatchDate.'</th>
                                        <th>'.MatchWith.'</th>
                                        <th>'.NumberOfSetsWin.'</th>
                                        <th>'.NumberOfSetsLoose.'</th>
                                        <th>'.MatchResult.'</th>
                                    </tr>
                                </thead>
                                <tbody>';
foreach ($PData AS $Key => $Value) {
    $html.="<tr>
                                                <td>".($Key + 1)."</td>
                                                <td>".date('d-m-Y', strtotime($Value['MatchDate']))."</td>
                                                <td>".$Value['TeamWith']."</td>
                                                <td>".$Value['SetWin']."</td>
                                                <td>".$Value['SetLoss']."</td>
                                                <td>";
    if ($Value['WinLos'] == 'Win') {
        $html.='<span style="color:green;">Win</span>';
    }else{
        $html.='<span style="color:red;">Loss</span>';
    }
    $html.="</td>
                                            </tr>";
}
$html.= '</tbody></table><br>';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
$FileName = 'Score Card For-'.ucwords($Tdetails['TeamName']).' IN '.ucwords($Tournaments['TournamentName']).' ' . date('Y-m-d H:i:s') . '.pdf';
ob_end_clean();
$pdf->Output($FileName, 'D');
ob_end_flush();

//============================================================+
// END OF FILE
//============================================================+
?>