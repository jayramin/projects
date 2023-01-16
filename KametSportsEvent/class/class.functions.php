<?php

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

        $PageQuery = "SELECT `MenuID`,`Name`,`MenuAlias`,`MenuURL` FROM `v_menus` WHERE `is_active`='Y' AND `MenuAlias` = '" . $page . "'";
        $stmt = $this->_db->prepare($PageQuery);
        $stmt->execute();
        //$total = $stmt->rowCount();
        $Data = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION[SESSION_ALIAS]['MenuID'] = $Data['MenuID'];

        $MenuAccessQuery = "SELECT `RoleID`,`MenuID`,`AccessID` FROM `v_menu_access` WHERE `is_active`='Y' AND `RoleID` = '" . $role_id . "' AND FIND_IN_SET('" . $Data['MenuID'] . "', MenuID)";
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
        $UserRole = isset($_SESSION[SESSION_ALIAS]['session']['RoleID']) ? $_SESSION[SESSION_ALIAS]['session']['RoleID'] : '1';
        $Condition = " VMA.RoleID = '" . $UserRole . "' AND VM.Level = '" . $level . "' AND VM.ParentID = '" . $parent . "' AND VM.is_active = 'Y' ORDER BY VM.OrderNo, VM.MenuID ASC";
        // echo "SELECT `MenuID`,`Name`,`RoleID`,`AccessID`,`Level`,`MenuAlias`,`IconClass` FROM `v_menu_access` INNER JOIN `v_menus` ON FIND_IN_SET(v_menus.MenuID,v_menu_access.MenuID) WHERE " . $Condition;
        // exit;
        $MenuQuery = "SELECT `VM`.`MenuID`,`VM`.`Name`,`VMA`.`RoleID`,`VMA`.`AccessID`,`VM`.`Level`,`VM`.`MenuAlias`,`VM`.`IconClass` FROM `v_menu_access` AS VMA INNER JOIN `v_menus` AS VM ON FIND_IN_SET(VM.MenuID,VMA.MenuID) WHERE " . $Condition;
        $query2 = $this->_db->prepare($MenuQuery);
        $query2->execute();
        $row = $query2->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <ul id="<?php echo $id; ?>" class="<?php echo $class; ?>">
            <?php foreach ($row AS $Key => $Value) { ?>
                <?php
                $SubMenuQuery = "SELECT * FROM `v_menus` WHERE Level = '" . ($Value['Level'] + 1) . "' AND ParentID = '" . $Value['MenuID'] . "' AND is_active = 'Y'";
                $submenu_query = $this->_db->prepare($SubMenuQuery);
                $submenu_query->execute();
                $SubmenuRows = $submenu_query->rowCount();

                if ($SubmenuRows > 0) {
                    $Collapse = 'collapse';
                    $DownArrow = '<span class="fa arrow"></span>';
                    $AreaExpanded = 'aria-expanded="false"';
                } else {
                    $Collapse = '';
                    $DownArrow = '';
                    $AreaExpanded = 'aria-expanded="false"';
                }
                if ($Value['menu_alias'] == $_REQUEST['page']) {
                    $ActiveClass = 'active';
                } else {
                    $ActiveClass = '';
                }
                ?>
                <!-- listing of menu -->
                <li class="<?php echo $ActiveClass; ?>" title="<?php echo $Value['menu_name']; ?>">
                    <a href="<?php echo $Value['MenuAlias']; ?>" <?php $AreaExpanded; ?>><i class="<?php echo $Value['IconClass']; ?>"></i><?php echo $Value['Name']; ?><?php echo $DownArrow; ?></a>
                    <?php
                    if ($SubmenuRows > 0) {
                        $this->get_menu($Value['Level'] + 1, $Value['MenuID'], 'gn-submenu', '');
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
//        print_r($json);
//        exit;
//        if($json['CountryID'] != ''){
        $StateData = $this->_db->prepare("SELECT State.StateID,State.CountryID,State.StateName,State.is_active,Country.CountryName FROM v_state AS State INNER JOIN v_country AS Country ON State.CountryID = Country.CountryID WHERE State.is_active != 'D' AND State.CountryID='" . $json['CountryID'] . "'");
//        }else{
//            $StateData = $this->_db->prepare("SELECT State.StateID,State.CountryID,State.StateName,State.is_active,Country.CountryName FROM v_state AS State INNER JOIN v_country AS Country ON State.CountryID = Country.CountryID WHERE State.is_active != 'D'");
//        }
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
//        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);


        $CityData = $this->_db->prepare("SELECT City.CityID,City.CityName,State.StateName,Country.CountryName,City.is_active FROM v_city AS City INNER JOIN v_country AS Country ON City.CountryID = Country.CountryID INNER JOIN v_state AS State ON State.CountryID = City.CountryID WHERE City.StateID = '" . $json['StateID'] . "' AND City.CountryID = '" . $json['CountryID'] . "' AND City.is_active != 'D' GROUP BY City.CityName");

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
//        echo "SELECT * FROM v_area WHERE CityID = '" . $json['Condition']['CityID'] . "' AND is_active != 'D'";
        $AreaData = $this->_db->prepare("SELECT * FROM v_area WHERE CityID = '" . $json['CityID'] . "' AND is_active != 'D'");

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

    public function Registration() {
        $mysql = new DataTransaction($this->_db);
        $DOB = str_replace('/', '-', $_REQUEST['DOB']);
        $DateOfBirth = date("Y-m-d", strtotime($DOB));
        if (isset($_REQUEST['UserName']) && $_REQUEST['UserName'] != '' && $_REQUEST['FirstName'] != '' && $_REQUEST['Height'] != '' && $_REQUEST['DOB'] != '' && $_REQUEST['Password'] != '' && $_REQUEST['EmailID'] != '' && $_REQUEST['AddressLine1'] != '' && $_REQUEST['SecurityQuestionID'] != '' && $_REQUEST['SecretAnswer'] != '' && $_REQUEST['MobileNumber'] != '' && $_REQUEST['StateID'] != '' && $_REQUEST['CityID'] != '' && $_REQUEST['ProofID'] != '' && $_REQUEST['ProofID1'] != '' && $_REQUEST['Weight'] != '') {
            if (isset($_REQUEST['ProofIDImage']) && $_REQUEST['ProofIDImage'] == '') {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'Please Upload Proof Image';
            } else if (isset($_REQUEST['ProofIDImage1']) && $_REQUEST['ProofIDImage1'] == '') {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'Please Upload Second Proof Image';
            } else {
                //            $PasswordPattern = '/^(?=.*\d)(?=.*[a-z])[0-9A-Za-z@#\-_$%^&+=§!\?]{4,20}$/';
                $PasswordPattern = '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(?=\S+$).{4,}$/';

                $EmailPattern = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
                $UserNamePattern = '/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/';
                $EmailAddress = $_REQUEST['EmailID'];
                $Password = trim($_REQUEST['Password']);
                if (preg_match($PasswordPattern, $Password)) {
                    if (preg_match($EmailPattern, $EmailAddress)) {
                        if (preg_match($UserNamePattern, $_REQUEST['UserName'])) {
                            $UserData = $this->_db->prepare("SELECT EmailID FROM v_users WHERE EmailID = '" . $_REQUEST['EmailID'] . "'");
                            $UserData->execute();
                            $EmailUserData = $UserData->fetch(PDO::FETCH_ASSOC);
                            $num_rows = $UserData->rowCount();
                            if ($num_rows > 0) {
                                $this->return_data['ResponseCode'] = 0;
                                $this->return_data['Message'] = 'Email Already Registred';
                            } else {
                                $UserMobileData = $this->_db->prepare("SELECT MobileNumber FROM v_users WHERE MobileNumber = '" . $_REQUEST['MobileNumber'] . "'");
                                $UserMobileData->execute();
                                $MobileUserData = $UserMobileData->fetch(PDO::FETCH_ASSOC);
                                $num_rowsMobile = $UserMobileData->rowCount();
//                    echo $MobileUserData;
                                if ($num_rowsMobile > 0) {
                                    $this->return_data['ResponseCode'] = 0;
                                    $this->return_data['Message'] = 'Mobile Number Already Registered';
                                } else {
                                    $UserName = $this->_db->prepare("SELECT UserName FROM v_users WHERE UserName = '" . $_REQUEST['UserName'] . "'");
                                    $UserName->execute();
                                    $UserNameData = $UserName->fetch(PDO::FETCH_ASSOC);
                                    $num_rowsUserName = $UserName->rowCount();
//                    echo $MobileUserData;
                                    if ($num_rowsUserName > 0) {

                                        $this->return_data['ResponseCode'] = 0;
                                        $this->return_data['Message'] = 'User Already Registered With This User Name';
                                    } else {

                                        $EncryptedPassword = $this->Encrypt($Password);

                                        $data = array("RoleID" => 2, "UserName" => $_REQUEST['UserName'], "FirstName" => $_REQUEST['FirstName'], "MiddleName" => $_REQUEST['MiddleName'], "LastName" => $_REQUEST['LastName'], "Height" => $_REQUEST['Height'], "Weight" => $_REQUEST['Weight'], "Gender" => $_REQUEST['Gender'], "CaptainshipStatus" => 'N', "DOB" => $DateOfBirth, "Password" => $EncryptedPassword, "EmailID" => $_REQUEST['EmailID'], "NickName" => $_REQUEST['NickName'], "AddressLine1" => $_REQUEST['AddressLine1'], "LandMark" => $_REQUEST['LandMark'], "SecurityQuestionID" => $_REQUEST['SecurityQuestionID'], "SecretAnswer" => $_REQUEST['SecretAnswer'], "AboutMe" => $_REQUEST['AboutMe'], "MobileNumber" => $_REQUEST['MobileNumber'], "CountryID" => 1, "StateID" => $_REQUEST['StateID'], 'CityID' => $_REQUEST['CityID'], 'ProfilePicture' => trim($_REQUEST['ProfilePicture']), 'ProofID' => $_REQUEST['ProofID'], 'ProofIDImage' => trim($_REQUEST['ProofIDImage']), 'ProofID1' => $_REQUEST['ProofID1'], 'ProofIDImage1' => trim($_REQUEST['ProofIDImage1']), 'BodyType' => $_REQUEST['BodyType'], 'FavoritePosition' => $_REQUEST['FavoritePosition'], 'EmailVerificationStatus' => 'N', 'AdminApproval' => 'N', 'TermsConditionStatus' => 'Y','is_active' => 'Y', 'EntryDate' => date('Y-m-d'), 'IPAddress' => CreatedIP);
//                            print_r($data);
                                        $UserData = $mysql->insert($data, 'v_users');
//                                    print_r($UserData);
                                        $UserRows = sizeof($UserData);
//                                        echo $UserRows;
//                                        exit;
//                                        if ($UserRows > 0) {
                                        $body = '<html>';
                                        $body .= '<head>';
                                        $body .= MAIL_HEADER;
                                        $body .= '<body>';
                                        $body .= BODY_START;
                                        $body .= '<div>';
                                        $body .= '<label>Hello,' . $_REQUEST['FirstName'] . ' ' . $_REQUEST['LastName'] . ' </label><br><br>';
                                        $body .= '<span>Please click below link to activate your account.</span><br><br>';
                                        $body .= '<a style = "background:##8b245e; padding:5px 7px; color:#fff; text-decoration:none;" target = "_blank" href="' . SITE_URL . 'activate?token=' . base64_encode($UserData) . '">Click here</a><br><br>';
                                        $body .= BODY_FOOTER;
                                        $body .= '</div>';
                                        $body .= '</body>';
                                        $body .= '</head>';
                                        $body .= MAIL_FOOTER;

                                        $mysql->send_email($_REQUEST['EmailID'], '', $bcc, 'Activation', nl2br($body), 'Please check your email.! ', $attachment);
//                                        }
                                        if ($UserData) {
                                            $this->return_data['ResponseCode'] = 1;
                                            $this->return_data['UserData'] = $UserData;
                                            $this->return_data['Message'] = 'You Have Successfully Registered to Kamet Sports. Please Check Your Mailbox to Verify Your Account.';
                                        } else {
                                            $this->return_data['ResponseCode'] = 0;
                                            $this->return_data['Message'] = 'No Record Found';
                                        }
                                    }
                                }
                            }
                        } else {
                            $this->return_data['ResponseCode'] = 0;
                            $this->return_data['Message'] = 'User Name Not Allowed Space Or Special Symbols';
                        }
                    } else {
                        $this->return_data['ResponseCode'] = 0;
                        $this->return_data['Message'] = 'Email ID Not In Valid Format';
                    }
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'Password Must Contain Atleast 1 Capital, 1 Small, 1 Numeric And 1 Special Character ';
                }
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Please Provide All Required Fields';
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

    public function AprroveRequest($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $AprroveUser = $mysql->update('v_users', array("AdminApproval" => 'Y'), array("UserID" => $_REQUEST['UserID'], "is_active" => 'Y', "TeamTournamentRelationID" => $_REQUEST['TeamTournamentRelationID']));
        $AprrovePlayer = $mysql->update('v_teams_tournament_relation_temp', array("AdminStatus" => 'Y'), array("PlayerID" => $_REQUEST['UserID'], "is_active" => 'Y'));

        $UserNameQueryForApproval = $this->_db->prepare("SELECT CONCAT(FirstName,' ',LastName) AS PlayerName FROM v_users WHERE is_active = 'Y' AND UserID = '" . $_REQUEST['UserID'] . "'");
        $UserNameQueryForApproval->execute();
        $UserNameDataForApproval = $UserNameQueryForApproval->fetch(PDO::FETCH_ASSOC);

        $TeamNameQueryForApproval = $this->_db->prepare("SELECT TeamName FROM v_teams WHERE is_active = 'Y' AND TeamID = '" . $_REQUEST['TeamID'] . "'");
        $TeamNameQueryForApproval->execute();
        $TeamNameDataForApproval = $TeamNameQueryForApproval->fetch(PDO::FETCH_ASSOC);
        $CaptainNameQueryForApproval = $this->_db->prepare("SELECT CONCAT(FirstName,' ',LastName) AS CaptainName FROM v_users WHERE is_active = 'Y' AND UserID = '" . $json['CaptainID'] . "'");
        $CaptainNameQueryForApproval->execute();
        $CaptainNameDataForApproval = $CaptainNameQueryForApproval->fetch(PDO::FETCH_ASSOC);

        $TournamentNameQueryForApproval = $this->_db->prepare("SELECT TournamentName FROM v_tournaments WHERE is_active = 'Y' AND TournamentID = '" . $_REQUEST['TournamentID'] . "'");
        $TournamentNameQueryForApproval->execute();
        $TournamentNameDataForApproval = $TournamentNameQueryForApproval->fetch(PDO::FETCH_ASSOC);

        $NotificationTextForPlayer = "Hello '" . $UserNameDataForApproval['PlayerName'] . "', Of '" . $TeamNameDataForApproval['TeamName'] . "' Your Request has been approved by admin for '" . $TournamentNameDataForApproval['TournamentName'] . "'";

        $NotificationDataApprovalPlayer = array("NotificationTitle" => 'Tournament Notifications', "NotificationType" => 'TournamentNotification', "NotificationText" => $NotificationTextForPlayer, "SenderID" => $_SESSION['KametSports']['session']['UserID'], "ReceiverID" => $json['UserID'], "is_active" => 'Y', "DeleteStatus" => 'N', "NotificationCreatedDate" => date('Y-m-d'));
        $NotificationDataApprovalPlayerData = $mysql->insert($NotificationDataApprovalPlayer, 'v_general_notifications');

        $NotificationTextApprovalForCaptain = "Hello '" . $CaptainNameDataForApproval['CaptainName'] . "', Your '" . $TeamNameDataForApproval['TeamName'] . "' Team Player '" . $UserNameDataForApproval['PlayerName'] . "' has been aproved by Admin for Tournament '" . $TournamentNameDataForApproval['TournamentName'] . "'";

        $NotificationDataApprovalForCaptain = array("NotificationTitle" => 'Tournament', "NotificationType" => 'TournamentNotification', "NotificationText" => $NotificationTextApprovalForCaptain, "SenderID" => $_SESSION['KametSports']['session']['UserID'], "ReceiverID" => $json['CaptainID'], "is_active" => 'Y', "DeleteStatus" => 'N', "NotificationCreatedDate" => date('Y-m-d'));
        $ApprovalNotificationDataCaptain = $mysql->insert($NotificationDataApprovalForCaptain, 'v_general_notifications');
        if ($AprroveUser > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetUserData'] = $AprroveUser;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Updatation Faild';
        }
        return $this->return_data;
    }

    public function DeclineReason($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        if ($json['EmailID'] != '' && $json['DeclineReason'] != '') {
            $DeclineUser = $mysql->update('v_users', array("DeclineReason" => $_REQUEST['DeclineReason']), array("EmailID" => $_REQUEST['EmailID'], "is_active" => 'Y'));
            $DeclinePlayer = $mysql->update('v_teams_tournament_relation_temp', array("AdminStatus" => 'R', "RejectionReason" => $_REQUEST['DeclineReason'], "is_active" => 'N'), array("PlayerID" => $_REQUEST['UserID'], "TeamID" => $_REQUEST['TeamID'],"TeamTournamentRelationID" => $_REQUEST['TeamTournamentRelationID']));

            $UserNameQueryForDecline = $this->_db->prepare("SELECT CONCAT(FirstName,' ',LastName) AS PlayerName FROM v_users WHERE is_active = 'Y' AND UserID = '" . $_REQUEST['UserID'] . "'");
            $UserNameQueryForDecline->execute();
            $UserNameDataForDecline = $UserNameQueryForDecline->fetch(PDO::FETCH_ASSOC);


            $TeamNameQueryForDecline = $this->_db->prepare("SELECT TeamName FROM v_teams WHERE is_active = 'Y' AND TeamID = '" . $_REQUEST['TeamID'] . "'");
            $TeamNameQueryForDecline->execute();
            $TeamNameDataForDecline = $TeamNameQueryForDecline->fetch(PDO::FETCH_ASSOC);

            $CaptainNameQueryForDecline = $this->_db->prepare("SELECT CONCAT(FirstName,' ',LastName) AS CaptainName FROM v_users WHERE is_active = 'Y' AND UserID = '" . $json['CaptainID'] . "'");
            $CaptainNameQueryForDecline->execute();
            $CaptainNameDataForDecline = $CaptainNameQueryForDecline->fetch(PDO::FETCH_ASSOC);

            $TournamentNameQueryForDecline = $this->_db->prepare("SELECT TournamentName FROM v_tournaments WHERE is_active = 'Y' AND TournamentID = '" . $_REQUEST['TournamentID'] . "'");
            $TournamentNameQueryForDecline->execute();
            $TournamentNameDataForDecline = $TournamentNameQueryForDecline->fetch(PDO::FETCH_ASSOC);

            $NotificationTextForPlayer = "Hello '" . $UserNameDataForDecline['PlayerName'] . "', Of '" . $TeamNameDataForDecline['TeamName'] . "' has been rejected by Admin for Tournament '" . $TournamentNameDataForDecline['TournamentName'] . "'. Kindly follow the rules appropriately or try again next time.";

            $NotificationDataDeclineReasonPlayer = array("NotificationTitle" => 'Tournament', "NotificationType" => 'TournamentNotification', "NotificationText" => $NotificationTextForPlayer, "SenderID" => $_SESSION['KametSports']['session']['UserID'], "ReceiverID" => $json['UserID'], "is_active" => 'Y', "DeleteStatus" => 'N', "NotificationCreatedDate" => date('Y-m-d'));
            $NotificationDataDeclineReasonPlayerData = $mysql->insert($NotificationDataDeclineReasonPlayer, 'v_general_notifications');

            $NotificationTextForCaptain = "Hello '" . $CaptainNameDataForDecline['CaptainName'] . "', Your '" . $TeamNameDataForDecline['TeamName'] . "' Team Player '" . $UserNameDataForDecline['PlayerName'] . "' has been rejected by Admin for Tournament '" . $TournamentNameDataForDecline['TournamentName'] . "'. Kindly follow the rules appropriately or try again next time.";

            $NotificationDataDeclineReasonForCaptain = array("NotificationTitle" => 'Tournament', "NotificationType" => 'TournamentNotification', "NotificationText" => $NotificationTextForCaptain, "SenderID" => $_SESSION['KametSports']['session']['UserID'], "ReceiverID" => $json['CaptainID'], "is_active" => 'Y', "DeleteStatus" => 'N', "NotificationCreatedDate" => date('Y-m-d'));
            $DeclineReasonNotificationDataCaptain = $mysql->insert($NotificationDataDeclineReasonForCaptain, 'v_general_notifications');

            $body = '<html>';
            $body .= '<head>';
            $body .= MAIL_HEADER;
            $body .= '<body>';
            $body .= BODY_START;
            $body .= '<div>';
            $body .= 'Hello' . ' ' . $_REQUEST['FirstName'] . ' ' . $_REQUEST['LastName'] . '<br>';
            $body .= '<span>your account is decline form admin for below reason.</span><br><br>';
            $body .= $_REQUEST['DeclineReason'] . '<br><br>';
            $body .= BODY_FOOTER;
            $body .= '</div>';
            $body .= '</body>';
            $body .= '</head>';
            $body .= MAIL_FOOTER;
            $bcc = '';
            $attachment = '';
            $mysql->send_email($_REQUEST['EmailID'], '', $bcc, 'Decline Reason', nl2br($body), 'Please check your email.! ', $attachment);

            $AdminEmailString = "SELECT UserID,UserName,FirstName,LastName,MiddleName,EmailID,MobileNumber,RoleID,DOB,is_active FROM v_users WHERE is_active = 'Y' AND UserID ='" . $json['CaptainID'] . "'";
            $AdminEmail = $this->_db->prepare($AdminEmailString);
            $AdminEmail->execute();
            $AdminEmailData = $AdminEmail->fetch(PDO::FETCH_ASSOC);

            $body = '<html>';
            $body .= '<head>';
            $body .= MAIL_HEADER;
            $body .= '<body>';
            $body .= BODY_START;
            $body .= '<div>';
            $body .= 'Hello' . ' ' . $AdminEmailData['FirstName'] . ' ' . $AdminEmailData['LastName'] . '<br>';
            $body .= '<span>Your Team Player (' . $_REQUEST['FirstName'] . ' ' . $_REQUEST['LastName'] . ') Decline By Admin for the Tournament.</span><br><br>';
            $body .= $_REQUEST['DeclineReason'] . '<br><br>';
            $body .= BODY_FOOTER;
            $body .= '</div>';
            $body .= '</body>';
            $body .= '</head>';
            $body .= MAIL_FOOTER;
            $mysql->send_email($AdminEmailData['EmailID'], '', $bcc, 'Decline Reason', nl2br($body), 'Please check your email.! ', $attachment);
            if ($DeclinePlayer > 0) {
                $this->return_data['ResponseCode'] = 1;
                $this->return_data['GetUserData'] = $DeclinePlayer;
                $this->return_data['Message'] = 'Success';
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'Updatation Faild';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Email Id And Decline Reason Required';
        }
        return $this->return_data;
    }

    public function GetAllIDProofTypeData() {
        $mysql = new DataTransaction($this->_db);
        $ProofTypeData = $this->_db->prepare("SELECT ProofID,ProofType,DocumentName,is_active FROM v_proof_type WHERE is_active = 'Y' AND ProofType='ID'");
        $ProofTypeData->execute();
        $ProofTypeWiseData = $ProofTypeData->fetchAll(PDO::FETCH_ASSOC);
        if ($ProofTypeWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetProofTypeWiseData'] = $ProofTypeWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function GetAllAddressProofTypeData() {
        $mysql = new DataTransaction($this->_db);
        $AddressProofTypeData = $this->_db->prepare("SELECT ProofID,ProofType,DocumentName,is_active FROM v_proof_type WHERE is_active = 'Y' AND ProofType='ADDRESS'");
        $AddressProofTypeData->execute();
        $AddressProofTypeWiseData = $AddressProofTypeData->fetchAll(PDO::FETCH_ASSOC);
        if ($AddressProofTypeWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAddressProofTypeWiseData'] = $AddressProofTypeWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function GetAllSecurityQuestionData() {
        $SecurityData = $this->_db->prepare("SELECT SecurityQuestionID,Question,is_active FROM v_security_question WHERE is_active ='Y' ");
        $SecurityData->execute();
        $SecurityQuestionData = $SecurityData->fetchAll(PDO::FETCH_ASSOC);
        if ($SecurityQuestionData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetSecurityWiseData'] = $SecurityQuestionData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetUserProfileData($Condition = "") {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $UserData = $this->_db->prepare("SELECT User.UserName,User.FirstName,User.MiddleName,User.LastName,User.Height,User.Weight,User.Gender,User.CaptainshipStatus,User.DOB,User.EmailID,User.NickName,User.AddressLine1,User.LandMark,User.SecurityQuestionID,User.SecretAnswer,User.MobileNumber,User.StateID,User.CityID,(CASE WHEN User.ProfilePicture = '' THEN '" . SITE_URL . "admin/uploads/ProfilePic/Placeholder.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/ProfilePic/',ProfilePicture) END) AS ProfilePicture,(CASE WHEN User.ProfilePicture = '' THEN 'Placeholder.png' ELSE ProfilePicture END) AS ProfilePicName,User.ProofID,(CASE WHEN User.ProofIDImage = '' THEN '" . SITE_URL . "admin/uploads/placeholder3.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/IDPreoofImage/',ProofIDImage) END) AS ProofIDImage,User.ProofID1,(CASE WHEN User.ProofIDImage = '' THEN 'placeholder3.png' ELSE ProofIDImage END) AS ProofIDImageName,User.ProofID1,(CASE WHEN User.ProofIDImage1 = '' THEN '" . SITE_URL . "admin/uploads/placeholder3.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/IDPreoofImage/',ProofIDImage1) END) AS ProofIDImage1,User.ProofID1,(CASE WHEN User.ProofIDImage1 = '' THEN 'placeholder3.png' ELSE ProofIDImage1 END) AS ProofIDImage1Name,User.DeclineReason,State.StateName,City.CityName,Question.Question,(SELECT DocumentName FROM v_proof_type as type WHERE type.ProofID = User.ProofID) as DocumentName1, (CASE WHEN User.ProofID1 !='0' THEN (SELECT DocumentName FROM v_proof_type as type WHERE type.ProofID = User.ProofID1) ELSE '' END) as DocumentName2,User.AboutMe,User.BodyType,User.FavoritePosition FROM v_users AS User INNER JOIN v_state As State  ON State.StateID =User.StateID INNER JOIN v_city As City ON City.CityID=User.CityID INNER JOIN v_security_question As Question ON Question.SecurityQuestionID= User.SecurityQuestionID INNER JOIN v_proof_type As Proof ON Proof.ProofID= User.ProofID WHERE UserID = '" . $json['UserID'] . "'");

        $UserData->execute();
        $UserWiseData = $UserData->fetch(PDO::FETCH_ASSOC);
        if ($UserWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['UserWiseData'] = $UserWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function update_user_data() {
        $mysql = new DataTransaction($this->_db);
        $DOB = date("Y-m-d", strtotime($_REQUEST['DOB']));
        $MiddleName = isset($_REQUEST['MiddleName']) && $_REQUEST['MiddleName'] != 'empty' ? $_REQUEST['MiddleName'] : '';
        $LastName = isset($_REQUEST['LastName']) && $_REQUEST['LastName'] != 'empty' ? $_REQUEST['LastName'] : '';
        $Weight = isset($_REQUEST['Weight']) && $_REQUEST['Weight'] != 'empty' ? $_REQUEST['Weight'] : '';
        $ProfilePicture = isset($_REQUEST['ProfilePicture']) && $_REQUEST['ProfilePicture'] != 'empty' ? $_REQUEST['ProfilePicture'] : '';
        $ProofID1 = isset($_REQUEST['ProofID1']) && $_REQUEST['ProofID1'] != 'empty' ? $_REQUEST['ProofID1'] : '';
        $ProofIDImage1 = isset($_REQUEST['ProofIDImage1']) && $_REQUEST['ProofIDImage1'] != 'empty' ? $_REQUEST['ProofIDImage1'] : '';
        if (isset($_REQUEST['UserName']) && $_REQUEST['UserName'] != '' && $_REQUEST['FirstName'] != '' && $_REQUEST['Height'] != '' && $DOB != '' && $_REQUEST['AddressLine1'] != '' && $_REQUEST['MobileNumber'] != '' && $_REQUEST['StateID'] != '' && $_REQUEST['CityID'] != '' && $_REQUEST['UserID'] != '' && $_REQUEST['ProofID'] != '' && $_REQUEST['ProofIDImage'] != '' && $_REQUEST['ProofID1'] != '' && $_REQUEST['ProofIDImage1'] != '') {

            $data = array("RoleID" => 2, "UserName" => $_REQUEST['UserName'], "FirstName" => $_REQUEST['FirstName'], "MiddleName" => $MiddleName, "LastName" => $LastName, "Height" => $_REQUEST['Height'], "Weight" => $Weight, "Gender" => $_REQUEST['Gender'], "DOB" => $DOB, "NickName" => $_REQUEST['NickName'], "AddressLine1" => $_REQUEST['AddressLine1'], "LandMark" => $_REQUEST['LandMark'], "SecurityQuestionID" => $_REQUEST['SecurityQuestionID'], "SecretAnswer" => $_REQUEST['SecretAnswer'], "MobileNumber" => $_REQUEST['MobileNumber'], "CountryID" => 1, "StateID" => $_REQUEST['StateID'], 'CityID' => $_REQUEST['CityID'], 'ProofID' => $_REQUEST['ProofID'], 'ProofIDImage' => $_REQUEST['ProofIDImage'], 'ProofID1' => $_REQUEST['ProofID1'], 'ProofIDImage1' => $_REQUEST['ProofIDImage1'], 'ProfilePicture' => trim($ProfilePicture), 'AboutMe' => $_REQUEST['AboutMe'], 'BodyType' => $_REQUEST['BodyType'], 'FavoritePosition' =>$_REQUEST['FavoritePosition'], 'EntryDate' => date('Y-m-d'), 'IPAddress' => CreatedIP);
            $UpdateData = $mysql->update('v_users', $data, array("UserID" => $_REQUEST['UserID'], "is_active" => 'Y'));
            $UserRows = sizeof($UpdateData);
            if ($UserRows > 0) {
                $this->return_data['ResponseCode'] = 1;
                $this->return_data['UserData'] = $UpdateData;
                $this->return_data['Message'] = 'Your Profile Updated Successfully !';
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Please Provide All Required Fields';
        }
        return $this->return_data;
    }

    public function GetAllTournamnetTypeData() {
        $TournamentTypeData = $this->_db->prepare("SELECT SrNo,TypeName,TypeDescription,is_active FROM v_tournament_type WHERE is_active != 'D'");
        $TournamentTypeData->execute();
        $TournamentTypeWiseData = $TournamentTypeData->fetchAll(PDO::FETCH_ASSOC);
        if ($TournamentTypeWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentTypeWiseData'] = $TournamentTypeWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllTournamnetData() {

        $TournamentData = $this->_db->prepare("SELECT TournamentID,TournamentName,Description,TournamentFor,TypeID,RegistrationFees,OrganizerID,WinnerPrize,RunnerUpsPrize,is_active FROM v_tournaments WHERE is_active != 'D'");

        $TournamentData->execute();
        $TournamentWiseData = $TournamentData->fetchAll(PDO::FETCH_ASSOC);
        if ($TournamentWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentWiseData'] = $TournamentWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllGroupsData($Condition = '') {
        $json = json_decode($Condition, true);
        $GroupData = $this->_db->prepare("SELECT TournamentID, GroupID,(SELECT TournamentName FROM v_tournaments WHERE v_tournaments.TournamentID = v_groups.TournamentID) as TournamentName,GroupName,GroupDescription,is_active FROM v_groups WHERE  is_active != 'D' AND TournamentID='" . $json['TournamentID'] . "'");

        $GroupData->execute();
        $GroupWiseData = $GroupData->fetchAll(PDO::FETCH_ASSOC);
        if (count($GroupWiseData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGroupWiseData'] = $GroupWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function TournamentStartDateByTournamentID($Condition = '') {
        $json = json_decode($Condition, true);
        $TournamentData = $this->_db->prepare("SELECT Tournament.TournamentID,Tournament.TournamentName,Tournament.StartDate,Tournament.EndDate,Tournament.Description,Tournament.TournamentFor,Tournament.SecondRunnerUpsPrize,Tournament.RegistrationFees,Tournament.MaximumPlayers,Tournament.MinimumPlayers,Tournament.WinnerPrize,Tournament.RunnerUpsPrize,(CASE WHEN Tournament.TournamentImage = '' THEN '" . SITE_URL . "admin/uploads/placeholder3.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/TournamentImage/',Tournament.TournamentImage) END) AS TournamentImage,Tournament.StateID,Tournament.CityID,GROUP_CONCAT(DISTINCT State.StateName) AS StateName,GROUP_CONCAT(DISTINCT City.CityName) AS CityName ,TournamentType.TypeName,Tournament.RegistrationStartDate,Tournament.RegistrationEndDate FROM v_tournaments AS Tournament LEFT JOIN v_state AS State ON find_in_set(State.StateID,Tournament.StateID) LEFT JOIN v_city AS City ON find_in_set(City.CityID,Tournament.CityID) INNER JOIN v_tournament_type AS TournamentType ON Tournament.TypeID = TournamentType.SrNo WHERE Tournament.TournamentID= '" . $json['TournamentID'] . "' AND StartDate !='0000-00-00' AND EndDate != '0000-00-00' GROUP BY Tournament.TournamentID");
        $TournamentData->execute();
        $TournamentStartData = $TournamentData->fetch(PDO::FETCH_ASSOC);
        if (count($TournamentStartData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['TournamentStartDateData'] = $TournamentStartData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllSetData() {
//        echo "SELECT SetMaster.*,Tournaments.TournamentID, Tournaments.TournamentName FROM v_set_master AS SetMaster INNER JOIN v_tournaments AS Tournaments ON SetMaster.TournamentID = Tournaments.TournamentID WHERE SetMaster.is_active != 'D'";
        $GroupData = $this->_db->prepare("SELECT SetMaster.*,Tournaments.TournamentID, Tournaments.TournamentName FROM v_set_master AS SetMaster INNER JOIN v_tournaments AS Tournaments ON SetMaster.TournamentID = Tournaments.TournamentID WHERE SetMaster.is_active != 'D'");

        $GroupData->execute();
        $GroupWiseData = $GroupData->fetchAll(PDO::FETCH_ASSOC);
        if (count($GroupWiseData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetSetWiseData'] = $GroupWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllCourtData() {

        $CourtQuery = $this->_db->prepare("SELECT CourtMaster.*,State.StateName, City.CityName FROM v_court_master AS CourtMaster INNER JOIN v_state AS State ON CourtMaster.StateID = State.StateID INNER JOIN v_city AS City ON CourtMaster.CityID=City.CityID WHERE CourtMaster.is_active != 'D'");

        $CourtQuery->execute();
        $CourtData = $CourtQuery->fetchAll(PDO::FETCH_ASSOC);
        if (count($CourtData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCourtData'] = $CourtData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllGroundData() {

        $GroundQuery = $this->_db->prepare("SELECT GroundMaster.*,State.StateName, City.CityName FROM v_ground_master AS GroundMaster INNER JOIN v_state AS State ON GroundMaster.StateID = State.StateID INNER JOIN v_city AS City ON GroundMaster.CityID=City.CityID WHERE GroundMaster.is_active != 'D'");

        $GroundQuery->execute();
        $GroundData = $GroundQuery->fetchAll(PDO::FETCH_ASSOC);
        if (count($GroundData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGroundData'] = $GroundData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertCourtData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("CourtName" => $_REQUEST['CourtName'], "StateID" => $_REQUEST['StateID'], "CityID" => $_REQUEST['CityID'], "GroundID" => $_REQUEST['GroundID'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'));
        $CourtData = $mysql->insert($data, 'v_court_master');
        if ($CourtData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCourtInsertData'] = $CourtData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UpdateCourtData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("CourtName" => $_REQUEST['CourtName'], "StateID" => $_REQUEST['StateID'], "CityID" => $_REQUEST['CityID'], "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $CourtUpdateData = $mysql->update('v_court_master', $data, array("CourtID" => $_REQUEST['CourtID'], "is_active" => "Y"));
        if ($CourtUpdateData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetCourtUpdateData'] = $CourtUpdateData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertGroundData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("GroundName" => $_REQUEST['GroundName'], "StateID" => $_REQUEST['StateID'], "CityID" => $_REQUEST['CityID'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'));
        $GroundData = $mysql->insert($data, 'v_ground_master');
        if ($GroundData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGroundInsertData'] = $GroundData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UpdateGroundData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("GroundName" => $_REQUEST['GroundName'], "StateID" => $_REQUEST['StateID'], "CityID" => $_REQUEST['CityID'], "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $GroundUpdateData = $mysql->update('v_ground_master', $data, array("GroundID" => $_REQUEST['GroundID'], "is_active" => "Y"));
        if ($GroundUpdateData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGroundUpdateData'] = $GroundUpdateData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllGroupsByTournamentID($TournamentID) {
        $GroupData = $this->_db->prepare("SELECT GroupID,(SELECT TournamentName FROM v_tournaments WHERE v_tournaments.TournamentID = v_groups.TournamentID) as TournamentName,GroupName,GroupDescription,is_active FROM v_groups WHERE is_active != 'D' AND TournamentID = " . $TournamentID);
        $GroupData->execute();
        $TournamentWiseGroupData = $GroupData->fetchAll(PDO::FETCH_ASSOC);
        if (count($TournamentWiseGroupData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentWiseGroupData'] = $TournamentWiseGroupData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
// Comment ON 04-01-2016 By Ronit
//    public function GetAllUnallocatedTeamsByTournamentID($TournamentID) {
//        $TeamsData = $this->_db->prepare("SELECT v_teams.TeamID,v_teams.TeamName,vgtr.TeamID as GrpTeamID FROM v_teams inner join (Select TournamentID,TeamID,COUNT(PlayerID) as TotalPlayer from v_teams_tournament_relation where AdminStatus = 'Y' group by TournamentID,TeamID ) as Vttr on Vttr.TeamID = v_teams.TeamID inner join v_tournaments on Vttr.TournamentID = v_tournaments.TournamentID left join v_groups_team_relation as vgtr on v_teams.TeamID = vgtr.TeamID AND vgtr.is_active != 'D' where Vttr.TotalPlayer >= v_tournaments.MinimumPlayers  AND vttr.TournamentID = " . $TournamentID);
//        $TeamsData->execute();
//        $TournamentWiseTeamsData = $TeamsData->fetchAll(PDO::FETCH_ASSOC);
//        if (count($TournamentWiseTeamsData) > 0) {
//            $this->return_data['ResponseCode'] = 1;
//            $this->return_data['GetTournamentWiseTeamsData'] = $TournamentWiseTeamsData;
//        } else {
//            $this->return_data['ResponseCode'] = 0;
//            $this->return_data['Message'] = 'No Record Found';
//        }
//        return $this->return_data;
//    }
    
    public function GetAllUnallocatedTeamsByTournamentID($TournamentID) {
        $TeamsData = $this->_db->prepare("SELECT p.TeamID,p.CaptainID,t.TeamName FROM v_tournament_payment as p INNER JOIN v_teams as t ON t.TeamID = p.TeamID LEFT JOIN v_groups_team_relation as r ON r.TeamID = p.TeamID AND p.TournamentID = r.TournamentID AND r.is_active != 'D' WHERE p.status='Approved' and p.TournamentID=".$TournamentID." AND r.TeamID is NULL");
        $TeamsData->execute();
        $TournamentWiseTeamsData = $TeamsData->fetchAll(PDO::FETCH_ASSOC);
        if (count($TournamentWiseTeamsData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentWiseTeamsData'] = $TournamentWiseTeamsData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllallocatedTeamsByTournamentID($TournamentID, $GroupID) {
        $allocatedTeamsData = $this->_db->prepare("SELECT GroupTeamRelationID,TeamID,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = v_groups_team_relation.TeamID) as TeamName FROM v_groups_team_relation WHERE TournamentID = " . $TournamentID . " AND GroupID = " . $GroupID . " AND is_active != 'D'");
        $allocatedTeamsData->execute();
        $TournamentAndGroupWiseAllocatedTeamsData = $allocatedTeamsData->fetchAll(PDO::FETCH_ASSOC);
        if (count($TournamentAndGroupWiseAllocatedTeamsData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentAndGroupWiseAllocatedTeamsData'] = $TournamentAndGroupWiseAllocatedTeamsData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetGroupNameByGroupID($GroupID) {
        $GroupDetails = $this->_db->prepare("SELECT GroupName FROM v_groups WHERE v_groups.GroupID = " . $GroupID);
        $GroupDetails->execute();
        $GroupIDWiseGroupData = $GroupDetails->fetch(PDO::FETCH_ASSOC);
        if (count($GroupIDWiseGroupData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGroupIDWiseGroupData'] = $GroupIDWiseGroupData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertTournamentData() {
        $mysql = new DataTransaction($this->_db);
        $StartDate = str_replace('/', '-', $_REQUEST['StartDate']);
        $EndDate = str_replace('/', '-', $_REQUEST['EndDate']);
        $RegistrationStartDate = str_replace('/', '-', $_REQUEST['RegistrationStartDate']);
        $RegistrationEndDate = str_replace('/', '-', $_REQUEST['RegistrationEndDate']);
        $Start = date("Y-m-d", strtotime($StartDate));
        $End = date("Y-m-d", strtotime($EndDate));
        $RegistStart = date("Y-m-d", strtotime($RegistrationStartDate));
        $RegistEnd = date("Y-m-d", strtotime($RegistrationEndDate));

        $data = array("TournamentName" => $_REQUEST['TournamentName'], "Description" => $_REQUEST['Description'], "TournamentFor" => $_REQUEST['TournamentFor'], "TypeID" => $_REQUEST['TypeID'], "RegistrationFees" => $_REQUEST['RegistrationFees'], "StateID" => $_REQUEST['StateID'], "CityID" => $_REQUEST['CityID'], "WinnerPrize" => $_REQUEST['WinnerPrize'], "RunnerUpsPrize" => $_REQUEST['RunnerUpsPrize'], "SecondRunnerUpsPrize" => $_REQUEST['SecondRunnerUpsPrize'], "PlayerOfTheTournamnetPrice" => $_REQUEST['PlayerOfTheTournamnetPrice'], "StartDate" => $Start, "EndDate" => $End, "RegistrationStartDate" => $RegistStart, "RegistrationEndDate" => $RegistEnd, "MaximumPlayers" => $_REQUEST['MaximumPlayers'], "MinimumPlayers" => $_REQUEST['MinimumPlayers'], "TournamentRules" => $_REQUEST['TournamentRules'], "TournamentImage" => $_REQUEST['TournamentImage'], "OrganizerID" => $_REQUEST['OrganizerID'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'));

        $TournamentData = $mysql->insert($data, 'v_tournaments');        
        $TournamentRows = sizeof($TournamentData);
        
        $UpcomingNotificationText = "Hello Users New Tournament '".$_REQUEST['TournamentName']."' Declared";
        $NotificationData = array("NotificationTitle" => 'Upcoming Tournament', "NotificationType" => 'UpcomingTournament', "NotificationText" => $UpcomingNotificationText, "SenderID" => $_SESSION['KametSports']['session']['UserID'], "ReceiverID" => '',"SendTo" => 'All' ,"is_active" => 'Y', "DeleteStatus" => 'N', "NotificationCreatedDate" => date('Y-m-d'));
        $UserNotificationData = $mysql->insert($NotificationData, 'v_general_notifications');
                
        if ($TournamentRows > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentWiseData'] = $TournamentData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UpdateTournamentData() {
        $mysql = new DataTransaction($this->_db);
        $StartDate = str_replace('/', '-', $_REQUEST['StartDate']);
        $EndDate = str_replace('/', '-', $_REQUEST['EndDate']);
        $RegistrationStartDate = str_replace('/', '-', $_REQUEST['RegistrationStartDate']);
        $RegistrationEndDate = str_replace('/', '-', $_REQUEST['RegistrationEndDate']);
        $Start = date("Y-m-d", strtotime($StartDate));
        $End = date("Y-m-d", strtotime($EndDate));
        $RegistStart = date("Y-m-d", strtotime($RegistrationStartDate));
        $RegistEnd = date("Y-m-d", strtotime($RegistrationEndDate));

        $data = array("TournamentName" => $_REQUEST['TournamentName'], "Description" => $_REQUEST['Description'], "TournamentFor" => $_REQUEST['TournamentFor'], "TypeID" => $_REQUEST['TypeID'], "RegistrationFees" => $_REQUEST['RegistrationFees'], "StateID" => $_REQUEST['StateID'], "CityID" => $_REQUEST['CityID'], "WinnerPrize" => $_REQUEST['WinnerPrize'], "RunnerUpsPrize" => $_REQUEST['RunnerUpsPrize'], "PlayerOfTheTournamnetPrice" => $_REQUEST['PlayerOfTheTournamnetPrice'], "StartDate" => $Start, "EndDate" => $End, "RegistrationStartDate" => $RegistStart, "RegistrationEndDate" => $RegistEnd, "MaximumPlayers" => $_REQUEST['MaximumPlayers'], "MinimumPlayers" => $_REQUEST['MinimumPlayers'], "TournamentRules" => $_REQUEST['TournamentRules'], "TournamentImage" => $_REQUEST['TournamentImage'], "OrganizerID" => $_REQUEST['OrganizerID'], "is_active" => 'Y', "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $TournamentUpdateData = $mysql->update('v_tournaments', $data, array("TournamentID" => $_REQUEST['TournamentID'], "is_active" => "Y"));
        $TournamentRows = sizeof($TournamentUpdateData);
        if ($TournamentRows > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentWiseData'] = $TournamentUpdateData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertGroupData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("TournamentID" => $_REQUEST['TournamentID'], "GroupName" => $_REQUEST['GroupName'], "GroupDescription" => $_REQUEST['GroupDescription'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $GroupData = $mysql->insert($data, 'v_groups');
        if ($GroupData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGroupInsertData'] = $GroupData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UpdateGroupData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("TournamentID" => $_REQUEST['TournamentID'], "GroupName" => $_REQUEST['GroupName'], "GroupDescription" => $_REQUEST['GroupDescription'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $GroupUpdateData = $mysql->update('v_groups', $data, array("GroupID" => $_REQUEST['GroupID'], "is_active" => "Y"));
        if ($GroupUpdateData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGroupUpdateData'] = $GroupUpdateData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertRoundData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("TournamentID" => $_REQUEST['TournamentID'], "RoundName" => $_REQUEST['RoundName'], "PlayMatchType" => $_REQUEST['PlayMatchType'], "SetID" => $_REQUEST['SetID'], "MatchType" => $_REQUEST['MatchType'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $RoundData = $mysql->insert($data, 'v_rounds');
        if ($RoundData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRoundInsertData'] = $RoundData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UpdateRoundData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("TournamentID" => $_REQUEST['TournamentID'], "RoundName" => $_REQUEST['RoundName'], "PlayMatchType" => $_REQUEST['PlayMatchType'], "SetID" => $_REQUEST['SetID'], "MatchType" => $_REQUEST['MatchType'], "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $RoundUpdateData = $mysql->update('v_rounds', $data, array("RoundID" => $_REQUEST['RoundID'], "is_active" => "Y"));
        if ($RoundUpdateData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRoundUpdateData'] = $RoundUpdateData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertSetData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("TournamentID" => $_REQUEST['TournamentID'], "NoOfSets" => $_REQUEST['NoOfSets'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $SetData = $mysql->insert($data, 'v_set_master');
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

    public function UpdateSetData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("TournamentID" => $_REQUEST['TournamentID'], "RoundID" => $_REQUEST['RoundID'], "NoOfSets" => $_REQUEST['NoOfSets'], "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $SetUpdateData = $mysql->update('v_set_master', $data, array("SetID" => $_REQUEST['SetID'], "is_active" => "Y"));
        if ($SetUpdateData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetSetUpdateData'] = $SetUpdateData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertRoundPointsData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("TournamentID" => $_REQUEST['TournamentID'], "RoundID" => $_REQUEST['RoundID'], "GamesWonPoints" => $_REQUEST['GamesWonPoints'], "GamesLostPoints" => $_REQUEST['GamesLostPoints'], "TotalPoints" => $_REQUEST['TotalPoints'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $RoundPointsData = $mysql->insert($data, 'v_round_points_parameters');
        if ($RoundPointsData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRoundPointsInsertData'] = $RoundPointsData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function UpdateRoundPointsData() {
        $mysql = new DataTransaction($this->_db);
        $data = array("TournamentID" => $_REQUEST['TournamentID'], "RoundID" => $_REQUEST['RoundID'], "GamesWonPoints" => $_REQUEST['GamesWonPoints'], "GamesLostPoints" => $_REQUEST['GamesLostPoints'], "TotalPoints" => $_REQUEST['TotalPoints'], "MatchType" => $_REQUEST['MatchType'], "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
        $RoundPointsUpdateData = $mysql->update('v_round_points_parameters', $data, array("PointParameterID" => $_REQUEST['PointParameterID'], "is_active" => "Y"));
        if ($RoundPointsUpdateData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRoundUpdateData'] = $RoundPointsUpdateData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertSelectedTeamsInGroup() {
        $mysql = new DataTransaction($this->_db);
        $TeamIDS = explode(',', substr(trim($_REQUEST['Teams']), 0, -1));
        for ($i = 0; $i < sizeof($TeamIDS); $i++) {
            $data = array("TournamentID" => $_REQUEST['TournamentID'], "GroupID" => $_REQUEST['GroupID'], "TeamID" => $TeamIDS[$i], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
            $TeamSaveData = $mysql->insert($data, 'v_groups_team_relation');
        }
        if ($TeamSaveData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['TeamSaveData'] = $TeamSaveData;
            $this->return_data['Message'] = 'Selected Teams Allocated';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetCanCreateTeamData($UserID = '') {
        $json = json_decode($UserID, true);
        $TeamMemberData = $this->_db->prepare("SELECT * FROM v_player_team_relation_master WHERE PlayerID = '" . $json['UserID'] . "' OR CaptainID = '" . $json['UserID'] . "'");
        $TeamMemberData->execute();
        $TeamWiseData = $TeamMemberData->fetch(PDO::FETCH_ASSOC);
        $total = $TeamMemberData->rowCount();
        if ($total) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamWiseData'] = $TeamWiseData;
            $this->return_data['Message'] = 'You Can Not Create a Team';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function MyTeamData($Condition = '') {
        $json = json_decode($Condition, true);
        if ($json['CaptainID'] == '') {
            $MyTeamData = $this->_db->prepare("SELECT TRMaster.*,CONCAT(User.FirstName,' ',User.LastName)AS PlayerName,Team.TeamName FROM v_player_team_relation_master AS TRMaster INNER JOIN v_users AS User ON TRMaster.PlayerID=User.UserID INNER JOIN v_teams AS Team ON TRMaster.TeamID=Team.TeamID WHERE TRMaster.PlayerID = '" . $json['UserID'] . "' AND TRMaster.is_active='Y'");
        } else {
            $MyTeamData = $this->_db->prepare("SELECT TRMaster.*,CONCAT(User.FirstName,' ',User.LastName)AS PlayerName,Team.TeamName FROM v_player_team_relation_master AS TRMaster INNER JOIN v_users AS User ON TRMaster.PlayerID=User.UserID INNER JOIN v_teams AS Team ON TRMaster.TeamID=Team.TeamID WHERE TRMaster.CaptainID = '" . $json['CaptainID'] . "' AND TRMaster.is_active='Y'");
        }
        $MyTeamData->execute();
        $MyTeamWiseData = $MyTeamData->fetchAll(PDO::FETCH_ASSOC);
        $CaptainDataQuery = $this->_db->prepare("SELECT CONCAT(FirstName,' ',LastName)AS CaptainName FROM v_users WHERE UserID = '" . $MyTeamWiseData[0]['CaptainID'] . "'");
        $CaptainDataQuery->execute();
        $CaptainData = $CaptainDataQuery->fetch(PDO::FETCH_ASSOC);

        $Data['TeamData'] = $MyTeamWiseData;
        $Data['CaptainData']['CaptainName'] = $CaptainData['CaptainName'];
        $total = $MyTeamData->rowCount();
        if ($total) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetMyTeamWiseData'] = $Data;
            $this->return_data['GetCaptainData'] = $CaptainData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    
    
    public function MyTeamDataNewForTournament($Condition = '') {
        $json = json_decode($Condition, true);
        $MyTeamData = $this->_db->prepare("SELECT TRMaster.*,CONCAT(User.FirstName,' ',User.LastName)AS PlayerName,Team.TeamName,temp.PlayerID,temp.AdminStatus,temp.RejectionReason FROM v_player_team_relation_master AS TRMaster INNER JOIN v_users AS User ON TRMaster.PlayerID=User.UserID INNER JOIN v_teams AS Team ON TRMaster.TeamID=Team.TeamID LEFT JOIN v_teams_tournament_relation_temp as temp ON temp.PlayerID = TRMaster.PlayerID AND temp.TeamID = TRMaster.TeamID AND temp.TournamentID = '".$json['TournamentID']."' WHERE (temp.AdminStatus = 'Y' OR temp.AdminStatus = 'R' OR temp.AdminStatus = 'N') AND TRMaster.TeamID = '".$json['TeamID']."' AND TRMaster.is_active='Y'");
        $MyTeamData->execute();
        $MyTeamWiseData = $MyTeamData->fetchAll(PDO::FETCH_ASSOC);
        $CaptainDataQuery = $this->_db->prepare("SELECT CONCAT(FirstName,' ',LastName)AS CaptainName FROM v_users WHERE UserID = '" . $MyTeamWiseData[0]['CaptainID'] . "'");
        $CaptainDataQuery->execute();
        $CaptainData = $CaptainDataQuery->fetch(PDO::FETCH_ASSOC);

        $Data['TeamData'] = $MyTeamWiseData;
        $Data['CaptainData']['CaptainName'] = $CaptainData['CaptainName'];
        $total = $MyTeamData->rowCount();
        if ($total) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetMyTeamWiseData'] = $Data;
            $this->return_data['GetCaptainData'] = $CaptainData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function MyTeamDataWithoutCaptain($Condition = '') {
        $json = json_decode($Condition, true);
        $MyTeamDataWithoutCaptainQuery = $this->_db->prepare("SELECT TRMaster.*,CONCAT(User.FirstName,' ',User.LastName)AS PlayerName,Team.TeamName FROM v_player_team_relation_master AS TRMaster INNER JOIN v_users AS User ON TRMaster.PlayerID=User.UserID INNER JOIN v_teams AS Team ON TRMaster.TeamID=Team.TeamID WHERE TRMaster.TeamID = '" . $json['TeamID'] . "' AND TRMaster.PlayerID != '" . $json['CaptainID'] . "' AND TRMaster.is_active='Y'");

        $MyTeamDataWithoutCaptainQuery->execute();
        $MyTeamDataWithoutCaptainQueryData = $MyTeamDataWithoutCaptainQuery->fetchAll(PDO::FETCH_ASSOC);
        $TotalCount = count($MyTeamDataWithoutCaptainQueryData);
        if ($TotalCount > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetMyTeamWiseDataWithoutCaptain'] = $MyTeamDataWithoutCaptainQueryData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function MyTeamNameData($Condition = '') {
        $json = json_decode($Condition, true);
        if ($json['CaptainID'] == '') {
            $MyTeamNameData = $this->_db->prepare("SELECT TeamName FROM v_teams AS TRMaster WHERE PlayerID = '" . $json['UserID'] . "'");
        } else {
            $MyTeamNameData = $this->_db->prepare("SELECT TeamName FROM v_teams AS TRMaster WHERE CaptainID = '" . $json['CaptainID'] . "'");
        }
        $MyTeamNameData->execute();
        $MyTeamNameWiseData = $MyTeamNameData->fetch(PDO::FETCH_ASSOC);
        $total = $MyTeamNameData->rowCount();
        if ($total) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetMyTeamNameWiseData'] = $MyTeamNameWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function MyCaptainData($Condition = '') {
        $json = json_decode($Condition, true);
        $MyCaptainData = $this->_db->prepare("SELECT * FROM v_users WHERE UserID = '" . $json['UserID'] . "'");
        $MyCaptainData->execute();
        $MyCaptainWiseData = $MyCaptainData->fetch(PDO::FETCH_ASSOC);
        $this->return_data['ResponseCode'] = 1;
        $this->return_data['GetMyCaptainWiseData'] = $MyCaptainWiseData;
        $this->return_data['Message'] = 'Success';
        return $this->return_data;
    }

    public function MyTeamDataByID($Condition = '') {
        $json = json_decode($Condition, true);
//            echo "SELECT TRMaster.*,CONCAT(User.FirstName,' ',User.LastName)AS PlayerName,Team.TeamName FROM v_player_team_relation_master AS TRMaster INNER JOIN v_users AS User ON TRMaster.PlayerID=User.UserID INNER JOIN v_teams AS Team ON TRMaster.TeamID=Team.TeamID WHERE TRMaster.TeamID ='".$json['TeamID']."'";
        $MyTeamDataByIDQuery = $this->_db->prepare("SELECT TRMaster.*,CONCAT(User.FirstName,' ',User.LastName)AS PlayerName,Team.TeamName,User.CaptainshipStatus FROM v_player_team_relation_master AS TRMaster INNER JOIN v_users AS User ON TRMaster.PlayerID=User.UserID INNER JOIN v_teams AS Team ON TRMaster.TeamID=Team.TeamID WHERE TRMaster.TeamID ='" . $json['TeamID'] . "'");
        $MyTeamDataByIDQuery->execute();
        $MyTeamWiseDataID = $MyTeamDataByIDQuery->fetchAll(PDO::FETCH_ASSOC);
//        echo '<pre>';
//        print_r($MyTeamWiseDataID);
        $CaptainDataQuery = $this->_db->prepare("SELECT CONCAT(FirstName,' ',LastName)AS CaptainName FROM v_users WHERE UserID = '" . $MyTeamWiseDataID[0]['CaptainID'] . "'");
        $CaptainDataQuery->execute();
        $CaptainData = $CaptainDataQuery->fetch(PDO::FETCH_ASSOC);
//        $MyTeamWiseDataID['CaptainData']['PlayerName'] = $CaptainData['CaptainName'];
//        echo '<pre>';
//        print_r($MyTeamWiseDataID);
        $total = $MyTeamDataByIDQuery->rowCount();
        if ($total) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetMyTeamWiseDataByID'] = $MyTeamWiseDataID;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllTeamData($Condition = '') {
        $json = json_decode($Condition, true);
        $TeamData = $this->_db->prepare("SELECT Team.TeamID,Team.TeamName,Team.TeamDescription,Team.TeamSlogan,Team.CoachName,(CASE WHEN Team.TeamLogo = '' THEN '" . SITE_URL . "admin/uploads/TeamLogo/team-placeholder.jpg' ELSE CONCAT('" . SITE_URL . "admin/uploads/TeamLogo/',Team.TeamLogo) END) AS TeamLogoWithPath,Team.TeamLogo,Team.CaptainID,Team.StateID,Team.CityID,Team.is_active,State.StateName,City.CityName,CONCAT(User.FirstName,' ', User.LastName ) AS CaptainName FROM v_teams Team INNER JOIN v_state AS State ON Team.StateID = State.StateID INNER JOIN v_city AS City ON Team.CityID = City.CityID INNER JOIN v_users AS User ON Team.CaptainID = User.UserID WHERE Team.is_active != 'D' AND Team.CaptainID = '" . $json['UserID'] . "'");
        $TeamData->execute();
        $TeamWiseData = $TeamData->fetch(PDO::FETCH_ASSOC);
        if ($TeamWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamWiseData'] = $TeamWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertTeamData() {
        $mysql = new DataTransaction($this->_db);
        if (isset($_REQUEST['TeamName']) && $_REQUEST['TeamName'] != '' && $_REQUEST['StateID'] != '' && $_REQUEST['CityID'] != '' && $_REQUEST['CaptainID'] != '') {
            $TeamDataSelect = $this->_db->prepare("SELECT * FROM v_teams WHERE is_active = 'Y' AND CaptainID = '" . $_REQUEST['CaptainID'] . "'");
            $TeamDataSelect->execute();
            $TeamWiseData = $TeamDataSelect->fetchAll(PDO::FETCH_ASSOC);
            $total = $TeamDataSelect->rowCount();
            if ($total < 1) {
                $data = array("TeamName" => $_REQUEST['TeamName'], "TeamDescription" => $_REQUEST['TeamDescription'], "TeamSlogan" => $_REQUEST['TeamSlogan'], "TeamLogo" => $_REQUEST['TeamLogo'], "StateID" => $_REQUEST['StateID'], "CityID" => $_REQUEST['CityID'], "is_active" => 'Y', "CaptainID" => $_REQUEST['CaptainID'], "EntryBy" => '1', 'EntryDate' => date('Y-m-d'));

                $TeamData = $mysql->insert($data, 'v_teams');

                $playerdata = array("PlayerID" => $_REQUEST['CaptainID'], "RoleID" => 2, "TeamID" => $TeamData, "CaptainID" => $_REQUEST['CaptainID'], "AdminApproval" => 'Y', "AdminComment" => 'No', "is_active" => 'Y', "EntryBy" => $_REQUEST['CaptainID'], 'EntryDate' => date('Y-m-d'));

                $FirstPlayerData = $mysql->insert($playerdata, 'v_player_team_relation_master');

                if ($TeamData) {
                    $Flag = 'Yes';
                } else {
                    $Flag = 'No';
                }
                $TeamUpdateData = $mysql->update('v_users', array("CaptainshipStatus" => 'Y'), array("UserID" => $_REQUEST['CaptainID'], "is_active" => "Y"));
                if ($TeamData) {
                    $this->return_data['ResponseCode'] = 1;
                    $this->return_data['TeamCreated'] = $Flag;
                    $this->return_data['GetTeamID'] = $TeamData;
//                    $this->return_data['Message'] = 'Team Created Successfully';
                    $this->return_data['Message'] = 'Your Team is Ready ! You Can Now Add Players in Your Team !';
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'No Record Found';
                }
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'You Are Already Created Your Team If You Want To Create New Team You Have To Deactive Your Currently Activated Team';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Provide Require Data';
        }


        return $this->return_data;
    }

    public function UpdateTeamData() {
        $mysql = new DataTransaction($this->_db);
//        print_r($_REQUEST);
//        exit;
        if ($_REQUEST['TeamName'] != '' && $_REQUEST['TeamSlogan'] != '' && $_REQUEST['StateID'] != '' && $_REQUEST['CityID'] != '' && $_REQUEST['CaptainID'] != '' && $_REQUEST['TeamID'] != '') {
            $data = array("TeamName" => $_REQUEST['TeamName'], "TeamDescription" => $_REQUEST['TeamDescription'], "TeamSlogan" => $_REQUEST['TeamSlogan'], "TeamLogo" => $_REQUEST['TeamLogo'], "CoachName" => $_REQUEST['CoachName'], "StateID" => $_REQUEST['StateID'], "CityID" => $_REQUEST['CityID'], "is_active" => 'Y', "CaptainID" => $_REQUEST['CaptainID'], "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
            $TeamUpdateData = $mysql->update('v_teams', $data, array("TeamID" => $_REQUEST['TeamID'], "is_active" => "Y"));
//        print_r($TournamentData);
            $TournamentRows = sizeof($TeamUpdateData);
            if ($TournamentRows > 0) {
                $this->return_data['ResponseCode'] = 1;
//                $this->return_data['GetTeamWiseData'] = $TournamentRows;
//                $this->return_data['Message'] = 'Success';
                $this->return_data['Message'] = 'Team Details Updated Successfully !';
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Please Provide Require Data';
        }

        return $this->return_data;
    }

    public function SearchPlayersData($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        unset($_REQUEST['do']);
        unset($_REQUEST['class']);
        unset($_REQUEST['method']);
        unset($_REQUEST['TournamentID']);
        $CaptainAge = $json['CaptainAge'];
        $CaptainID = $json['CaptainID'];
        $CaptainGender = $json['CaptainGender'];
        unset($json['CaptainAge']);
        unset($json['CaptainID']);
        unset($json['CaptainGender']);
        $a = array_filter($json);
        $last_key = end(array_keys($a));
        foreach ($a as $k => $val) {
            if ($k == 'CityID') {
                $conditions .= "User.CityID = '" . $a[$k] . "'";
            } else if ($k == 'PlayerName') {
                $conditions .= "(User.FirstName LIKE'" . $a[$k] . "%' OR User.LastName LIKE'" . $a[$k] . "%')";
            } else {
                $conditions .= $k . " = '" . $a[$k] . "'";
            }
            if ($k == $last_key) {
            } else {
                $conditions .= " AND ";
            }
        }
        if ($CaptainAge > 17) {
            $AgeCondition = "YEAR(now()) - YEAR(User.DOB) - (DATE_FORMAT(now(), '%m%d') < DATE_FORMAT(User.DOB, '%m%d')) > 17";
        } else if ($CaptainAge < 17) {
            $AgeCondition = "YEAR(now()) - YEAR(User.DOB) - (DATE_FORMAT(now(), '%m%d') < DATE_FORMAT(User.DOB, '%m%d')) < 17";
        }
        if ($CaptainGender == 'M') {
            $GenderCondition = "User.Gender = 'M'";
        } else if ($CaptainAge == 'F') {
            $GenderCondition = "User.Gender = 'F'";
        }
        $NotInData = $this->_db->prepare("SELECT GROUP_CONCAT(PlayerID) as PlayerID FROM v_player_team_relation WHERE CaptainID='" . $CaptainID . "' AND (RejectStatus = 'A' OR RejectStatus = 'N') AND is_active ='Y'");
        $NotInData->execute();
        $AllNotInData = $NotInData->fetch(PDO::FETCH_ASSOC);
        $PlayerList = $AllNotInData['PlayerID'];
        if ($PlayerList != '') {
            $PlayerListCondition = 'AND User.UserID NOT IN (' . $PlayerList . ')';
        }
        $NotInReleData = $this->_db->prepare("SELECT GROUP_CONCAT(PlayerID) as PlayerID FROM v_player_team_relation_master WHERE is_active = 'Y'");
        $NotInReleData->execute();
        $AllNotInReleData = $NotInReleData->fetch(PDO::FETCH_ASSOC);
        $PlayerReleList = $AllNotInReleData['PlayerID'];

        if ($PlayerReleList != '') {
            $PlayerListReleCondition = ' User.UserID NOT IN (' . $PlayerReleList . ')';
        }
        if ($json['CityID'] != '' || $json['PlayerName'] != '' || $json['BodyType'] != '' || $json['FavoritePosition'] != '') {
            $QueryForPlayersData = $this->_db->prepare("SELECT User.UserID,now(),  YEAR(now()) - YEAR(User.DOB) - (DATE_FORMAT(now(), '%m%d') < DATE_FORMAT(User.DOB, '%m%d')) as Age,User.UserID,User.RoleID,User.UserName,User.FirstName,User.MiddleName,User.LastName,User.CityID,User.Height,User.Weight,User.Gender,User.DOB,User.EmailID,User.NickName,User.AddressLine1,User.LandMark,User.MobileNumber, User.BodyType, User.FavoritePosition,(CASE WHEN User.ProfilePicture = '' THEN '" . SITE_URL . "admin/uploads/ProfilePic/placeholder.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/ProfilePic/', User.ProfilePicture) END ) AS ProfilePicture,City.CityName,State.StateName FROM v_users AS User INNER JOIN v_city AS City ON City.CityID=User.CityID INNER JOIN v_state AS State ON State.StateID=User.StateID LEFT JOIN v_player_team_relation as relation ON relation.PlayerID = User.UserID WHERE User.is_active='Y' AND User.EmailVerificationStatus='Y' AND User.CaptainshipStatus='N' $PlayerListCondition AND $PlayerListReleCondition AND $conditions AND $AgeCondition AND $GenderCondition GROUP BY User.UserID");
        } else {
            $QueryForPlayersData = $this->_db->prepare("SELECT User.UserID,now(),  YEAR(now()) - YEAR(User.DOB) - (DATE_FORMAT(now(), '%m%d') < DATE_FORMAT(User.DOB, '%m%d')) as Age,User.UserID,User.RoleID,User.UserName,User.FirstName,User.MiddleName,User.LastName,User.Height,User.Weight,User.Gender,User.DOB,User.EmailID,User.NickName,User.AddressLine1,User.LandMark,User.MobileNumber, User.BodyType, User.FavoritePosition,(CASE WHEN User.ProfilePicture = '' THEN '" . SITE_URL . "admin/uploads/ProfilePic/placeholder.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/ProfilePic/', User.ProfilePicture) END ) AS ProfilePicture,City.CityName,State.StateName FROM v_users AS User INNER JOIN v_city AS City ON City.CityID=User.CityID INNER JOIN v_state AS State ON State.StateID=User.StateID LEFT JOIN v_player_team_relation as relation ON relation.PlayerID = User.UserID WHERE User.is_active='Y' AND User.EmailVerificationStatus='Y' AND User.CaptainshipStatus='N' $PlayerListCondition AND $PlayerListReleCondition AND $AgeCondition AND $GenderCondition GROUP BY User.UserID");
        }
        $QueryForPlayersData->execute();
        $PlayersWiseData = $QueryForPlayersData->fetchAll(PDO::FETCH_ASSOC);
        $PlayersList = $QueryForPlayersData->rowCount();
        if ($PlayersList > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPlayerData'] = $PlayersWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function SaveTeamPlayer($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        unset($_REQUEST['class']);
        unset($_REQUEST['method']);
        if (substr($json['PlayerList'], -1, 1) == ',') {
            $json['PlayerList'] = substr($json['PlayerList'], 0, -1);
        }
        $lis = trim($json['PlayerList']);
        $list = explode(',', $lis);
//        print_r($list);
        if (isset($list) && $list != '') {
//           print_r($list);
            for ($i = 0; $i < sizeof($list); $i++) {

                $TeamData = $this->_db->prepare("SELECT TeamName FROM v_teams WHERE is_active = 'Y' AND TeamID = '" . $json['TeamID'] . "'");
                $TeamData->execute();
                $TeamWiseData = $TeamData->fetch(PDO::FETCH_ASSOC);
                $UserEmailData = $this->_db->prepare("SELECT UserName,FirstName,LastName,EmailID FROM v_users WHERE is_active = 'Y' AND UserID = '" . $list[$i] . "'");
                $UserEmailData->execute();
                $UserEmailWiseData = $UserEmailData->fetch(PDO::FETCH_ASSOC);
                $NotificationText = 'Hello' . ' ' . $UserEmailWiseData['FirstName'] . ' ' . ', you have received request to join team' . ' ' . $TeamWiseData['TeamName'];
//                $NotificationData = array("UserID" => $list[$i], "NotificationText" => $NotificationText, "RoleID" => $json['RoleID'], "CaptainID" => $json['CaptainID'], "ReadStatus" => 'N', "AcceptedRejected" => 'P', "is_active" => 'Y', "EntryBy" => $json['CaptainID'], "EntryDate" => date('Y-m-d'));
//                $UserNotificationData = $mysql->insert($NotificationData, 'v_notifications');
                $NotificationData = array("NotificationTitle" => 'Team', "NotificationType" => 'TeamNotification', "NotificationText" => $NotificationText, "SenderID" => $json['CaptainID'],"IsOperational"=>'Y', "ReceiverID" => $list[$i], "is_active" => 'Y', "DeleteStatus" => 'N', "NotificationCreatedDate" => date('Y-m-d'));
                $UserNotificationData = $mysql->insert($NotificationData, 'v_general_notifications');


                $data = array("NotificationID" => $UserNotificationData, "PlayerID" => $list[$i], "RoleID" => 2, "TeamID" => $json['TeamID'], "CaptainID" => $json['CaptainID'], "is_active" => 'Y', "EntryBy" => $json['CaptainID'], "EntryDate" => date('Y-m-d'));
                $UserData = $mysql->insert($data, 'v_player_team_relation');

//                print_r($UserEmailWiseData['EmailID']);
                if (isset($UserEmailWiseData['EmailID']) && $UserEmailWiseData['EmailID'] != '') {
                    $body = '<html>';
                    $body .= '<head>';
                    $body .= MAIL_HEADER;
                    $body .= '<body>';
                    $body .= BODY_START;
                    $body .= '<div>';
                    $body .= 'Hello' . ' ' . $UserEmailWiseData['FirstName'] . ' ' . $UserEmailWiseData['LastName'] . '<br>';
//            $body .= 'Hello' . ' ' . $UserEmailWiseData['FirstName'] . ' ' . $UserEmailWiseData['LastName'] . '<br>';
                    $body .= '<span>Request to join a team .</span><br><br>';
                    $body .= $_REQUEST['DeclineReason'] . '<br><br>';
                    $body .= BODY_FOOTER;
                    $body .= '</div>';
                    $body .= '</body>';
                    $body .= '</head>';
                    $body .= MAIL_FOOTER;

                    $SendData = $mysql->send_email($UserEmailWiseData['EmailID'], '', $bcc, 'Notification', nl2br($body), 'Please check your email.! ', $attachment);
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'Email Id Can Not Allow Null';
                }
            }

            if ($UserData > 0) {
                $this->return_data['ResponseCode'] = 1;
                $this->return_data['GetTournamentWiseData'] = $UserData;
//                $this->return_data['Message'] = 'Request Send Successfully to selected players';
                $this->return_data['Message'] = 'Invitation to Join Your Team Sent Succefully to Selected Players !';
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Select player to add team';
        }
        return $this->return_data;
    }

//CMS Data START   
    public function GetAboutUsData() {
        $AboutUsData = $this->_db->prepare("SELECT DocumentID,DocumentFor,Type,DocumentTitle,DocumentFile,DocumentDescription FROM v_documents WHERE is_active = 'Y' AND DocumentID = 1");
        $AboutUsData->execute();
        $AboutUsWiseData = $AboutUsData->fetch(PDO::FETCH_ASSOC);
        if ($AboutUsWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAboutUsWiseData'] = $AboutUsWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetPrivacyData() {
        $PrivacyData = $this->_db->prepare("SELECT DocumentID,DocumentFor,Type,DocumentTitle,DocumentFile,DocumentDescription FROM v_documents WHERE is_active = 'Y' AND DocumentID = 2");
        $PrivacyData->execute();
        $PrivacyWiseData = $PrivacyData->fetch(PDO::FETCH_ASSOC);
        if ($PrivacyWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPrivacyWiseData'] = $PrivacyWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetTermsConditionData() {
        $TermsConditionData = $this->_db->prepare("SELECT DocumentID,DocumentFor,Type,DocumentTitle,DocumentFile,DocumentDescription FROM v_documents WHERE is_active = 'Y' AND DocumentID = 3");
        $TermsConditionData->execute();
        $TermsConditionWiseData = $TermsConditionData->fetch(PDO::FETCH_ASSOC);
        if ($TermsConditionWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTermsConditionWiseData'] = $TermsConditionWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetUserAgreementData() {
        $UserAgreementData = $this->_db->prepare("SELECT DocumentID,DocumentFor,Type,DocumentTitle,DocumentFile,DocumentDescription FROM v_documents WHERE is_active = 'Y' AND DocumentID = 4");
        $UserAgreementData->execute();
        $UserAgreementWiseData = $UserAgreementData->fetch(PDO::FETCH_ASSOC);
        if ($UserAgreementWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetUserAgreementWiseData'] = $UserAgreementWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetPaymentAgreementData() {
        $PaymentAgreementData = $this->_db->prepare("SELECT DocumentID,DocumentFor,Type,DocumentTitle,DocumentFile,DocumentDescription FROM v_documents WHERE is_active = 'Y' AND DocumentID = 5");
        $PaymentAgreementData->execute();
        $PaymentAgreementWiseData = $PaymentAgreementData->fetch(PDO::FETCH_ASSOC);
        if ($PaymentAgreementWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPaymentAgreementWiseData'] = $PaymentAgreementWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetHowItWorksData() {
        $HowItWorksData = $this->_db->prepare("SELECT DocumentID,DocumentFor,Type,DocumentTitle,DocumentFile,DocumentDescription FROM v_documents WHERE is_active = 'Y' AND DocumentID = 6");
        $HowItWorksData->execute();
        $HowItWorksWiseData = $HowItWorksData->fetch(PDO::FETCH_ASSOC);
        if ($HowItWorksWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetHowItWorksWiseData'] = $HowItWorksWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAddressData() {
        $AddressData = $this->_db->prepare("SELECT DocumentID,DocumentFor,Type,DocumentTitle,DocumentFile,DocumentDescription FROM v_documents WHERE is_active = 'Y' AND DocumentID = 7");
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

    public function GetSubstitutionRulesData() {
        $SubstitutionRulesData = $this->_db->prepare("SELECT DocumentID,DocumentFor,Type,DocumentTitle,DocumentFile,DocumentDescription FROM v_documents WHERE is_active = 'Y' AND DocumentID = 8");
        $SubstitutionRulesData->execute();
        $SubstitutionRulesWiseData = $SubstitutionRulesData->fetch(PDO::FETCH_ASSOC);
        if ($SubstitutionRulesWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetSubstitutionRulesWiseData'] = $SubstitutionRulesWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetMatchRulesData() {
        $MatchRulesData = $this->_db->prepare("SELECT DocumentID,DocumentFor,Type,DocumentTitle,DocumentFile,DocumentDescription FROM v_documents WHERE is_active = 'Y' AND DocumentID = 9");
        $MatchRulesData->execute();
        $MatchRulesWiseData = $MatchRulesData->fetch(PDO::FETCH_ASSOC);
        if ($MatchRulesWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetMatchRulesWiseData'] = $MatchRulesWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function GetTournamentRulesData() {
        $TournamentRulesData = $this->_db->prepare("SELECT DocumentID,DocumentFor,Type,DocumentTitle,DocumentFile,DocumentDescription FROM v_documents WHERE is_active = 'Y' AND DocumentID = 10");
        $TournamentRulesData->execute();
        $TournamentRulesWiseData = $TournamentRulesData->fetch(PDO::FETCH_ASSOC);
        if ($TournamentRulesWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentRulesWiseData'] = $TournamentRulesWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

//CMS Data END   
//
    public function GetTeamIDFromUserIDData($Condition = '') {
        $json = json_decode($Condition, true);
//        echo "SELECT TeamID,CaptainID,AdminApproval,AdminComment FROM v_player_team_relation WHERE PlayerID='" . $json['PlayerID'] . "'";
        $TeamReleData = $this->_db->prepare("SELECT TeamID,CaptainID,AdminApproval,AdminComment FROM v_player_team_relation_master WHERE PlayerID='" . $json['PlayerID'] . "'");
        $TeamReleData->execute();
        $TeamReleWiseData = $TeamReleData->fetch(PDO::FETCH_ASSOC);
        if ($TeamReleWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamReleWiseData'] = $TeamReleWiseData;
            $this->return_data['Message'] = 'You Can Not Crate a Team';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllTeamJoinRequest($Condition = '') {

        $json = json_decode($Condition, true);
        $TeamJoinRequestData = $this->_db->prepare("SELECT Player.RelationID,Player.PlayerID,Player.RoleID,Player.TeamID,Player.CaptainID,Team.TeamName,CONCAT(User.FirstName,' ',User.LastName)AS CaptainName,User.EmailID,Notification.NotificationText,Notification.NotificationID FROM v_player_team_relation AS Player INNER JOIN v_general_notifications AS Notification ON Notification.NotificationID=Player.NotificationID INNER JOIN v_teams AS Team ON Team.TeamID=Player.TeamID  INNER JOIN v_users AS User ON User.UserID=Player.CaptainID  WHERE Player.is_active = 'Y' AND Player.PlayerID = '" . $json['UserID'] . "' ORDER BY Player.RelationID");

        $TeamJoinRequestData->execute();
        $TeamJoinRequestWiseData = $TeamJoinRequestData->fetchAll(PDO::FETCH_ASSOC);

        if ($TeamJoinRequestWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamJoinRequestWiseData'] = $TeamJoinRequestWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function ApproveTeamJoinRequest($Condition = '') {
        $json = json_decode($Condition, true);

        $mysql = new DataTransaction($this->_db);
        $data = array("PlayerID" => $json['PlayerID'], "RoleID" => 2, "TeamID" => $json['TeamID'], "AdminApproval" => 'Y', "AdminComment" => 'No', "CaptainID" => $json['CaptainID'], "is_active" => 'Y', "EntryBy" => $json['PlayerID'], 'EntryDate' => date('Y-m-d'));

        $TeamRequestAcceptData = $mysql->insert($data, 'v_player_team_relation_master');

        $TeamRequestAcceptTeamPlayerRelationUpdateData = $mysql->update('v_player_team_relation', array("is_active" => "N", "RejectStatus" => "A"), array("RelationID" => $json['RelationID']));

        $query = $this->_db->prepare("UPDATE v_player_team_relation SET is_active='N',RejectStatus = 'R' WHERE PlayerID = " . $json['PlayerID'] . " AND RelationID != " . $json['RelationID'] . "");
        $query->execute();

        $TeamRequestAcceptNotificationUpdateData = $mysql->update('v_general_notifications', array("NotificationStatus" => 'A'), array("NotificationID" => $json['NotificationID']));
        $NotificationQuery = $this->_db->prepare("UPDATE v_general_notifications SET NotificationStatus = 'R' WHERE ReceiverID = " . $json['PlayerID'] . " AND NotificationID != " . $json['NotificationID'] . " AND NotificationType='TeamNotification' ");
        $NotificationQuery->execute();
        
//        $NotificationText = '';
//        $NotificationCaptainTeamJoinAcceptInsertData = array("NotificationTitle" => 'Team Notification',"NotificationType"=>'TeamNotification', "NotificationText" => $_REQUEST['RemovingReason'], "RoleID" => 2, "is_active" => 'Y', "EntryBy" => $_REQUEST['PlayerID'], "EntryDate" => date('Y-m-d'));
//
//        $NotificationCaptainTeamJoinAcceptInsert = $mysql->insert($NotificationCaptainTeamJoinAcceptInsertData, 'v_general_notifications');

        if ($TeamRequestAcceptData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamJoinRequestWiseData1'] = $TeamRequestAcceptData;
            $this->return_data['Message'] = 'Invitation Accepted Successfully';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function RejectTeamJoinRequest($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        $TeamRequestRejectData = $mysql->update('v_player_team_relation', array("is_active" => "N", "RejectReason" => $json['RejectReason'], "RejectStatus" => 'R'), array("RelationID" => $json['RelationID']));
//        $TeamRequestRejectNotificationUpdateData = $mysql->update('v_notifications', array("is_active" => "Y", "AcceptedRejected" => 'R'), array("NotificationID" => $json['NotificationID']));
        $TeamRequestRejectNotificationUpdateData = $mysql->update('v_general_notifications', array("is_active" => "Y", "NotificationStatus" => 'R',"RejectedReason" => $json['RejectReason']), array("NotificationID" => $json['NotificationID']));
        if ($TeamRequestRejectData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamRequestRejectData'] = $TeamRequestRejectData;
//            $this->return_data['Message'] = 'Invitation Rejected';
            $this->return_data['Message'] = 'Invitation Rejected. Your Message Sent To The Team\'s Captain.';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function RemoveFromTeam() {
//        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);

        $PlayerTeamReleUpdateData = $mysql->update('v_player_team_relation', array("is_active" => "N"), array("PlayerID" => $_REQUEST['PlayerID'], "TeamID" => $_REQUEST['TeamID']));
        $PlayerTeamReleMasterUpdateData = $mysql->update('v_player_team_relation_master', array("is_active" => "N"), array("PlayerID" => $_REQUEST['PlayerID'], "TeamID" => $_REQUEST['TeamID']));


        $NotificationInsertData = array("UserID" => $_REQUEST['PlayerID'], "NotificationText" => $_REQUEST['RemovingReason'], "RoleID" => 2, "is_active" => 'Y', "EntryBy" => $_REQUEST['PlayerID'], "EntryDate" => date('Y-m-d'));

        $NotificationData = $mysql->insert($NotificationInsertData, 'v_notifications');
//        $CaptainIDQuery = $this->_db->prepare("SELECT CaptainID FROM v_teams WHERE TeamID = '".$_REQUEST['TeamID']."'");
//        $CaptainIDQuery->execute();
//        $CaptainIDData = $CaptainIDQuery->fetch(PDO::FETCH_ASSOC);
//        $CaptainID = $CaptainIDData['CaptainID'];
//        $NotificationInsertData = array("ReceiverID" => $_REQUEST['PlayerID'],"NotificationText" => $_REQUEST['RemovingReason'],"is_active" => 'Y',"EntryBy" => $_REQUEST['PlayerID'], "EntryDate" => date('Y-m-d'));
//        $NotificationData = $mysql->insert($NotificationInsertData, 'v_notifications');
        if ($NotificationData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRemoveFromTeamData'] = $NotificationData;
//            $this->return_data['Message'] = 'Invitation Rejected';
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllNotification($Condition = '') {
        $json = json_decode($Condition, true);
        if (isset($json['RoleID']) && $json['RoleID'] == 2 && $json['CaptainShipStatus'] == 'Y') {
            $ConditionForPending = "Notification.AcceptedRejected = 'P' AND Notification.CaptainID = '" . $json['UserID'] . "'";
            $ConditionForAccepted = "Notification.AcceptedRejected = 'A' AND Notification.CaptainID = '" . $json['UserID'] . "'";
            $ConditionForNotAccepted = "Notification.AcceptedRejected = 'R' AND Notification.CaptainID = '" . $json['UserID'] . "'";
        } else if (isset($json['RoleID']) && $json['RoleID'] == 2 && $json['CaptainShipStatus'] == 'N') {
            $ConditionForPending = "Notification.AcceptedRejected = 'P' AND Notification.UserID = '" . $json['UserID'] . "'";
            $ConditionForAccepted = "Notification.AcceptedRejected = 'A' AND Notification.UserID = '" . $json['UserID'] . "'";
            $ConditionForNotAccepted = "Notification.AcceptedRejected = 'R' AND Notification.UserID = '" . $json['UserID'] . "'";
        } else if (isset($json['RoleID']) && $json['RoleID'] == 1) {
            
        }
//        echo "SELECT Notification.CaptainID,Notification.NotificationID,Notification.UserID,Notification.is_active,Notification.NotificationText,Notification.ReadStatus,CONCAT(User.FirstName,' ',User.LastName)AS UserName,Notification.EntryBy,Notification.AcceptedRejected FROM v_notifications AS Notification INNER JOIN v_users AS User ON Notification.UserID=User.UserID WHERE " . $ConditionForPending . "";
        $PendingNotificationData = $this->_db->prepare("SELECT Notification.CaptainID,Notification.NotificationID,Notification.UserID,Notification.is_active,Notification.NotificationText,Notification.ReadStatus,CONCAT(User.FirstName,' ',User.LastName)AS UserName,Notification.EntryBy,Notification.AcceptedRejected FROM v_notifications AS Notification INNER JOIN v_users AS User ON Notification.UserID=User.UserID WHERE " . $ConditionForPending . "");

        $PendingNotificationData->execute();
        $PendingNotificationWiseData = $PendingNotificationData->fetchAll(PDO::FETCH_ASSOC);
        $NumberOfPendingNotification = $PendingNotificationData->rowCount();


        $AcceptedNotificationData = $this->_db->prepare("SELECT Notification.CaptainID,Notification.NotificationID,Notification.UserID,Notification.is_active,Notification.NotificationText,Notification.ReadStatus,CONCAT(User.FirstName,' ',User.LastName)AS UserName,Notification.EntryBy,Notification.AcceptedRejected FROM v_notifications AS Notification INNER JOIN v_users AS User ON Notification.UserID=User.UserID WHERE " . $ConditionForAccepted . "");
        $AcceptedNotificationData->execute();
        $AcceptedNotificationWiseData = $AcceptedNotificationData->fetchAll(PDO::FETCH_ASSOC);
        $NumberOfAcceptedNotification = $AcceptedNotificationData->rowCount();

        // echo "SELECT Notification.CaptainID,Notification.NotificationID,Notification.UserID,Notification.is_active,Notification.NotificationText,Notification.ReadStatus,CONCAT(User.FirstName,' ',User.LastName)AS UserName,Notification.EntryBy,Notification.AcceptedRejected,VTPR.RejectReason FROM v_notifications AS Notification INNER JOIN v_users AS User ON Notification.UserID=User.UserID LEFT JOIN v_player_team_relation as VTPR on Notification.UserId = VTPR.PlayerId and Notification.CaptainID = VTPR.CaptainID AND Notification.is_active = 'Y' WHERE " . $ConditionForNotAccepted . "";
        //   echo "<br>";
        $RejectedNotificationData = $this->_db->prepare("SELECT Notification.CaptainID,Notification.NotificationID,Notification.UserID,Notification.is_active,Notification.NotificationText,Notification.ReadStatus,CONCAT(User.FirstName,' ',User.LastName)AS UserName,Notification.EntryBy,Notification.AcceptedRejected,VTPR.RejectReason FROM v_notifications AS Notification INNER JOIN v_users AS User ON Notification.UserID=User.UserID LEFT JOIN v_player_team_relation as VTPR on Notification.UserId = VTPR.PlayerId and Notification.CaptainID = VTPR.CaptainID  WHERE " . $ConditionForNotAccepted . "");
        $RejectedNotificationData->execute();
        $RejectedNotificationWiseData = $RejectedNotificationData->fetchAll(PDO::FETCH_ASSOC);
        $NumberOfRejectedNotification = $RejectedNotificationData->rowCount();

        if ($NumberOfPendingNotification || $NumberOfAcceptedNotification || $RejectedNotificationWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPendingNotificationWiseData'] = $PendingNotificationWiseData;
            $this->return_data['GetAcceptedNotificationWiseData'] = $AcceptedNotificationWiseData;
            $this->return_data['GetRejectedNotificationWiseData'] = $RejectedNotificationWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetNotificationCountData($Condition = '') {
        $json = json_decode($Condition, true);
//        print_r($json);
//        exit;
        if ($json['CaptainShipStatus'] == 'Y') {
//            $NotificationData = $this->_db->prepare("SELECT (SELECT COUNT(*) FROM v_notifications WHERE AcceptedRejected='P' AND CaptainID ='" . $json['UserID'] . "') as Pending,(SELECT COUNT(*) FROM v_notifications WHERE AcceptedRejected='R' AND CaptainID ='" . $json['UserID'] . "') as Reject,(SELECT COUNT(*) FROM v_notifications WHERE AcceptedRejected='A' AND CaptainID ='" . $json['UserID'] . "') as Accept");
            $NotificationData = $this->_db->prepare("SELECT (SELECT COUNT(*) FROM v_general_notifications WHERE NotificationStatus='P' AND SenderID ='" . $json['UserID'] . "' AND NotificationType = 'TeamNotification') as Pending,(SELECT COUNT(*) FROM v_general_notifications WHERE NotificationStatus='R' AND SenderID ='" . $json['UserID'] . "' AND NotificationType = 'TeamNotification') as Reject,(SELECT COUNT(*) FROM v_general_notifications WHERE NotificationStatus='A' AND SenderID ='" . $json['UserID'] . "' AND NotificationType = 'TeamNotification') as Accept");
        } else if ($json['CaptainShipStatus'] == 'N') {
//            echo "SELECT (SELECT COUNT(*) FROM v_notifications WHERE AcceptedRejected='P' AND UserID ='" . $json['UserID'] . "') as Pending,(SELECT COUNT(*) FROM v_notifications WHERE AcceptedRejected='R' AND UserID ='" . $json['UserID'] . "') as Reject,(SELECT COUNT(*) FROM v_notifications WHERE AcceptedRejected='A' AND UserID ='" . $json['UserID'] . "') as Accept";
//            exit;
//            $NotificationData = $this->_db->prepare("SELECT (SELECT COUNT(*) FROM v_notifications WHERE AcceptedRejected='P' AND UserID ='" . $json['UserID'] . "') as Pending,(SELECT COUNT(*) FROM v_notifications WHERE AcceptedRejected='R' AND UserID ='" . $json['UserID'] . "') as Reject,(SELECT COUNT(*) FROM v_notifications WHERE AcceptedRejected='A' AND UserID ='" . $json['UserID'] . "') as Accept");
//            echo "SELECT (SELECT COUNT(*) FROM v_general_notifications WHERE NotificationStatus='P' AND ReceiverID ='" . $json['UserID'] . "' AND NotificationType = 'TeamNotification') as Pending,(SELECT COUNT(*) FROM v_general_notifications WHERE NotificationStatus='R' AND ReceiverID ='" . $json['UserID'] . "' AND NotificationType = 'TeamNotification') as Reject,(SELECT COUNT(*) FROM v_general_notifications WHERE NotificationStatus='A' AND ReceiverID ='" . $json['UserID'] . "' AND NotificationType = 'TeamNotification') as Accept";
            $NotificationData = $this->_db->prepare("SELECT (SELECT COUNT(*) FROM v_general_notifications WHERE NotificationStatus='P' AND ReceiverID ='" . $json['UserID'] . "' AND NotificationType = 'TeamNotification') as Pending,(SELECT COUNT(*) FROM v_general_notifications WHERE NotificationStatus='R' AND ReceiverID ='" . $json['UserID'] . "' AND NotificationType = 'TeamNotification') as Reject,(SELECT COUNT(*) FROM v_general_notifications WHERE NotificationStatus='A' AND ReceiverID ='" . $json['UserID'] . "' AND NotificationType = 'TeamNotification') as Accept");
        }
        $NotificationData->execute();
        $CountNotificationData = $NotificationData->fetch(PDO::FETCH_ASSOC);

        if ($CountNotificationData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetNotificationCountData'] = $CountNotificationData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetNotificationData($Condition = '') {
        $json = json_decode($Condition, true);
//        print_r($json);
        if ($json['Status'] == 'Pending') {
            $whereCondition = "NotificationStatus = 'P' AND SenderID = '" . $json['UserID'] . "' AND NotificationType = 'TeamNotification'";
        } else if ($json['Status'] == 'Reject') {
            $whereCondition = "NotificationStatus = 'R' AND SenderID = '" . $json['UserID'] . "' AND NotificationType = 'TeamNotification'";
        } else if ($json['Status'] == 'Accept') {
            $whereCondition = "NotificationStatus = 'A' AND SenderID = '" . $json['UserID'] . "' AND NotificationType = 'TeamNotification'";
        }
        $Query = $this->_db->prepare("SELECT Notification.NotificationID,Notification.ReceiverID,Notification.is_active,Notification.NotificationText,Notification.ReadStatus,CONCAT(User.FirstName,' ',User.LastName)AS UserName,User.NickName,User.Height,User.Weight,User.EmailID,Notification.SenderID,Notification.NotificationStatus,RejectedReason FROM v_general_notifications AS Notification INNER JOIN v_users AS User ON Notification.ReceiverID=User.UserID WHERE " . $whereCondition . "");
        $Query->execute();
        $ResponseNotificationWiseData = $Query->fetchAll(PDO::FETCH_ASSOC);
        if ($ResponseNotificationWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetNotificationData'] = $ResponseNotificationWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllTournamentTeamData($Status = '') {
        $json = json_decode($Status, true);
// Comment ON 05-01-2016 By RONIT
//        if (isset($json['Flag']) && $json['Flag'] == 'TeamData') {
//            $condition = "TeamTournament.is_active='Y' AND TeamTournament.TournamentID = '" . $json['TournamentID'] . "' GROUP BY Team.TeamID";
//        } else if ($json['Flag'] == 'TeamPlayersData') {
//            $condition = "TeamTournament.is_active='Y' AND TeamTournament.TournamentID = '" . $json['TournamentID'] . "' AND Team.TeamID='" . $json['TeamID'] . "'";
//        }
        
        if (isset($json['Flag']) && $json['Flag'] == 'TeamData') {
            $condition = "TeamTournament.TournamentID = '" . $json['TournamentID'] . "' GROUP BY Team.TeamID";
        } else if ($json['Flag'] == 'TeamPlayersData') {
            $condition = "TeamTournament.TournamentID = '" . $json['TournamentID'] . "' AND Team.TeamID='" . $json['TeamID'] . "'";
        }
        
        $Query = $this->_db->prepare("SELECT TeamTournament.TeamTournamentRelationID, TeamTournament.CaptainID,TeamTournament.TournamentID,TeamTournament.TeamID,TeamTournament.PlayerID,TeamTournament.AdminStatus,TeamTournament.RejectionReason,TeamTournament.is_active,Tournaments.TournamentName,Tournaments.MaximumPlayers,Tournaments.MinimumPlayers,Tournaments.StartDate,Tournaments.EndDate,Tournaments.RegistrationStartDate,Tournaments.RegistrationEndDate,Team.TeamName,CONCAT(User.FirstName,' ',User.LastName )AS FullName,User.Height,User.Weight,User.EmailID,User.DOB,User.MobileNumber,User.UserID FROM v_teams_tournament_relation_temp AS TeamTournament INNER JOIN v_tournaments AS Tournaments ON TeamTournament.TournamentID=Tournaments.TournamentID INNER JOIN v_users AS User ON TeamTournament.PlayerID=User.UserID INNER JOIN v_teams AS Team ON TeamTournament.TeamID=Team.TeamID WHERE $condition");
        $Query->execute();
        $ResponseTournamentTeamWiseData = $Query->fetchAll(PDO::FETCH_ASSOC);
        if ($ResponseTournamentTeamWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentTeamData'] = $ResponseTournamentTeamWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllRoundsData() {

        $RoundData = $this->_db->prepare("SELECT Round.*, Tournament.TournamentID, Tournament.TournamentName FROM v_rounds AS Round INNER JOIN v_tournaments AS Tournament ON Round.TournamentID=Tournament.TournamentID WHERE Round.is_active != 'D'");

        $RoundData->execute();
        $RoundWiseData = $RoundData->fetchAll(PDO::FETCH_ASSOC);
        if (count($RoundWiseData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRoundWiseData'] = $RoundWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function ChangeCaptainShip() {
        $mysql = new DataTransaction($this->_db);
//        $json = json_decode($Condition, true);
//        print_r($_REQUEST);
//        exit;
        $QueryData = $this->_db->prepare("SELECT * FROM v_switch_captainship WHERE CaptainID = " . $_REQUEST['CaptainID'] . " AND is_active = 'Y' AND PlayerID = " . $_REQUEST['PlayerID'] . "");
        $QueryData->execute();
        $AvailableData = $QueryData->fetchAll(PDO::FETCH_ASSOC);
        if (Count($AvailableData) <= 0) {
            $data = array("PlayerID" => $_REQUEST['PlayerID'], "CaptainID" => $_REQUEST['CaptainID'], "TeamID" => $_REQUEST['TeamID'], "is_active" => 'Y', "EntryBy" => $_REQUEST['CaptainID'], "EntryDate" => date('Y-m-d'));

            $CaptainshipData = $mysql->insert($data, 'v_switch_captainship');
            if (count($CaptainshipData) > 0) {
                $this->return_data['ResponseCode'] = 1;
                $this->return_data['GetChnageCAptainshipData'] = $CaptainshipData;
                $this->return_data['Message'] = "Request To Change Captainship Send Successfully ";
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'You Have Already Send Request To This Player ';
        }


        return $this->return_data;
    }

    public function GetAllTeamCaptainRequest($Condition = '') {

        $json = json_decode($Condition, true);
//        echo "SELECT SwitchCaptain.SwitchCaptainshipID,SwitchCaptain.TeamID,SwitchCaptain.PlayerID,SwitchCaptain.CaptainID,SwitchCaptain.is_active,SwitchCaptain.AcceptedRejected,SwitchCaptain.ReadStatus,CONCAT(User.FirstName,' ',User.LastName)AS CaptainName,User.EmailID FROM v_switch_captainship AS SwitchCaptain INNER JOIN v_users AS User ON User.UserID=SwitchCaptain.CaptainID  WHERE SwitchCaptain.is_active = 'Y' AND SwitchCaptain.PlayerID = '" . $json['UserID'] . "'";
        $AcceptBecomeCaptainQuery = $this->_db->prepare("SELECT SwitchCaptain.SwitchCaptainshipID,SwitchCaptain.TeamID,SwitchCaptain.PlayerID,SwitchCaptain.CaptainID,SwitchCaptain.is_active,SwitchCaptain.AcceptedRejected,SwitchCaptain.ReadStatus,CONCAT(User.FirstName,' ',User.LastName)AS CaptainName,User.EmailID FROM v_switch_captainship AS SwitchCaptain INNER JOIN v_users AS User ON User.UserID=SwitchCaptain.CaptainID  WHERE SwitchCaptain.is_active = 'Y' AND SwitchCaptain.PlayerID = '" . $json['UserID'] . "'");

        $AcceptBecomeCaptainQuery->execute();
        $AcceptBecomeCaptainData = $AcceptBecomeCaptainQuery->fetchAll(PDO::FETCH_ASSOC);
//        print_r($AcceptBecomeCaptainData);
        if ($AcceptBecomeCaptainData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetBecomeCaptainData'] = $AcceptBecomeCaptainData;
            $this->return_data['Message'] = 'Request List';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function AcceptBecomeCaptainRequest($Condition = '') {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $SwitchCaptainshipData = $mysql->update('v_switch_captainship', array("is_active" => 'N', "AcceptedRejected" => "A"), array("SwitchCaptainshipID" => $json['SwitchCaptainshipID'], "is_active" => 'Y'));
        if ($SwitchCaptainshipData) {
            $TeamsData = $mysql->update('v_teams', array("CaptainID" => $json['PlayerID']), array("TeamID" => $json['TeamID'], "is_active" => 'Y'));
            if ($TeamsData) {
                $PlayerReleMasterData = $mysql->update('v_player_team_relation_master', array("CaptainID" => $json['PlayerID']), array("TeamID" => $json['TeamID'], "is_active" => 'Y'));
                if ($PlayerReleMasterData) {
                    $PlayerReleData = $mysql->update('v_player_team_relation', array("CaptainID" => $json['PlayerID']), array("TeamID" => $json['TeamID'], "is_active" => 'Y'));
                    if ($PlayerReleData) {
                        $PlayerToCaptainStatusYData = $mysql->update('v_users', array("CaptainshipStatus" => 'Y'), array("UserID" => $json['PlayerID'], "is_active" => 'Y'));
                        if ($PlayerToCaptainStatusYData) {
                                $PlayerToCaptainStatusData = $mysql->update('v_users', array("CaptainshipStatus" => 'N'), array("UserID" => $json['CaptainID'], "is_active" => 'Y'));
                                if ($PlayerToCaptainStatusData) {
                                    $this->return_data['ResponseCode'] = 1;
                                    $this->return_data['Message'] = 'Congrulations, Now you are become the Captain';
                                } else {
                                    $this->return_data['ResponseCode'] = 0;
                                    $this->return_data['Message'] = 'No Record Found';
                                }
                            }
                        }
                    }
                }
            }
        return $this->return_data;
    }

    public function RejectBecomeCaptainRequest($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        $TeamCaptainShipRequestRejectData = $mysql->update('v_switch_captainship', array("is_active" => "N", "RejectReason" => $_REQUEST['ReajectCaptainshipReason'], "AcceptedRejected" => 'R'), array("SwitchCaptainshipID" => $_REQUEST['SwitchCaptainshipID']));
        if ($TeamCaptainShipRequestRejectData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['Message'] = 'Request Rejected.';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllRoundsPointsDataByTournament($Condition = '') {
        $json = json_decode($Condition, true);

        $RoundPointsData = $this->_db->prepare("SELECT RoundPoints.*,Tournament.TournamentName,Rounds.RoundName FROM v_round_points_parameters AS RoundPoints INNER JOIN v_tournaments AS Tournament ON RoundPoints.TournamentID=Tournament.TournamentID INNER JOIN v_rounds AS Rounds ON RoundPoints.RoundID=Rounds.RoundID WHERE RoundPoints.is_active != 'D' AND RoundPoints.TournamentID='" . $json['TournamentID'] . "' ");

        $RoundPointsData->execute();
        $RoundPointsWiseData = $RoundPointsData->fetchAll(PDO::FETCH_ASSOC);
        if (count($RoundPointsWiseData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetRoundPointsWiseData'] = $RoundPointsWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllTournaments($Condition = '') {
        $json = json_decode($Condition, true);
        if ((!isset($json['StartDate']) || $json['StartDate'] == '') && (!isset($json['EndDate']) || $json['EndDate'] == '')) {
            $TournamentData = $this->_db->prepare("SELECT Tournament.TournamentID,Tournament.TournamentName,Tournament.StartDate,Tournament.EndDate,Tournament.Description,Tournament.TournamentFor,Tournament.SecondRunnerUpsPrize,Tournament.RegistrationFees,Tournament.MaximumPlayers,Tournament.MinimumPlayers,Tournament.WinnerPrize,Tournament.RunnerUpsPrize,(CASE WHEN Tournament.TournamentImage = '' THEN '" . SITE_URL . "admin/uploads/placeholder3.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/TournamentImage/',Tournament.TournamentImage) END) AS TournamentImage,Tournament.StateID,Tournament.CityID,GROUP_CONCAT(DISTINCT State.StateName) AS StateName,GROUP_CONCAT(DISTINCT City.CityName) AS CityName ,TournamentType.TypeName,Tournament.RegistrationStartDate,Tournament.RegistrationEndDate FROM v_tournaments AS Tournament LEFT JOIN v_state AS State ON find_in_set(State.StateID,Tournament.StateID) LEFT JOIN v_city AS City ON find_in_set(City.CityID,Tournament.CityID) INNER JOIN v_tournament_type AS TournamentType ON Tournament.TypeID = TournamentType.SrNo WHERE StartDate>= curdate() AND StartDate !='0000-00-00' GROUP BY Tournament.TournamentID ORDER BY startdate DESC");
        } else {
            $TournamentData = $this->_db->prepare("SELECT Tournament.TournamentID,Tournament.TournamentName,Tournament.StartDate,Tournament.EndDate,Tournament.Description,Tournament.TournamentFor,Tournament.SecondRunnerUpsPrize,Tournament.RegistrationFees,Tournament.MaximumPlayers,Tournament.MinimumPlayers,Tournament.WinnerPrize,Tournament.RunnerUpsPrize,(CASE WHEN Tournament.TournamentImage = '' THEN '" . SITE_URL . "admin/uploads/placeholder3.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/TournamentImage/',Tournament.TournamentImage) END) AS TournamentImage,Tournament.StateID,Tournament.CityID,GROUP_CONCAT(DISTINCT State.StateName) AS StateName,GROUP_CONCAT(DISTINCT City.CityName) AS CityName ,TournamentType.TypeName,Tournament.RegistrationStartDate,Tournament.RegistrationEndDate FROM v_tournaments AS Tournament LEFT JOIN v_state AS State ON find_in_set(State.StateID,Tournament.StateID) LEFT JOIN v_city AS City ON find_in_set(City.CityID,Tournament.CityID) INNER JOIN v_tournament_type AS TournamentType ON Tournament.TypeID = TournamentType.SrNo WHERE StartDate >= '" . $json['StartDate'] . "' AND EndDate<= '" . $json['EndDate'] . "' AND StartDate !='0000-00-00' AND EndDate != '0000-00-00' GROUP BY Tournament.TournamentID");
        }
        $TournamentData->execute();
        $TournamentWiseData = $TournamentData->fetchAll(PDO::FETCH_ASSOC);
        if (count($TournamentWiseData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentDateWiseData'] = $TournamentWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetTournamentDetails($Condition = '') {
        $json = json_decode($Condition, true);

        $TournamentIDData = $this->_db->prepare("SELECT Tournament.TournamentID,Tournament.TournamentName,Tournament.StartDate,Tournament.EndDate,Tournament.Description,Tournament.PlayerOfTheTournamnetPrice,Tournament.TournamentFor,Tournament.SecondRunnerUpsPrize,Tournament.RegistrationFees,Tournament.MaximumPlayers,Tournament.MinimumPlayers,Tournament.WinnerPrize,Tournament.RunnerUpsPrize,(CASE WHEN Tournament.TournamentImage = '' THEN '" . SITE_URL . "admin/uploads/placeholder3.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/TournamentImage/',Tournament.TournamentImage) END) AS TournamentImage,Tournament.StateID,Tournament.CityID,GROUP_CONCAT(DISTINCT State.StateName) AS StateName,GROUP_CONCAT(DISTINCT City.CityName) AS CityName ,TournamentType.TypeName,Tournament.RegistrationStartDate,Tournament.RegistrationEndDate,Tournament.TournamentRules FROM v_tournaments AS Tournament LEFT JOIN v_state AS State ON find_in_set(State.StateID,Tournament.StateID) LEFT JOIN v_city AS City ON find_in_set(City.CityID,Tournament.CityID) INNER JOIN v_tournament_type AS TournamentType ON Tournament.TypeID = TournamentType.SrNo WHERE TournamentID='" . $json['TournamentID'] . "' GROUP BY Tournament.TournamentID");
        $TournamentIDData->execute();
        $TournamentIDWiseData = $TournamentIDData->fetchAll(PDO::FETCH_ASSOC);
        if (count($TournamentIDWiseData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentIDWiseData'] = $TournamentIDWiseData;
            $this->return_data['Flag'] = 'True';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function SendTeamToVerification($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        unset($_REQUEST['class']);
        unset($_REQUEST['method']);
        if (substr($json['PlayerList'], -1, 1) == ',') {
            $json['PlayerList'] = substr($json['PlayerList'], 0, -1);
        }
        $lis = trim($json['PlayerList']);
        $list = explode(',', $lis);

        if ($json['TournamentID'] != '') {
            if ($json['StateID'] != '') {
                if ($json['CityID'] != '') {
                    if ($json['TeamID'] != '') {
                        if ($json['TournamentRulesStatus'] != '') {
                            $TeamData = $this->_db->prepare("SELECT TeamName FROM v_teams WHERE is_active = 'Y' AND TeamID = '" . $json['TeamID'] . "'");
                            $TeamData->execute();
                            $TeamWiseData = $TeamData->fetch(PDO::FETCH_ASSOC);

                            $TournamentData = $this->_db->prepare("SELECT * FROM v_tournaments WHERE is_active = 'Y' AND TournamentID = '" . $json['TournamentID'] . "'");
                            $TournamentData->execute();
                            $TournamentWiseData = $TournamentData->fetch(PDO::FETCH_ASSOC);
                            $SendPlayer = $this->_db->prepare("SELECT COUNT(PlayerID) as PlayerAlreadySent FROM v_teams_tournament_relation_temp WHERE (AdminStatus='Y' OR AdminStatus='R') AND TeamID = '" . $json['TeamID'] . "' AND TournamentID = '".$json['TournamentID']."' AND is_active='Y'");
                            $SendPlayer->execute();
                            $SendPlayerCountData = $SendPlayer->fetch(PDO::FETCH_ASSOC);
                            $SendPlayerCountNew = $SendPlayerCountData['PlayerAlreadySent'];
                            $PlayerAlreadySent = sizeof($list) + $SendPlayerCountNew;
                            if (isset($list) && $list != '') {
                                if ($PlayerAlreadySent > $TournamentWiseData['MaximumPlayers'] || $PlayerAlreadySent < $TournamentWiseData['MinimumPlayers']) {
                                    $this->return_data['ResponseCode'] = 0;
                                    $this->return_data['Message'] = 'Please select atleast ' . $TournamentWiseData['MinimumPlayers'] . ' and not more than ' . $TournamentWiseData['MaximumPlayers'] . ' players to apply for tournament';
                                } else {
//                            $TournamentLastIDData = $this->_db->prepare("SELECT * FROM v_teams_tournament_relation WHERE TeamID =  '".$json['TeamID']."' AND is_active = 'Y'");
//                            $TournamentLastIDData->execute();
//                            $TournamentLastIDWiseData = $TournamentLastIDData->fetchAll(PDO::FETCH_ASSOC);
//                            echo "SELECT * FROM v_tournaments WHERE TournamentID =  '".$TournamentLastIDWiseData[0]['TournamentID']."'";
//                            $GetAppliedTournamentQuery = $this->_db->prepare("SELECT * FROM v_tournaments WHERE TournamentID =  '".$TournamentLastIDWiseData[0]['TournamentID']."'");
//                            $GetAppliedTournamentQuery->execute();
//                            $GetAppliedTournamentData = $GetAppliedTournamentQuery->fetch(PDO::FETCH_ASSOC);
//                            
//                            echo '<pre>';
//                            print_r($GetAppliedTournamentData);
//                            $AppliedTournamentStartDate =$GetAppliedTournamentData['StartDate'];
//                            $AppliedTournamentEndDate =$GetAppliedTournamentData['EndDate'];
//                            
//                            if (count($TournamentLastIDWiseData) <= 0 ) {
                                    for ($i = 0; $i < sizeof($list); $i++) {
                                        $TournamentRelationTempPlayersQuery = $this->_db->prepare("SELECT * FROM v_teams_tournament_relation_temp WHERE TeamID =  '" . $json['TeamID'] . "' AND TournamentID = '" . $json['TournamentID'] . "' AND PlayerID = '" . $list[$i] . "' AND AdminStatus!='R'");
                                        $TournamentRelationTempPlayersQuery->execute();
                                        $NewArray = $TournamentRelationTempPlayersQuery->fetch(PDO::FETCH_ASSOC);
                                        if (empty($NewArray)) {

                                            $UsertNameQuery = $this->_db->prepare("SELECT CONCAT(FirstName,' ',LastName) AS PlayerName FROM v_users WHERE UserID =  '" . $list[$i] . "' AND is_active = 'Y'");
                                            $UsertNameQuery->execute();
                                            $UsertNameData = $UsertNameQuery->fetch(PDO::FETCH_ASSOC);

//                                echo '<pre>';
//                                print_r($UsertNameData);
//                                exit;
                                            $data = array("PlayerID" => $list[$i], "TournamentID" => $json['TournamentID'], "CityID" => $json['CityID'], "StateID" => $json['StateID'], "TeamID" => $json['TeamID'], "CaptainID" => $json['CaptainID'], "TournamentRulesStatus" => $json['TournamentRulesStatus'], "is_active" => 'Y', "EntryBy" => $json['CaptainID'], "EntryDate" => date('Y-m-d'));
                                            $UserData = $mysql->insert($data, 'v_teams_tournament_relation_temp');

                                            $NotificationTextForTournament = 'Hello "' . $UsertNameData['PlayerName'] . '", your team "' . $TeamWiseData['TeamName'] . '" has been sent for approval. It may take couple of days to get approval. You will be notified once the approval process completes. Thank you for showing willingness to be the part of "' . $TournamentWiseData['TournamentName'] . '".';
                                            $TournamentSentNotification = array("NotificationTitle" => 'Tournament', "NotificationType" => 'TournamentNotification', "NotificationText" => $NotificationTextForTournament, "SenderID" => $json['CaptainID'], "ReceiverID" => $list[$i], "is_active" => 'Y', "NotificationCreatedDate" => date('Y-m-d'));
                                            $TournamentNotificationData = $mysql->insert($TournamentSentNotification, 'v_general_notifications');
                                        }
                                    }
                                    $this->return_data['ResponseCode'] = 1;
                                    $this->return_data['GetSendTeamData'] = $UserData;
                                    $this->return_data['Message'] = 'Team Request For Selected Players Send Successfully To Admin';
//                            } else {
//                                $this->return_data['ResponseCode'] = 0;
//                                $this->return_data['Message'] = 'Team Already Sent';
//                            }
                                }
                            } else {
                                $this->return_data['ResponseCode'] = 0;
                                $this->return_data['Message'] = 'Select player to add team';
                            }
                        } else {
                            $this->return_data['ResponseCode'] = 0;
                            $this->return_data['Message'] = 'Please Accept Tournament Rules';
                        }
                    } else {
                        $this->return_data['ResponseCode'] = 0;
                        $this->return_data['Message'] = 'Team ID Required';
                    }
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'Select City';
                }
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'Select State';
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Select Tournament';
        }
        return $this->return_data;
    }

    public function GetAprrovalTeamData($Condition = '') {
        $json = json_decode($Condition, true);
        $TournamentAprrovalData = $this->_db->prepare("SELECT COUNT(TournamentRele.AdminStatus) AS AdminStatusCount,Tournament.TournamentID,Tournament.MaximumPlayers,Tournament.MinimumPlayers FROM v_teams_tournament_relation AS TournamentRele INNER JOIN v_tournaments AS Tournament ON TournamentRele.TournamentID= Tournament.TournamentID WHERE TournamentRele.TournamentID='" . $json['TournamentID'] . "' AND TournamentRele.TeamID='" . $json['TeamID'] . "' AND TournamentRele.AdminStatus = 'Y'");

        $TournamentAprrovalData->execute();
        $TournamentAprrovalWiseData = $TournamentAprrovalData->fetch(PDO::FETCH_ASSOC);

        if (count($TournamentAprrovalWiseData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentAprrovalWiseData'] = $TournamentAprrovalWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function SaveFinalTeamForTournament($Condition = '') {
        $mysql = new DataTransaction($this->_db);
        $json = json_decode($Condition, true);
        $TournamentTeamAprrovalData = $this->_db->prepare("SELECT * FROM v_teams_tournament_relation_temp WHERE TournamentID='" . $_REQUEST['TournamentID'] . "' AND TeamID='" . $_REQUEST['TeamID'] . "' AND AdminStatus = 'Y'");

        $TournamentTeamAprrovalData->execute();
        $TournamentTeamAprrovalWiseData = $TournamentTeamAprrovalData->fetchAll(PDO::FETCH_ASSOC);

        $CaptainIDDataQ = $this->_db->prepare("SELECT * FROM v_teams WHERE TeamID='" . $_REQUEST['TeamID'] . "' AND is_active='Y'");

        $CaptainIDDataQ->execute();
        $CaptainIDData = $CaptainIDDataQ->fetch(PDO::FETCH_ASSOC);
        
        $TournamentAlreadyApproveQuery = $this->_db->prepare("SELECT * FROM v_teams_tournament_relation WHERE TournamentID='" . $_REQUEST['TournamentID'] . "' AND TeamID='" . $_REQUEST['TeamID'] . "'");
        
        $TournamentAlreadyApproveQuery->execute();
        $TournamentAlreadyApproveData = $TournamentAlreadyApproveQuery->fetchAll(PDO::FETCH_ASSOC);
        
        $TournamentNameQueryForFinalTeam = $this->_db->prepare("SELECT TournamentName FROM v_tournaments WHERE is_active = 'Y' AND TournamentID = '" . $_REQUEST['TournamentID'] . "'");
        $TournamentNameQueryForFinalTeam->execute();
        $TournamentNameQueryForFinalTeamData = $TournamentNameQueryForFinalTeam->fetch(PDO::FETCH_ASSOC);
        
        $TeamNameQueryForFinalTeam = $this->_db->prepare("SELECT TeamName FROM v_teams WHERE is_active = 'Y' AND TeamID = '" . $_REQUEST['TeamID'] . "'");
        $TeamNameQueryForFinalTeam->execute();
        $TeamNameQueryForFinalTeamData = $TeamNameQueryForFinalTeam->fetch(PDO::FETCH_ASSOC);
        
        if (is_array($TournamentAlreadyApproveData) && !empty($TournamentAlreadyApproveData)) {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Team Already Approved';
        } else {
            foreach ($TournamentTeamAprrovalWiseData AS $Key => $Value) {  
            $PalyerNameQueryForFinalTeam = $this->_db->prepare("SELECT CONCAT(FirstName,' ',LastName) AS PlayerName FROM v_users WHERE is_active = 'Y' AND UserID = '" . $Value['PlayerID'] . "'");
            $PalyerNameQueryForFinalTeam->execute();
            $PalyerNameQueryForFinalTeamData = $PalyerNameQueryForFinalTeam->fetch(PDO::FETCH_ASSOC);
            $NotificationTextForPlayerFinalTeam = "Hello '".$PalyerNameQueryForFinalTeamData['PlayerName']."' Your Team,'" . $TeamNameQueryForFinalTeamData['TeamName'] . "' has been Successfully Approved by Admin for '" . $TournamentNameQueryForFinalTeamData['TournamentName'] . "' Tournament.";

            $NotificationDataDeclineReasonPlayer = array("NotificationTitle" => 'Tournament', "NotificationType" => 'TournamentNotification', "NotificationText" => $NotificationTextForPlayerFinalTeam, "SenderID" => $_SESSION['KametSports']['session']['UserID'], "ReceiverID" => $Value['PlayerID'], "is_active" => 'Y', "DeleteStatus" => 'N', "NotificationCreatedDate" => date('Y-m-d'));
            $NotificationDataDeclineReasonPlayerData = $mysql->insert($NotificationDataDeclineReasonPlayer, 'v_general_notifications');
            
            $CaptianNameQueryForFinalTeam = $this->_db->prepare("SELECT CONCAT(FirstName,' ',LastName) AS CaptainName FROM v_users WHERE is_active = 'Y' AND UserID = '" . $Value['CaptainID'] . "'");
            $CaptianNameQueryForFinalTeam->execute();
            $CaptianNameQueryForFinalTeamData = $CaptianNameQueryForFinalTeam->fetch(PDO::FETCH_ASSOC);
            
            
            
            $DataForTeamTournaRele = array("TournamentID" => $Value['TournamentID'], "TeamID" => $Value['TeamID'], "PlayerID" => $Value['PlayerID'], "CaptainID" => $Value['CaptainID'], "StateID" => $Value['StateID'], "CityID" => $Value['CityID'], "AdminStatus" => $Value['AdminStatus'], "TournamentRulesStatus" => $Value['TournamentRulesStatus'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'));
                $TeamTournaReleData = $mysql->insert($DataForTeamTournaRele, 'v_teams_tournament_relation');
            }
            
            
            
            $NotificationTextForPayment = 'Congratulation !!!,"'.$CaptianNameQueryForFinalTeamData['CaptainName'].'" Your Team has been successfully approved by admin make payment for finalize team for tournament';
            $NotificationDataDeclineReasonPlayer = array("NotificationTitle" => 'Payment', "NotificationType" => 'MakePaymetForTeam', "NotificationText" => $NotificationTextForPayment, "SenderID" => $_SESSION['KametSports']['session']['UserID'], "ReceiverID" => $CaptainIDData['CaptainID'], "is_active" => 'Y', "DeleteStatus" => 'N', "NotificationCreatedDate" => date('Y-m-d'));
            $NotificationDataDeclineReasonPlayerData = $mysql->insert($NotificationDataDeclineReasonPlayer, 'v_general_notifications');
            if ($TeamTournaReleData) {
                $this->return_data['ResponseCode'] = 1;
//            $this->return_data['GetTournamentAprrovalWiseData'] = $TournamentAprrovalWiseData;
                $this->return_data['Message'] = 'Team Approved Successfully';
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found';
            }
        }
        return $this->return_data;
    }

    public function GetTournamnetReleTeamTempData($Condition = '') {
        $json = json_decode($Condition, true);
        $TournamentAprrovalData = $this->_db->prepare("SELECT COUNT(TournamentRele.AdminStatus) AS AdminStatusCount,Tournament.TournamentID,Tournament.MaximumPlayers,Tournament.MinimumPlayers FROM v_teams_tournament_relation_temp AS TournamentRele INNER JOIN v_tournaments AS Tournament ON TournamentRele.TournamentID= Tournament.TournamentID WHERE TournamentRele.TournamentID='" . $json['TournamentID'] . "' AND TournamentRele.TeamID='" . $json['TeamID'] . "' AND TournamentRele.AdminStatus = 'Y'");

        $TournamentAprrovalData->execute();
        $TournamentAprrovalWiseData = $TournamentAprrovalData->fetch(PDO::FETCH_ASSOC);
        
        if ($TournamentAprrovalWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentTempData'] = $TournamentAprrovalWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function GetTournamnetReleTeamTempForCheckPlayerData($Condition = '') {
        $json = json_decode($Condition, true);
//        echo "SELECT COUNT(TournamentRele.AdminStatus) AS AdminStatusCount,Tournament.TournamentID,Tournament.MaximumPlayers,Tournament.MinimumPlayers FROM v_teams_tournament_relation_temp AS TournamentRele INNER JOIN v_tournaments AS Tournament ON TournamentRele.TournamentID= Tournament.TournamentID WHERE TournamentRele.TournamentID='" . $json['TournamentID'] . "' AND TournamentRele.TeamID='" . $json['TeamID'] . "'";
        $TournamentAprrovalPlayerData = $this->_db->prepare("SELECT COUNT(TournamentRele.AdminStatus) AS AdminStatusCount,Tournament.TournamentID,Tournament.MaximumPlayers,Tournament.MinimumPlayers FROM v_teams_tournament_relation_temp AS TournamentRele INNER JOIN v_tournaments AS Tournament ON TournamentRele.TournamentID= Tournament.TournamentID WHERE TournamentRele.TournamentID='" . $json['TournamentID'] . "' AND TournamentRele.TeamID='" . $json['TeamID'] . "'");

        $TournamentAprrovalPlayerData->execute();
        $TournamentAprrovalWisePlayerData = $TournamentAprrovalPlayerData->fetch(PDO::FETCH_ASSOC);
        
        if ($TournamentAprrovalWisePlayerData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentTempPlayerData'] = $TournamentAprrovalWisePlayerData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function GetTournamnetReleTeamTempForPlayerCheckData($Condition = '') {
        $json = json_decode($Condition, true);
        $TournamentAprrovalForPlayerCheckData = $this->_db->prepare("SELECT TournamentID,TeamID,PlayerID,CaptainID,AdminStatus FROM v_teams_tournament_relation_temp WHERE PlayerID='" . $json['PlayerID'] . "' AND TournamentID = '".$json['TournamentID']."'");

        $TournamentAprrovalForPlayerCheckData->execute();
        $TournamentAprrovalWiseForPlayerCheckData = $TournamentAprrovalForPlayerCheckData->fetch(PDO::FETCH_ASSOC);

        if (count($TournamentAprrovalWiseForPlayerCheckData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentTempForPlayerCheckData'] = $TournamentAprrovalWiseForPlayerCheckData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetTournamnetWiseForTeamScheduleData($Condition = '') {
        $json = json_decode($Condition, true);

        $TeamGroupQuery = $this->_db->prepare("SELECT GroupTeamRele.TournamentID,GroupTeamRele.GroupID,GroupTeamRele.TeamID,GroupTeamRele.GroupTeamRelationID,Tournament.TournamentName,Tournament.StartDate,Tournament.EndDate,Team.TeamName,VGroup.GroupName FROM v_groups_team_relation AS GroupTeamRele INNER JOIN v_tournaments AS Tournament ON GroupTeamRele.TournamentID = Tournament.TournamentID INNER JOIN v_teams AS Team ON GroupTeamRele.TeamID = Team.TeamID INNER JOIN v_groups AS VGroup ON GroupTeamRele.GroupID = VGroup.GroupID WHERE GroupTeamRele.TournamentID='" . $json['TournamentID'] . "' AND GroupTeamRele.is_active = 'Y' GROUP BY GroupTeamRele.GroupID");

        $TeamGroupQuery->execute();
        $TeamGroupData = $TeamGroupQuery->fetchAll(PDO::FETCH_ASSOC);
        if (count($TeamGroupData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamGroupData'] = $TeamGroupData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetGroupDropDownData($Condition = '') {
        $json = json_decode($Condition, true);
        $GroupDrpQuery = $this->_db->prepare("SELECT GroupTeamRele.TournamentID,GroupTeamRele.GroupID,GroupTeamRele.TeamID,GroupTeamRele.GroupTeamRelationID,Tournament.TournamentName,Team.TeamName,VGroup.GroupName FROM v_groups_team_relation AS GroupTeamRele INNER JOIN v_tournaments AS Tournament ON GroupTeamRele.TournamentID = Tournament.TournamentID INNER JOIN v_teams AS Team ON GroupTeamRele.TeamID = Team.TeamID INNER JOIN v_groups AS VGroup ON GroupTeamRele.GroupID = VGroup.GroupID WHERE GroupTeamRele.GroupID = '" . $json['GroupID'] . "' AND GroupTeamRele.TournamentID='" . $json['TournamentID'] . "' AND GroupTeamRele.is_active = 'Y'");
        $GroupDrpQuery->execute();
        $GroupDrpData = $GroupDrpQuery->fetchAll(PDO::FETCH_ASSOC);

        if (count($GroupDrpData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGroupDrpData'] = $GroupDrpData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function TournamentWiseGroup($Condition = '') {
        $json = json_decode($Condition, true);
        echo "SELECT GroupID,TournamentID,GroupName FROM v_groups WHERE TournamentID='" . $json['TournamentID'] . "' AND is_active = 'Y'";
        $GroupQuery = $this->_db->prepare("SELECT GroupID,TournamentID,GroupName FROM v_groups WHERE TournamentID='" . $json['TournamentID'] . "' AND is_active = 'Y'");
        $GroupQuery->execute();
        $GroupData = $GroupQuery->fetchAll(PDO::FETCH_ASSOC);

        if (count($GroupData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGroupData'] = $GroupData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetAllMacthScheduleData() {

        $MatchScheduleQuery = $this->_db->prepare("SELECT MatchSchedule.*,Team.TeamName AS FirstName,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2) as SecondName, Ground.GroundName,Court.CourtName,Round.RoundName,Tournament.TournamentName FROM v_match_schedule AS MatchSchedule INNER JOIN v_teams AS Team ON MatchSchedule.GroupTeamRelationID1 = Team.TeamID INNER JOIN v_ground_master AS Ground ON MatchSchedule.GroundID=Ground.GroundID INNER JOIN v_court_master AS Court ON MatchSchedule.CourtID=Court.CourtID INNER JOIN v_rounds AS Round ON MatchSchedule.RoundID=Round.RoundID INNER JOIN v_tournaments AS Tournament ON MatchSchedule.TournamentID=Tournament.TournamentID WHERE MatchSchedule.is_active != 'D'");

        $MatchScheduleQuery->execute();
        $MatchScheduleData = $MatchScheduleQuery->fetchAll(PDO::FETCH_ASSOC);
        if (count($MatchScheduleData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetMatchScheduleData'] = $MatchScheduleData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertMatchScheduleData() {
        $mysql = new DataTransaction($this->_db);
        $data = date("Y-m-d", strtotime($_REQUEST['MatchDate']));
        $MatchScheduleQuery = $this->_db->prepare("SELECT * FROM v_match_schedule WHERE ((GroupTeamRelationID1= '" . $_REQUEST['GroupTeamRelationID1'] . "' AND GroupTeamRelationID2 = '" . $_REQUEST['GroupTeamRelationID2'] . "') OR (GroupTeamRelationID1= '" . $_REQUEST['GroupTeamRelationID2'] . "' AND GroupTeamRelationID2 = '" . $_REQUEST['GroupTeamRelationID1'] . "')) AND TournamentID= '" . $_REQUEST['TournamentID'] . "' AND RoundID = '" . $_REQUEST['RoundID'] . "' AND is_active = 'Y'");
        $MatchScheduleQuery->execute();
        $MatchScheduleData = $MatchScheduleQuery->fetch(PDO::FETCH_ASSOC);
//        alert($MatchScheduleData);
        if ($MatchScheduleData) {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Already Schedule Set For This Team';
        } else {
            $data = array("TournamentID" => $_REQUEST['TournamentID'], "RoundID" => $_REQUEST['RoundID'], "MatchType" => $_REQUEST['MatchType'], "GroupTeamRelationID1" => $_REQUEST['GroupTeamRelationID1'], "GroupTeamRelationID2" => $_REQUEST['GroupTeamRelationID2'], "MatchDate" => $data, "GroundID" => $_REQUEST['GroundID'], "MatchTime" => $_REQUEST['MatchTime'], "CourtID" => $_REQUEST['CourtID'], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'));
            $MatchScheduleData = $mysql->insert($data, 'v_match_schedule');
            if ($MatchScheduleData) {
                $this->return_data['ResponseCode'] = 1;
                $this->return_data['GetMatchScheduleData'] = $MatchScheduleData;
                $this->return_data['Message'] = 'Match Schedule Data Save Successfully';
            } else {
                $this->return_data['ResponseCode'] = 0;
                $this->return_data['Message'] = 'No Record Found';
            }
        }
        return $this->return_data;
    }

    public function GetMatchScheduleDataByID($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);

        $MatchScheduleQuery = $this->_db->prepare("SELECT MatchSchedule.*,(SELECT GROUP_CONCAT(GroupName) FROM v_groups WHERE v_groups.TournamentID = MatchSchedule.TournamentID) AS GroupName, Team.TeamName AS FirstName,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2) as SecondName,Ground.GroundName,Court.CourtName,Round.RoundName FROM v_match_schedule AS MatchSchedule INNER JOIN v_teams AS Team ON MatchSchedule.GroupTeamRelationID1 = Team.TeamID INNER JOIN v_ground_master AS Ground ON MatchSchedule.GroundID=Ground.GroundID INNER JOIN v_court_master AS Court ON MatchSchedule.CourtID=Court.CourtID INNER JOIN v_rounds AS Round ON MatchSchedule.RoundID=Round.RoundID WHERE MatchSchedule.is_active != 'D' AND MatchSchedule.MatchId = '" . $_REQUEST['MatchId'] . "'");


        $MatchScheduleQuery->execute();
        $MatchScheduleData = $MatchScheduleQuery->fetch(PDO::FETCH_ASSOC);

        if ($MatchScheduleData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetMatchScheduleData'] = $MatchScheduleData;
            $this->return_data['Message'] = 'Match Schedule Data Save Successfully';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetMatchScheduleDataByTournamentID($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        $StartDate = date('Y-m-d', strtotime($json['StartDate']));
        $EndDate = date('Y-m-d', strtotime($json['EndDate']));
        if ($json['TournamentID'] != '' && $json['StartDate'] == '' && $json['EndDate'] == '') {
            $MatchScheduleQuery = $this->_db->prepare("SELECT MatchSchedule.*,MatchSchedule.MatchTime AS MatchStartTime,(SELECT GROUP_CONCAT(GroupName) FROM v_groups WHERE v_groups.TournamentID = MatchSchedule.TournamentID) AS GroupName, Team.TeamName AS FirstName,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2) as SecondName,(CASE WHEN (SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2) = '' THEN '" . SITE_URL . "admin/uploads/TeamLogo/team-placeholder.jpg' ELSE CONCAT('" . SITE_URL . "admin/uploads/TeamLogo/',(SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2)) END) AS SecondTeamLogo,(CASE WHEN (SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID1) = '' THEN '" . SITE_URL . "admin/uploads/TeamLogo/team-placeholder.jpg' ELSE CONCAT('" . SITE_URL . "admin/uploads/TeamLogo/',(SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID1)) END) AS FirstTeamLogo,Ground.GroundName,Court.CourtName,Round.RoundName,Tournament.SecondRunnerUpsPrize,Tournament.StartDate,Tournament.EndDate FROM v_match_schedule AS MatchSchedule INNER JOIN v_teams AS Team ON MatchSchedule.GroupTeamRelationID1 = Team.TeamID INNER JOIN v_ground_master AS Ground ON MatchSchedule.GroundID=Ground.GroundID INNER JOIN v_court_master AS Court ON MatchSchedule.CourtID=Court.CourtID INNER JOIN v_tournaments AS Tournament ON MatchSchedule.TournamentID=Tournament.TournamentID INNER JOIN v_rounds AS Round ON MatchSchedule.RoundID=Round.RoundID WHERE MatchSchedule.is_active != 'D' AND MatchSchedule.TournamentID = '" . $json['TournamentID'] . "'");
        } else if ($json['StartDate'] != '' && $json['EndDate'] != '' && $json['TournamentID'] != '') {
            $MatchScheduleQuery = $this->_db->prepare("SELECT MatchSchedule.*,MatchSchedule.MatchTime AS MatchStartTime,(SELECT GROUP_CONCAT(GroupName) FROM v_groups WHERE v_groups.TournamentID = MatchSchedule.TournamentID) AS GroupName, Team.TeamName AS FirstName,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2) as SecondName,(CASE WHEN (SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2) = '' THEN '" . SITE_URL . "admin/uploads/TeamLogo/team-placeholder.jpg' ELSE CONCAT('" . SITE_URL . "admin/uploads/TeamLogo/',(SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2)) END) AS SecondTeamLogo,(CASE WHEN (SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID1) = '' THEN '" . SITE_URL . "admin/uploads/TeamLogo/team-placeholder.jpg' ELSE CONCAT('" . SITE_URL . "admin/uploads/TeamLogo/',(SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID1)) END) AS FirstTeamLogo,Ground.GroundName,Court.CourtName,Round.RoundName,Tournament.SecondRunnerUpsPrize,Tournament.StartDate,Tournament.EndDate FROM v_match_schedule AS MatchSchedule INNER JOIN v_teams AS Team ON MatchSchedule.GroupTeamRelationID1 = Team.TeamID INNER JOIN v_ground_master AS Ground ON MatchSchedule.GroundID=Ground.GroundID INNER JOIN v_court_master AS Court ON MatchSchedule.CourtID=Court.CourtID INNER JOIN v_tournaments AS Tournament ON MatchSchedule.TournamentID=Tournament.TournamentID INNER JOIN v_rounds AS Round ON MatchSchedule.RoundID=Round.RoundID WHERE MatchSchedule.is_active != 'D' AND MatchSchedule.TournamentID = '" . $json['TournamentID'] . "' AND MatchSchedule.MatchDate >= '" . $StartDate . "' AND MatchSchedule.MatchDate <= '" . $EndDate . "'");
        }

        $MatchScheduleQuery->execute();
        $MatchScheduleData = $MatchScheduleQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($MatchScheduleData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetMatchScheduleDataByTournamentID'] = $MatchScheduleData;
            $this->return_data['Message'] = 'Match Schedule Data Save Successfully';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetTeamWisePlayerData($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        $MatchTeamQuery = $this->_db->prepare("SELECT GroupTeamRelationID1,GroupTeamRelationID2,RoundID FROM v_match_schedule WHERE MatchId = '" . $json['MatchId'] . "'");
        $MatchTeamQuery->execute();
        $MatchTeamData = $MatchTeamQuery->fetch(PDO::FETCH_ASSOC);
        $RoundID = $MatchTeamData['RoundID'];
        unset($MatchTeamData['RoundID']);
        $teams = implode(',', $MatchTeamData);
        $MatchPlayerQuery = $this->_db->prepare("SELECT TeamTournamentRele.TournamentID,TeamTournamentRele.TeamTournamentRelationMasterID,TeamTournamentRele.TournamentID,TeamTournamentRele.TeamID,TeamTournamentRele.PlayerID,(SELECT CONCAT(v_users.FirstName,' ',v_users.LastName) AS PlayerName FROM v_users WHERE v_users.UserID = TeamTournamentRele.PlayerID) AS PlayerName,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = TeamTournamentRele.TeamID) AS TeamName FROM v_teams_tournament_relation AS TeamTournamentRele WHERE TeamTournamentRele.TeamID IN($teams) AND TeamTournamentRele.TournamentID='".$json['TournamentID']."'");
        $MatchPlayerQuery->execute();
        $MatchPlayerData = $MatchPlayerQuery->fetchAll(PDO::FETCH_ASSOC);

        if ($MatchPlayerData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetMatchPlayerDataByTeamID'] = $MatchPlayerData;
//                    $this->return_data['GetTeamIDData'] = $teams;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetTeamDataByMatchID($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);

        $MatchTeamQueryNew = $this->_db->prepare("SELECT GroupTeamRelationID1,GroupTeamRelationID2,RoundID,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = v_match_schedule.GroupTeamRelationID1) as FirstTeamName,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = v_match_schedule.GroupTeamRelationID2) as SecondTeamName FROM v_match_schedule WHERE MatchId = '" . $json['MatchId'] . "'");
        $MatchTeamQueryNew->execute();
        $MatchTeamDataNew = $MatchTeamQueryNew->fetch(PDO::FETCH_ASSOC);
//        print_r($MatchTeamDataNew);
        if ($MatchTeamDataNew) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamIDByMatchID'] = $MatchTeamDataNew;
//                    $this->return_data['GetTeamIDData'] = $teams;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function InsertMatchScore() {
        $mysql = new DataTransaction($this->_db);
        $TournamentID = $_REQUEST['TournamentID'];
        $MatchId = $_REQUEST['MatchId'];
        $SetWinningTeam = $_REQUEST['SetWinningTeam'];
        $SetNo = $_REQUEST['SetNo'];
        $Setwon = $_REQUEST['Setwon'];
        $SetLosingTeam = $_REQUEST['SetLosingTeam'];
        $Setlose = $_REQUEST['Setlose'];
        $SetDeference = $_REQUEST['SetDeference'];
        $PlayerOfTheMatch = $_REQUEST['PlayerOfTheMatch'];
        $PlayerOfTheMatchTeamID = $_REQUEST['PlayerOfTheMatchTeamID'];
        $MatchScore = $this->_db->prepare("SELECT * FROM v_result_sets WHERE MatchId = '" . $MatchId . "'");
        $MatchScore->execute();
        $MatchScoreData = $MatchScore->fetchAll(PDO::FETCH_ASSOC);
        if (count($MatchScoreData) == 0) {
            for ($i = 0; $i < sizeof($SetWinningTeam); $i++) {
                if ($SetWinningTeam[$i] != '') {
                    $TeamIDS[] = $SetWinningTeam[$i];
                    $InsertMatchScoreData = array("MatchId" => $MatchId, "SetNo" => $SetNo[$i], "TournamentID" => $TournamentID, "WinningTeamID" => $SetWinningTeam[$i], "WinningTeamScore" => $Setwon[$i], "LosingTeamID" => $SetLosingTeam[$i], "LosingTeamScore" => $Setlose[$i], "Margin" => $SetDeference[$i], "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
                    $InsertMatchScore = $mysql->insert($InsertMatchScoreData, 'v_result_sets');
                }
            }
            $count = array_count_values($TeamIDS);
            arsort($count);
            $keys = array_keys($count);
            $WinningTeamID = $keys[0];
            $LosingTeamID = $keys[1];
            $WinningTeamSets = $count[$keys[0]];
            $LosingTeamSets = $count[$keys[1]];
            if ($InsertMatchScore) {
                $InsertResultData = array("TournamentID" => $TournamentID, "MatchId" => $MatchId, "WinningTeamID" => $WinningTeamID, "LosingTeamID" => $LosingTeamID, "WinningTeamSet" => $WinningTeamSets, "LosingTeamSet" => $LosingTeamSets, "PlayerOfTheMatch" => $PlayerOfTheMatch, "PlayerOfTheMatchTeamID" => $PlayerOfTheMatchTeamID, "is_active" => 'Y', "EntryBy" => '1', 'EntryDate' => date('Y-m-d'), "ModificationBy" => '1', 'ModificationDate' => date('Y-m-d'));
                $InsertResult = $mysql->insert($InsertResultData, 'v_result');
                if($InsertResult){
                 $MatchStatusUpdate = $this->_db->prepare("UPDATE v_match_schedule SET MatchStatus='Complete' WHERE MatchId = '" . $MatchId . "'");
                 $MatchStatusUpdate->execute(); }
                if ($InsertResult) {
                    $this->return_data['ResponseCode'] = 1;
                    $this->return_data['GetResultData'] = $InsertResult;
                    $this->return_data['Message'] = 'Score Data Successfully Inserted';
                } else {
                    $this->return_data['ResponseCode'] = 0;
                    $this->return_data['Message'] = 'No Record Found';
                }
            }
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'Recored Alredy Exists';
        }

        return $this->return_data;
    }

    public function GetScoreData($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        $MatchScoreQueryNew = $this->_db->prepare("SELECT Result.TournamentID,Result.MatchID,Result.WinningTeamID,Result.LosingTeamID,Result.WinningTeamSet,Result.LosingTeamSet,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = Result.WinningTeamID) as WinningTeamName,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = Result.LosingTeamID) as LosingTeamName,TournamentName FROM v_result Result INNER JOIN v_tournaments AS Tournaments ON Result.TournamentID = Tournaments.TournamentID WHERE Result.is_active = 'Y' AND Result.TournamentID = ".$json['TournamentID']);
        $MatchScoreQueryNew->execute();
        $MatchScoreDataNew = $MatchScoreQueryNew->fetchAll(PDO::FETCH_ASSOC);
        if ($MatchScoreDataNew) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetScoreByMatchID'] = $MatchScoreDataNew;
//                    $this->return_data['GetTeamIDData'] = $teams;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function GetTypeTitleData($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        $NotificationTypeQuery = $this->_db->prepare("SELECT NotificationTitle,NotificationType FROM v_general_notifications GROUP BY NotificationType");
        $NotificationTypeQuery->execute();
        $NotificationTypeData = $NotificationTypeQuery->fetchAll(PDO::FETCH_ASSOC);
//        print_r($MatchTeamDataNew);
        if ($NotificationTypeData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetNotificationTypeText'] = $NotificationTypeData;
//                    $this->return_data['GetTeamIDData'] = $teams;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }

    public function TournamentDropDown($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
//        echo date('Y-m-d');
        $TeamTournamentQuery = $this->_db->prepare("SELECT * FROM v_teams_tournament_relation_temp WHERE is_active = 'Y' AND TeamID='" . $json['TeamID'] . "'");

        $TeamTournamentQuery->execute();
        $TeamTournamentData = $TeamTournamentQuery->fetch(PDO::FETCH_ASSOC);

        $TournamentQuery = $this->_db->prepare("SELECT * FROM v_tournaments WHERE is_active = 'Y' AND TournamentID='" . $TeamTournamentData['TournamentID'] . "'");

        $TournamentQuery->execute();
        $TournamentData = $TournamentQuery->fetch(PDO::FETCH_ASSOC);

        $TournamentStartDate = $TournamentData['StartDate'];
        $TournamentEndDate = $TournamentData['EndDate'];
        $currentData = date('Y-m-d');
        if (!empty($TournamentData)) {
            $ApplyTournamentQuery = $this->_db->prepare("SELECT TournamentID,TournamentName,StartDate,EndDate,Description,TournamentFor,RegistrationFees,RegistrationStartDate,RegistrationEndDate FROM v_tournaments WHERE is_active = 'Y' AND StartDate NOT BETWEEN '" . $TournamentStartDate . "' AND '" . $TournamentEndDate . "' AND EndDate NOT BETWEEN '" . $TournamentStartDate . "' AND '" . $TournamentEndDate . "'  AND (RegistrationStartDate <= '".$currentData."' AND RegistrationEndDate >= '".$currentData."') AND is_active = 'Y' OR TournamentID ='" . $TeamTournamentData['TournamentID'] . "'");
        } else {
//            echo "SELECT TournamentID,TournamentName,StartDate,EndDate,Description,TournamentFor,RegistrationFees FROM v_tournaments WHERE is_active = 'Y' AND (RegistrationStartDate <= '".$currentData."' AND RegistrationEndDate >= '".$currentData."') ";
            $ApplyTournamentQuery = $this->_db->prepare("SELECT TournamentID,TournamentName,StartDate,EndDate,Description,TournamentFor,RegistrationFees FROM v_tournaments WHERE is_active = 'Y' AND (RegistrationStartDate <= '".$currentData."' AND RegistrationEndDate >= '".$currentData."') ");
        }
        $ApplyTournamentQuery->execute();
        $ApplyTournamentData = $ApplyTournamentQuery->fetchAll(PDO::FETCH_ASSOC);
        if (count($ApplyTournamentData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetApplyTournamentWiseData'] = $ApplyTournamentData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }

        return $this->return_data;
    }

    public function GetTournamentStates($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
//        echo '<pre>';
//        print_r($json);
//        exit;
//        echo "SELECT * FROM `v_tournaments` WHERE `v_tournaments`.`TournamentID` = ('" . $_REQUEST['TournamentID'] . "')";
        $GetStateData = $this->_db->prepare("SELECT * FROM `v_tournaments` WHERE `v_tournaments`.`TournamentID` = ('" . $json['TournamentID'] . "')");
        $GetStateData->execute();
        $StateIDArray = $GetStateData->fetch(PDO::FETCH_ASSOC);
        $TournamentStateQuery = $this->_db->prepare("SELECT * FROM `v_state` WHERE `v_state`.`StateID` IN (" . $StateIDArray['StateID'] . ")");
        $TournamentStateQuery->execute();
        $TournamentState = $TournamentStateQuery->fetchAll(PDO::FETCH_ASSOC);

        if ($TournamentState) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentStates'] = $TournamentState;
            //$this->return_data['GetTournamentTeamID'] = $StateIDArray;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }


        return $this->return_data;
    }

    public function GetTournamentCities($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
//        echo "SELECT StateID FROM `v_tournaments` WHERE `v_tournaments`.`TournamentID` = ('".$_REQUEST['TournamentID']."')";
        $GetCityData = $this->_db->prepare("SELECT CityID FROM `v_tournaments` WHERE `v_tournaments`.`TournamentID` = '" . $json['TournamentID'] . "'");
        $GetCityData->execute();
        $CityIDArray = $GetCityData->fetch(PDO::FETCH_ASSOC);
        $TournamentCityQuery = $this->_db->prepare("SELECT * FROM `v_city` WHERE `v_city`.`CityID` IN (" . $CityIDArray['CityID'] . ") AND `v_city`.`StateID` = '" . $json['StateID'] . "'");
        $TournamentCityQuery->execute();
        $TournamentCity = $TournamentCityQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($TournamentCity) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTournamentCities'] = $TournamentCity;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }


        return $this->return_data;
    }

    public function AppliedTournamentData($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        $AppliedTeamTournamentQuery = $this->_db->prepare("SELECT * FROM v_teams_tournament_relation_temp WHERE is_active = 'Y' AND TeamID='" . $json['TeamID'] . "' AND TournamentID='".$json['TournamentID']."'");

        $AppliedTeamTournamentQuery->execute();
        $AppliedTeamTournamentData = $AppliedTeamTournamentQuery->fetch(PDO::FETCH_ASSOC);
        if ($AppliedTeamTournamentData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAppliedTournamentData'] = $AppliedTeamTournamentData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }


        return $this->return_data;
    }
    public function GetGeneralNotificationData($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        $GetGeneralNotificationQuery = $this->_db->prepare("SELECT NotificationID,NotificationTitle,NotificationType,NotificationText,SenderID,ReceiverID,NotificationStatus,IsOperational,IFNULL(RejectedReason,'')AS RejectedReason,ReadStatus,SendTo,is_active,DeleteStatus,NotificationCreatedDate FROM v_general_notifications WHERE ReceiverID = '".$json['ReceiverID']."' AND NotificationType = '".$json['NotificationType']."' AND is_active = 'Y' AND IsOperational = 'N' ORDER BY NotificationCreatedDate DESC");

        $GetGeneralNotificationQuery->execute();
        $GetGeneralNotificationData = $GetGeneralNotificationQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($GetGeneralNotificationData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGenralNotificationData'] = $GetGeneralNotificationData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function UpdateTournamnetIsActive($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        $currDate= date('Y-m-d');
        $UpdateToutnamentQuery = $this->_db->prepare("UPDATE v_tournaments SET is_active = 'N' WHERE EndDate < '".$currDate."'");
        $UpdateToutnamentQuery->execute();
        if ($UpdateToutnamentQuery) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGenralNotificationData'] = $UpdateToutnamentQuery;
            $this->return_data['Message'] = 'Data Updated';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }


        return $this->return_data;
    }
    public function GetTeamDataByTeamID($Condition = '') {
        $json = json_decode($Condition, true);

        $mysql = new DataTransaction($this->_db);
        $GetTeamDataByTeamIDQuery = $this->_db->prepare("SELECT TeamMaster.*,CONCAT(User.FirstName,' ',User.LastName) AS PalyerName,User.CaptainshipStatus,Team.TeamName,Team.TeamSlogan,(CASE WHEN TeamLogo = '' THEN '" . SITE_URL . "admin/uploads/placeholder3.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/TeamLogo/',TeamLogo) END) AS TeamLogo FROM v_player_team_relation_master AS TeamMaster LEFT JOIN v_users AS User ON User.UserID = TeamMaster.PlayerID LEFT JOIN v_teams AS Team ON Team.TeamID = TeamMaster.TeamID WHERE TeamMaster.TeamID = '".$json['TeamID']."'");

        $GetTeamDataByTeamIDQuery->execute();
        $GetTeamDataByTeamIDData = $GetTeamDataByTeamIDQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($GetTeamDataByTeamIDData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetGenralNotificationData'] = $GetTeamDataByTeamIDData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }


        return $this->return_data;
    }
    public function MyTeamDataForPayment($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
//        echo"SELECT TeamTournaRele.*,Team.TeamName FROM v_teams_tournament_relation AS TeamTournaRele INNER JOIN v_teams AS Team ON Team.TeamID = TeamTournaRele.TeamID WHERE  TeamTournaRele.TeamID = '".$json['TeamID']."' AND TeamTournaRele.CaptainID='".$json['CaptainID']."' AND TeamTournaRele.TournamentID = '".$json['TournamentID']."'";
        $GetTeamDataByTeamIDForPaymentQuery = $this->_db->prepare("SELECT TeamTournaRele.*,Team.TeamName,Users.EmailID,Tournament.RegistrationFees,Tournament.TournamentName,Tournament.StartDate,Tournament.EndDate,Tournament.Description,Tournament.TournamentFor,Tournament.MaximumPlayers,Tournament.MinimumPlayers,Tournament.WinnerPrize,Tournament.RunnerUpsPrize,Tournament.SecondRunnerUpsPrize,Tournament.PlayerOfTheTournamnetPrice FROM v_teams_tournament_relation AS TeamTournaRele INNER JOIN v_teams AS Team ON Team.TeamID = TeamTournaRele.TeamID INNER JOIN v_users AS Users ON Users.UserID = TeamTournaRele.CaptainID INNER JOIN v_tournaments AS Tournament ON Tournament.TournamentID = TeamTournaRele.TournamentID WHERE TeamTournaRele.TeamID = '".$json['TeamID']."' AND TeamTournaRele.CaptainID='".$json['CaptainID']."' AND TeamTournaRele.TournamentID = '".$json['TournamentID']."'");
        $GetTeamDataByTeamIDForPaymentQuery->execute();
        $GetTeamDataByTeamIDForPaymentData = $GetTeamDataByTeamIDForPaymentQuery->fetchAll(PDO::FETCH_ASSOC);
        if (count($GetTeamDataByTeamIDForPaymentData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamPaymentData'] = $GetTeamDataByTeamIDForPaymentData;
             $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function MakePaymentForTeam($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        $PaymentInvoiceQuery = $this->_db->prepare("SELECT InvoiceID FROM v_tournament_payment");
        $PaymentInvoiceQuery->execute();
        $PaymentInvoiceCount = $PaymentInvoiceQuery->rowCount();
        if ($PaymentInvoiceCount > 0) {
            $PaymentInvoiceLastQuery = $this->_db->prepare("SELECT InvoiceID FROM v_tournament_payment ORDER BY PaymentID DESC LIMIT 1 ");
            $PaymentInvoiceLastQuery->execute();
            $InvoiceData = $PaymentInvoiceLastQuery->fetch(PDO::FETCH_ASSOC);
            $InvoiceWithoutPrefix = filter_var($InvoiceData['InvoiceID'], FILTER_SANITIZE_NUMBER_INT);
            $NewNumber = str_pad($InvoiceWithoutPrefix + 1, 6, 0, STR_PAD_LEFT);
            $InvoiceNumber = 'KS' . ($NewNumber);
        } else {
            $InvoiceNumber = 'KS' . '000001';
        }
        $PaymentData = array("TournamentID" => $json['TournamentID'], "TeamID" => $json['TeamID'], "CaptainID" => $json['CaptainID'], "AmountPaid" => $json['RegistrationFees'], "EMail" => $json['EmailID'], "InvoiceID" => $InvoiceNumber, "is_active" => 'N', "EntryBy" => $json['CaptainID'], 'EntryDate' => date('Y-m-d'), 'ModificationBy' => $json['CaptainID'], 'ModificationDate'=> date('Y-m-d'));
        $TeamPaymentData = $mysql->insert($PaymentData, 'v_tournament_payment');
        if($TeamPaymentData){
         $DeactiveNotification = $this->_db->prepare("UPDATE v_general_notifications SET is_active='D' WHERE NotificationID = '".$json['NotificationID']."'");
         $DeactiveNotification->execute();   
        }
        if (count($TeamPaymentData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamPaymentDoneData'] = $TeamPaymentData;
            $this->return_data['Message'] = 'Payment Done Successfully';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    
    public function UpdatePayment($Condition = '')
    {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        if($json['ResponseCode'] == '1'){
            $Status = 'Approved';
        }else{
            $Status = 'Decline';
        }
        $PaymentUpdateArray = array("status" => $Status, "ResponseCode" => $json['ResponseCode'], "response" => $json['response'], "TransactionID" => $json['TransactionID'], "is_active" => 'Y', 'ModificationBy' => $json['CaptainID'], 'ModificationDate'=> date('Y-m-d'));
        
        $conditionArr = array("TournamentID" => $json['TournamentID'], "TeamID" => $json['TeamID'], "CaptainID" => $json['CaptainID'], "InvoiceID" => $json['InvoiceID']);
        $TeamPaymentUpdateData = $mysql->update('v_tournament_payment', $PaymentUpdateArray, $conditionArr);
        if($TeamPaymentUpdateData){
         $DeactiveNotification = $this->_db->prepare("UPDATE v_general_notifications SET is_active='D' WHERE NotificationID = '".$json['NotificationID']."'");
         $DeactiveNotification->execute();   
        }
        if (count($TeamPaymentUpdateData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamPaymentDoneData'] = $TeamPaymentUpdateData;
            $this->return_data['Message'] = 'Payment Done Successfully';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function TeamTournamentPaymentDoneCheck($Condition = '') {
        $json = json_decode($Condition, true);
        $mysql = new DataTransaction($this->_db);
        $GetTeamPaymentQuery = $this->_db->prepare("SELECT * FROM v_tournament_payment WHERE TeamID = '".$json['TeamID']."' AND CaptainID='".$json['CaptainID']."' AND TournamentID = '".$json['TournamentID']."'");
        $GetTeamPaymentQuery->execute();
        $GetTeamPaymentData = $GetTeamPaymentQuery->fetch(PDO::FETCH_ASSOC);
        
        if ($GetTeamPaymentData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetTeamPaymentStatusDetais'] = $GetTeamPaymentData;
             $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function GetAllAppliedTeamDataByTournament($Condition = '') {
        $json = json_decode($Condition, true);
        $AppliedTeamData = $this->_db->prepare("SELECT TournamentPayment.TeamID,Team.TeamID,Team.TeamName,Team.TeamDescription,Team.TeamSlogan,(CASE WHEN Team.TeamLogo = '' THEN '" . SITE_URL . "admin/uploads/TeamLogo/team-placeholder.jpg' ELSE CONCAT('" . SITE_URL . "admin/uploads/TeamLogo/',Team.TeamLogo) END) AS TeamLogoWithPath,Team.TeamLogo,Team.CaptainID,CONCAT(FirstName,' ',LastName) AS CaptainName FROM v_tournament_payment AS TournamentPayment INNER JOIN v_teams AS Team ON Team.TeamID = TournamentPayment.TeamID INNER JOIN v_users AS User ON User.UserID = TournamentPayment.CaptainID WHERE TournamentPayment.is_active = 'Y' AND TournamentPayment.TournamentID = '" . $json['TournamentID'] . "'");
        $AppliedTeamData->execute();
        $AppliedTeamWiseData = $AppliedTeamData->fetchAll(PDO::FETCH_ASSOC);
        if ($AppliedTeamWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAllAppliedTeamDataByTournament'] = $AppliedTeamWiseData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function GetAllAppliedTournamentTeamPlayersData($Condition = '') {
        $json = json_decode($Condition, true);
        $AppliedTeamPlayersQuery = $this->_db->prepare("SELECT TeamTournamentRele.PlayerID,CONCAT(User.FirstName,' ',LastName)AS PlayerName,(CASE WHEN User.ProfilePicture = '' THEN '" . SITE_URL . "admin/uploads/ProfilePic/placeholder.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/ProfilePic/',User.ProfilePicture) END) AS ProfilePicWithPath,User.ProfilePicture,User.Height,User.Weight,User.CaptainshipStatus,DOB,BodyType,FavoritePosition,CityName,StateName FROM v_teams_tournament_relation AS TeamTournamentRele INNER JOIN v_users AS User ON User.UserID = TeamTournamentRele.PlayerID LEFT JOIN v_city on User.CityID = v_city.CityID LEFT JOIN v_state on v_city.StateID = v_state.StateID WHERE TeamTournamentRele.is_active = 'Y' AND TeamTournamentRele.TournamentID = '" . $json['TournamentID'] . "' AND TeamTournamentRele.TeamID='".$json['TeamID']."' AND TeamTournamentRele.AdminStatus='Y'");
        $AppliedTeamPlayersQuery->execute();
        $AppliedTeamPlayersData = $AppliedTeamPlayersQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($AppliedTeamPlayersData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAppliedTeamPlayersData'] = $AppliedTeamPlayersData;
            $this->return_data['Message'] = 'Success';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    public function DeleteGeneralNotification($Condition = '') {
        $json = json_decode($Condition, true);
        $DeleteNotificationQuery = $this->_db->prepare("UPDATE v_general_notifications SET is_active = 'D',DeleteStatus = 'Y' WHERE NotificationID='".$json['NotificationID']."'");
        $DeleteNotificationQuery->execute();
        if ($DeleteNotificationQuery) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['Message'] = 'Notification Deleted';
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
    
    public function CheckEligiblityToPay($Condition = '')
    {
        $json = json_decode($Condition, true);
        $AppliedTeamQuery = $this->_db->prepare("SELECT DISTINCT(tr.TournamentID),t.TournamentName FROM v_teams_tournament_relation as tr INNER JOIN v_tournaments as t ON t.TournamentID = tr.TournamentID AND t.StartDate > CURDATE() LEFT JOIN v_tournament_payment as p ON p.TournamentID = tr.TournamentID and p.TeamID = tr.TeamID WHERE tr.TeamID = '".$json['TeamID']."' AND p.TournamentID is null");
        $AppliedTeamQuery->execute();
        $AppliedTeamData = $AppliedTeamQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($AppliedTeamData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['ApplyData'] = $AppliedTeamData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    
    public function GetEligiblePlayersToVerify($Condition = '')
    {
        $json = json_decode($Condition, true);
        $AppliedTeamQuery = $this->_db->prepare("SELECT TRMaster.*,CONCAT(User.FirstName,' ',User.LastName)AS PlayerName,Team.TeamName,temp.AdminStatus FROM v_player_team_relation_master AS TRMaster INNER JOIN v_users AS User ON TRMaster.PlayerID=User.UserID INNER JOIN v_teams AS Team ON TRMaster.TeamID=Team.TeamID LEFT JOIN v_teams_tournament_relation_temp as temp ON temp.PlayerID = TRMaster.PlayerID AND temp.TeamID = TRMaster.TeamID  AND temp.is_active='Y' AND temp.TournamentID = '".$json['TournamentID']."' WHERE (temp.AdminStatus = 'R' OR temp.AdminStatus is null) AND TRMaster.TeamID = '".$json['TeamID']."' AND TRMaster.is_active='Y'");
        $AppliedTeamQuery->execute();
        $AppliedTeamData = $AppliedTeamQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($AppliedTeamData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['EligiblePlayers'] = $AppliedTeamData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    
    public function GetTournamentScoreCardDetails($Condition = '')
    {
        $json = json_decode($Condition, true);
        $ScoreCardQuery = $this->_db->prepare("Select TeamID, TeamName,IFNULL(WIN.WiningCount,0) AS MatchWinCount,IFNULL(Loose.LossingCount,0) AS MatchLooseCount,IFNULL((SELECT COUNT(m.MatchId) FROM v_match_schedule as m WHERE m.MatchStatus='abandoned' AND m.TournamentID = '".$json['TournamentID']."'),0)  as TotalAbandond,IFNULL((SELECT COUNT(m.MatchId) FROM v_match_schedule as m WHERE m.TournamentID = '".$json['TournamentID']."'),0)  as TotalMatch
From v_teams left join (select WinningTeamID,COUNT(WinningTeamID) as WiningCount from v_result Where TournamentID ='".$json['TournamentID']."' group by WinningTeamID) as  WIN on v_teams.TeamID = WIN.WinningTeamID
left join (select LosingTeamID,COUNT(LosingTeamID) as LossingCount from v_result Where TournamentID = '".$json['TournamentID']."' group by LosingTeamID) as  Loose on v_teams.TeamID = Loose.LosingTeamID
where WIN.WiningCount > 0 or Loose.LossingCount > 0");
        $ScoreCardQuery->execute();
        $ScoreCardData = $ScoreCardQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($ScoreCardData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['ScoreCardEntries'] = $ScoreCardData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;  
    }
    
    public function GetTournamentScoreCardDetailsByTeam($Condition = '')
    {
        $json = json_decode($Condition, true);
        
        $ScoreCardByTeamQuery = $this->_db->prepare("Select Matchs.MatchId,Matchs.MatchDate,(CASE WHEN (Matchs.GroupTeamRelationID1 = '".$json['TeamID']."') THEN (SELECT T.TeamName FROM v_teams as T WHERE T.TeamID = Matchs.GroupTeamRelationID2) ELSE (SELECT T.TeamName FROM v_teams as T WHERE T.TeamID = Matchs.GroupTeamRelationID1) END) as TeamWith,(CASE WHEN (Matchs.GroupTeamRelationID1 = '".$json['TeamID']."') THEN (SELECT T.TeamID FROM v_teams as T WHERE T.TeamID = Matchs.GroupTeamRelationID2) ELSE (SELECT T.TeamID FROM v_teams as T WHERE T.TeamID = Matchs.GroupTeamRelationID1) END) as TeamWithID,(CASE WHEN (Matchs.GroupTeamRelationID1 = '".$json['TeamID']."') THEN (SELECT T.TeamDescription FROM v_teams as T WHERE T.TeamID = Matchs.GroupTeamRelationID2) ELSE (SELECT T.TeamDescription FROM v_teams as T WHERE T.TeamID = Matchs.GroupTeamRelationID1) END) as TeamWithDescription,(CASE WHEN (Matchs.GroupTeamRelationID1 = '".$json['TeamID']."') THEN (SELECT T.TeamLogo FROM v_teams as T WHERE T.TeamID = Matchs.GroupTeamRelationID2) ELSE (SELECT T.TeamLogo FROM v_teams as T WHERE T.TeamID = Matchs.GroupTeamRelationID1) END) as TeamWithLogo,(CASE WHEN (Matchs.GroupTeamRelationID1 = '".$json['TeamID']."') THEN (SELECT T.TeamSlogan FROM v_teams as T WHERE T.TeamID = Matchs.GroupTeamRelationID2) ELSE (SELECT T.TeamSlogan FROM v_teams as T WHERE T.TeamID = Matchs.GroupTeamRelationID1) END) as TeamWithSlogan,IFNULL(WIN.WiningCount,0) AS SetWin,IFNULL(Loss.LossingCount,0) AS SetLoss,
IFNULL(WIN.WiningCount,0) + IFNULL(Loss.LossingCount,0)  as TotalSets, (CASE WHEN (IFNULL(WIN.WiningCount,0) > IFNULL(Loss.LossingCount,0)) THEN 'Win' ELSE 'Loss' END) AS WinLos
From v_match_schedule as Matchs
Left join (select MatchID,COUNT(WinningTeamID) as WiningCount from v_result_sets Where TournamentID = '".$json['TournamentID']."' and WinningTeamID = '".$json['TeamID']."' group by MatchID) as  WIN on Matchs.MatchId = WIN.MatchID
Left join (select MatchID,COUNT(LosingTeamID) as LossingCount from v_result_sets Where TournamentID = '".$json['TournamentID']."' and LosingTeamID = '".$json['TeamID']."' group by MatchID) as  Loss on Matchs.MatchId  = Loss.MatchID
Where WIN.WiningCount > 0 or Loss.LossingCount > 0 AND TournamentID = ".$json['TournamentID']);
        $ScoreCardByTeamQuery->execute();
        $ScoreCardByTeamData = $ScoreCardByTeamQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($ScoreCardByTeamData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['ScoreCardEntriesByTeam'] = $ScoreCardByTeamData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;  
    }
    
    public function TeamDetailsByTeamID($Condition = '')
    {
        $json = json_decode($Condition, true);
        $TeamDetails = $this->_db->prepare("SELECT TeamID,TeamName,TeamDescription,TeamSlogan,CoachName,(CASE WHEN TeamLogo = '' THEN '" . SITE_URL . "admin/uploads/TeamLogo/team-placeholder.jpg' ELSE CONCAT('" . SITE_URL . "admin/uploads/TeamLogo/',TeamLogo) END) AS TeamLogo FROM v_teams WHERE TeamID = '".$json['TeamID']."' AND is_active='Y'");
        $TeamDetails->execute();
        $TeamDetailsData = $TeamDetails->fetch(PDO::FETCH_ASSOC);
        if ($TeamDetailsData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['TeamDetailsByTeamID'] = $TeamDetailsData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    public function MatchDetailsByMatchID($Condition = '')
    {
        $json = json_decode($Condition, true);
        $MatchQuery = $this->_db->prepare("SELECT MatchSchedule.MatchId,MatchSchedule.TournamentID,MatchSchedule.GroupTeamRelationID1,MatchSchedule.GroupTeamRelationID2,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID1) AS FirstTeamName,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2) AS SecondTeamName FROM v_match_schedule AS MatchSchedule INNER JOIN v_teams AS Team ON MatchSchedule.GroupTeamRelationID1 = Team.TeamID WHERE MatchSchedule.TournamentID = '".$json['TournamentID']."' AND MatchSchedule.is_active = 'Y' AND MatchSchedule.MatchStatus='Incomplete'");
        $MatchQuery->execute();
        $MatchDataArray = $MatchQuery->fetchAll(PDO::FETCH_ASSOC);
        foreach ($MatchDataArray as $K => $V) {
        $TeamsName = $V['FirstTeamName'] .' VS '. $V['SecondTeamName'];
        }
        if ($MatchDataArray) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['MatchNameByMatchID'] = $TeamsName;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    public function GetPlayerProfileByPlayerID($Condition = '')
    {
        $json = json_decode($Condition, true);
        $UserQuery = $this->_db->prepare("SELECT UserID, CONCAT(FirstName,' ',LastName) as PlayerName, Height, Weight, DOB, CaptainshipStatus, NickName,(SELECT StateName FROM v_state WHERE v_state.StateID = v_users.StateID) as StateName, (SELECT CityName FROM v_city WHERE v_city.CityID = v_users.CityID) as CityName,(CASE WHEN v_users.ProfilePicture = '' THEN '" . SITE_URL . "admin/uploads/ProfilePic/placeholder.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/ProfilePic/', v_users.ProfilePicture) END ) AS ProfilePicture, BodyType, FavoritePosition, AboutMe FROM v_users WHERE UserID = '".$json['PlayerID']."'");
        $UserQuery->execute();
        $UserData= $UserQuery->fetch(PDO::FETCH_ASSOC);
        if ($UserData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['PlayerProfileByPlayerID'] = $UserData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    public function GetPlayerTotalCareerByPlayerID($Condition = '')
    {
        $json = json_decode($Condition, true);
        $CareerQuery = $this->_db->prepare("Select COUNT(Total.MatchId) AS TotalMatch,count(v_result.MatchID) as Played,COUNT(Abandoned.MatchId) AS Abandoned,COUNT(Plom.PlayerOfTheMatch) as PlayerofthMatch
From v_teams_tournament_relation as TR 
INNER JOIN v_match_schedule as Total on Total.GroupTeamRelationID1 = TR.TeamID or Total.GroupTeamRelationID2 = TR.TeamID
LEFT JOIN v_result on v_result.MatchID = Total.MatchId
LEFT JOIN v_match_schedule as Abandoned on Total.MatchID = Abandoned.MatchId and Abandoned.MatchStatus = 'abandoned'
LEFT JOIN v_result as Plom on Total.MatchID = Plom.MatchId and Plom.PlayerOfTheMatch = TR.PlayerID
Where TR.PlayerID = '".$json['PlayerID']."' and TR.is_active = 'Y' and Total.is_active = 'Y'");
        $CareerQuery->execute();
        $CareerQueryData= $CareerQuery->fetch(PDO::FETCH_ASSOC);
        if ($CareerQueryData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['PlayerTotalCareerByPlayerID'] = $CareerQueryData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    public function GetPlayerCareerTeamWiseByPlayerID($Condition = '')
    {
        $json = json_decode($Condition, true);
        $CareerTeamWiseQuery = $this->_db->prepare("Select v_teams.TeamID,v_teams.TeamName,IFNULL(Winners.WinCount,0) as MatchWin, IFNULL(Losers.LossCount,0) as MatchLoss,IFNULL(MatchAbandoned.AbandonedCount,0) as AbandonedCount ,IFNULL(PlyrMatch.PlmCount,0) as PlayerOfTheMatch From v_teams_tournament_relation as TR INNER JOIN v_teams on TR.TeamID = v_teams.TeamID LEFT JOIN (SELECT Win.WinningTeamID,count(Win.WinningTeamID) as WinCount FROM v_result as Win GROUP BY WinningTeamID) AS Winners ON TR.TeamID = Winners.WinningTeamID LEFT JOIN (SELECT Loss.LosingTeamID,count(Loss.LosingTeamID) as LossCount FROM v_result as Loss GROUP BY LosingTeamID) AS Losers ON TR.TeamID = Losers.LosingTeamID LEFT JOIN (SELECT (CASE WHEN vms.GroupTeamRelationID2 = vttmr.TeamID THEN vms.GroupTeamRelationID2 ELSE vms.GroupTeamRelationID1 END) as AbandonedTeamID ,count(vms.MatchId) as AbandonedCount FROM v_match_schedule as vms inner join v_teams_tournament_relation as vttmr on vms.TournamentID = vttmr.TournamentID AND (vms.GroupTeamRelationID1 = vttmr.TeamID or vms.GroupTeamRelationID2 = vttmr.TeamID) Where vms.MatchStatus = 'abandoned' AND vttmr.PlayerID = '".$json['PlayerID']."' GROUP BY vms.TournamentID) AS MatchAbandoned ON TR.TeamID = MatchAbandoned.AbandonedTeamID LEFT JOIN (SELECT plm.PlayerOfTheMatchTeamID ,count(plm.PlayerOfTheMatchTeamID) as PlmCount FROM v_result as plm GROUP BY MatchID) AS PlyrMatch ON TR.TeamID = PlyrMatch.PlayerOfTheMatchTeamID where TR.PlayerID = '".$json['PlayerID']."' and TR.is_active = 'Y'");
        $CareerTeamWiseQuery->execute();
        $CareerTeamWiseData= $CareerTeamWiseQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($CareerTeamWiseData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['PlayerCareerTeamWiseByPlayerID'] = $CareerTeamWiseData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    public function CheckTeamAlreadySentForApproval($Condition = '')
    {
        $json = json_decode($Condition, true);
        $TournamentQuery = $this->_db->prepare("SELECT * FROM `v_teams_tournament_relation` WHERE TournamentID = '" . $json['TournamentID'] . "' AND TeamID = '" . $json['TeamID'] . "' AND is_active = 'Y'");
        $TournamentQuery->execute();
        $total = $TournamentQuery->rowCount();
        if ($total > 0) {
            $Flag = 'TRUE';
        } else {
            $Flag = 'FALSE';
        }
        if ($Flag) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['CheckTeamAlreadySentForApproval'] = $Flag;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    public function GetTeamWisePlayerList($Condition = '')
    {
        $json = json_decode($Condition, true);
        $PlayerQuery = $this->_db->prepare("SELECT CONCAT(u.FirstName,' ',u.LastName) as PlayerName,u.Height,u.Weight,u.ProfilePicture,u.EmailID,u.MobileNumber FROM v_users as u INNER JOIN v_player_team_relation_master as rm ON rm.PlayerID = u.UserID AND rm.TeamID = '".$json['TeamID']."' AND rm.is_active = 'Y'");
        $PlayerQuery->execute();
        $PlayerQueryData= $PlayerQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($PlayerQueryData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['PlayerListByTeam'] = $PlayerQueryData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    public function GetMatchScheduleByTeamAndTournamentID($Condition = '')
    {
        $json = json_decode($Condition, true);
        $MatchScheduleQueryReports = $this->_db->prepare("SELECT MatchSchedule.*,MatchSchedule.MatchTime AS MatchStartTime,(SELECT GROUP_CONCAT(GroupName) FROM v_groups WHERE v_groups.TournamentID = MatchSchedule.TournamentID) AS GroupName, Team.TeamName AS FirstName,(SELECT TeamName FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2) as SecondName,(CASE WHEN (SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2) = '' THEN '" . SITE_URL . "admin/uploads/TeamLogo/team-placeholder.jpg' ELSE CONCAT('" . SITE_URL . "admin/uploads/TeamLogo/',(SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID2)) END) AS SecondTeamLogo,(CASE WHEN (SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID1) = '' THEN '" . SITE_URL . "admin/uploads/TeamLogo/team-placeholder.jpg' ELSE CONCAT('" . SITE_URL . "admin/uploads/TeamLogo/',(SELECT TeamLogo FROM v_teams WHERE v_teams.TeamID = MatchSchedule.GroupTeamRelationID1)) END) AS FirstTeamLogo,Ground.GroundName,Court.CourtName,Round.RoundName,Tournament.SecondRunnerUpsPrize,Tournament.StartDate,Tournament.EndDate FROM v_match_schedule AS MatchSchedule INNER JOIN v_teams AS Team ON MatchSchedule.GroupTeamRelationID1 = Team.TeamID INNER JOIN v_ground_master AS Ground ON MatchSchedule.GroundID=Ground.GroundID INNER JOIN v_court_master AS Court ON MatchSchedule.CourtID=Court.CourtID INNER JOIN v_tournaments AS Tournament ON MatchSchedule.TournamentID=Tournament.TournamentID INNER JOIN v_rounds AS Round ON MatchSchedule.RoundID=Round.RoundID WHERE MatchSchedule.is_active != 'D' AND MatchSchedule.TournamentID = '" . $json['TournamentID'] . "' AND (MatchSchedule.GroupTeamRelationID2 = '" . $json['TeamID'] . "' OR MatchSchedule.GroupTeamRelationID1 = '" . $json['TeamID'] . "')");
        $MatchScheduleQueryReports->execute();
        $MatchScheduleReportsData= $MatchScheduleQueryReports->fetchAll(PDO::FETCH_ASSOC);
        if ($MatchScheduleReportsData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetMatchScheduleByTeamAndTournamentID'] = $MatchScheduleReportsData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    public function GetAllPlayerList($Condition = '')
    {
        $json = json_decode($Condition, true);
        if(isset($json['PlayerName']) && $json['PlayerName'] != '')
        {
        $PlayerListQuery = $this->_db->prepare("SELECT u.UserID,CONCAT(u.FirstName,' ',u.LastName) as PlayerName,u.Height,u.Weight,u.ProfilePicture,u.EmailID,u.MobileNumber FROM v_users as u INNER JOIN v_player_team_relation_master as rm ON rm.PlayerID = u.UserID AND (u.FirstName LIKE '".$json['PlayerName']."%' OR u.LastName LIKE '".$json['PlayerName']."%') WHERE u.EmailVerificationStatus = 'Y' AND u.is_active='Y'");
        }else{
        $PlayerListQuery = $this->_db->prepare("SELECT u.UserID,CONCAT(u.FirstName,' ',u.LastName) as PlayerName,u.Height,u.Weight,u.ProfilePicture,u.EmailID,u.MobileNumber FROM v_users as u INNER JOIN v_player_team_relation_master as rm ON rm.PlayerID = u.UserID WHERE u.EmailVerificationStatus = 'Y' AND u.is_active='Y'");   
        }
        $PlayerListQuery->execute();
        $PlayerListQueryData= $PlayerListQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($PlayerListQueryData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetPlayerList'] = $PlayerListQueryData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    public function RevenueAndTaxReportByTournament($Condition = '')
    {
        $json = json_decode($Condition, true);
        $RevenueAndTaxQuery = $this->_db->prepare("SELECT t.TeamName,p.BasicAmount,p.TaxAmount,p.AmountPaid,p.EMail FROM v_tournament_payment as p INNER JOIN v_teams as t ON t.TeamID = p.TeamID AND p.TournamentID = '".$json['TournamentID']."' AND p.status = 'Approved'");
        $RevenueAndTaxQuery->execute();
        $RevenueAndTaxQueryData= $RevenueAndTaxQuery->fetchAll(PDO::FETCH_ASSOC);
        if ($RevenueAndTaxQueryData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['RevenueAndTaxReportByTournament'] = $RevenueAndTaxQueryData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    public function PlayerDetailsByPlayer($Condition = '')
    {
        $json = json_decode($Condition, true);
        $UserDetailsQuery = $this->_db->prepare("SELECT UserID,CONCAT(FirstName,' ',LastName) as PlayerName FROM v_users WHERE UserID = '".$json['PlayerID']."'");
        $UserDetailsQuery->execute();
        $UserDetailsQueryData = $UserDetailsQuery->fetch(PDO::FETCH_ASSOC);
        if ($UserDetailsQueryData) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['UserDetailsDataByUserID'] = $UserDetailsQueryData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data; 
    }
    
    public function GetTournaments($Condition = '') {
        $json = json_decode($Condition, true);
        $GetAllTournamentQuery = $this->_db->prepare("SELECT Tournament.TournamentID,Tournament.TournamentName,Tournament.StartDate,Tournament.EndDate,Tournament.Description,Tournament.TournamentFor,Tournament.SecondRunnerUpsPrize,Tournament.RegistrationFees,Tournament.MaximumPlayers,Tournament.MinimumPlayers,Tournament.WinnerPrize,Tournament.RunnerUpsPrize,(CASE WHEN Tournament.TournamentImage = '' THEN '" . SITE_URL . "admin/uploads/placeholder3.png' ELSE CONCAT('" . SITE_URL . "admin/uploads/TournamentImage/',Tournament.TournamentImage) END) AS TournamentImage,Tournament.StateID,Tournament.CityID,GROUP_CONCAT(DISTINCT State.StateName) AS StateName,GROUP_CONCAT(DISTINCT City.CityName) AS CityName ,TournamentType.TypeName,Tournament.RegistrationStartDate,Tournament.RegistrationEndDate FROM v_tournaments AS Tournament LEFT JOIN v_state AS State ON find_in_set(State.StateID,Tournament.StateID) LEFT JOIN v_city AS City ON find_in_set(City.CityID,Tournament.CityID) INNER JOIN v_tournament_type AS TournamentType ON Tournament.TypeID = TournamentType.SrNo WHERE StartDate !='0000-00-00' GROUP BY Tournament.TournamentID ORDER BY startdate DESC");
        $GetAllTournamentQuery->execute();
        $GetAllTournamentQueryData = $GetAllTournamentQuery->fetchAll(PDO::FETCH_ASSOC);
        if (count($GetAllTournamentQueryData) > 0) {
            $this->return_data['ResponseCode'] = 1;
            $this->return_data['GetAllTournamentQueryData'] = $GetAllTournamentQueryData;
        } else {
            $this->return_data['ResponseCode'] = 0;
            $this->return_data['Message'] = 'No Record Found';
        }
        return $this->return_data;
    }
}
