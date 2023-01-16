<?php
if (isset($_POST['create'])) {
    $pop = array_pop($_POST);
    extract($_POST);
//get menu lavel

    $menu_level_query = $db->selectdata(TBL_MENUS, "menu_type = '" . $menu_type . "' AND menu_level = '" . $menu_level . "' AND menu_parent_id = '" . $menu_parent . "' ORDER BY menu_id DESC LIMIT 1", "");
    $menu_level_order = mysql_fetch_object($menu_level_query);
    $uncommon_fields = array(
        "menu_order" => ($menu_level_order->menu_order + 1),
        "menu_name" => $menu_name,
        "menu_description" => $menu_description,
        "menu_url" => $menu_url,
        "menu_alias" => $menu_alias,
        "menu_type" => $menu_type,
        "menu_level" => $menu_level,
        "menu_parent_id" => $menu_parent,
        "menu_status" => '1',
        "created_by" => $_SESSION['user_data']->user_id,
        "modified_by" => $_SESSION['user_data']->user_id,
        "created_date" => date('Y-m-d'),
        "modified_date" => date('Y-m-d')
    );

    $create_menu = array_merge($uncommon_fields, $_POST);

    $query = $db->InsertData($uncommon_fields, TBL_MENUS, "");
    $last_menu_id = mysql_insert_id();

    $sadmin_menu_id_query = $db->selectdata(TBL_MENU_ACCESS, 'menu_access_role_id = "1"');
    $sadmin_menu_id = mysql_fetch_object($sadmin_menu_id_query);

    $new_sadmin_menu_id = $sadmin_menu_id->menu_access_menu_ids . "," . $last_menu_id;
    $data_menu = array("menu_access_menu_ids" => $new_sadmin_menu_id);
    $cond_menu = array("menu_access_role_id" => '1');
    $db->update(TBL_MENU_ACCESS, $cond_menu, $data_menu, "");

    header("Location: main_menu");
}

$main_menu_query = $db->selectdata(TBL_MENUS, "menu_id = '" . @$_REQUEST['id'] . "'");
$main_menu = mysql_fetch_assoc($main_menu_query);
?>
<section class="container">
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="menu_name">Menu Name</label>
                <input type="text" name="menu_name" id="menu_name" class="form-control input-sm" placeholder="Menu Name" value="<?php echo $main_menu['menu_name']; ?>" required>
            </div>
        </div>
        <!--/span-->
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="menu_description">Menu Description</label>
                <input type="text" name="menu_description" id="menu_description" class="form-control input-sm" value="<?php echo $main_menu['menu_description']; ?>" placeholder="Menu Description">
            </div>
        </div>
        <!--/span-->
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="menu_url">Menu Url</label>
                <input type="text" name="menu_url" id="menu_url" class="form-control input-sm" placeholder="Menu Url" value="<?php echo $main_menu['menu_url']; ?>" required>
            </div>
        </div>
        <!--/span-->
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="menu_alias">Menu Alias</label>
                <input type="text" name="menu_alias" id="menu_alias" class="form-control input-sm" value="<?php echo $main_menu['menu_alias']; ?>" placeholder="Menu Alias" required>
            </div>
        </div>
        <!--/span-->
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="menu_type">Menu Type</label>
                <?php
                $db_array = array('tbl_name' => TBL_MENUS, 'condition' => 'menu_status = "1" GROUP BY menu_type');
                $select_array = array('name' => 'menu_type', 'id' => 'menu_type', 'class' => 'form-control input-sm', 'required' => '');
                $option_array = array('value' => 'menu_type', 'label' => 'menu_type', 'placeholder' => $lang->lang['select_menu_type'], 'selected' => $main_menu['menu_type']);
                $db->dropdown($db_array, $select_array, $option_array);
                ?>
            </div>
        </div>
        <!--/span-->
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="menu_level">Menu Level</label>
                <?php
                $db_array = array('tbl_name' => TBL_MENUS, 'condition' => 'menu_status = "1" GROUP BY menu_level');
                $select_array = array('name' => 'menu_level', 'id' => 'menu_level', 'class' => 'form-control input-sm', 'required' => '');
                $option_array = array('value' => 'menu_level', 'label' => 'menu_level', 'placeholder' => $lang->lang['select_menu_level'], 'selected' => $main_menu['menu_level']);
                $db->dropdown($db_array, $select_array, $option_array);
                ?>
            </div>
        </div>
        <!--/span-->
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="menu_parent">Menu Parent ID</label>
                <?php
                $db_array = array('tbl_name' => TBL_MENUS, 'condition' => 'menu_level="1" AND menu_status="1"');
                $select_array = array('name' => 'menu_parent', 'id' => 'menu_parent', 'class' => 'form-control input-sm');
                $option_array = array('value' => 'menu_id', 'label' => 'menu_name', 'placeholder' => $lang->lang['select_parent'], 'selected' => $main_menu['menu_parent_id']);
                $db->dropdown($db_array, $select_array, $option_array);
                ?>
            </div>
        </div>
        <!--/span-->
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="menu_icon_class">Menu Icon Class</label>
                <input type="text" name="menu_icon_class" id="menu_icon_class" class="form-control input-sm" value="<?php echo $main_menu['menu_icon_class']; ?>" placeholder="Menu Icon Class">
            </div>
        </div>
    </div>
    <div class="row col-lg-12">
        <input type="submit" name="create" id="create" value="<?php echo $lang->lang['create_menu']; ?>" class="btn btn-primary btn-sm" >
    </div>
</form>
</section>