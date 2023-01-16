	
<?php
include "../config_db.php";
$strm=$_POST['stream'];
$sem=$_POST['semester'];
$sub=$_POST['subject'];
$row = 1;
if (($handle = fopen($_FILES['userfile']['tmp_name'], "r")) !== FALSE)
 {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
	{
        $num = count($data);
        $row++;
		$insert_csv = array();
        for ($c=0; $c < $num; $c++) {
            $insert_csv[$c]=$data[$c] ;
        }
		$que = "insert into  tbl_mcq(stream,semester,subject,que,op1,op2,op3,op4,ans)
values ('$strm','$sem','$sub','.$insert_csv[0]','.$insert_csv[1]','$insert_csv[2]','$insert_csv[3]','$insert_csv[4]','$insert_csv[5]')";
$n=mysql_query($que,$conn);
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
mysql_close($conn);

?>

