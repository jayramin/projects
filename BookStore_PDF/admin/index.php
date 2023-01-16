<?php
require_once 'include/AdminHeader.php';
require_once 'include/AdminSideMenu.php';

$PageName=isset($_REQUEST['page'])?$_REQUEST['page']:'home';
$MenuList = $fn->get_menu_file($PageName, $_SESSION['BookStore']['session']['RoleID']);
if (isset($PageName)) {
    if (file_exists($MenuList)) {
        require_once $MenuList;
    } else {
        require_once '404.php';
    }
} else {
    echo "<script>window.location='home';</script>";
}
require_once 'include/AdminFooter.php';
?>