<?php
session_start();
require_once 'config.php';

if($_REQUEST['do']=='send_message')
{
    $msg=$_REQUEST['msg'];
    $sender=$_REQUEST['sender'];
    $reciver=$_REQUEST['receiver'];
    $sql1="insert into chat(sender_id,reciver_id,body_message) values ('$sender','$reciver','$msg')";
    $ex1=$conn->query($sql1);
    
    $query="select * from chat where sender_id=".$sender." OR reciver_id=".$sender;
    $rs=$conn->query($query);
    while ($r = $rs->fetch_assoc()) {
        if($_SESSION['userdata']['user_id']==$sender)
        {
            $sen_id=$r['sender_id'];
        }else{
            $sen_id=$r['reciver_id'];
        }
        $query2="select username from user where user_id=".$sen_id;
        $rs1=$conn->query($query2);
        $res=$rs1->fetch_assoc();
        
        ?>
                                <p><?php echo $res['username']; ?>:<?php echo $r['body_message']; ?></p>
    <?php } ?> 
       
        
<?php    
}elseif($_REQUEST['do']=='get_message')
{
    $sender=$_REQUEST['sender'];
    $query="select * from chat where sender_id=".$sender." OR reciver_id=".$sender;
    $rs=$conn->query($query);
    while ($r = $rs->fetch_assoc()) {
        if($_SESSION['userdata']['user_id']==$sender)
        {
            $sen_id=$r['sender_id'];
        }else{
            $sen_id=$r['reciver_id'];
        }
        $query2="select username from user where user_id=".$sen_id;
        $rs1=$conn->query($query2);
        $res=$rs1->fetch_assoc();
        
        ?>
                                <p><?php echo $res['username']; ?>:<?php echo $r['body_message']; ?></p>
    <?php } ?> 
  <?php
}
?>