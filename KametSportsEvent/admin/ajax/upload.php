<?php

error_reporting(0);
session_start();
require_once("../../config/connection.php");
require_once("../../config/constants.php");
require_once '../../class/mysql.php';
require_once '../../class/function.class.php';
$db = new DataTransaction();

function imageResize($name, $tmp_name, $mimeType, $thumbheight, $thumbwidth, $upload_path_thumb) {  // function to resize the image
    $image = $name;
    $uploadedfile = $tmp_name;
    if ($mimeType == "jpeg" || $mimeType == "jpg") {
        $src = imagecreatefromjpeg($uploadedfile);
    } else if ($mimeType == "png") {
        $src = imagecreatefrompng($uploadedfile);
    } else if ($mimeType == "gif") {
        $src = imagecreatefromgif($uploadedfile);
    }
    list($width, $height) = getimagesize($uploadedfile);
    $newwidth = $thumbheight;
    $newheight = $thumbwidth;
    $tmp = imagecreatetruecolor($newwidth, $newheight);
    $trans_colour = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
    imagefill($tmp, 0, 0, $trans_colour);
    imagealphablending($tmp, true);
    imagesavealpha($tmp, true);
    imagecopyresized($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    $filename = $upload_path_thumb . $name;

    if ($mimeType == "jpeg" || $mimeType == "jpg") {
        imagejpeg($tmp, $filename, 100);
    } else if ($mimeType == "gif") {
        imagegif($tmp, $filename, 100);
    } else if ($mimeType == "png") {
        imagepng($tmp, $filename, 9);
    }
    //$image = file_get_contents("$filename", true);
    //return $image;
}

//check directory exits
if (!file_exists(ADMIN_ROOT . "uploads/" . $_REQUEST['do'])) {
    mkdir(ADMIN_ROOT . "uploads/" . $_REQUEST['do'], 0777, true);
}
if (isset($_REQUEST['folder']) && $_REQUEST['folder'] != '') {
    if (!file_exists(ADMIN_ROOT . "uploads/" . $_REQUEST['do'] . "/" . $_REQUEST['folder'])) {
        mkdir(ADMIN_ROOT . "uploads/" . $_REQUEST['do'] . "/" . $_REQUEST['folder'], 0777, true);
    }
    $output_dir = ADMIN_ROOT . "uploads/" . $_REQUEST['do'] . "/" . $_REQUEST['folder'] . "/";
} else {
    $output_dir = ADMIN_ROOT . "uploads/" . $_REQUEST['do'] . "/";
}
//check thumb directory exits
if (!file_exists(ADMIN_ROOT . "uploads/" . $_REQUEST['do'] . "/thumbs")) {
    mkdir(ADMIN_ROOT . "uploads/" . $_REQUEST['do'] . "/thumbs", 0777, true);
}
$output_dir_thumbs = ADMIN_ROOT . "uploads/" . $_REQUEST['do'] . "/thumbs/";
if (isset($_FILES["myfile"])) {
    $ret = array();
    $error = $_FILES["myfile"]["error"];
    //You need to handle  both cases
    //If Any browser does not support serializing of multiple files using FormData()
    if (!is_array($_FILES["myfile"]["name"])) { //single file
        $temp_name = $_FILES["myfile"]["tmp_name"];
        $fileName = time() . '-' . $_FILES["myfile"]["name"];
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);
        $ext_array = explode('.', $fileName);
        $extension = $ext_array[sizeof($ext_array) - 1];
        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {
            switch ($extension) {
                case 'jpg':
                    imagejpeg($new, $file_name, 100);
                    break;
                case 'jpeg':
                    imagejpeg($new, $file_name, 100);
                    break;
                case 'png':
                    imagepng($new, $file_name, 9);
                    break;
                case 'gif':
                    imagegif($new, $file_name, 100);
                    break;
                default:
                    exit;
                    break;
            }

            $_SESSION['file_name'] = $fileName;
            $img = imageResize($fileName, $output_dir . $fileName, $extension, '100', '100', $output_dir_thumbs);
        }
        $ret = $fileName;
    } else {  //Multiple files, file[]
        $fileCount = count($_FILES["myfile"]["name"]);
        for ($i = 0; $i < $fileCount; $i++) {
            $temp_name = $_FILES["myfile"]["tmp_name"][$i];
            $fileName = time() . '-' . $_FILES["myfile"]["name"][$i];
            move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName);
            $ext_array = explode('.', $fileName);
            $extension = $ext_array[sizeof($ext_array) - 1];
            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {
                switch ($extension) {
                    case 'jpg':
                        imagejpeg($new, $file_name, 100);
                        break;
                    case 'jpeg':
                        imagejpeg($new, $file_name, 100);
                        break;
                    case 'png':
                        imagepng($new, $file_name, 9);
                        break;
                    case 'gif':
                        imagegif($new, $file_name, 100);
                        break;
                    default:
                        exit;
                        break;
                }
                $_SESSION['file_name'] = $fileName;
                //if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif')
                $img = imageResize($fileName, $output_dir . $fileName, $extension, '100', '100', $output_dir_thumbs);
            }
            $ret[] = $fileName;
        }
    }
    echo json_encode($ret);
}
?>