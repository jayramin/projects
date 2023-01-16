<?php

/*Name of the document file*/
$document = 'mcq.docx';

function get_string_between($string, $start, $end) {
        $string = " " . $string;
        $ini = strpos($string, $start);
        if ($ini == 0)
            return "";
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

function read_file_docx($filename){

    $striped_content = '';
    $content = '';

    if(!$filename || !file_exists($filename)) return false;

    $zip = zip_open($filename);

    if (!$zip || is_numeric($zip)) return false;

    while ($zip_entry = zip_read($zip)) {

        if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

        if (zip_entry_name($zip_entry) != "word/document.xml") continue;

        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

        zip_entry_close($zip_entry);
    }// end while

    zip_close($zip);

    echo $im = get_string_between($content,"descr=","/>");
    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
//    $content = str_replace('</w:r></w:p>', "\r\n", $content);
    //$content = str_replace('</w:r></w:p>', "-viavitae-", $content);
  //  $content = str_replace('-viavitae-', $im, $content);
//    $striped_content = strip_tags($content);
    $striped_content = ($content);
//    echo get_string_between($striped_content,"descr=","/>");
    return $striped_content;
}

$content = read_file_docx($document);
if($content !== false) {

    echo nl2br($content);
}
else {
    echo 'Couldn\'t the file. Please check that file.';
}