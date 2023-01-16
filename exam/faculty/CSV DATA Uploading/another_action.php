<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$connect = mysql_connect('localhost','root','');
if (!$connect)
 {
die('Could not connect to MySQL: ' . mysql_error());
}
$cid =mysql_select_db('quiz',$connect);

$strm=$_POST['stream'];
$sem=$_POST['semister'];
$sub=$_POST['subject'];
$row = 1;
if (($handle = fopen($_FILES['userfile']['tmp_name'], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
		$insert_csv = array();
        for ($c=0; $c < $num; $c++) {
            $insert_csv[$c]=$data[$c] ;
        }
		$query = "INSERT INTO tbl_mcq(stream,semister,subject,que,op1,op2,op3,op4,ans)
VALUES('$strm','$sem','$sub','.$insert_csv[0]','.$insert_csv[1]','$insert_csv[2]','$insert_csv[3]','$insert_csv[4]','$insert_csv[5]')";
$n=mysql_query($query, $connect );
    }
	
}
 fclose($handle);
 if($n)
 {
	echo "File data successfully imported to database!!";
 }
 else
 {
	 	echo "File data not  SUccessfully imported";
 }
mysql_close($connect);

?>