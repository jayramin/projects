<?php
//$ClassList = $fn->get_all_class();
//print_r($ClassList);

?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h2>User Management</h2>
                <ol class="breadcrumb">
                    <li><a href="home">Dashboard</a></li>
                    <li><a href="user-management">User Management</a></li>
                   <li class="active"><?php echo ($_REQUEST['method']=='edit')?'Edit Users':'View All User'; ?></li>
                </ol>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>User Management</h1>
        </div>
        <div class='panel-body'>
             
        </div>
    </div>
</div>