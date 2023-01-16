<?php
require_once("header.php");
require_once("sidemenu.php");
if($_REQUEST['issue_id'] != ''){
    $delsql="DELETE FROM book_issue WHERE issue_id ='".$_REQUEST['issue_id']."'";
    $ex = $conn->query($delsql);
}
?>
<br />
<br />
<br />
<br />

<link href="assets/css/new.css" rel="stylesheet" />

<form method="post">

    <div class="col-lg-2"></div>
    <div class="col-lg-10" style="padding-left: 250px"> 
        <h2 style="margin-left: 100px"> Issued Book List</h2>
    <table border="2px solid">
        <thead>
        <tH>department</th>
        <th>semister</th>
        <th>division</th>
        <th>student or faculty name</th>
        <th>book name</th>
         <th>Action</th>
    </thead>
 
            <?php
           $sql ="SELECT bs.*,dept.department,division.division,semi.sem,regist.name,book.name_of_book FROM book_issue AS bs 
INNER JOIN department AS dept
ON bs.department_id = dept.department_id 
INNER JOIN division 
ON bs.div_id = division.div_id
INNER JOIN sem AS semi
ON bs.sem_id = semi.sem_id
INNER JOIN book_list AS book
ON bs.book_list_id = book.book_list_id
INNER JOIN registration AS regist
ON bs.regist_id = regist.regist_id";
//            $sql = "SELECT * FROM book_issue";
            $ex = $conn->query($sql);
            foreach ($ex AS $key=>$value){
//                echo '<pre>';
//                print_r($value);
                ?>
                
                <tr>
                <td><?php echo $value['department'] ?></td>
                <td><?php echo $value['sem'] ?></td>
                <td><?php echo $value['division'] ?></td> 
                <td> <?php echo $value['name'];?></td>
                <td><?php echo $value['name_of_book'] ?></td>
                <td><a href="view_issued_books.php?issue_id=<?php echo $value['issue_id']?>">Delete</a></td>
                </tr>
                  
            <?php } ?>
            </table> 
 </div>
</form>
<?php
require_once("footer.php");
?>
