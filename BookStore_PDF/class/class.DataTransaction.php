<?php

error_reporting(0);

class DataTransaction {

    public $db;

    function __construct($db = null) {
        $this->_db = $db;
    }

    public function update($TableName, $DataObject, $Condition) {
        $sql = '';
        foreach ($DataObject as $key => $value) {
            $sql .= $key . " = :" . addslashes($key) . ", ";
        }
        $sql_update = substr($sql, 0, -2);
        foreach ($Condition as $key1 => $value1) {
            $GetData[] = $key1 . " = '" . $value1 . "'";
        }
        //print_r($Condition);
        try {
            $stmt = $this->_db->prepare('UPDATE `' . $TableName . '` SET ' . $sql_update . ' WHERE ' . implode(' AND ', $GetData));
            $UPdateParams = 'UPDATE `'.$TableName.'` SET ';
            foreach ($DataObject as $ParamID => $ParamValue) {
                $UPdateParams .= $ParamID.' = "'.$ParamValue.'", ';
                $stmt->bindValue(':' . $ParamID, $ParamValue, PDO::PARAM_STR);
            }   
            $UPdateParams .= ' WHERE ' . implode(' AND ', $GetData);
//            echo $UPdateParams;            
            //echo $stmt->execute();
            //echo $stmt->queryString;
            //echo array('Response' => $stmt->execute(), 'String' => $stmt->queryString);
            //echo $stmt->debugDumpParams();
            return $stmt->execute();            
            
        } catch (PDOException $e) {
            $LogFile = DOCUMENT_ROOT."log.txt";
            file_put_contents($LogFile, PHP_EOL."TIME:>> ".date('Y-m-d H:i A')." during update query on ".$TableName ." table: ".PHP_EOL."ErrorStatement:>> ".$e->getMessage().PHP_EOL , FILE_APPEND);
            return $e->getMessage();
        }
    }

    public function insert($Data, $ViewName) {
        $keystr = "";
        $valstr = "";
        foreach ($Data as $key => $value) {
            $keystr .= "$key, "; // get key string with comma
            //$valstr .= ":" . htmlspecialchars(addslashes($key)) . ", ";
            $valstr .= ":" . htmlspecialchars(addslashes($key)) . ", ";
            $valstrDebug .= "'".htmlspecialchars(addslashes($value)) . "', "; 
        }
        $keys = substr($keystr, 0, -2); // remove last comma from key string
        $vals = substr($valstr, 0, -2); // remove last comma from value string
        $valsDebug = substr($valstrDebug, 0, -2); // DEBUG
         'INSERT INTO `' . $ViewName . '` (' . $keys . ') VALUES (' . $valsDebug . ')';
        
//exit;
        try {
            $stmt = $this->_db->prepare('INSERT INTO `' . $ViewName . '` (' . $keys . ') VALUES (' . $vals . ')');
            foreach ($Data as $ParamID => $ParamValue) {
                $stmt->bindValue(':' . $ParamID, $ParamValue, PDO::PARAM_STR);
            }
//            echo $stmt;
            $stmt->execute();
            //$Data = var_dump($Data);
            return $this->_db->lastInsertId();
            //echo $stmt->getMessage();
        } catch (PDOException $e) {
            $LogFile = DOCUMENT_ROOT."log.txt";
            file_put_contents($LogFile, PHP_EOL."TIME:>> ".date('Y-m-d H:i A')." during insert query in ".$ViewName ." table: ".PHP_EOL."ErrorStatement:>> ".$e->getMessage().PHP_EOL , FILE_APPEND);
            return $e->getMessage();
        }
    }

    public function selectdata($ViewName, $Columns, $Condition) {
        $ColumnData = '';
        $ConditionData = '';
        $ResponseData = '';
        //if ($Condition != '') {
        if (is_array($Condition) && !empty($Condition)) {
            foreach ($Condition as $key1 => $value1) {
                $ConditionData .= "AND " . $key1 . " = '" . $value1 . "' ";
            }
            $Cond = substr($ConditionData, 3, -1);
        } else {
            $Cond = $Condition;
        }
        if (is_array($Columns) && isset($Columns)) {
            foreach ($Columns as $key) {
                $ColumnData .= " `" . $ViewName . "`.`" . $key . "`, ";
            }
        } else {
            $ColumnData = " *  ";
        }
        $Cols = substr($ColumnData, 0, -2);
        //echo $query = 'SELECT '.$Cols. ' FROM `' . $ViewName.'`  WHERE ' . $Cond;
        try {
            $query = $this->_db->prepare('SELECT ' . $Cols . ' FROM `' . $ViewName . '`  WHERE ' . $Cond);
            $query->execute();
            $ResponseData = $query->fetchAll(PDO::FETCH_ASSOC);
//            while ($row = $query->fetch()) {
//                $ResponseData[] = $row;
//            }
        } catch (PDOException $e) {     
            $LogFile = DOCUMENT_ROOT."log.txt";
            file_put_contents($LogFile, PHP_EOL."TIME:>> ".date('Y-m-d H:i A')." during select query with ".$ViewName ." table: ".PHP_EOL."ErrorStatement:>> ".$e->getMessage().PHP_EOL , FILE_APPEND);
            return $e->getMessage();
        }
        return $ResponseData;
    }

