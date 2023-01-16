<?php
$con = mysql_connect('localhost', 'root', '');
mysql_select_db('bloodbuddies', $con);

//Import uploaded file to Database
$handle = fopen('cities.csv', "r");

while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $import = "INSERT into bd_cities(CountrySrNo,StateSrNo,CityName,CreatedIP,ModifyIP,IsActive,DeleteStatus,EntryByUser,EntryDate,ModificationByUser,ModifyDate) values(1,'$data[2]','$data[1]','192.168.0.103','192.168.0.103','Y','N',1,'2016-08-31',1,'2016-08-31')";

    mysql_query($import) or die(mysql_error());
}

fclose($handle);

