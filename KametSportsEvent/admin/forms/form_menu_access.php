<section class="panel-body">
    <?php
//When submit button is clicked
    if (isset($_POST['update_menu_access'])) {
        //print_r($_REQUEST);
        //to store the requested menu ids as comma-seperator in database table
        $menu_access_menu_ids = implode(",", $_REQUEST['menu_access_menu_ids']);
        //$dashboard_access_ids = implode(",", $_REQUEST['dashboard_access']);
        //check menu role_id exits
        $check_role_id = $db->selectdata(TBL_MENU_ACCESS, "menu_access_role_id = '" . $_REQUEST['UserType'] . "'");
        $check_role_id_row = mysql_num_rows($check_role_id);
        if ($check_role_id_row != 0) {
            $update_condition = array('menu_access_role_id' => $_REQUEST['UserType']);
            $update_data = array("menu_access_menu_ids" => $menu_access_menu_ids);
            $db->update(TBL_MENU_ACCESS, $update_condition, $update_data, '');
		} else {
            //This is table columns in database
            $uncommon_fields = array("menu_access_status" => "1",
                "menu_access_created_by" => "" . $_SESSION['user_data']->user_id . "",
                "menu_access_modified_by" => "" . $_SESSION['user_data']->user_id . "",
                "menu_access_created_date" => date('Y-m-d'),
                "menu_access_modified_date" => date('Y-m-d'),
                "menu_access_menu_ids" => $menu_access_menu_ids,
                // "dashboard_access_ids"      => $dashboard_access_ids,
                "menu_access_role_id" => $_REQUEST['UserType']);
            $db->InsertData($uncommon_fields, TBL_MENU_ACCESS, '');
        }
        echo '<script>window.location = "menu_rights"</script>';
        // header("Location: menus");
    }
    ?>
    <!-- Content Start -->
    <div class="panel-body">
        <!-- Content Start -->
        <form action="" method="post" enctype="multipart/form-data" id="menu_form">
            <!-- Select box for selection of user type group -->
            <div class="form-group">
                <label class="control-label" for="title"><?php echo $lang->lang['user_role'] ?></label>
                <div class="controls">
                    <div class="row">
                        <div class="col-lg-4">
                            <?php
                            //to assign menus to a particular user type
                            $db_array = array('tbl_name' => TBL_USER_TYPES);
                            $select_array = array('name' => 'UserType', 'id' => TBL_USER_TYPES, 'class' => 'selectbox form-control required', "readonly" => '1');
                            $option_array = array('value' => 'UserType', 'label' => 'TypeLabel', 'placeholder' => 'No Preference', 'selected' => @$_REQUEST['UserType']);
                            $db->dropdown($db_array, $select_array, $option_array);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group" id="menu_access">
<!--                <label class="control-label"><?php echo $lang->lang['menu'] ?></label>-->
                <div class="">
                    <!-- to check all the menu checkboxes -->
                    <a onclick="checkAll('#menu_access');" href="#">Check All</a>
                    <span>&nbsp;/&nbsp;</span>
                    <!-- to uncheck all the menu checkboxes -->
                    <a onclick="uncheckAll('#menu_access');" href="#">Uncheck All</a>
                    <br>
                </div>
                <?php
                $user_id = isset($_REQUEST['UserType']) ? $_REQUEST['UserType'] : '0';
                echo $menu->menus('1', '0', $user_id);
                ?>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <input type="submit" value="Submit" name="update_menu_access" id="update_menu_access" class="btn btn-primary btn-sm" onclick="menu_access(this.form)" />
                        <a class="btn btn-primary btn-sm" href="menu_rights"><?php echo $lang->lang['cancel']; ?></a>
                    </div>
					</div>
            </div>
        </form>
    </div>
</section>