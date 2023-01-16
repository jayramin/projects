<?php
date_default_timezone_set("Asia/Calcutta");

class functions {

    public $db;

    function __construct($db = NULL) {
        $db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_db = $db;
        $this->_connection = $db;
    }

    public function Encrypt($Password) {
        $your_password = $Password;
        $key = 'password to (en/de)crypt';
        $PWD = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $your_password, MCRYPT_MODE_CBC, md5(md5($key))));
        return $PWD;
    }

    public function Decrypt($Password) {
        $your_password = $Password;
        $key = 'password to (en/de)crypt';
        $PWD = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($your_password), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $PWD;
    }

//start of function to get menu file
    public function get_menu_file($page, $role_id) {

        $PageQuery = "SELECT `MenuID`,`Name`,`MenuAlias`,`MenuURL` FROM `b_menus` WHERE `is_active`='Y' AND `MenuAlias` = '" . $page . "'";
        $stmt = $this->_db->prepare($PageQuery);
        $stmt->execute();
        //$total = $stmt->rowCount();
        $Data = $stmt->fetch(PDO::FETCH_ASSOC);
//        print_r($Data);
        $_SESSION[SESSION_ALIAS]['MenuID'] = $Data['MenuID'];
//        echo "<br>";
//        echo "<br>";
//        echo "<br>";
//        echo "<br>";
//        echo "SELECT `RoleID`,`MenuID`,`AccessID` FROM `b_menu_access` WHERE `is_active`='Y' AND `RoleID` = '" . $role_id . "' AND FIND_IN_SET('" . $Data['MenuID'] . "', MenuID)";
        $MenuAccessQuery = "SELECT `RoleID`,`MenuID`,`AccessID` FROM `b_menu_access` WHERE `is_active`='Y' AND `RoleID` = '" . $role_id . "' AND FIND_IN_SET('" . $Data['MenuID'] . "', MenuID)";
        $menu_access_query = $this->_db->prepare($MenuAccessQuery);
        $menu_access_query->execute();
        $total = $menu_access_query->rowCount();
        if ($total > 0) {
            return $Data['MenuURL'];
        } else {
            return false;
        }
    }

//end of function get menu file
//start of function to get menu access
    public function get_menu($level, $parent, $class, $id) {
        $UserRole = isset($_SESSION['BookStore']['session']['RoleID']) ? $_SESSION['BookStore']['session']['RoleID'] : '1';
//        echo $UserRole;
        $Condition = "VMA.RoleID = '" . $UserRole . "' AND VM.Level = '" . $level . "' AND VM.ParentID = '" . $parent . "' AND VM.is_active = 'Y' ORDER BY VM.OrderNo, VM.MenuID ASC";
        $MenuQuery = "SELECT `VM`.`MenuID`,`VM`.`Name`,`VMA`.`RoleID`,`VMA`.`AccessID`,`VM`.`Level`,`VM`.`MenuAlias`,`VM`.`IconClass` FROM `b_menu_access` AS VMA INNER JOIN `b_menus` AS VM ON FIND_IN_SET(VM.MenuID,VMA.MenuID) WHERE " . $Condition;
        $query2 = $this->_db->prepare($MenuQuery);
        $query2->execute();
        $row = $query2->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <ul class="<?php echo $class; ?>">
            <?php foreach ($row AS $Key => $Value) { ?>
                <?php
                $SubMenuQuery = "SELECT * FROM `b_menus` WHERE Level = '" . ($Value['Level'] + 1) . "' AND ParentID = '" . $Value['MenuID'] . "' AND is_active = 'Y'";
                $submenu_query = $this->_db->prepare($SubMenuQuery);
                $submenu_query->execute();
                $SubmenuRows = $submenu_query->rowCount();

                if ($SubmenuRows > 0) {
                    $Collapse = 'treeview';
                    $DownArrow = '<span class="fa fa-angle-right"></span>';
                } else {
                    $Collapse = '';
                    $DownArrow = '';
                }
                $PageNameWithoutExtension = explode('.', basename($_REQUEST['page']));
                if ($Value['MenuAlias'] == $PageNameWithoutExtension[0]) {
                    $ActiveClass = 'active';
                } else {
                    $ActiveClass = '';
                }
                ?>
                <li class="<?php echo $ActiveClass; ?> <?php echo $Collapse; ?>" title="<?php echo $Value['Name']; ?>">
                    <a href="<?php echo $Value['MenuAlias']; ?>" <?php $AreaExpanded; ?>><i class="<?php echo $Value['IconClass']; ?>"></i><?php echo $Value['Name']; ?><?php echo $DownArrow; ?></a>
                    <?php
                    if ($SubmenuRows > 0) {
                        $this->get_menu($Value['Level'] + 1, $Value['MenuID'], 'treeview-menu', 'treeview-menu');
                    }
                    ?>
                </li>                   
        <?php }
        ?>
        </ul>
        <?php
    }

//end of function get menu access
//Start of function get user types
    public function get_user_types() {
        $SliderStmt = $this->_db->prepare("SELECT * FROM `t4m_user_types` WHERE `is_active`!='D'");
        $SliderStmt->execute();
        return $SliderStmt->fetchAll(PDO::FETCH_ASSOC);
    }

//end of function get user types
//Start of fuction get all countries
    public function get_all_countries() {
        $CountryStmt = $this->_db->prepare("SELECT * FROM `v_country` WHERE `is_active`!='D'");
        $CountryStmt->execute();
        return $CountryStmt->fetchAll(PDO::FETCH_ASSOC);
    }

//end of function get all countries
//Start of function get all states
    public function get_all_states() {
        $StateStmt = $this->_db->prepare("SELECT v_country.CountryID,v_country.CountryName,v_state.StateID,v_state.is_active,v_state.StateName FROM `v_state` INNER JOIN `v_country` ON `v_state`.`CountryID`=`v_country`.`CountryID` WHERE `v_state`.`is_active`!='D'");
        $StateStmt->execute();
        return $StateStmt->fetchAll(PDO::FETCH_ASSOC);
    }

//end of function gat all states
//start of function get all cities by stateid
    public function get_all_cities($StateID) {
        if (isset($StateID) && $StateID > 0) {
            $Filter = " AND `v_state`.`StateID`='" . $StateID . "'";
        } else {
            $Filter = " AND `v_state`.`StateID`='1'";
        }
        $CityStmt = $this->_db->prepare("SELECT v_country.CountryID,v_country.CountryName,v_city.CityID,v_city.CityName,v_state.StateID,v_city.is_active,v_state.StateName FROM `v_city` INNER JOIN `v_country` ON `v_city`.`CountryID`=`v_country`.`CountryID` INNER JOIN `v_state` ON `v_city`.`StateID`=`v_state`.`StateID` WHERE `v_city`.`is_active`!='D' " . $Filter);
        $CityStmt->execute();
        return $CityStmt->fetchAll(PDO::FETCH_ASSOC);
    }

//end of function get all cities by state id
//start of function get all areas
    public function get_all_areas() {
        $AreaStmt = $this->_db->prepare("SELECT v_country.CountryID,v_country.CountryName,v_city.CityID,v_city.CityName,v_state.StateID,v_area.AreaName,v_area.AreaID,v_area.ZIPCode,v_area.is_active,v_state.StateName FROM `v_city` INNER JOIN `v_country` ON `v_city`.`CountryID`=`v_country`.`CountryID` INNER JOIN `v_state` ON `v_city`.`StateID`=`v_state`.`StateID` INNER JOIN `v_area` ON `v_city`.`CityID`=`v_area`.`CityID` WHERE v_area.is_active!='D'");
        //print_r($AreaStmt);
        $AreaStmt->execute();
        return $AreaStmt->fetchAll(PDO::FETCH_ASSOC);
    }

//end of function get all areas
    //start of function get all areas
    public function get_all_documents() {
        $docStmt = $this->_db->prepare("SELECT * FROM v_documents WHERE is_active!='D'");
        $docStmt->execute();
        return $docStmt->fetchAll(PDO::FETCH_ASSOC);
    }

