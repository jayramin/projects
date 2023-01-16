<?php

session_start();
error_reporting(0);
require_once ("../config/connection.php");
require_once("../config/constants.php");
require_once '../class/mysql.php';
require_once '../class/function.class.php';

$db = new DataTransaction();

$table_name = $_REQUEST['selected_value'];
$query = $db->query('SHOW columns FROM ' . $table_name . '');
$json = array();
if (mysql_num_rows($query)) {
    while ($row = mysql_fetch_assoc($query)) {
        $json[] = array(
            'label' => $row['Field'],
            'value' => $row['Field']
        );
    }
}
echo json_encode($json, TRUE);