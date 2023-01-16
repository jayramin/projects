<?php
session_start();
include 'model.php';
$db = new model();

if(isset($_REQUEST['SaveCart']) && $_REQUEST['SaveCart'] !='')
{
    unset($_REQUEST['SaveCart']);
    if(isset($_SESSION['Cart']['ProductID_'.$_REQUEST['ProductCode']]))
    {
        $_SESSION['Cart']['ProductID_'.$_REQUEST['ProductCode']]['Qty']+=1;
    }else{
        $_REQUEST['Qty'] = 1;
        $_SESSION['Cart']['ProductID_'.$_REQUEST['ProductCode']] = $_REQUEST;
    }
//    
//    echo "<pre>";
//    print_r($_SESSION['Cart']);
}


if(isset($_REQUEST['Delete']) && $_REQUEST['Delete'] !='')
{
    unset($_SESSION['Cart']['ProductID_'.$_REQUEST['Code']]);
}


?>