//end of function get all areas
    //
    public function get_all_attacks() {
        $CountryStmt = $this->_db->prepare("SELECT * FROM `v_attacks` WHERE `is_active`!='D'");
        $CountryStmt->execute();
        return $CountryStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_all_formation() {
        $CountryStmt = $this->_db->prepare("SELECT * FROM `v_formation` WHERE `is_active`!='D'");
        $CountryStmt->execute();
        return $CountryStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_all_security_question() {
        $CountryStmt = $this->_db->prepare("SELECT * FROM `v_security_question` WHERE `is_active`!='D'");
        $CountryStmt->execute();
        return $CountryStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_all_tournament_type() {
        $CountryStmt = $this->_db->prepare("SELECT * FROM `v_tournament_type` WHERE `is_active`!='D'");
        $CountryStmt->execute();
        return $CountryStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_all_levels() {
        $CountryStmt = $this->_db->prepare("SELECT * FROM `v_levels` WHERE `is_active`!='D'");
        $CountryStmt->execute();
        return $CountryStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_all_slider() {
        $sliderStmt = $this->_db->prepare("SELECT * FROM `v_sliders` WHERE `is_active`!='D'");
        $sliderStmt->execute();
        return $sliderStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_all_active_sliders() {
        $SliderStmt = $this->_db->prepare("SELECT * FROM `t4m_sliders` WHERE `is_active`='Y' OR `is_active`='N'");
        $SliderStmt->execute();
        return $SliderStmt->fetchAll(PDO::FETCH_ASSOC);
    }

//end of function get all sliders
//start of dropdown function for all dropdown    
    public function dropdown($db_array, $select_array, $option_array) {
        $query = "SELECT * FROM " . $db_array['tbl_name'];

        if (array_key_exists('innerjoin', $db_array)) {
            $query .= " " . $db_array['innerjoin'];
        }
        if (array_key_exists('condition', $db_array)) {
            $query .= " WHERE " . $db_array['condition'];
        }

        if (array_key_exists('order_by', $db_array)) {
            $query .= " ORDER BY " . $db_array['order_by'];
        }
        //echo $query;
        $DDStmt = $this->_db->prepare($query);
        $DDStmt->execute();
        ?>
        <select
        <?php
        foreach ($select_array as $select_key => $select_value) {
            if ($select_key == 'multiple') {
                if ($select_value == '1') {
                    echo 'multiple';
                } else {
                    echo '';
                }
            } else {
                echo $select_key . "='" . $select_value . "' ";
            }
        }
        ?>>
            <?php if (array_key_exists('placeholder', $option_array)) { ?>
                <option value=""><?php echo $option_array['placeholder']; ?></option>
            <?php } ?>
            <?php
            //  while ($dropdown = mysql_fetch_object($result)) {
            while ($dropdown = $DDStmt->fetch()) {
                //print_r($dropdown);
                $opt = explode(',', $option_array['label']);
                ?>
                <option value="<?php echo $dropdown[$option_array['value']]; ?>"
                <?php
                if ($select_array['multiple'] == '1') {
                    $selected_vals = explode(',', $option_array['selected']);
                    for ($s = 0; $s < sizeof($selected_vals); $s++) {
                        if ($dropdown[$option_array['value']] == $selected_vals[$s]) {
                            echo 'selected="selected"';
                        }
                    }
                } else {
                    $selected_vals = $option_array['selected'];
                    if ($dropdown[$option_array['value']] == $selected_vals) {
                        echo 'selected="selected"';
                    }
                }
                if ($option_array['disabled'] == 'disabled') {
                    ?> disabled <?php } ?>>
                            <?php
                            for ($i = 0; $i < sizeof($opt); $i++) {
                                echo $dropdown[$opt[$i]] . "&nbsp;";
                            }
                            ?>
                </option>
                <?php
            }
            ?>
        </select>
        <?php
    }

//end of dropdown function
    public function get_profile_data($UserID, $Table) {
        //echo "SELECT * FROM `" . $Table . "` WHERE `is_active`='Y' AND `UserID` = '" . $UserID . "'";
        $UserStmt = $this->_db->prepare("SELECT * FROM `" . $Table . "` WHERE `is_active`='Y' AND `UserID` = '" . $UserID . "'");
        $UserStmt->execute();
        return $UserStmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Country($CID) {
        $stmt = $this->_db->prepare("SELECT `CountryName` FROM `v_country` WHERE `CountryID`=:CountryID");
        $stmt->execute(array(":CountryID" => $CID));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function State($CID) {
        $stmt = $this->_db->prepare("SELECT `StateName` FROM `v_state` WHERE `StateID`=:StateID");
        $stmt->execute(array(":StateID" => $CID));
        //print_r($stmt);
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function City($CID) {
        $stmt = $this->_db->prepare("SELECT `CityName` FROM `v_city` WHERE `CityID`=:CityID");
        $stmt->execute(array(":CityID" => $CID));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function getID($id) {
        $stmt = $this->_db->prepare("SELECT * FROM `v_state` WHERE `StateID`=:StateID");
        $stmt->execute(array(":StateID" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

//start of function get data by ID
    public function getDataByID($table, $Key, $value) {
        $stmt = $this->_db->prepare("SELECT * FROM `" . $table . "` WHERE `" . $Key . "`='" . $value . "'");
        $stmt->execute();
        //print_r($stmt);
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

//end of function get data by ID

    public function GetCountriesData($Flag = "") {
        $mysql = new DataTransaction($this->_db);

        $json = json_decode($Flag, true);
        $Condition = ($json['Flag'] == 'All') ? "is_active != 'D'" : "is_active ='Y'";

        $CountryData = $this->_db->prepare('SELECT CountryID,CountryName,is_active FROM v_country WHERE ' . $Condition);
        $CountryData->execute();
        $CountryWiseData = $CountryData->fetchAll(PDO::FETCH_ASSOC);
        if (is_array($CountryWiseData)) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCountryWiseData'] = $CountryWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllStateData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $StateData = $this->_db->prepare("SELECT State.StateID,State.CountryID,State.StateName,State.is_active FROM b_state AS State WHERE State.is_active != 'D'");
        $StateData->execute();
        $StateWiseData = $StateData->fetchAll(PDO::FETCH_ASSOC);
        if ($StateWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetStateWiseData'] = $StateWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllCitiesData($Condition = "") {

        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $CityData = $this->_db->prepare("SELECT City.CityID,City.CityName,State.StateName,City.is_active FROM b_city AS City INNER JOIN b_state AS State ON State.StateID = City.StateID WHERE City.StateID = '" . $json['StateID'] . "' AND City.is_active != 'D' GROUP BY City.CityName");

        $CityData->execute();
        $CityWiseData = $CityData->fetchAll(PDO::FETCH_ASSOC);
        if ($CityWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCityWiseData'] = $CityWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllAreasData($Condition = "") {

        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $AreaData = $this->_db->prepare("SELECT * FROM b_area WHERE CityID = '" . $json['CityID'] . "' AND is_active != 'D'");
        $AreaData->execute();
        $AreaWiseData = $AreaData->fetchAll(PDO::FETCH_ASSOC);
        if ($AreaWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAreaWiseData'] = $AreaWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllCategoryData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $CategoryData = $this->_db->prepare("SELECT * FROM b_category WHERE is_active != 'D'");
        $CategoryData->execute();
        $CategoryWiseData = $CategoryData->fetchAll(PDO::FETCH_ASSOC);
        if ($CategoryWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCategoryWiseData'] = $CategoryWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetActiveCategoryData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $CategoryData = $this->_db->prepare("SELECT * FROM b_category WHERE is_active = 'Y'");
        $CategoryData->execute();
        $CategoryWiseData = $CategoryData->fetchAll(PDO::FETCH_ASSOC);
        if ($CategoryWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCategoryWiseData'] = $CategoryWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllBookData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
        if ($json != '' && $json['Flag'] == '') {
//            echo "SELECT Book.*,Stock.Quantity FROM b_bookmaster AS Book INNER JOIN b_stock_master AS Stock ON Book.BookID= Stock.BookID WHERE Book.is_active != 'D' AND Book.BookID='".$json['BookID']."'";
            $BookData = $this->_db->prepare("SELECT Book.*,Stock.Quantity,Stock.purchase_amount FROM b_bookmaster AS Book LEFT JOIN b_stock_master AS Stock ON Book.BookID= Stock.BookID WHERE Book.is_active != 'D' AND Book.BookID='" . $json['BookID'] . "' GROUP BY Book.BookID ");
            $BookData->execute();
            $BookWiseData = $BookData->fetch(PDO::FETCH_ASSOC);
        } elseif ($json['Flag'] == 'Index') {
//            echo "SELECT Book.*,Stock.Quantity FROM b_bookmaster AS Book INNER JOIN b_stock_master AS Stock ON Book.BookID= Stock.BookID WHERE Book.is_active != 'D' AND Book.BookID='".$json['BookID']."'";
            $BookData = $this->_db->prepare("SELECT Book.*,Stock.Quantity,Stock.purchase_amount FROM b_bookmaster AS Book LEFT JOIN b_stock_master AS Stock ON Book.BookID= Stock.BookID WHERE Book.is_active = 'Y' GROUP BY Book.BookID ");
            $BookData->execute();
            $BookWiseData = $BookData->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $BookData = $this->_db->prepare("SELECT Book.*,Stock.Quantity,Stock.purchase_amount FROM b_bookmaster AS Book LEFT JOIN b_stock_master AS Stock ON Book.BookID= Stock.BookID WHERE Book.is_active != 'D' GROUP BY Book.BookID ");
            $BookData->execute();
            $BookWiseData = $BookData->fetchAll(PDO::FETCH_ASSOC);
        }


        if ($BookWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetBookWiseData'] = $BookWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetCategoryWiseBookData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
        if ($json != '') {
            $BookData = $this->_db->prepare("SELECT Book.*,Stock.Quantity,Category.CategoryTitle FROM b_bookmaster AS Book INNER JOIN b_stock_master AS Stock ON Book.BookID= Stock.BookID INNER JOIN b_category AS Category ON Book.CategoryID = Category.CategoryID WHERE Book.is_active = 'Y' AND Category.CategoryTitle='" . $json['Category'] . "' GROUP BY Book.BookID");
            $BookData->execute();
            $BookWiseData = $BookData->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $BookData = $this->_db->prepare("SELECT Book.*,Stock.Quantity FROM b_bookmaster AS Book INNER JOIN b_stock_master AS Stock ON Book.BookID= Stock.BookID WHERE Book.is_active != 'D'");
            $BookData->execute();
            $BookWiseData = $BookData->fetchAll(PDO::FETCH_ASSOC);
        }


        if ($BookWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetBookWiseData'] = $BookWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllExpenseData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
        $ExpenseData = $this->_db->prepare("SELECT * FROM b_expense WHERE is_active != 'D'");
        $ExpenseData->execute();
        $ExpenseWiseData = $ExpenseData->fetchAll(PDO::FETCH_ASSOC);


        if ($ExpenseWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetExpenseData'] = $ExpenseWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllAgentsData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
        $AgentData = $this->_db->prepare("SELECT * FROM b_user WHERE is_active != 'D' AND RoleID=2");
        $AgentData->execute();
        $AgentWiseData = $AgentData->fetchAll(PDO::FETCH_ASSOC);


        if ($AgentWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAgentData'] = $AgentWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllGeneralUserData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
        $GeneralData = $this->_db->prepare("SELECT * FROM b_user WHERE is_active != 'D' AND RoleID=5");
        $GeneralData->execute();
        $GeneralWiseData = $GeneralData->fetchAll(PDO::FETCH_ASSOC);


        if ($GeneralWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGeneralUserData'] = $GeneralWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllRetailersData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
        $RetailersData = $this->_db->prepare("SELECT * FROM b_user WHERE is_active != 'D' AND RoleID=3");
        $RetailersData->execute();
        $RetailersWiseData = $RetailersData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersData'] = $RetailersWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllCreditNotesData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $RetailersData = $this->_db->prepare("SELECT Notes.*,User.* FROM b_credit_notes AS Notes INNER JOIN b_user AS User ON User.UserID = Notes.UserID WHERE Notes.is_active != 'D'");
        $RetailersData->execute();
        $RetailersWiseData = $RetailersData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersData'] = $RetailersWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UserTypeWiseRecord($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        if ($_REQUEST['RoleID'] == 2) {
            $InnerTable = "b_agent_book_stock_master";
            $GrpKey = "AgentBookStockMasterID";
        } elseif ($_REQUEST['RoleID'] == 3) {
            $InnerTable = "b_retailer_book_stock_master";
            $GrpKey = "RetailerBookStockMasterID";
        } elseif ($_REQUEST['RoleID'] == 4) {
            $InnerTable = "b_client_book_stock_master";
            $GrpKey = "ClientBookStockMasterID";
        } elseif ($_REQUEST['RoleID'] == 5) {
            $InnerTable = "b_user_book_stock_master";
            $GrpKey = "UserBookStockMasterID";
        }
        if ($_REQUEST['todate']) {
            $FromDate = $_REQUEST['fromdate'] . " 00:00:00";
            $TODate = $_REQUEST['todate'] . " 00:00:00";

            $append = "AND $InnerTable.EntryDate BETWEEN '$FromDate' AND '$TODate'";
        } else {
            $append = " ";
        }
//        echo "SELECT User.*,$InnerTable.* FROM b_user AS User INNER JOIN  $InnerTable AS $InnerTable WHERE User.is_active != 'D' AND User.RoleID='".$_REQUEST['RoleID']."'  $append Group By $InnerTable.$GrpKey";
        $RetailersData = $this->_db->prepare("SELECT User.*,$InnerTable.* FROM b_user AS User INNER JOIN  $InnerTable AS $InnerTable WHERE User.is_active != 'D' AND User.RoleID='" . $_REQUEST['RoleID'] . "'  $append Group By $InnerTable.$GrpKey");
        $RetailersData->execute();
        $RetailersWiseData = $RetailersData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersData'] = $RetailersWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UserTypeWiseRecordForSMS($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
        if ($json['RoleID'] == 2) {
            $InnerTable = "b_agent_book_stock_master";
            $GrpKey = "AgentBookStockMasterID";
        } elseif ($json['RoleID'] == 3) {
            $InnerTable = "b_retailer_book_stock_master";
            $GrpKey = "RetailerBookStockMasterID";
        } elseif ($json['RoleID'] == 4) {
            $InnerTable = "b_client_book_stock_master";
            $GrpKey = "ClientBookStockMasterID";
        } elseif ($json['RoleID'] == 5) {
            $InnerTable = "b_user_book_stock_master";
            $GrpKey = "UserBookStockMasterID";
        }
//       echo "SELECT User.*,INNERTbl.* FROM b_user AS User INNER JOIN  $InnerTable AS INNERTbl WHERE User.is_active != 'D' AND User.RoleID='".$json['RoleID']."' Group By INNERTbl.$GrpKey";
        $RetailersData = $this->_db->prepare("SELECT * FROM b_user AS User WHERE User.is_active != 'D' AND User.RoleID='" . $json['RoleID'] . "' ");
        $RetailersData->execute();
        $RetailersWiseData = $RetailersData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersData'] = $RetailersWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function ReportFunction($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//            $RetailersData = $this->_db->prepare("SELECT User.*,Book.* FROM b_user AS User INNER JOIN b_bookmaster AS Book ON User.UserID = Book.UserID WHERE User.is_active != 'D' AND RoleID='".$_REQUEST['RoleID']."'");
        $Data = $this->_db->prepare("SELECT User.*,Book.* FROM b_user AS User INNER JOIN b_bookmaster AS Book ON User.UserID = Book.UserID WHERE User.is_active != 'D' AND RoleID='" . $_REQUEST['RoleID'] . "'");
        $RetailersData->execute();
        $RetailersWiseData = $RetailersData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersData'] = $RetailersWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetUserWiseCreditNotesData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
        $RetailersData = $this->_db->prepare("SELECT * FROM b_user WHERE is_active != 'D' AND RoleID=3");
        $RetailersData->execute();
        $RetailersWiseData = $RetailersData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersData'] = $RetailersWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllRetailersBalanceData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "SELECT RBalance.*,RTransaction.BalanceTransactionID,RTransaction.RetailerBalanceID ,RTransaction.RetailerID,RTransaction.Date,RTransaction.ChequeNo,RTransaction.CreditAmount,RTransaction.InvoiceDate,RTransaction.InvoiceNo,RTransaction.DebitAmount FROM b_retailer_balance AS RBalance LEFT JOIN b_retailer_balance_transaction AS RTransaction ON RBalance.RetailerBalanceID = RTransaction.RetailerBalanceID INNER JOIN b_user AS User ON RBalance.RetailerID = User.UserID WHERE RBalance.is_active != 'D' AND User.RoleID=3";
        $RetailersBalanceData = $this->_db->prepare("SELECT RBalance.*,RTransaction.BalanceTransactionID,RTransaction.RetailerBalanceID ,RTransaction.RetailerID,RTransaction.Date,RTransaction.ChequeNo,RTransaction.CreditAmount,RTransaction.InvoiceDate,RTransaction.InvoiceNo,RTransaction.DebitAmount FROM b_retailer_balance AS RBalance LEFT JOIN b_retailer_balance_transaction AS RTransaction ON RBalance.RetailerBalanceID = RTransaction.RetailerBalanceID INNER JOIN b_user AS User ON RBalance.RetailerID = User.UserID WHERE RBalance.is_active != 'D' AND User.RoleID=3");
        $RetailersBalanceData->execute();
        $RetailersBalanceWiseData = $RetailersBalanceData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersBalanceWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersBalanceData'] = $RetailersBalanceWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetRetailersBalanceData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        if (isset($json['flag']) && $json['flag'] == "RetailerWise") {
            $RetailersBalanceData = $this->_db->prepare("SELECT RetailersBalance.*,User.UserName FROM b_retailer_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3' AND RetailersBalance.RetailerID='" . $json['RetailerID'] . "' AND RetailersBalance.Flag<>'OpeningBalalnce ");
        } else {
//            echo"SELECT RetailersBalance.*,User.UserName FROM b_retailer_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3'";
            $RetailersBalanceData = $this->_db->prepare("SELECT RetailersBalance.*,User.UserName FROM b_retailer_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3'");
        }
        $RetailersBalanceData->execute();
        $RetailersBalanceWiseData = $RetailersBalanceData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersBalanceWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersBalanceData'] = $RetailersBalanceWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    
    public function GetRetailersOpBalanceData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//       echo "SELECT * FROM b_retailer_invoice_balance_rele as RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.Type='Opening Balance'";
        $RetailersBalanceData = $this->_db->prepare("SELECT * FROM b_retailer_invoice_balance_rele as RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.Type='Opening Balance'");
        
        $RetailersBalanceData->execute();
        $RetailersBalanceWiseData = $RetailersBalanceData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersBalanceWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersBalanceData'] = $RetailersBalanceWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    
    
    public function GetRetailersOpeningBalanceData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        if (isset($json['flag']) && $json['flag'] == "RetailerOpeningWise") {
            $RetailersBalanceData = $this->_db->prepare("SELECT RetailersBalance.*,User.UserName FROM b_retailer_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3' AND RetailersBalance.RetailerID='" . $json['RetailerID'] . "' AND RetailersBalance.Flag<>'OpeningBalalnce ");
        } else {
//            echo"SELECT RetailersBalance.*,User.UserName FROM b_retailer_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3'";
            $RetailersBalanceData = $this->_db->prepare("SELECT RetailersBalance.*,User.UserName FROM b_retailer_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3'");
        }
        $RetailersBalanceData->execute();
        $RetailersBalanceWiseData = $RetailersBalanceData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersBalanceWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersBalanceData'] = $RetailersBalanceWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetGeneralUserBalanceData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        if (isset($json['flag']) && $json['flag'] == "GeneralUserWise") {
//            echo "SELECT RetailersBalance.*,User.UserName FROM b_retailer_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3' AND RetailersBalance.RetailerID='".$json['RetailerID']."' AND RetailersBalance.Flag<>'OpeningBalance'";
            $RetailersBalanceData = $this->_db->prepare("SELECT RetailersBalance.*,User.UserName FROM b_general_user_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.UserID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3' AND RetailersBalance.UserID='" . $json['UserID'] . "' AND RetailersBalance.Flag<>'OpeningBalalnce ");
        } else {
//            echo "SELECT RetailersBalance.*,User.UserName FROM b_general_user_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.UserID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='5'";
            $RetailersBalanceData = $this->_db->prepare("SELECT RetailersBalance.*,User.UserName FROM b_general_user_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.UserID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='5'");
        }
        $RetailersBalanceData->execute();
        $RetailersBalanceWiseData = $RetailersBalanceData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersBalanceWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersBalanceData'] = $RetailersBalanceWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetRetailersPaymentData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        if (isset($json['flag']) && $json['flag'] == "RetailerWise") {
//            echo "SELECT RetailersBalance.*,User.UserName FROM b_retailer_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3' AND RetailersBalance.RetailerID='".$json['RetailerID']."' AND RetailersBalance.Flag<>'OpeningBalance'";
            $RetailersBalanceData = $this->_db->prepare("SELECT RetailersBalance.*,User.UserName FROM b_retailer_payment AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3' AND RetailersBalance.RetailerID='" . $json['RetailerID'] . "' AND RetailersBalance.Flag<>'OpeningBalalnce ");
        } else {
//            echo"SELECT RetailersBalance.*,User.UserName FROM b_retailer_balance AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3'";
            $RetailersBalanceData = $this->_db->prepare("SELECT RetailersBalance.*,User.UserName FROM b_retailer_payment AS RetailersBalance INNER JOIN b_user AS User ON RetailersBalance.RetailerID = User.UserID WHERE RetailersBalance.is_active != 'D' AND User.RoleID='3'");
        }
        $RetailersBalanceData->execute();
        $RetailersBalanceWiseData = $RetailersBalanceData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailersBalanceWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailersBalanceData'] = $RetailersBalanceWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllRetailerOrderData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
         $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_retailer_book_stock_master AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.RetailerID ='" . $json['RetailerID'] . "'";
        $RetailerStockData = $this->_db->prepare($String);
        $RetailerStockData->execute();
        $RetailerStockWiseData = $RetailerStockData->fetchAll(PDO::FETCH_ASSOC);
        if ($RetailerStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerOrderStockData'] = $RetailerStockWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetRetailerWiseBookStock($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $OrderMaster = "SELECT * FROM b_retailer_book_stock_master WHERE is_active = 'Y' AND RetailerID ='" . $json['RetailerID'] . "' AND RetailerBookStockMasterID ='" . $json['RetailerBookStockMasterID'] . "'";
        $OrderMasterData = $this->_db->prepare($OrderMaster);
        $OrderMasterData->execute();
        $OrderMasterWiseData = $OrderMasterData->fetch(PDO::FETCH_ASSOC);

//        echo "<pre>";
//        print_r($OrderMasterWiseData['AgentBookStockID']);
//        exit;
        $DataValue = explode(',', $OrderMasterWiseData['RetailerBookStockID']);
        $size = sizeof($DataValue);
//       print_r($DataValue);
        if ($DataValue == '') {
            $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_retailer_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.RetailerID ='" . $json['RetailerID'] . "' AND BookStock.RetailerOrderStatus='P'";
            $RetailerStockData = $this->_db->prepare($String);
            $RetailerStockData->execute();
            $RetailerStockWiseData[] = $RetailerStockData->fetch(PDO::FETCH_ASSOC);
        } else {
            for ($DataValue = 1; $DataValue <= $size; $DataValue++) {
                $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_retailer_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.RetailerID ='" . $json['RetailerID'] . "' AND BookStock.RetailerBookStockID = '" . $DataValue . "'";
                $RetailerStockData = $this->_db->prepare($String);
                $RetailerStockData->execute();
                $RetailerStockWiseData[] = $RetailerStockData->fetch(PDO::FETCH_ASSOC);
            }
        }


        if ($RetailerStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerStockData'] = $RetailerStockWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetRetailerOrderPenddingData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);

        $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_retailer_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.RetailerID ='" . $json['RetailerID'] . "' AND BookStock.RetailerOrderStatus='P'";
        $RetailerStockData = $this->_db->prepare($String);
        $RetailerStockData->execute();
        $RetailerStockWiseData = $RetailerStockData->fetchAll(PDO::FETCH_ASSOC);
        if ($RetailerStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerStockData'] = $RetailerStockWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetUserOrderPenddingData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);

        $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_user_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.UserID ='" . $json['UserID'] . "' AND BookStock.UserOrderStatus='P'";
        $RetailerStockData = $this->_db->prepare($String);
        $RetailerStockData->execute();
        $RetailerStockWiseData = $RetailerStockData->fetchAll(PDO::FETCH_ASSOC);
        if ($RetailerStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerStockData'] = $RetailerStockWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetUserWiseBookStock($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $OrderMaster = "SELECT * FROM b_user_book_stock_master WHERE is_active = 'Y' AND UserID ='" . $json['UserID'] . "' AND UserBookStockMasterID ='" . $json['UserBookStockMasterID'] . "'";
        $OrderMasterData = $this->_db->prepare($OrderMaster);
        $OrderMasterData->execute();
        $OrderMasterWiseData = $OrderMasterData->fetch(PDO::FETCH_ASSOC);

//        echo "<pre>";
//        print_r($OrderMasterWiseData['AgentBookStockID']);
//        exit;
        $DataValue = explode(',', $OrderMasterWiseData['UserBookStockID']);
        $size = sizeof($DataValue);
//       print_r($DataValue);
        if ($DataValue == '') {
            $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_user_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.UserID ='" . $json['UserID'] . "' AND BookStock.RetailerOrderStatus='P'";
            $RetailerStockData = $this->_db->prepare($String);
            $RetailerStockData->execute();
            $RetailerStockWiseData[] = $RetailerStockData->fetch(PDO::FETCH_ASSOC);
        } else {
            for ($DataValue = 1; $DataValue <= $size; $DataValue++) {
                $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_user_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.UserID ='" . $json['UserID'] . "' AND BookStock.UserBookStockID = '" . $DataValue . "'";
                $RetailerStockData = $this->_db->prepare($String);
                $RetailerStockData->execute();
                $RetailerStockWiseData[] = $RetailerStockData->fetch(PDO::FETCH_ASSOC);
            }
        }


        if ($RetailerStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerStockData'] = $RetailerStockWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function TotalPurchasedData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);

        $String = "SELECT * FROM b_retailer_book_stock_master WHERE is_active = 'Y' AND RetailerID ='" . $json['RetailerID'] . "' ";
        $TotalPurchasedData = $this->_db->prepare($String);
        $TotalPurchasedData->execute();
        $TotalPurchasedWiseData = $TotalPurchasedData->fetchAll(PDO::FETCH_ASSOC);
        if ($TotalPurchasedWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTotalPurchasedData'] = $TotalPurchasedWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertRetailerBookStockData() {
        $mysql = new DataTransaction($this->_db);
//        echo date('Y-m-d h:i:sa');
        
        $Discount = ($_REQUEST['Discount']/100 ) * $_REQUEST['Amount'];
        $Discounted_prise = $_REQUEST['Amount'] - $Discount;
        $data = array("BookID" => $_REQUEST['BookID'], "RetailerID" => $_REQUEST['RetailerID'], "Quantity" => $_REQUEST['Quantity'], "Quantity" => $_REQUEST['Quantity'], "Amount" => $Discounted_prise,'Discount'=>$_REQUEST['Discount'], "CategoryID" => $_REQUEST['CategoryID'], "BookPrice" => $_REQUEST['BookPrice'], "is_active" => $_REQUEST['is_active'], "RetailerOrderStatus" => 'P', "EntryBy" => '1', 'EntryDate' => date('Y-m-d h:i:sa'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $BookQuantityData = $mysql->insert($data, 'b_retailer_book_stock');
        if ($BookQuantityData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerBookQuantityInsertData'] = $BookQuantityData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertUserBookStockData() {
        $mysql = new DataTransaction($this->_db);
//        echo "<pre>";
//        print_r($_REQUEST);
//        exit;
        if (isset($_REQUEST['UserID']) && $_REQUEST['UserID'] != "") {
            $UserID = $_REQUEST['UserID'];
        } else {
            $UserData = array("RoleID" => 5, "UserName" => $_REQUEST['UserName'], "MobileNumber" => $_REQUEST['MobileNumber'], "Email" => $_REQUEST['EmailID'], "is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d h:i:sa'));
            $BookUserData = $mysql->insert($UserData, 'b_user');
//        echo $BookUserData ;
//        exit;
            if ($BookUserData != '') {
                $UserAddressData = array("UserID" => $BookUserData, "AddressLine1" => $_REQUEST['AddressLine1'], "AddressLine2" => $_REQUEST['AddressLine2'], "Area" => $_REQUEST['AddressArea'], "MobileNumber" => $_REQUEST['MobileNumber'], "CityID" => $_REQUEST['CityID'], "Pincode" => $_REQUEST['AddressPincode'], "is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d h:i:sa'));
                $UserAddressData = $mysql->insert($UserAddressData, 'b_user_address');
//        echo $UserAddressData;
//        exit;
            }
            $UserID = $BookUserData;
        }
        $Discount = ($_REQUEST['Discount']/100 ) * $_REQUEST['Amount'];
        $Discounted_prise = $_REQUEST['Amount'] - $Discount;
        $data = array("BookID" => $_REQUEST['BookID'], "UserID" => $UserID, "Quantity" => $_REQUEST['Quantity'], "Quantity" => $_REQUEST['Quantity'], "discount"=>$_REQUEST['Discount'],"Amount" => $Discounted_prise, "CategoryID" => $_REQUEST['CategoryID'], "BookPrice" => $_REQUEST['BookPrice'], "is_active" => $_REQUEST['is_active'], "UserOrderStatus" => 'P', "EntryBy" => '1', 'EntryDate' => date('Y-m-d h:i:sa'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
//        echo "<pre>";
//        print_r($data);
//        exit;
            $BookUserSellData = $mysql->insert($data, 'b_user_book_stock');
//        echo $BookUserSellData;
//        exit;
        if ($BookUserSellData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetUserSellInsertData'] = $BookUserSellData;
            $this->return_data['UserID'] = $UserID;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetClientsData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
//        exit;
//        echo "SELECT * FROM b_agent_client WHERE is_active != 'D' AND AgentID='".$json['AgentID']."'";
        $ClientData = $this->_db->prepare("SELECT * FROM b_agent_client WHERE is_active != 'D' AND AgentID='" . $json['AgentID'] . "'");
        $ClientData->execute();
        $ClientWiseData = $ClientData->fetchAll(PDO::FETCH_ASSOC);


        if ($ClientWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetClientData'] = $ClientWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function SelectAddressData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
//        echo "SELECT Address.*,City.CityName FROM b_user_address AS Address INNER JOIN b_city AS City ON City.CityID = Address.CityID WHERE Address.is_active = 'Y' AND Address.UserID='".$json['UserID']."'";
        $AddressData = $this->_db->prepare("SELECT Address.*,City.CityName FROM b_user_address AS Address INNER JOIN b_city AS City ON City.CityID = Address.CityID WHERE Address.is_active = 'Y' AND Address.UserID='" . $json['UserID'] . "'");
        $AddressData->execute();
        $AddressWiseData = $AddressData->fetch(PDO::FETCH_ASSOC);
        if ($AddressWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAddressWiseData'] = $AddressWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetGeneralUserData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
        $AddressData = $this->_db->prepare("SELECT Address.*,City.CityName,User.UserName,User.Email FROM b_user_address AS Address INNER JOIN b_city AS City ON City.CityID = Address.CityID INNER JOIN b_user AS User ON User.UserID = Address.UserID WHERE Address.is_active = 'Y' AND Address.UserID='" . $_REQUEST['UserID'] . "'");
        $AddressData->execute();
        $AddressWiseData = $AddressData->fetch(PDO::FETCH_ASSOC);
        if ($AddressWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAddressWiseData'] = $AddressWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function AgentClient($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<br>";
//        echo "<br>";
//        echo "<br>";
//        echo "SELECT AgentClient.*,CBSM.TotalBookQuantity,CBSM.PayableAmount,Book.BookTitle FROM b_agent_client AS AgentClient INNER JOIN b_client_book_stock_master AS CBSM ON AgentClient.ClientID = CBSM.ClientID INNER JOIN b_bookmaster AS Book ON Book.BookID = CBSM.BookID WHERE AgentClient.is_active = 'Y' AND AgentClient.AgentID='".$json['AgentID']."'";
        $AgentClientData = $this->_db->prepare("SELECT AgentClient.*,CBSM.TotalBookQuantity,CBSM.PayableAmount,Book.BookTitle FROM b_agent_client AS AgentClient INNER JOIN b_client_book_stock_master AS CBSM ON AgentClient.ClientID = CBSM.ClientID INNER JOIN b_bookmaster AS Book ON Book.BookID = CBSM.BookID WHERE AgentClient.is_active = 'Y' AND AgentClient.AgentID='" . $json['AgentID'] . "'");
        $AgentClientData->execute();
        $AddressWiseData = $AgentClientData->fetchAll(PDO::FETCH_ASSOC);
//        echo "<pre>";
//        print_r($AddressWiseData);
        if ($AddressWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetClientAddressWiseData'] = $AddressWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function SelectAllUserData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $UserData = $this->_db->prepare("SELECT User.*,Address.* FROM b_user AS User LEFT JOIN b_user_address AS Address ON Address.UserID = User.UserID WHERE User.is_active != 'D' AND User.RoleID != 1");
        $UserData->execute();
        $UserWiseData = $UserData->fetchAll(PDO::FETCH_ASSOC);
        if ($UserWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetUserWiseData'] = $UserWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function SelectAllPlacedOrdersData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        if ($json['UserID'] != '') {
            $PlacedOrderData = $this->_db->prepare("SELECT OrderMaster.*,User.*,Address.* FROM b_order_master AS OrderMaster INNER JOIN b_user AS User ON OrderMaster.UserID = User.UserID INNER JOIN b_user_address AS Address ON OrderMaster.UserID = Address.UserID WHERE OrderMaster.is_active !='D' AND OrderMaster.UserID ='" . $json['UserID'] . "'");
            $PlacedOrderData->execute();
            $PlacedOrderWiseData = $PlacedOrderData->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $PlacedOrderData = $this->_db->prepare("SELECT OrderMaster.*,User.*,Address.* FROM b_order_master AS OrderMaster INNER JOIN b_user AS User ON OrderMaster.UserID = User.UserID INNER JOIN b_user_address AS Address ON OrderMaster.UserID = Address.UserID WHERE OrderMaster.is_active !='D' ");
            $PlacedOrderData->execute();
            $PlacedOrderWiseData = $PlacedOrderData->fetchAll(PDO::FETCH_ASSOC);
        }

        if ($PlacedOrderWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPlacedOrderWiseData'] = $PlacedOrderWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function SelectAllRetailerPlacedOrdersData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        if ($json['UserID'] != '') {
            $PlacedOrderData = $this->_db->prepare("SELECT OrderMaster.*,User.*,Address.* FROM b_retailer_book_stock_master AS OrderMaster INNER JOIN b_user AS User ON OrderMaster.RetailerID = User.UserID INNER JOIN b_user_address AS Address ON OrderMaster.RetailerID = Address.UserID WHERE OrderMaster.is_active !='D' AND OrderMaster.RetailerID ='" . $json['RetailerID'] . "'");
            $PlacedOrderData->execute();
            $PlacedOrderWiseData = $PlacedOrderData->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $PlacedOrderData = $this->_db->prepare("SELECT OrderMaster.*,User.*,Address.* FROM b_retailer_book_stock_master AS OrderMaster INNER JOIN b_user AS User ON OrderMaster.RetailerID = User.UserID INNER JOIN b_user_address AS Address ON OrderMaster.RetailerID = Address.UserID WHERE OrderMaster.is_active !='D' ");
            $PlacedOrderData->execute();
            $PlacedOrderWiseData = $PlacedOrderData->fetchAll(PDO::FETCH_ASSOC);
        }

        if ($PlacedOrderWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPlacedOrderWiseData'] = $PlacedOrderWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetQuantityDataByQuantityID($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "SELECT Stock.*,Book.* FROM b_stock_master AS Stock INNER JOIN b_bookmaster AS Book ON Stock.BookID = Book.BookID WHERE Stock.StockID = '".$json['StockID']."'";
        $QuantityData = $this->_db->prepare("SELECT Stock.*,Book.* FROM b_stock_master AS Stock INNER JOIN b_bookmaster AS Book ON Stock.BookID = Book.BookID WHERE Stock.BookID = '" . $json['BookID'] . "'");
        $QuantityData->execute();
        $QuantityWiseData = $QuantityData->fetch(PDO::FETCH_ASSOC);
        if ($QuantityWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetQuantityWiseData'] = $QuantityWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetBookQuantityData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "SELECT (Stock.Quantity - OrderMaster.Quantity)AS DisplayQuantity,Stock.Quantity FROM  b_stock_master AS Stock LEFT JOIN b_order_details AS OrderMaster ON OrderMaster.BookID = Stock.BookID WHERE Stock.BookID = '".$json['BookID']."'";
        $BookQuantityData = $this->_db->prepare("SELECT (Stock.Quantity - OrderMaster.Quantity)AS DisplayQuantity,Stock.Quantity FROM  b_stock_master AS Stock LEFT JOIN b_order_details AS OrderMaster ON OrderMaster.BookID = Stock.BookID WHERE Stock.BookID = '" . $json['BookID'] . "'");
        $BookQuantityData->execute();
        $BookQuantityWiseData = $BookQuantityData->fetch(PDO::FETCH_ASSOC);
        if ($BookQuantityWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetBookQuantityWiseData'] = $BookQuantityWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function AddToCart($Condition = "") {

        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json['Quantity']);
        $CartTableData = $this->_db->prepare("SELECT * FROM b_cart WHERE BookID = '" . $json['BookID'] . "' AND UserID =  '" . $json['UserID'] . "' AND is_active = 'Y' AND OrderStatus = 'P'");
        $CartTableData->execute();
        $CartTableWiseData = $CartTableData->fetch(PDO::FETCH_ASSOC);
        if ($CartTableWiseData != '') {
//            echo "<pre>";
//            print_r($CartTableWiseData);
            $UpdateCartData = $mysql->update('b_cart', array("Quantity" => $json['Quantity'] + $CartTableWiseData['Quantity']), array("CartID" => $CartTableWiseData['CartID'], "is_active" => 'Y'));
        } else {
            $data = array("BookID" => $json['BookID'], "UserID" => $json['UserID'], "Quantity" => $json['Quantity'], "Date" => date('Y-m-d'), "is_active" => 'Y', "OrderStatus" => 'P', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
            $CartData = $mysql->insert($data, 'b_cart');
        }
        if ($CartData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCartWiseData'] = $CartData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function PlaceOrder($Condition = "") {

        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $UserAddressQuery = $this->_db->prepare("SELECT * FROM b_user_address WHERE UserID =  '" . $_REQUEST['UserID'] . "' AND is_active = 'Y'");
        $UserAddressQuery->execute();
        $UserAddressData = $UserAddressQuery->fetch(PDO::FETCH_ASSOC);
        $count = $UserAddressQuery->rowCount();
        if ($count > 0) {
            $AddressData = $mysql->update('b_user_address', array("AddressLine1" => $_REQUEST['AddressLine1'], "AddressLine2" => $_REQUEST['AddressLine2'], "Area" => $_REQUEST['Area'], "CityID" => $_REQUEST['CityID'], "Pincode" => $_REQUEST['Pincode'], "MobileNumber" => $_REQUEST['MobileNumber'], "ModificationBy" => $_REQUEST['UserID'], 'ModificationDate' => date('Y-m-d')), array("UserID" => $_REQUEST['UserID'], "is_active" => 'Y'));
        } else {
            $data = array("UserID" => $_REQUEST['UserID'], "AddressLine1" => $_REQUEST['AddressLine1'], "AddressLine2" => $_REQUEST['AddressLine2'], "Area" => $_REQUEST['Area'], "CityID" => $_REQUEST['CityID'], "Pincode" => $_REQUEST['Pincode'], "MobileNumber" => $_REQUEST['MobileNumber'], "is_active" => 'Y', "EntryBy" => $_REQUEST['UserID'], 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
            $AddressData = $mysql->insert($data, 'b_user_address');
        }

        $CartQuery = $this->_db->prepare("SELECT * FROM b_cart WHERE UserID =  '" . $_REQUEST['UserID'] . "' AND OrderStatus = 'P'");
        $CartQuery->execute();
        $SelectedCartData = $CartQuery->fetchAll(PDO::FETCH_ASSOC);
//        echo "<pre>";
//        print_r($CartData);
//        exit;

        $OrderNumber = mt_rand(5, 100000);
        $OrderData = array("OrderNo" => $OrderNumber, "OrderDate" => date('Y-m-d'), "UserID" => $_REQUEST['UserID'], "OrderPrice" => $_REQUEST['Price'], "AddressID" => $AddressData, "OrderDeliveryStatus" => "P", "is_active" => 'Y', "EntryBy" => $_REQUEST['UserID'], 'EntryDate' => date('Y-m-d'));
        $CartData = $mysql->insert($OrderData, 'b_order_master');

        foreach ($SelectedCartData AS $Key => $Value) {
            $OrderData = array("OrderNo" => $OrderNumber, "BookID" => $Value['BookID'], "UserID" => $Value['UserID'], "OrderPrice" => $_REQUEST['Price'], "Quantity" => $Value['Quantity'], "Status" => $Value["OrderStatus"], "PurchaseDate" => date('Y-m-d'), "is_active" => 'Y', "EntryBy" => $_REQUEST['UserID'], 'EntryDate' => date('Y-m-d'));
            $OrderCartData = $mysql->insert($OrderData, 'b_order_details');
        }

        $StockTransactionData = array("UserID" => $_REQUEST['UserID'], "BookID" => $_REQUEST['BookID'], "Qauntity" => $_REQUEST['Qauntity'], "OrderDate" => date('Y-m-d'), "is_active" => 'Y', "EntryBy" => $_REQUEST['UserID'], 'EntryDate' => date('Y-m-d'), "ModificationBy" => $_REQUEST['UserID'], 'ModificationDate' => date('Y-m-d'));
        $StockTransactionFinalData = $mysql->insert($StockTransactionData, 'b_stock_transaction');

        $UpdateCartData = $mysql->update('b_cart', array("OrderStatus" => "S", "ModificationBy" => $_REQUEST['UserID'], 'ModificationDate' => date('Y-m-d')), array("UserID" => $_REQUEST['UserID'], "is_active" => 'Y', "OrderStatus" => "P"));
        if ($CartData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCartWiseData'] = $CartData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function AgentPlaceOrder() {
        $mysql = new DataTransaction($this->_db);
//        echo "<pre>";
//        print_r($_REQUEST);
//        exit;
        $UserAddressQuery = $this->_db->prepare("SELECT * FROM b_user_address WHERE UserID =  '" . $_REQUEST['AgentID'] . "' AND is_active = 'Y'");
        $UserAddressQuery->execute();
        $UserAddressData = $UserAddressQuery->fetch(PDO::FETCH_ASSOC);
        $count = $UserAddressQuery->rowCount();
        if ($count > 0) {
            $AgentAddressData = $mysql->update('b_user_address', array("AddressLine1" => $_REQUEST['AddressLine1'], "AddressLine2" => $_REQUEST['AddressLine2'], "Area" => $_REQUEST['Area'], "CityID" => $_REQUEST['CityID'], "Pincode" => $_REQUEST['Pincode'], "MobileNumber" => $_REQUEST['MobileNumber'], "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d')), array("UserID" => $_REQUEST['AgentID'], "is_active" => 'Y'));
        } else {
            $AgentAddressdata = array("UserID" => $_REQUEST['AgentID'], "AddressLine1" => $_REQUEST['AddressLine1'], "AddressLine2" => $_REQUEST['AddressLine2'], "Area" => $_REQUEST['Area'], "CityID" => $_REQUEST['CityID'], "Pincode" => $_REQUEST['Pincode'], "MobileNumber" => $_REQUEST['MobileNumber'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
            $AgentAddressData = $mysql->insert($AgentAddressdata, 'b_user_address');
        }
        if ($AgentAddressData) {
            $Stockdata = array("BookID" => $_REQUEST['BookID'], "AgentID" => $_REQUEST['AgentID'], "TotalBookQuantity" => $_REQUEST['TotalBookQuantity'], "PayableAmount" => $_REQUEST['PayableAmount'], "AgentBookStockID" => $_REQUEST['AgentBookStockID'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
            $AgentPlaceOrderData = $mysql->insert($Stockdata, 'b_agent_book_stock_master');

            $AgentAddressData = $mysql->update('b_agent_book_stock', array("AgentOrderStatus" => 'S', "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d')), array("AgentID" => $_REQUEST['AgentID'], "is_active" => 'Y', "AgentOrderStatus" => 'P'));

            if ($AgentPlaceOrderData) {
                $this->return_data['ResponseCode'] = 1;
                $this->return_data['GetInsertAgentPlaceOrderData'] = $AgentPlaceOrderData;
                $this->return_data['Message'] = 'Success';
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Please Provide Address Details';
        }

        return $this->return_data;
    }

    public function RemoveFromCart($Condition = "") {

        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//      echo "<pre>";
//      print_r($json);
//      exit;
//        $UpdateData = $mysql->update('b_cart', array("Quantity" => $json['Quantity'], "is_active" => 'N'), array("CartID" => $json['CartID'], "is_active" => 'Y', "BookID" => $json['BookID']));
        $UpdateData = $mysql->delete('b_cart', array("CartID" => $json['CartID'], "is_active" => 'Y', "BookID" => $json['BookID']));


//        $data = array("BookID" => $json['BookID'],"UserID" => $json['UserID'],"Quantity" => $json['Quantity'],"Date"=> date('Y-m-d'),"is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
//        $CartData = $mysql->insert($data, 'b_cart');

        if ($UpdateData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['UpdateCartData'] = $UpdateData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllUsersDataByRoleID($Condition = "") {

        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $UserData = $this->_db->prepare("SELECT UserID,UserName,CONCAT(FirstName,' ', LastName) AS FullName,is_active,AdminApproval  FROM v_users WHERE RoleID = '" . $_REQUEST['RoleID'] . "' ORDER BY AdminApproval");
        $UserData->execute();
        $UserWiseData = $UserData->fetchAll(PDO::FETCH_ASSOC);
//        print_r($UserWiseData);
        if ($UserWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetUserWiseData'] = $UserWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function DataByID($Condition = '') {

        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);

//        echo "SELECT * FROM `" . $json['Condition']['table'] . "` WHERE `" . $json['Condition']['Key'] . "`='" . $json['Condition']['value'] . "'";
        $Data = $this->_db->prepare("SELECT * FROM `" . $json['Condition']['table'] . "` WHERE `" . $json['Condition']['Key'] . "`='" . $json['Condition']['value'] . "'");
        $Data->execute();
        $DataRow = $Data->fetch(PDO::FETCH_ASSOC);
        if ($DataRow) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetData'] = $DataRow;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function ForgotPasswordTokenGenerate() {
        $mysql = new DataTransaction($this->_db);
        $start = date('Y-m-d H:i:s');
        $expires = date("Y-m-d H:i:s", strtotime("+24 hours"));

//        $json = json_decode($Condition, true);
        $TokenNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        if (isset($_REQUEST['EmailID']) && $_REQUEST['EmailID'] != '') {
//            echo $_REQUEST['EmailID'];
            $TokenData = $this->_db->prepare("SELECT UserID,UserName,CONCAT(FirstName,' ',LastName) AS UserFullName,EmailID,PasswordToken,PasswordTokenDateTimeEnd,is_active,EmailVerificationStatus,AdminApproval FROM v_users WHERE EmailID = '" . $_REQUEST['EmailID'] . "' AND is_active='Y'");
            $TokenData->execute();
            $TokenWiseUserData = $TokenData->fetch(PDO::FETCH_ASSOC);
            $num_rows = $TokenData->rowCount();
            if ($num_rows > 0) {
                $PasswordUpdateData = $mysql->update('v_users', array("PasswordToken" => $TokenNumber, "PasswordTokenDateTimeStart" => $start, "PasswordTokenDateTimeEnd" => $expires), array("UserID" => $TokenWiseUserData['UserID'], "is_active" => 'Y'));
                $body = '<html>';
                $body .= '<head>';
                $body .= MAIL_HEADER;
                $body .= '<body>';
                $body .= BODY_START;
                $body .= '<div>';
                $body .= '<label>Hello,' . $TokenWiseUserData['UserFullName'] . ' </label><br><br>';
                $body .= '<span>Your Token Number To Change Password is Given Below.</span><br><br>';
                $body .= $TokenNumber . '<br><br>';
                $body .= BODY_FOOTER;
                $body .= '</div>';
                $body .= '</body>';
                $body .= '</head>';
                $body .= MAIL_FOOTER;
                $mysql->send_email($TokenWiseUserData['EmailID'], '', $bcc, 'Token Number', nl2br($body), 'Please check your email.! ', $attachment);
                if ($TokenWiseUserData) {
                    $this->return_data['ResponseCode'] = 1;
                    //$this->return_data['tokenNumber'] = $TokenNumber;
                    $this->return_data['UserID'] = $TokenWiseUserData['UserID'];
                    $this->return_data['Message'] = 'OTP send to your email';
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'No Record Found';
                }
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found ';
//                $PasswordUpdateData = $mysql->update('v_users', array("PasswordToken" => $TokenNumber, "PasswordTokenDateTimeStart" => $start, "PasswordTokenDateTimeEnd" => $expires), array("UserID" => $TokenWiseUserData['UserID'], "is_active" => 'Y'));
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Email Id Required';
        }
        return $this->return_data;
    }

    public function ForgotPasswordChange() {

        $mysql = new DataTransaction($this->_db);
        $CurrentTime = date('Y-m-d H:i:s');
        if (isset($_REQUEST['Password']) && $_REQUEST['Password'] != '' && $_REQUEST['PasswordToken'] != '' && $_REQUEST['UserID'] != '') {
            $PasswordUserStatus = $mysql->selectdata('v_users', '', array("is_active" => "Y", "UserID" => $_REQUEST['UserID']));
            $num_rowsPassword = sizeof($PasswordUserStatus);
            if ($num_rowsPassword > 0) {
                if ($PasswordUserStatus[0]['PasswordToken'] != '') {
                    if ($PasswordUserStatus[0]['PasswordToken'] == $_REQUEST['PasswordToken']) {
                        $PasswordPattern = '/^(?=.*\d)(?=.*[a-z])[0-9A-Za-z@#\-_$%^&+=§!\?]{4,20}$/';
                        $Password = $_REQUEST['Password'];
                        if (preg_match($PasswordPattern, $Password)) {
                            if ($PasswordUserStatus[0]['PasswordTokenDateTimeEnd'] > $CurrentTime) {
                                $password = $this->Encrypt($_REQUEST['Password']);
                                $Password = $mysql->update('v_users', array("Password" => $password, "PasswordToken" => '', "PasswordTokenDateTimeStart" => '', "PasswordTokenDateTimeEnd" => ''), array("UserID" => $_REQUEST['UserID'], "is_active" => 'Y'));
                                $this->return_data['UserID'] = $PasswordUserStatus[0]['UserID'];
                                $this->return_data['ResponseCode'] = 1;
                                $this->return_data['Message'] = "Password Updated Successfully";
                            } else {
                                $this->return_data['ResponseCode'] = 0;
                                $this->return_data['Message'] = 'OTP Was Expired For This User';
                            }
                        } else {
                            $this->return_data['ResponseCode'] = 0;
                            $this->return_data['Message'] = 'Password Must Required 1 Charater 1 Number And Not Allow Space';
                        }
                    } else {
                        $this->return_data['ResponseCode'] = 0;
                        $this->return_data['Message'] = 'OTP Number Doesn\'t Match';
                    }
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'Token Not Generated';
                }
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'UserID,Password And Password Id Must Required';
        }
        return $this->return_data;
    }

    public function EmailChangeTokenGenerate() {

        $mysql = new DataTransaction($this->_db);
        $start = date('Y-m-d H:i:s');
        $expires = date("Y-m-d H:i:s", strtotime("+24 hours"));
//        $json = json_decode($Condition, true);
        $TokenNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        if (isset($_REQUEST['UserID']) && $_REQUEST['UserID'] != '') {
            $EmailTokenData = $this->_db->prepare("SELECT UserID,UserName,CONCAT(FirstName,' ',LastName) AS UserFullName,EmailID,EmailToken,EmailTokenDateTimeStart,EmailTokenDateTimeEnd FROM v_users WHERE UserID = '" . $_REQUEST['UserID'] . "' AND is_active='Y'");
            $EmailTokenData->execute();
            $EmailTokenWiseUserData = $EmailTokenData->fetch(PDO::FETCH_ASSOC);
            $num_rows = $EmailTokenData->rowCount();
            if ($num_rows > 0) {
                $EmailUpdateData = $mysql->update('v_users', array("EmailToken" => $TokenNumber, "EmailTokenDateTimeStart" => $start, "EmailTokenDateTimeEnd" => $expires), array("UserID" => $EmailTokenWiseUserData['UserID'], "is_active" => 'Y'));
                $body = '<html>';
                $body .= '<head>';
                $body .= MAIL_HEADER;
                $body .= '<body>';
                $body .= BODY_START;
                $body .= '<div>';
                $body .= '<label>Hello,' . $EmailTokenWiseUserData['UserFullName'] . ' </label><br><br>';
                $body .= '<span>Please click activate your account.</span><br><br>';
                $body .= $TokenNumber . '<br><br>';
                $body .= BODY_FOOTER;
                $body .= '</div>';
                $body .= '</body>';
                $body .= '</head>';
                $body .= MAIL_FOOTER;

                $mysql->send_email($EmailTokenWiseUserData['EmailID'], '', $bcc, 'Token Number', nl2br($body), 'Please check your email.! ', $attachment);

                if ($EmailTokenWiseUserData) {
                    $this->return_data['ResponseCode'] = 1;
                    // $this->return_data['tokenNumber'] = $TokenNumber;
                    $this->return_data['UserID'] = $EmailTokenWiseUserData['UserID'];
                    $this->return_data['Message'] = 'The One Time Password (OTP) has been sent to your Registered Email Id';
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'No Record Found Or Account Not Verified Yet';
                }
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'User Id Required';
        }
        return $this->return_data;
    }

    public function EmailIDChange() {
        $mysql = new DataTransaction($this->_db);
        $CurrentTime = date('Y-m-d H:i:s');
//        print_r($_REQUEST);
//        exit;
        if (isset($_REQUEST['EmailID']) && $_REQUEST['EmailID'] != '' && $_REQUEST['EmailToken'] != '' && $_REQUEST['UserID'] != '') {
            $EmailUserStatus = $mysql->selectdata('v_users', '', array("is_active" => "Y", "UserID" => $_REQUEST['UserID']));
            $num_rowsEmail = sizeof($EmailUserStatus);
//            print_r($EmailUserStatus[0]['UserID']);
//            exit;
            if ($num_rowsEmail > 0) {
                if ($EmailUserStatus[0]['EmailToken'] != '') {
                    if ($EmailUserStatus[0]['EmailToken'] == $_REQUEST['EmailToken']) {
                        if ($EmailUserStatus[0]['EmailTokenDateTimeEnd'] > $CurrentTime) {

                            $EmailPattern = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
                            $EmailAddress = $_REQUEST['EmailID'];
                            if (preg_match($EmailPattern, $EmailAddress)) {
                                $Email = $mysql->update('v_users', array("EmailID" => $_REQUEST['EmailID'], "EmailToken" => '', "EmailTokenDateTimeStart" => '', "EmailToken" => '', "EmailVerificationStatus" => 'N', "EmailTokenDateTimeEnd" => ''), array("UserID" => $_REQUEST['UserID'], "is_active" => 'Y'));
                                $body = '<html>';
                                $body .= '<head>';
                                $body .= MAIL_HEADER;
                                $body .= '<body>';
                                $body .= BODY_START;
                                $body .= '<div>';
                                $body .= '<label>Hello,' . $EmailUserStatus[0]['FirstName'] . ' ' . $EmailUserStatus[0]['LastName'] . ' </label><br><br>';
                                $body .= '<span>Please click below link to activate your account.</span><br><br>';
                                $body .= '<a style = "background:##8b245e; padding:5px 7px; color:#fff; text-decoration:none;" target = "_blank" href="' . SITE_URL . 'activate?token=' . base64_encode($EmailUserStatus[0]['UserID']) . '">Click here</a><br><br>';
                                $body .= BODY_FOOTER;
                                $body .= '</div>';
                                $body .= '</body>';
                                $body .= '</head>';
                                $body .= MAIL_FOOTER;

                                $mysql->send_email($_REQUEST['EmailID'], '', $bcc, 'Activation', nl2br($body), 'Please check your email.! ', $attachment);

                                $this->return_data['UserID'] = $EmailUserStatus[0]['UserID'];
                                $this->return_data['ResponseCode'] = 1;
                                $this->return_data['Message'] = "Email Updated Successfully";
                            } else {
                                $this->return_data['ResponseCode'] = 0;
                                $this->return_data['Message'] = 'Email ID Not In Valid Format';
                            }
                        } else {
                            $this->return_data['ResponseCode'] = 0;
                            $this->return_data['Message'] = 'OTP Was Expired For This User';
                        }
                    } else {
                        $this->return_data['ResponseCode'] = 0;
                        $this->return_data['Message'] = 'OTP Doesn\'t Match';
                    }
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'OTP Not Generated';
                }
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'OTP,UserID And Email Id Must Required';
        }
        return $this->return_data;
    }

    public function login($Condition = "") {
        $json = json_decode($Condition, true);
        $PassWord = $this->Encrypt($json['Password']);
        if ($json['UserName'] != '') {
            $String = "SELECT UserID,UserName,FirstName,LastName,MiddleName,EmailID,MobileNumber,RoleID,DOB,is_active FROM v_users WHERE is_active = 'Y' AND UserName ='" . $json['UserName'] . "'";
            $userdata = $this->_db->prepare($String);
            $userdata->execute();
            if ($userdata->rowCount() > 0) {
                $String = "SELECT vu.RoleID,vu.is_active,vu.UserID,vu.FirstName,vu.LastName,vu.MiddleName,vu.MobileNumber,vu.EmailID,vu.UserID,now(),  YEAR(now()) - YEAR(vu.DOB) - (DATE_FORMAT(now(), '%m%d') < DATE_FORMAT(vu.DOB, '%m%d')) as Age,(CASE WHEN vu.DOB = '0000-00-00' THEN '-' ELSE vu.DOB END) AS DOB,vu.Gender,(CASE WHEN ProfilePicture = '' THEN '" . SITE_URL . "admin/uploads/ProfilePic/placeholder.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/ProfilePic/', ProfilePicture) END ) AS ProfilePicture,vu.TermsConditionStatus,ct.CityName,cntry.CountryName,st.StateName,vu.AdminApproval,vu.DeclineReason,CaptainshipStatus,vu.CityID,vu.StateID,vu.EmailVerificationStatus FROM v_users AS vu LEFT JOIN v_city AS ct ON vu.CityID = ct.CityID LEFT JOIN v_country cntry ON vu.CountryID = cntry.CountryID LEFT JOIN v_state st ON vu.StateID = st.StateID WHERE vu.is_active = 'Y' AND vu.UserName = '" . $json['UserName'] . "' AND vu.Password = '" . $PassWord . "'";
                $userdata = $this->_db->prepare($String);
                $userdata->execute();
                $logindata = $userdata->fetch(PDO::FETCH_ASSOC);
                $TeamData = $this->_db->prepare("SELECT Team.TeamID,Team.TeamName,Team.TeamDescription,Team.TeamSlogan,Team.TeamLogo,Team.CaptainID,Team.StateID,Team.CityID,Team.is_active FROM v_teams Team WHERE Team.is_active != 'D' AND Team.CaptainID = '" . $logindata['UserID'] . "'");
                $TeamData->execute();
                $TeamWiseData = $TeamData->fetch(PDO::FETCH_ASSOC);
                $TeamRowCount = $TeamData->rowCount();
                if ($TeamRowCount > 0) {
                    $logindata['TeamCreated'] = 'Yes';
                } else {
                    $logindata['TeamCreated'] = 'No';
                }
                $total = $userdata->rowCount();
                if ($logindata['CaptainshipStatus'] == 'Y') {
                    $logindata['CanBuildATeam'] = "Yes";
                } else {
                    $logindata['CanBuildATeam'] = "No";
                }
                $_SESSION[SESSION_ALIAS]['session'] = $logindata;
                if ($total > 0 && $logindata['EmailVerificationStatus'] == 'Y') {
                    $this->return_data['ResponseCode'] = 1;
                    $this->return_data['GetUserData'] = $logindata;
                    $this->return_data['Message'] = 'Logged In Successfully!';
                } else if ($total > 0 && $logindata['EmailVerificationStatus'] != 'Y') {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'Please Verify Your Email ID to Login Into Your Account!';
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'Password Do Not Match!';
                }
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'Username Do Not Match!';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'User Name and Password Required';
        }
        return $this->return_data;
    }

    public function InsertStateData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("StateName" => $_REQUEST['StateName'], "CountryID" => 1, "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $SetData = $mysql->insert($data, 'b_state');
        if ($SetData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetSetInsertData'] = $SetData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UpdateStateData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("StateName" => $_REQUEST['StateName'], "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $StateUpdateData = $mysql->update('b_state', $data, array("StateID" => $_REQUEST['StateID'], "is_active" => "Y"));
        if ($StateUpdateData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetStateUpdateData'] = $StateUpdateData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertCityData() {
        $mysql = new DataTransaction($this->_db);

        $data = array("CityName" => $_REQUEST['CityName'], "StateID" => $_REQUEST['StateID'], "CountryID" => 1, "is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $CityData = $mysql->insert($data, 'b_city');
        if ($CityData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCityInsertData'] = $CityData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UpdateCityData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("StateName" => $_REQUEST['StateName'], "StateID" => $_REQUEST['StateID'], "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $CityUpdateData = $mysql->update('b_state', $data, array("StateID" => $_REQUEST['StateID'], "is_active" => "Y"));
        if ($CityUpdateData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCityUpdateData'] = $CityUpdateData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertAreaData() {
        $mysql = new DataTransaction($this->_db);

        $data = array("AreaName" => $_REQUEST['AreaName'], "StateID" => $_REQUEST['StateID'], "CityID" => $_REQUEST['CityID'], "CountryID" => 1, "ZIPCode" => $_REQUEST['ZIPCode'], "is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $AreaData = $mysql->insert($data, 'b_area');
        if ($AreaData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAreaInsertData'] = $AreaData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UpdateAreaData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("AreaName" => $_REQUEST['AreaName'], "StateID" => $_REQUEST['StateID'], "CityID" => $_REQUEST['CityID'], "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $AreaUpdateData = $mysql->update('b_area', $data, array("AreaID" => $_REQUEST['AreaID'], "is_active" => "Y"));
        if ($AreaUpdateData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAreaUpdateData'] = $AreaUpdateData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertBookData() {
        $mysql = new DataTransaction($this->_db);
//        echo "<pre>";
//        print_r($_REQUEST);
//        exit;
        $data = array("BookTitle" => $_REQUEST['BookTitle'], "CategoryID" => $_REQUEST['CategoryID'], "BookPrice" => $_REQUEST['BookPrice'], "BookMRP" => $_REQUEST['BookMRP'], "BookDescription" => $_REQUEST['BookDescription'], "BookCode" => $_REQUEST['BookCode'], "BookAutherName" => $_REQUEST['BookAutherName'], "BookPublisher" => $_REQUEST['BookPublisher'], "BookImage" => $_REQUEST['BookImage'], "is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $BookData = $mysql->insert($data, 'b_bookmaster');
        if ($BookData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetBookInsertData'] = $BookData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertBookQuantityData() {
        $mysql = new DataTransaction($this->_db);
        
        $data = array("BookID" => $_REQUEST['BookID'], "CategoryID" => $_REQUEST['CategoryID'], "Quantity" => $_REQUEST['Quantity'], 'Date' => date('Y-m-d'), "is_active" => $_REQUEST['is_active'], "purchase_amount"=>$_REQUEST['purchase_amount'],"EntryBy" => '1',"PurchaseDate"=>$_REQUEST['PurchaseDate'] ,'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $BookQuantityData = $mysql->insert($data, 'b_stock_master');
        if ($BookQuantityData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetBookQuantityInsertData'] = $BookQuantityData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertRetailerOpeningBalanceData($Condition = '') {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        if (isset($json['flag']) && $json['flag'] == "OpeningBalance") {
            $data = array("RetailerID" => $_REQUEST['RetailerID'], "OpeningBalance" => $_REQUEST['OpeningBalance'], "BalanceType" => $_REQUEST['BalanceType'], "Flag" => $json['flag'], "ChequeNo" => $_REQUEST['ChequeNo'], "BankName" => $_REQUEST['BankName'], "Comment" => $_REQUEST['Comment'], "Date" => $_REQUEST['Date'], "is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        } else {
            $data = array("RetailerID" => $_REQUEST['RetailerID'], "OpeningBalance" => $_REQUEST['OpeningBalance'], "BalanceType" => $_REQUEST['BalanceType'], "Flag" => "Payment", "ChequeNo" => $_REQUEST['ChequeNo'], "BankName" => $_REQUEST['BankName'], "Comment" => $_REQUEST['Comment'], "Date" => $_REQUEST['Date'], "is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        }

        $RetailerBalanceData = $mysql->insert($data, 'b_retailer_balance');
        if ($RetailerBalanceData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerBalanceInsertData'] = $RetailerBalanceData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    
    
    public function InsertRetailerOpeningBalance($Condition = '') {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
            $data = array("RetailerBookStockMasterID"=>0,"RetailerID" => $_REQUEST['RetailerID'], "PayableAmount" => $_REQUEST['OpeningBalance'], "Type" => "Opening Balance", "Date"=>date('Y-m-d'),"is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        

        $RetailerBalanceData = $mysql->insert($data, 'b_retailer_invoice_balance_rele');
        if ($RetailerBalanceData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerBalanceInsert'] = $RetailerBalanceData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertGeneralUserBalanceData($Condition = '') {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        if (isset($json['flag']) && $json['flag'] == "OpeningBalance") {
            $data = array("UserID" => $_REQUEST['UserID'], "OpeningBalance" => $_REQUEST['OpeningBalance'], "BalanceType" => $_REQUEST['BalanceType'], "Flag" => $json['flag'], "ChequeNo" => $_REQUEST['ChequeNo'], "BankName" => $_REQUEST['BankName'], "Comment" => $_REQUEST['Comment'], "Date" => $_REQUEST['Date'], "is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        } else {
            $data = array("UserID" => $_REQUEST['UserID'], "OpeningBalance" => $_REQUEST['OpeningBalance'], "BalanceType" => $_REQUEST['BalanceType'], "Flag" => "Payment", "ChequeNo" => $_REQUEST['ChequeNo'], "BankName" => $_REQUEST['BankName'], "Comment" => $_REQUEST['Comment'], "Date" => $_REQUEST['Date'], "is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        }

        $RetailerBalanceData = $mysql->insert($data, 'b_general_user_balance');
        if ($RetailerBalanceData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerBalanceInsertData'] = $RetailerBalanceData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertAgentBookStockData() {
        $mysql = new DataTransaction($this->_db);
//        echo date('Y-m-d h:i:sa');
        $data = array("BookID" => $_REQUEST['BookID'], "AgentID" => $_REQUEST['AgentID'], "Quantity" => $_REQUEST['Quantity'], "Quantity" => $_REQUEST['Quantity'], "Amount" => $_REQUEST['Amount'], "CategoryID" => $_REQUEST['CategoryID'], "BookPrice" => $_REQUEST['BookPrice'], "is_active" => $_REQUEST['is_active'], "AgentOrderStatus" => 'P', "EntryBy" => '1', 'EntryDate' => date('Y-m-d h:i:sa'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $BookQuantityData = $mysql->insert($data, 'b_agent_book_stock');
        if ($BookQuantityData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetBookQuantityInsertData'] = $BookQuantityData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertOnBehalfOFAgentBookStockData() {
        $mysql = new DataTransaction($this->_db);
//        echo date('Y-m-d h:i:sa');
        $data = array("ClientName" => $_REQUEST['ClientName'], "ClientAddressLine1" => $_REQUEST['ClientAddressLine1'], "ClientAddressLine2" => $_REQUEST['ClientAddressLine2'], 'ClientAddressArea' => $_REQUEST['ClientAddressArea'], "ClientAddressCity" => $_REQUEST['ClientAddressCity'], "ClientAddressPincode" => $_REQUEST['ClientAddressPincode'], "ClientMobileNumber" => $_REQUEST['ClientMobileNumber'], "ClientEmailID" => $_REQUEST['ClientEmailID'], "AgentID" => $_REQUEST['AgentID'], "is_active" => $_REQUEST['is_active'], "EntryBy" => $_REQUEST['AgentID'], 'EntryDate' => date('Y-m-d'));
//        echo "<pre>";
//        print_r($data);
        $ClientData = $mysql->insert($data, 'b_agent_client');
        $data = array("BookID" => $_REQUEST['BookID'], "AgentID" => $_REQUEST['AgentID'], "ClientID" => $ClientData, 'TotalBookQuantity' => $_REQUEST['Quantity'], "PayableAmount" => $_REQUEST['Amount'], "is_active" => $_REQUEST['is_active'], "EntryBy" => 1, 'EntryDate' => date('Y-m-d'));
        $AgentClintSellData = $mysql->insert($data, 'b_client_book_stock_master');

        $BookRecord = $mysql->selectdata('b_stock_master', '', array("is_active" => "Y", "BookID" => $_REQUEST['BookID']));
        $NewQuantity = $BookRecord[0]['Quantity'] - $_REQUEST['Quantity'];
        $UpdateData = array("Quantity" => $NewQuantity);
        $AreaUpdateData = $mysql->update('b_stock_master', $UpdateData, array("BookID" => $_REQUEST['BookID'], "is_active" => "Y"));

        if ($AgentClintSellData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetBookQuantityInsertData'] = $AgentClintSellData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function RetailerInvoiceData($Condition = '') {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT * FROM b_retailer_book_stock_master WHERE is_active = 'Y' AND RetailerBookStockMasterID ='" . $json['RetailerBookStockMasterID'] . "'";
        $RetailerBookStockData = $this->_db->prepare($String);
        $RetailerBookStockData->execute();
        $RetailerBookStockWiseData = $RetailerBookStockData->fetch(PDO::FETCH_ASSOC);

//        echo "<pre>";
//        print_r($RetailerBookStockWiseData);
//        exit;
        $DataValue = explode(',', $RetailerBookStockWiseData['RetailerBookStockID']);
        $size = sizeof($DataValue);
        $i = 0;
        foreach ($DataValue AS $Keys => $Value) {
            $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_retailer_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.RetailerID ='" . $json['UserID'] . "' AND BookStock.RetailerBookStockID = '" . $Value . "'";
            $RetailerStockData = $this->_db->prepare($String);
            $RetailerStockData->execute();
            $RetailerStockWiseData[] = $RetailerStockData->fetch(PDO::FETCH_ASSOC);
            $i++;
        }

        if ($RetailerBookStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerInvoiceData'] = $RetailerBookStockWiseData;
            $this->return_data['GetRetailerBookData'] = $RetailerStockWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function CreditNoteInvoiceData($Condition = '') {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT Credit.*,Book.BookPrice,Book.BookMRP,Book.BookTitle,User.* FROM b_credit_notes AS Credit RIGHT JOIN b_user AS User ON Credit.UserID = User.UserID RIGHT JOIN b_bookmaster AS Book ON Book.BookID = Credit.BookID WHERE Credit.is_active = 'Y' AND Credit.UserID ='" . $json['UserID'] . "'";
        $RetailerBookStockData = $this->_db->prepare($String);
        $RetailerBookStockData->execute();
        $RetailerBookStockWiseData = $RetailerBookStockData->fetchALL(PDO::FETCH_ASSOC);

        if ($RetailerBookStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerInvoiceData'] = $RetailerBookStockWiseData;
//            $this->return_data['GetRetailerBookData'] = $RetailerBookStockWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GeneralUserInvoiceData($Condition = '') {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT * FROM b_user_book_stock_master WHERE is_active = 'Y' AND UserBookStockMasterID ='" . $json['UserBookStockMasterID'] . "'";
        $RetailerBookStockData = $this->_db->prepare($String);
        $RetailerBookStockData->execute();
        $RetailerBookStockWiseData = $RetailerBookStockData->fetch(PDO::FETCH_ASSOC);

//        echo "<pre>";
//        print_r($RetailerBookStockWiseData);
//        exit;
        $DataValue = explode(',', $RetailerBookStockWiseData['BookID']);
        $size = sizeof($DataValue);
        $i = 0;
        foreach ($DataValue AS $Keys => $Value) {
            $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_user_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.UserID ='" . $json['UserID'] . "' AND BookStock.BookID = '" . $Value . "'";
            $RetailerStockData = $this->_db->prepare($String);
            $RetailerStockData->execute();
            $RetailerStockWiseData[] = $RetailerStockData->fetch(PDO::FETCH_ASSOC);
            $i++;
        }

        if ($RetailerBookStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerInvoiceData'] = $RetailerBookStockWiseData;
            $this->return_data['GetRetailerBookData'] = $RetailerStockWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
public function AgentInvoiceData($Condition = '') {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT * FROM b_agent_book_stock_master WHERE is_active = 'Y' AND AgentBookStockMasterID='" . $json['AgentBookStockMasterID'] . "'";
        $RetailerBookStockData = $this->_db->prepare($String);
        $RetailerBookStockData->execute();
        $RetailerBookStockWiseData = $RetailerBookStockData->fetch(PDO::FETCH_ASSOC);

//        echo "<pre>";
//        print_r($RetailerBookStockWiseData);
//        exit;
        $DataValue = explode(',', $RetailerBookStockWiseData['BookID']);
        $size = sizeof($DataValue);
        $i = 0;
        foreach ($DataValue AS $Keys => $Value) {
            $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_agent_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.AgentID ='" . $json['UserID'] . "' AND BookStock.BookID = '" . $Value . "'";
            $RetailerStockData = $this->_db->prepare($String);
            $RetailerStockData->execute();
            $RetailerStockWiseData[] = $RetailerStockData->fetch(PDO::FETCH_ASSOC);
            $i++;
        }

        if ($RetailerBookStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerInvoiceData'] = $RetailerBookStockWiseData;
            $this->return_data['GetRetailerBookData'] = $RetailerStockWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function RetailerBalanceInvoiceData($Condition = '') {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT * FROM b_retailer_invoice_balance_rele WHERE is_active = 'Y' AND RetailerID ='" . $json['RetailerID'] . "'";
        $RetailerBalanceInvoiceData = $this->_db->prepare($String);
        $RetailerBalanceInvoiceData->execute();
        $RetailerBalanceInvoiceWiseData = $RetailerBalanceInvoiceData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailerBalanceInvoiceWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetBalanceInvoiceData'] = $RetailerBalanceInvoiceWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GeneralUserBalanceInvoiceData($Condition = '') {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT * FROM b_general_user_invoice_balance_rele WHERE is_active = 'Y' AND UserID ='" . $json['UserID'] . "'";
        $RetailerBalanceInvoiceData = $this->_db->prepare($String);
        $RetailerBalanceInvoiceData->execute();
        $RetailerBalanceInvoiceWiseData = $RetailerBalanceInvoiceData->fetchAll(PDO::FETCH_ASSOC);


        if ($RetailerBalanceInvoiceWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetBalanceInvoiceData'] = $RetailerBalanceInvoiceWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertAgentData() {
        $mysql = new DataTransaction($this->_db);
//        echo "<pre>";
//        print_r($_REQUEST);
//        exit;
        if (isset($_REQUEST['Flag']) && $_REQUEST['Flag'] == 'Retailer') {
            $RoleID = 3;
        } else {
            $RoleID = 2;
        }
        $EncryptedPassword = $this->Encrypt($_REQUEST['MobileNumber']);
        $data = array("UserName" => $_REQUEST['UserName'], "Password" => $EncryptedPassword, "Email" => $_REQUEST['Email'], 'Gender' => $_REQUEST['Gender'], "ProfilePicture" => $_REQUEST['ProfilePicture'], "MobileNumber" => $_REQUEST['MobileNumber'], "is_active" => 'Y', "RoleID" => $RoleID, "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $AgentData = $mysql->insert($data, 'b_user');
        if ($AgentData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAgentInsertData'] = $AgentData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertClientData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("ClientName" => $_REQUEST['ClientName'], "ClientAddressLine1" => $_REQUEST['ClientAddressLine1'], "ClientAddressLine2" => $_REQUEST['ClientAddressLine2'], 'ClientAddressArea' => $_REQUEST['ClientAddressArea'], "ClientAddressCity" => $_REQUEST['ClientAddressCity'], "ClientAddressPincode" => $_REQUEST['ClientAddressPincode'], "ClientMobileNumber" => $_REQUEST['ClientMobileNumber'], "ClientEmailID" => $_REQUEST['ClientEmailID'], "AgentID" => $_REQUEST['AgentID'], "is_active" => $_REQUEST['is_active'], "EntryBy" => $_REQUEST['AgentID'], 'EntryDate' => date('Y-m-d'));
        $AgentData = $mysql->insert($data, 'b_agent_client');
        if ($AgentData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAgentInsertData'] = $AgentData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertRegistrationData() {
        $mysql = new DataTransaction($this->_db);
//        echo "<pre>";
//        print_r($_REQUEST);
        $EncryptedPassword = $this->Encrypt($_REQUEST['Password']);
        $data = array("UserName" => $_REQUEST['UserName'], "Password" => $EncryptedPassword, "RoleID" => $_REQUEST['RoleID'], "Email" => $_REQUEST['Email'], "Gender" => $_REQUEST['Gender'], "Terms" => $_REQUEST['Terms'], "ProfilePicture" => $_REQUEST['ProfilePicture'], "is_active" => $_REQUEST['is_active']);
        $RegistrationData = $mysql->insert($data, 'b_user');
        if ($RegistrationData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRegistrationData'] = $RegistrationData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertExpenseData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("ExpenseTitle" => $_REQUEST['ExpenseTitle'], "ExpenseDescription" => $_REQUEST['ExpenseDescription'], "ExpenseDate" => $_REQUEST['ExpenseDate'], "ExpenseAmount" => $_REQUEST['ExpenseAmount'], "is_active" => 'Y', "EntryBy" => 1, 'EntryDate' => date('Y-m-d'));
        $ExpenseData = $mysql->insert($data, 'b_expense');
        if ($ExpenseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetExpenseData'] = $ExpenseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UserLogin($Condition = "") {
        $json = json_decode($Condition, true);
        $PassWord = $this->Encrypt($json['Password']);
        if ($json['UserName'] != '') {
             $String = "SELECT * FROM b_user WHERE is_active = 'Y' AND UserName ='" . $json['UserName'] . "'";
            $userdata = $this->_db->prepare($String);
            $userdata->execute();
            if ($userdata->rowCount() > 0) {
                $UserLoginData = $this->_db->prepare("SELECT * FROM b_user WHERE is_active = 'Y' AND UserName = '" . $json['UserName'] . "' AND Password = '" . $PassWord . "'");
                $UserLoginData->execute();
                $UserLoginWiseData = $UserLoginData->fetch(PDO::FETCH_ASSOC);
                if ($UserLoginWiseData) {
                    session_start();
                    $_SESSION['BookStore']['session'] = $UserLoginWiseData;
                    $this->return_data['ResponseCode'] = 1;
                    if ($UserLoginWiseData['RoleID'] == 1) {
                        $this->return_data['RedirectMsg'] = "Admin";
                        $this->return_data['Message'] = $UserLoginWiseData;
                    } elseif ($UserLoginWiseData['RoleID'] == 2) {
                        $this->return_data['RedirectMsg'] = "Agent";
                        $this->return_data['Message'] = $UserLoginWiseData;
                    } elseif ($UserLoginWiseData['RoleID'] == 3) {
                        $this->return_data['RedirectMsg'] = "Retailers";
                        $this->return_data['Message'] = $UserLoginWiseData;
                    } elseif ($UserLoginWiseData['RoleID'] == 5) {
                        $this->return_data['RedirectMsg'] = "GeneralUser";
                        $this->return_data['Message'] = $UserLoginWiseData;
                    } elseif ($UserLoginWiseData['RoleID'] == 4) {
                        $this->return_data['RedirectMsg'] = "WebUser";
                        $this->return_data['Message'] = $UserLoginWiseData;
                    } else {
                        $this->return_data['Message'] = $UserLoginWiseData;
                    }
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'Password Do Not Match!';
                }
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'Username Do Not Match!';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'User Name and Password Required';
        }
        return $this->return_data;
    }

    public function InsertCategoryData() {
        $mysql = new DataTransaction($this->_db);

        $data = array("CategoryTitle" => $_REQUEST['CategoryTitle'], "is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $CategoryData = $mysql->insert($data, 'b_category');
        if ($CategoryData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCategoryInsertData'] = $CategoryData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertCreditNoteData() {

        $mysql = new DataTransaction($this->_db);
//        echo "<pre>";
//        print_r($_REQUEST);
        $data = array("UserID" => $_REQUEST['UserID'], "BookID" => $_REQUEST['BookID'], "Quantity" => $_REQUEST['Quantity'], "Discount" => $_REQUEST['Discount'], "NetAmount" => $_REQUEST['Amount'], 'Date' => date('Y-m-d'), "is_active" => $_REQUEST['is_active'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $CategoryData = $mysql->insert($data, 'b_credit_notes');

        $OrderMaster = "SELECT * FROM b_agent_book_stock_master WHERE is_active = 'Y' AND BookID ='" . $_REQUEST['BookID'] . "' ";
        $OrderMasterData = $this->_db->prepare($OrderMaster);
        $OrderMasterData->execute();
        $OrderMasterWiseData = $OrderMasterData->fetch(PDO::FETCH_ASSOC);

        $Quantity = $OrderMasterWiseData['Quantity'] - $_REQUEST['Quantity'];
        $UpdateBookStockData = $mysql->update('b_agent_book_stock_master', array("Quantity" => $Quantity), array("BookID" => $_REQUEST['BookID'], "is_active" => 'Y'));
        if ($CategoryData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCategoryInsertData'] = $CategoryData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAgentWiseBookStock($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $OrderMaster = "SELECT * FROM b_agent_book_stock_master WHERE is_active = 'Y' AND AgentID ='" . $json['AgentID'] . "' AND AgentBookStockMasterID ='" . $json['AgentBookStockMasterID'] . "'";
        $OrderMasterData = $this->_db->prepare($OrderMaster);
        $OrderMasterData->execute();
        $OrderMasterWiseData = $OrderMasterData->fetch(PDO::FETCH_ASSOC);

//        echo "<pre>";
//        print_r($OrderMasterWiseData['AgentBookStockID']);
//        exit;
        $DataValue = explode(',', $OrderMasterWiseData['AgentBookStockID']);
        $size = sizeof($DataValue);
//       print_r($DataValue);
        if ($DataValue == '') {
            $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_agent_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.AgentID ='" . $json['AgentID'] . "' AND BookStock.AgentOrderStatus='P'";
            $AgentStockData = $this->_db->prepare($String);
            $AgentStockData->execute();
            $AgentStockWiseData[] = $AgentStockData->fetch(PDO::FETCH_ASSOC);
        } else {
            for ($DataValue = 1; $DataValue <= $size; $DataValue++) {
                $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_agent_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.AgentID ='" . $json['AgentID'] . "' AND BookStock.AgentBookStockID = '" . $DataValue . "'";
                $AgentStockData = $this->_db->prepare($String);
                $AgentStockData->execute();
                $AgentStockWiseData[] = $AgentStockData->fetch(PDO::FETCH_ASSOC);
            }
        }


        if ($AgentStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAgentStockData'] = $AgentStockWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetClientWiseBookStock($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $OrderMaster = "SELECT * FROM b_client_book_stock_master WHERE is_active = 'Y' AND ClientID ='" . $json['ClientID'] . "' AND ClientBookStockMasterID ='" . $json['ClientBookStockMasterID'] . "'";
        $OrderMasterData = $this->_db->prepare($OrderMaster);
        $OrderMasterData->execute();
        $OrderMasterWiseData = $OrderMasterData->fetch(PDO::FETCH_ASSOC);

//        echo "<pre>";
//        print_r($OrderMasterWiseData['AgentBookStockID']);
//        exit;
        $DataValue = explode(',', $OrderMasterWiseData['ClientBookStockID']);
        $size = sizeof($DataValue);
//       print_r($DataValue);
        if ($DataValue == '') {
            $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_client_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.ClientID ='" . $json['ClientID'] . "' AND BookStock.ClientOrderStatus='P'";
            $ClientStockData = $this->_db->prepare($String);
            $ClientStockData->execute();
            $ClientStockWiseData[] = $ClientStockData->fetch(PDO::FETCH_ASSOC);
        } else {
            for ($DataValue = 1; $DataValue <= $size; $DataValue++) {
                $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_client_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.ClientID ='" . $json['ClientID'] . "' AND BookStock.ClientBookStockID = '" . $DataValue . "'";
                $ClientStockData = $this->_db->prepare($String);
                $ClientStockData->execute();
                $ClientStockWiseData[] = $ClientStockData->fetch(PDO::FETCH_ASSOC);
            }
        }

        if ($ClientStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAgentStockData'] = $ClientStockWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAgentOrderPenddingData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);

        $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_agent_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.AgentID ='" . $json['AgentID'] . "' AND BookStock.AgentOrderStatus='P'";
        $AgentStockData = $this->_db->prepare($String);
        $AgentStockData->execute();
        $AgentStockWiseData = $AgentStockData->fetchAll(PDO::FETCH_ASSOC);
        if ($AgentStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAgentStockData'] = $AgentStockWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetClientOrderPenddingData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);

        $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_client_book_stock AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.ClientID ='" . $json['ClientID'] . "' AND BookStock.AgentOrderStatus='P'";
        $AgentStockData = $this->_db->prepare($String);
        $AgentStockData->execute();
        $AgentStockWiseData = $AgentStockData->fetchAll(PDO::FETCH_ASSOC);
        if ($AgentStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAgentStockData'] = $AgentStockWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllAgentOrderData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT BookStock.*,Book.BookTitle,Book.BookCode FROM b_agent_book_stock_master AS BookStock INNER JOIN b_bookmaster AS Book ON Book.BookID = BookStock.BookID WHERE BookStock.is_active = 'Y' AND BookStock.AgentID ='" . $json['AgentID'] . "'";
        $AgentStockData = $this->_db->prepare($String);
        $AgentStockData->execute();
        $AgentStockWiseData = $AgentStockData->fetchAll(PDO::FETCH_ASSOC);
        if ($AgentStockWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAgentOrderStockData'] = $AgentStockWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetCartData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT Cart.*,Book.*,(Cart.Quantity * Book.BookPrice) AS PayableAmount FROM b_cart AS Cart INNER JOIN b_bookmaster AS Book ON Book.BookID = Cart.BookID WHERE Cart.is_active = 'Y' AND Cart.UserID ='" . $json . "' AND Cart.OrderStatus='P'";
        $CartData = $this->_db->prepare($String);
        $CartData->execute();
        $UserCartData = $CartData->fetchAll(PDO::FETCH_ASSOC);
        if ($UserCartData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetSelectedCartData'] = $UserCartData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllAgentData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT * FROM b_user WHERE is_active = 'Y' AND RoleID ='2'";
        $AgentData = $this->_db->prepare($String);
        $AgentData->execute();
        $AgentWiseData = $AgentData->fetchAll(PDO::FETCH_ASSOC);
        if ($AgentWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAgentData'] = $AgentWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllRetailerData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT * FROM b_user WHERE is_active = 'Y' AND RoleID ='3'";
        $RetailerData = $this->_db->prepare($String);
        $RetailerData->execute();
        $RetailerWiseData = $RetailerData->fetchAll(PDO::FETCH_ASSOC);
        if ($RetailerWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerData'] = $RetailerWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function RetailerBalanceData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT * FROM b_retailer_balance WHERE is_active = 'Y' AND RetailerID ='" . $json['RetailerID'] . "'";
        $RetailerBalanceData = $this->_db->prepare($String);
        $RetailerBalanceData->execute();
        $RetailerBalance = $RetailerBalanceData->fetchAll(PDO::FETCH_ASSOC);
        if ($RetailerBalance) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerBalanceData'] = $RetailerBalance;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GeneralUserBalanceData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT * FROM b_general_user_balance WHERE is_active = 'Y' AND UserID ='" . $json['UserID'] . "'";
        $RetailerBalanceData = $this->_db->prepare($String);
        $RetailerBalanceData->execute();
        $RetailerBalance = $RetailerBalanceData->fetchAll(PDO::FETCH_ASSOC);
        if ($RetailerBalance) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerBalanceData'] = $RetailerBalance;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function RetailerTransactionBalanceData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $String = "SELECT * FROM b_retailer_balance_transaction WHERE is_active = 'Y' AND RetailerID ='" . $json['RetailerID'] . "'";
        $RetailerBalanceData = $this->_db->prepare($String);
        $RetailerBalanceData->execute();
        $RetailerBalance = $RetailerBalanceData->fetchAll(PDO::FETCH_ASSOC);
        if ($RetailerBalance) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRetailerBalanceData'] = $RetailerBalance;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function RetailerPlaceOrder() {
        $mysql = new DataTransaction($this->_db);
//        echo "<pre>";
//        print_r($_REQUEST);
//        if (isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'Cash') {
//            echo "yes its cash";
//        }
//        exit;
        $UserAddressQuery = $this->_db->prepare("SELECT * FROM b_user_address WHERE UserID =  '" . $_REQUEST['RetailerID'] . "' AND is_active = 'Y'");
        $UserAddressQuery->execute();
        $UserAddressData = $UserAddressQuery->fetch(PDO::FETCH_ASSOC);
        $count = $UserAddressQuery->rowCount();
        if ($count > 0) {
            $RetailerAddressData = $mysql->update('b_user_address', array("AddressLine1" => $_REQUEST['AddressLine1'], "AddressLine2" => $_REQUEST['AddressLine2'], "Area" => $_REQUEST['Area'], "CityID" => $_REQUEST['CityID'], "Pincode" => $_REQUEST['Pincode'], "MobileNumber" => $_REQUEST['MobileNumber'], "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d')), array("UserID" => $_REQUEST['RetailerID'], "is_active" => 'Y'));
        } else {
            $RetailerAddressdata = array("UserID" => $_REQUEST['RetailerID'], "AddressLine1" => $_REQUEST['AddressLine1'], "AddressLine2" => $_REQUEST['AddressLine2'], "Area" => $_REQUEST['Area'], "CityID" => $_REQUEST['CityID'], "Pincode" => $_REQUEST['Pincode'], "MobileNumber" => $_REQUEST['MobileNumber'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
            $RetailerAddressData = $mysql->insert($RetailerAddressdata, 'b_user_address');
        }
        if ($RetailerAddressData) {
            if (isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'Cash') {
                $BalanceDataArray = array("RetailerID" => $_REQUEST['RetailerID'], "OpeningBalance" => $_REQUEST['PayableAmount'], "BalanceType" => $_REQUEST['Type'], "ChequeNo" =>NULL, "BankName" => NULL, "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'Date'=>date('Y-m-d H:i:s'),'ModificationDate' => date('Y-m-d'));
                $BalanceData = $mysql->insert($BalanceDataArray, 'b_retailer_balance');
            }
            
             
            
            
            
            $Stockdata = array("BookID" => $_REQUEST['BookID'], "RetailerID" => $_REQUEST['RetailerID'], "TotalBookQuantity" => $_REQUEST['TotalBookQuantity'], "PayableAmount" => $_REQUEST['PayableAmount'], "RetailerBookStockID" => $_REQUEST['RetailerBookStockID'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
            $AgentPlaceOrderData = $mysql->insert($Stockdata, 'b_retailer_book_stock_master');
            if ($AgentPlaceOrderData) {
                $RetailerInvoiceBalanceReleData = array("RetailerBookStockMasterID" => $AgentPlaceOrderData, "RetailerID" => $_REQUEST['RetailerID'], "Date" => date('Y-m-d'), "PayableAmount" => $_REQUEST['PayableAmount'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
                $RetailerInvoiceBalanceReleInsertData = $mysql->insert($RetailerInvoiceBalanceReleData, 'b_retailer_invoice_balance_rele');

//        echo "<pre>";


                $BookRecord = $mysql->selectdata('b_stock_master', '', array("is_active" => "Y", "BookID" => $_REQUEST['BookID']));
                $NewQuantity = $BookRecord[0]['Quantity'] - $_REQUEST['Quantity'];
                $UpdateData = array("Quantity" => $NewQuantity);
                $AreaUpdateData = $mysql->update('b_stock_master', $UpdateData, array("BookID" => $_REQUEST['BookID'], "is_active" => "Y"));


                if ($RetailerInvoiceBalanceReleInsertData) {
                    $this->return_data['ResponseCode'] = 1;
                    $this->return_data['RetailerInvoiceBalanceReleInsertData'] = $RetailerInvoiceBalanceReleInsertData;
                    $this->return_data['Message'] = 'Success';
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'No Record Found';
                }
            }
            $RetailerAddressData = $mysql->update('b_retailer_book_stock', array("RetailerOrderStatus" => 'S', "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d')), array("RetailerID" => $_REQUEST['RetailerID'], "is_active" => 'Y', "RetailerOrderStatus" => 'P'));
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Please Provide Address Details';
        }

        return $this->return_data;
    }

    public function UserPlaceOrder() {
        $mysql = new DataTransaction($this->_db);

        if($_REQUEST['TransactionType'] == 'Debit'){
        $GeneralUserBalData = array("UserID" => $_REQUEST['UserID'], "OpeningBalance" => $_REQUEST['PayableAmount'], "BalanceType" =>'Cash', "Flag" => "Payment", "ChequeNo" => "null", "BankName" => "null", "Comment" => "Debit Entry of general user ", "Date" => $_REQUEST['Date'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'),"Date"=>date('Y-m-d'));
        $GeneralUserBalanceInsertData = $mysql->insert($GeneralUserBalData, 'b_general_user_balance');
        }
        $BalanceDataArray = array("UserID" => $_REQUEST['UserID'], "Balance" => $_REQUEST['PayableAmount'], "BalanceType" => $_REQUEST['Type'], "ChequeNo" => $_REQUEST['ChequeNo'], "BankName" => $_REQUEST['BankName'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $BalanceData = $mysql->insert($BalanceDataArray, 'b_user_balance');

       
        $Stockdata = array("BookID" => $_REQUEST['BookID'], "UserID" => $_REQUEST['UserID'], "TotalBookQuantity" => $_REQUEST['TotalBookQuantity'], "PayableAmount" => $_REQUEST['PayableAmount'], "UserBookStockID" => $_REQUEST['UserBookStockIDs'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        
        $AgentPlaceOrderData = $mysql->insert($Stockdata, 'b_user_book_stock_master');

        
        if ($AgentPlaceOrderData) {
            
            $UpdateData = $mysql->update('b_user_book_stock', array("UserOrderStatus" => "D"), array("UserID" => $_REQUEST['UserID'], "is_active" => "Y"));
            
            $RetailerInvoiceBalanceReleData = array("UserBookStockMasterID" => $AgentPlaceOrderData, "UserID" => $_REQUEST['UserID'], "Date" => date('Y-m-d'), "PayableAmount" => $_REQUEST['PayableAmount'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
            $RetailerInvoiceBalanceReleInsertData = $mysql->insert($RetailerInvoiceBalanceReleData, 'b_general_user_invoice_balance_rele');

            $BookRecord = $mysql->selectdata('b_stock_master', '', array("is_active" => "Y", "BookID" => $_REQUEST['BookID']));
            $NewQuantity = $BookRecord[0]['Quantity'] - $_REQUEST['Quantity'];
            $UpdateData = array("Quantity" => $NewQuantity);
            $AreaUpdateData = $mysql->update('b_stock_master', $UpdateData, array("BookID" => $_REQUEST['BookID'], "is_active" => "Y"));
            


            if ($RetailerInvoiceBalanceReleInsertData) {
                $this->return_data['ResponseCode'] = 1;
                $this->return_data['RetailerInvoiceBalanceReleInsertData'] = $RetailerInvoiceBalanceReleInsertData;
                $this->return_data['Message'] = 'Success';
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found';
            }
        }
        $RetailerAddressData = $mysql->update('b_retailer_book_stock', array("RetailerOrderStatus" => 'S', "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d')), array("RetailerID" => $_REQUEST['RetailerID'], "is_active" => 'Y', "RetailerOrderStatus" => 'P'));


        return $this->return_data;
    }

    public function GetPlacedOrderedData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);

        $String = "SELECT OrderMaster.*,Book.BookTitle,Book.BookImage,Book.BookAutherName,Book.BookPublisher,Book.BookPrice FROM b_order_details  AS OrderMaster INNER JOIN b_bookmaster AS Book ON Book.BookID= OrderMaster.BookID WHERE OrderMaster.is_active = 'Y' AND OrderMaster.UserID ='" . $json['UserID'] . "'";
        $PlacedOrderData = $this->_db->prepare($String);
        $PlacedOrderData->execute();
        $PlacedOrderWiseData = $PlacedOrderData->fetchAll(PDO::FETCH_ASSOC);
        if ($PlacedOrderWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPlacedOrderedWiseData'] = $PlacedOrderWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetPlacedOrderedDetails($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "SELECT OrderMaster.*,Book.BookTitle,Book.BookImage,Book.BookAutherName,Book.BookPublisher,Book.BookPrice FROM b_order_master  AS OrderMaster INNER JOIN b_bookmaster AS Book ON Book.BookID= OrderMaster.BookID WHERE OrderMaster.is_active = 'Y' AND OrderMaster.OrderNo ='" . $json['OrderNo']. "'";
//        exit;
        $String = "SELECT OrderMaster.*,Book.BookTitle,Book.BookImage,Book.BookAutherName,Book.BookPublisher,Book.BookPrice FROM b_order_master  AS OrderMaster LEFT JOIN b_bookmaster AS Book ON Book.BookID= OrderMaster.BookID WHERE OrderMaster.is_active = 'Y' AND OrderMaster.OrderNo ='" . $json['OrderNo'] . "'";
        $PlacedOrderData = $this->_db->prepare($String);
        $PlacedOrderData->execute();
        $PlacedOrderWiseData = $PlacedOrderData->fetch(PDO::FETCH_ASSOC);
        if ($PlacedOrderWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPlacedOrderedWiseData'] = $PlacedOrderWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetRetailerPlacedOrderedDetails($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "SELECT OrderMaster.*,Book.BookTitle,Book.BookImage,Book.BookAutherName,Book.BookPublisher,Book.BookPrice FROM b_order_master  AS OrderMaster INNER JOIN b_bookmaster AS Book ON Book.BookID= OrderMaster.BookID WHERE OrderMaster.is_active = 'Y' AND OrderMaster.OrderNo ='" . $json['OrderNo']. "'";
//        exit;
//        echo "<br>";
//        echo "<br>";
//        echo "<br>";
//        echo "<br>";
        $String = "SELECT OrderMaster.*,Book.BookTitle,Book.BookImage,Book.BookAutherName,Book.BookPublisher,Book.BookPrice FROM b_retailer_book_stock_master  AS OrderMaster LEFT JOIN b_bookmaster AS Book ON Book.BookID= OrderMaster.BookID WHERE OrderMaster.is_active = 'Y' AND OrderMaster.RetailerBookStockMasterID ='" . $json['OrderNo'] . "'";
        $PlacedOrderData = $this->_db->prepare($String);
        $PlacedOrderData->execute();
        $PlacedOrderWiseData = $PlacedOrderData->fetch(PDO::FETCH_ASSOC);
        if ($PlacedOrderWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPlacedOrderedWiseData'] = $PlacedOrderWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetOrderedWiseBooksDetails($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
//        echo "SELECT OrderMaster.*,Book.BookTitle,Book.BookImage,Book.BookAutherName,Book.BookPublisher,Book.BookPrice FROM b_order_details  AS OrderMaster LEFT JOIN b_bookmaster AS Book ON Book.BookID= OrderMaster.BookID WHERE OrderMaster.is_active = 'Y' AND OrderMaster.UserID ='" . $json['UserID']. "' AND OrderMaster.OrderNo ='" . $json['OrderNo']. "'";
        $String = "SELECT OrderMaster.*,Book.BookTitle,Book.BookMRP,Book.BookImage,Book.BookAutherName,Book.BookPublisher,Book.BookPrice FROM b_order_details  AS OrderMaster LEFT JOIN b_bookmaster AS Book ON Book.BookID= OrderMaster.BookID WHERE OrderMaster.is_active = 'Y' AND OrderMaster.UserID ='" . $json['UserID'] . "' AND OrderMaster.OrderNo ='" . $json['OrderNo'] . "'";
        $PlacedOrderDetailData = $this->_db->prepare($String);
        $PlacedOrderDetailData->execute();
        $PlacedOrderWiseDetailData = $PlacedOrderDetailData->fetchAll(PDO::FETCH_ASSOC);
        if ($PlacedOrderWiseDetailData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPlacedOrderedWiseDetailData'] = $PlacedOrderWiseDetailData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetRetailerOrderedWiseBooksDetails($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
//        echo "SELECT OrderMaster.*,Book.BookTitle,Book.BookImage,Book.BookAutherName,Book.BookPublisher,Book.BookPrice FROM b_order_details  AS OrderMaster LEFT JOIN b_bookmaster AS Book ON Book.BookID= OrderMaster.BookID WHERE OrderMaster.is_active = 'Y' AND OrderMaster.UserID ='" . $json['UserID']. "' AND OrderMaster.OrderNo ='" . $json['OrderNo']. "'";

        $String = "SELECT OrderMaster.*,Book.BookTitle,Book.BookImage,Book.BookAutherName,Book.BookPublisher,Book.BookPrice FROM b_retailer_book_stock_master  AS OrderMaster LEFT JOIN b_bookmaster AS Book ON Book.BookID= OrderMaster.BookID WHERE OrderMaster.is_active = 'Y' AND OrderMaster.RetailerID ='" . $json['UserID'] . "' AND OrderMaster.RetailerBookStockMasterID ='" . $json['OrderNo'] . "'";
        $PlacedOrderDetailData = $this->_db->prepare($String);
        $PlacedOrderDetailData->execute();
        $PlacedOrderWiseDetailData = $PlacedOrderDetailData->fetchAll(PDO::FETCH_ASSOC);
        if ($PlacedOrderWiseDetailData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPlacedOrderedWiseDetailData'] = $PlacedOrderWiseDetailData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAgentWiseBookSellDetails($Condition = "") {
//        $mysql = new DataTransaction($this->_db);
//        $json = json_decode($Condition, true);
//        $String = "SELECT * FROM b_order_details  AS OrderMaster LEFT JOIN b_bookmaster AS Book ON Book.BookID= OrderMaster.BookID WHERE OrderMaster.is_active = 'Y' AND OrderMaster.UserID ='" . $json['UserID']. "' AND OrderMaster.OrderNo ='" . $json['AgentID']. "'";
//        $PlacedOrderDetailData = $this->_db->prepare($String);
//        $PlacedOrderDetailData->execute();
//        $PlacedOrderWiseDetailData = $PlacedOrderDetailData->fetchAll(PDO::FETCH_ASSOC);
//        if ($PlacedOrderWiseDetailData) {
//            $this->return_data['ResponseCode'] = 1;
//            $this->return_data['GetPlacedOrderedWiseDetailData'] = $PlacedOrderWiseDetailData;
//            $this->return_data['Message'] = 'Success';
//        } else {
//            $this->return_data['ResponseCode'] = 0;
//            $this->return_data['Message'] = 'No Record Found';
//        }
//        return $this->return_data;
    }

    public function SearchBook($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
//        echo "<pre>";
//        print_r($json);
//        exit;
//        echo "SELECT Book.*,Stock.Quantity,Category.CategoryTitle FROM b_bookmaster AS Book INNER JOIN b_stock_master AS Stock ON Book.BookID= Stock.BookID INNER JOIN b_category AS Category ON Book.CategoryID = Category.CategoryID WHERE Book.is_active = 'Y' AND Category.CategoryTitle Like '%".$json['SearchText']."%' OR Book.BookTitle LIKE '%".$json['SearchText']."%' ";
        $SearchBookData = $this->_db->prepare("SELECT Book.*,Stock.Quantity,Category.CategoryTitle FROM b_bookmaster AS Book INNER JOIN b_stock_master AS Stock ON Book.BookID= Stock.BookID INNER JOIN b_category AS Category ON Book.CategoryID = Category.CategoryID WHERE Book.is_active = 'Y' AND Category.CategoryTitle Like '%" . $json['SearchText'] . "%' OR Book.BookTitle LIKE '%" . $json['SearchText'] . "%' OR Book.BookAutherName LIKE '%" . $json['SearchText'] . "%'");
        $SearchBookData->execute();
        $SearchBookWiseData = $SearchBookData->fetchAll(PDO::FETCH_ASSOC);
        if ($SearchBookWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetSearchBookWiseData'] = $SearchBookWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

}
