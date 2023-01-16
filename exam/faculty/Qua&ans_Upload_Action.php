<?php
include "../config_db.php";
if (!$conn)
 {
die('Could not connect to MySQL: ' . mysql_error());
}
$cid =mysql_select_db('exam',$conn);?>
<?php
$strm=$_POST['stream'];
$sem=$_POST['semester'];
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
		$query = "insert into tbl_mcq(stream,semester,subject,que,op1,op2,op3,op4,ans)
VALUES('$strm','$sem','$sub','.$insert_csv[0]','.$insert_csv[1]','.$insert_csv[2]','.$insert_csv[3]','.$insert_csv[4]','.$insert_csv[5]')";
$n=mysql_query($query, $conn );
    }
	
}
 fclose($handle);
 if($n)
 {
 ?>
 <script>alert('File data successfully imported to database!!');
 window.location="Qua&ans_Upload.php";
 </script>
 <?php
 }
 else
 {
 ?>
 <script>alert('File data does not imported to database!!');
 window.location="Qua&ans_Upload.php";
 </script>
<?php
 }
mysql_close($conn);

?>