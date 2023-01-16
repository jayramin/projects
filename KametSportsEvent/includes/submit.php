<?php

// Error reporting:
//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);
session_start();
//include "../includes/connect.php";
//include "../config/constants.php";
//include "../class/comment.class.php";


$arr = array();
//$validates = Comment::validate($arr);
$validates = true;
if ($validates) {
    /* Everything is OK, insert to database: */
    mysql_query("INSERT INTO `pshh_comments` (CommentFor,Level,ParentID,MediaID,UserID,UserType,UserName,UserEmailID,IPAddress,CommentBody,is_active,EntryByUser,EntryDate,EntryTime) VALUES (
						'" . $_REQUEST['CommentFor'] . "',
                                                '" . $_REQUEST['Level'] . "',
                                                '" . $_REQUEST['ParentID'] . "',
                                                '" . $_REQUEST['MediaID'] . "',
                                                '" . $_SESSION['PSHH']['user_data']->user_id . "',
                                                '" . $_SESSION['PSHH']['user_data']->UserType . "',
                                                '" . $_SESSION['PSHH']['user_data']->username . "',
                                                '" . $_SESSION['PSHH']['user_data']->email . "',
                                                '" . IP_ADDRESS . "',
						'" . $_REQUEST['CommentBody'] . "',
						'1',
						'" . $_SESSION['PSHH']['user_data']->user_id . "',
                                                '" . date('Y-m-d') . "',
                                                '" . date('H:i:s') . "'
					)");

    $arr['EntryDate'] = date('Y-m-d');
    $arr['EntryTime'] = date('h:i A');
    $arr['CommentBody'] = $_REQUEST['CommentBody'];
    $arr['CommentID'] = mysql_insert_id();

    $arr = array_map('stripslashes', $arr);

    $insertedComment = new Comment($arr);

    /* Outputting the markup of the just-inserted comment: */

    echo json_encode(array('status' => 1, 'html' => $insertedComment->markup()));
} else {
    /* Outputtng the error messages */
    echo '{"status":0,"errors":' . json_encode($arr) . '}';
}
?>