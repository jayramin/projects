<?php
//require_once './config/connection.php';

//$sql='insert into mlm_countries';
function readCSV($csvFile){
	$file_handle = fopen($csvFile, 'r');
	while (!feof($file_handle) ) {
		$line_of_text[] = fgetcsv($file_handle, 1024);
	}
	
	fclose($file_handle);
	return $line_of_text;
}
// Set path to CSV file
$csvFile = 'mcq.docx';

$csv = readCSV($csvFile);
echo '<pre>';
print_r($csv);
echo '</pre>';
?>

