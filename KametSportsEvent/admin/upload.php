<?php
error_reporting(0);
require_once '../includes/labels.php';

$MaxImageSize = 1024000;
$ImageQuality = 70;
if (is_array($_FILES)) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $sourcePath = $_FILES['userImage']['tmp_name'];
        $targetPath = time() . "-" . $_FILES['userImage']['name'];
        if (move_uploaded_file($sourcePath, "uploads/avatar/" . $targetPath)) {
             compress("uploads/avatar/" . $targetPath,"uploads/avatar/" . $targetPath, $ImageQuality);
            echo $targetPath;
        }
    } 
//    else if (is_uploaded_file($_FILES['SliderImage']['tmp_name'])) {
//        $sourcePath = $_FILES['SliderImage']['tmp_name'];
//        $targetPath = time() . "-" . $_FILES['SliderImage']['name'];
//        if (move_uploaded_file($sourcePath, "uploads/slideshow/" . $targetPath)) {
//            compress('',"uploads/slideshow/" . $targetPath, $ImageQuality);
//            echo $targetPath;
//        }
//    } 
    else if (is_uploaded_file($_FILES['ProfilePicture']['tmp_name'])) {
        $sourcePath = $_FILES['ProfilePicture']['tmp_name'];
        $targetPath = time() . "-" . $_FILES['ProfilePicture']['name'];
        if (move_uploaded_file($sourcePath, "uploads/ProfilePic/" . $targetPath)) {
            compress("uploads/ProfilePic/" . $targetPath,"uploads/ProfilePic/" . $targetPath, $ImageQuality);
            echo json_encode(array('ResponseCode' => 1, 'Message' => 'Profile Picture Uploaded Successfully', 'FileName' => $targetPath, 'FilePath' => ADMIN_URL.'/uploads/ProfilePic/'.$targetPath));
        }else {
            echo json_encode(array('ResponseCode' => 0, 'Message' => 'Failed ! Please try again'));
        }
    }else if (is_uploaded_file($_FILES['ProofIDImageUpload']['tmp_name'])) {
        $sourcePath = $_FILES['ProofIDImageUpload']['tmp_name'];
        $targetPath = time() . "-" . $_FILES['ProofIDImageUpload']['name'];
        if (move_uploaded_file($sourcePath, "uploads/IDPreoofImage/" . $targetPath)) {
            compress("uploads/IDPreoofImage/" . $targetPath,"uploads/IDPreoofImage/" . $targetPath, $ImageQuality);
            echo json_encode(array('ResponseCode' => 1, 'Message' => 'Proof Id Uploaded Successfully', 'FileName' => $targetPath, 'FilePath' => ADMIN_URL.'/uploads/IDPreoofImage/'.$targetPath));
        }else {
            echo json_encode(array('ResponseCode' => 0, 'Message' => 'Failed ! Please try again'));
        }
    }
    else if (is_uploaded_file($_FILES['ProofIDImage1Upload']['tmp_name'])) {
        $sourcePath = $_FILES['ProofIDImage1Upload']['tmp_name'];
        $targetPath = time() . "-" . $_FILES['ProofIDImage1Upload']['name'];
        if (move_uploaded_file($sourcePath, "uploads/IDPreoofImage/" . $targetPath)) {
            compress("uploads/IDPreoofImage/" . $targetPath,"uploads/IDPreoofImage/" . $targetPath, $ImageQuality);
//            echo $targetPath;
//            echo '1';
//            echo 'File Uploaded Successfully';
        echo json_encode(array('ResponseCode' => 1, 'Message' => 'Proof Id Uploaded Successfully', 'FileName' => $targetPath, 'FilePath' => ADMIN_URL.'/uploads/IDPreoofImage/'.$targetPath));
        }else {
            echo json_encode(array('ResponseCode' => 0, 'Message' => 'Failed ! Please try again'));
        }
    }
    else if (is_uploaded_file($_FILES['SliderImage']['tmp_name'])) {
        
        $sourcePath = $_FILES['SliderImage']['tmp_name'];
        $targetPath = time() . "-" . $_FILES['SliderImage']['name'];
        if (move_uploaded_file($sourcePath, "uploads/Slider/" . $targetPath)) {
            compress("uploads/Slider/" . $targetPath,"uploads/Slider/" . $targetPath, $ImageQuality);
//            echo $targetPath;
//            echo '1';
//            echo 'File Uploaded Successfully';
        echo json_encode(array('ResponseCode' => 1, 'Message' => 'Slider Image Uploaded Successfully', 'FileName' => $targetPath, 'FilePath' => ADMIN_URL.'/uploads/Slider/'.$targetPath));
        }else {
            echo json_encode(array('ResponseCode' => 0, 'Message' => 'Failed ! Please try again'));
        }
    }
    else if (is_uploaded_file($_FILES['TeamLogoUpload']['tmp_name'])) {
        $sourcePath = $_FILES['TeamLogoUpload']['tmp_name'];
        $targetPath = time() . "-" . $_FILES['TeamLogoUpload']['name'];
        if (move_uploaded_file($sourcePath, "uploads/TeamLogo/" . $targetPath)) {
            compress("uploads/TeamLogo/" . $targetPath,"uploads/TeamLogo/" . $targetPath, $ImageQuality);
//            echo $targetPath;
//            echo '1';
//            echo 'File Uploaded Successfully';
        echo json_encode(array('ResponseCode' => 1, 'Message' => 'Logo Uploaded Successfully', 'FileName' => $targetPath, 'FilePath' => ADMIN_URL.'uploads/TeamLogo/'.$targetPath));
        }else {
            echo json_encode(array('ResponseCode' => 0, 'Message' => 'Failed ! Please try again'));
        }
    }else if (is_uploaded_file($_FILES['TournamentImage']['tmp_name'])) {
        
        $sourcePath = $_FILES['TournamentImage']['tmp_name'];
        $targetPath = time() . "-" . $_FILES['TournamentImage']['name'];
        
        if (move_uploaded_file($sourcePath, "uploads/TournamentImage/" . $targetPath)) {
            compress("uploads/TournamentImage/" . $targetPath,"uploads/TournamentImage/" . $targetPath, $ImageQuality);
//            echo $targetPath;
//            echo '1';
//            echo 'File Uploaded Successfully';
        echo json_encode(array('ResponseCode' => 1, 'Message' => 'Logo Uploaded Successfully', 'FileName' => $targetPath, 'FilePath' => ADMIN_URL.'uploads/TeamLogo/'.$targetPath));
        }else {
            echo json_encode(array('ResponseCode' => 0, 'Message' => 'Failed ! Please try again'));
        }
    }
}


function compress($source, $destination, $quality) {
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg'){
            $image = imagecreatefromjpeg($source);
        }
//        else if ($info['mime'] == 'image/gif'){
//            $image = imagecreatefromgif($source);
//        }
        else if ($info['mime'] == 'image/png'){
            $image = imagecreatefrompng($source);
        }
        imagejpeg($image, $destination, $quality);
        return $destination;
}
?>