    public function innerdata($FirstInnerTable, $Condition, $InnerJoinTables, $InnerJoinFields = null, $Limit = null) {
        $ColumnData = '';
        $ConditionData = '';
        $ResponseData = '';
        $Tables = '';
        $LimitQry = '';

        //print_r($InnerJoinFields);
        if ($Condition != '') {
            foreach ($Condition as $key1 => $value1) {
                $ConditionData .= "AND " . $key1 . " = '" . $value1 . "', ";
            }
            $Cond = substr($ConditionData, 3, -2);
        } else {
            $Cond = ' 1 ';
        }
        if (is_array($InnerJoinTables) & isset($InnerJoinTables)) {
            //print_r($InnerJoinTables);
            foreach ($InnerJoinTables as $keyF => $valueF) {
                $Tables .= ' INNER JOIN `' . $keyF . '` ON '; // get key string with comma
                $Tables .= "" . $valueF . "  "; // get string of value with comma
            }
        } else {
            $Tables .= ' INNER JOIN `' . $InnerJoinTables . '` '; // get key string with comma            
        }
        if (is_array($InnerJoinFields) & isset($InnerJoinFields)) {
            foreach ($InnerJoinFields as $keyC => $valueC) {
                $ColumnData .= "" . $keyC . " as " . $valueC . ", ";
            }
            $Cols = substr($ColumnData, 0, -2);
        } else {
            $Cols = " *  ";
        }

        if (is_array($Limit) & isset($Limit)) {
            $LimitQry = ' LIMIT ' . $Limit[0] . ', ' . $Limit[1];
        }

        //if ($Limit != '') {
        //    $LimitQry = 'LIMIT '.$Limit;
        //}
        //echo $ColumnData;

        $Tbls = substr($Tables, 0, -2);
        //echo $query = 'SELECT '.$Cols. ' FROM `' . $FirstInnerTable.'` '.$Tbls.' WHERE ' . $Cond . $LimitQry;
        try {
            $query = $this->_db->prepare('SELECT ' . $Cols . ' FROM `' . $FirstInnerTable . '` ' . $Tbls . ' WHERE ' . $Cond . $LimitQry);
            $query->execute();
            $ResponseData = $query->fetchAll(PDO::FETCH_ASSOC);
//            while ($row = $query->fetch()) {
//                $ResponseData[] = $row;
//            }
        } catch (PDOException $e) {
            $LogFile = DOCUMENT_ROOT."log.txt";
            file_put_contents($LogFile, PHP_EOL."TIME:>> ".date('Y-m-d H:i A')." during INNER JOIN Query with ".$FirstInnerTable ." table: ".PHP_EOL."ErrorStatement:>> ".$e->getMessage().PHP_EOL , FILE_APPEND);
            return $e->getMessage();
        }
        return $ResponseData;
    }

    public function leftdata($FirstInnerTable, $Condition, $InnerJoinTables, $InnerJoinFields = null, $Limit = null) {
        $ColumnData = '';
        $ConditionData = '';
        $ResponseData = '';
        $Tables = '';
        $LimitQry = '';

        //print_r($InnerJoinFields);
        if ($Condition != '') {
            foreach ($Condition as $key1 => $value1) {
                $ConditionData .= "AND " . $key1 . " = '" . $value1 . "', ";
            }
            $Cond = substr($ConditionData, 3, -2);
        } else {
            $Cond = ' 1 ';
        }
        if (is_array($InnerJoinTables) & isset($InnerJoinTables)) {
            //print_r($InnerJoinTables);
            foreach ($InnerJoinTables as $keyF => $valueF) {
                $Tables .= ' LEFT JOIN `' . $keyF . '` ON '; // get key string with comma
                $Tables .= "" . $valueF . "  "; // get string of value with comma
            }
        } else {
            $Tables .= ' LEFT JOIN `' . $InnerJoinTables . '` '; // get key string with comma            
        }
        if (is_array($InnerJoinFields) & isset($InnerJoinFields)) {
            foreach ($InnerJoinFields as $keyC => $valueC) {
                $ColumnData .= "" . $keyC . " as " . $valueC . ", ";
            }
            $Cols = substr($ColumnData, 0, -2);
        } else {
            $Cols = " *  ";
        }

        if (is_array($Limit) & isset($Limit)) {
            $LimitQry = ' LIMIT ' . $Limit[0] . ', ' . $Limit[1];
        }

        $Tbls = substr($Tables, 0, -2);
        //echo $query = 'SELECT '.$Cols. ' FROM `' . $FirstInnerTable.'` '.$Tbls.' WHERE ' . $Cond . $LimitQry;
        try {
            $query = $this->_db->prepare('SELECT ' . $Cols . ' FROM `' . $FirstInnerTable . '` ' . $Tbls . ' WHERE ' . $Cond . $LimitQry);
            $query->execute();
            $ResponseData = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $LogFile = DOCUMENT_ROOT."log.txt";
            file_put_contents($LogFile, PHP_EOL."TIME:>> ".date('Y-m-d H:i A')." during left join query with ".$FirstInnerTable ." table: ".PHP_EOL."ErrorStatement:>> ".$e->getMessage().PHP_EOL , FILE_APPEND);
            return $e->getMessage();
        }
        return $ResponseData;
    }

