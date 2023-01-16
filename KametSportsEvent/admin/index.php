<?php 
require_once './includes/header.php';
$PageName=isset($_REQUEST['page'])?$_REQUEST['page']:'home';

$UserType=isset($_SESSION[SESSION_ALIAS]['session']['RoleID'])?$_SESSION[SESSION_ALIAS]['session']['RoleID']:'1';

$MenuList = $fn->get_menu_file($PageName, $UserType);
if (isset($PageName)) {
    if (file_exists($MenuList)) {
        require_once $MenuList;
    } else {
        require_once '404.php';
    }
} else {
    echo "<script>window.location='home';</script>";
}
include './includes/footer.php';