    public function delete($ViewName, $Condition) {
        $ConditionData = '';
        $ResponseData = '';
        if ($Condition != '') {
            foreach ($Condition as $key1 => $value1) {
                $ConditionData .= "AND `" . $key1 . "` = '" . $value1 . "' ";
            }
            $Cond = substr($ConditionData, 3, -1);
        } else {
            $Cond = ' 1 ';
        }
        //echo $query = 'DELETE FROM `'.$ViewName.'` WHERE '.$Cond;
        try {
            $stmt = $this->_db->prepare('DELETE FROM `' . $ViewName . '` WHERE ' . $Cond);
            return $stmt->execute();
        } catch (PDOException $e) {
            $LogFile = DOCUMENT_ROOT."log.txt";
            file_put_contents($LogFile, PHP_EOL."TIME:>> ".date('Y-m-d H:i A')." during delete query on ".$ViewName ." table: ".PHP_EOL."ErrorStatement:>> ".$e->getMessage().PHP_EOL , FILE_APPEND);
            return $e->getMessage();
        }
    }

    public function send_email_13102016($to, $cc = null, $bcc = null, $subject, $message, $alert_msg, $attachment = null) {
        require_once('mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->AddAddress($to);
        $mail->Username = CONTACT_EMAIL;
        $mail->Password = CONTACT_PASSWORD;
        $mail->SetFrom(CONTACT_EMAIL, SITE_NAME);
        $mail->AddReplyTo(CONTACT_EMAIL, SITE_NAME);
        $mail->Subject = $subject;
        if ($cc != "") {
            $mail->AddCC($cc);
        }

        if ($bcc != "") {
            $mail->AddBCC($cc);
        }
        if ($attachment != '') {
            $mail->AddAttachment($attachment);
        }
        $mail->MsgHTML($message);
        if (!$mail->Send()) {
            $LogFile = DOCUMENT_ROOT."log.txt";
            file_put_contents($LogFile, PHP_EOL."TIME:>> ".date('Y-m-d H:i A')." while sending email to ".$to ." : ".PHP_EOL."ErrorStatement:>> ".$this->_mailer->ErrorInfo.PHP_EOL , FILE_APPEND);
            return 'Failed to send email. Mailer error: ' . $this->_mailer->ErrorInfo;
        } else {
            if ($alert_msg != "") {
                return $alert_msg;
            }
        }
    }
    
    public function send_email($to, $cc = null, $bcc = null, $subject, $message, $alert_msg, $attachment = null) {

        require_once('mailer/class.phpmailer.php');

        $mail = new PHPMailer();

        $mail->IsSMTP();

        $mail->SMTPDebug = 1;

        $mail->SMTPAuth = true;

        $mail->SMTPSecure = "ssl";

        $mail->Host = "43.225.55.90";

        $mail->Port = 465;

        $mail->AddAddress($to);

        $mail->Username = CONTACT_EMAIL;

        $mail->Password = CONTACT_PASSWORD;

        $mail->SetFrom(CONTACT_EMAIL, SITE_NAME);

        $mail->AddReplyTo(CONTACT_EMAIL, SITE_NAME);

        $mail->Subject = $subject;

        if ($cc != "") {

            $mail->AddCC($cc);
        }
        if ($bcc != "") {

            $mail->AddBCC($cc);
        }

        if ($attachment != '') {

            $mail->AddAttachment($attachment);
        }

        $mail->MsgHTML($message);

        if (!$mail->Send()) {

            $LogFile = DOCUMENT_ROOT . "log.txt";

            file_put_contents($LogFile, PHP_EOL . "TIME:>> " . date('Y-m-d H:i A') . " while sending email to " . $to . " : " . PHP_EOL . "ErrorStatement:>> " . $this->_mailer->ErrorInfo . PHP_EOL, FILE_APPEND);

            return 'Failed to send email. Mailer error: ' . $this->_mailer->ErrorInfo;
        } else {

            if ($alert_msg != "") {

                return $alert_msg;
            }
        }
    }

    public function Query($sql) {
        try {
            //$qry = $this->_db->prepare($sql);
            $stmt = $this->_db->prepare($sql);
            $stmt->execute();
            return $qry;
        } catch (PDOException $e) {
            $LogFile = DOCUMENT_ROOT."log.txt";
            file_put_contents($LogFile, PHP_EOL."TIME:>> ".date('Y-m-d H:i A')." during query statement ".PHP_EOL."Querystatement:>> ".$sql, FILE_APPEND);
            return $e->getMessage();
        }
    }

    public function redirect($url) {
        header("Location: $url");
    }

}

?>