<?php
session_start();
require_once 'config.php';
?>
<script src="jquery-1.11.1.min.js"></script>
<form method="post">
 <div>
    <?php if (($_SESSION['userdata']['utype_id'] == '2') || ($_SESSION['userdata']['utype_id'] == '1')) { ?>
            
            <?php }?>
            
            <?php
                if ($_SESSION['userdata']['utype_id'] == '2' || $_SESSION['userdata']['utype_id'] == '1') 
            { ?>
         <div class="col-lg-3">
             <div class="row"  style="background-color:lightgrey">
              <?php
                
//                require_once 'side_menu.php';
				?>
                 </div>
             
            </div><br/>
            <?php
            }
             ?>
             </div>	
    <table border="1" align="center">
        <tr>
            <td>
                <select id="receiver" name="chatuser" style="width:100%;">
                    <?php
                    $sql = "select * from user";
                    $ex = $conn->query($sql);
                    while ($r = $ex->fetch_object()) 
                        {
                        if($_SESSION['userdata']['user_id'] !=$r->user_id)
                        {
                    ?>
                        <option value="<?php echo $r->user_id ; ?>"><?php echo $r->username; ?></option>
                        <?php } } ?>    
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <?php 
                    $sql2="select * from chat";
                    $ex2=$conn->query($sql2);
                    
                ?>
                <div id="chatbox" style="height:200px; overflow-y: scroll;">
                    <?php
                    $sender=$_SESSION['userdata']['user_id'];
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
                </div>
                   
                
            </td>
        </tr>
        <tr>
        <td>
            <textarea id="msg" name="chatbody" cols="30" rows="2"> </textarea>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="button" name="send" value="Send" onclick="send_msg();" />
                <input type="reset" value="Calncel" />
            </td> 
        </tr>
    </table>
</form>
<script>
document.getElementById('msg').addEventListener('keydown', function (e){
   if (e.which == 13) {
       var sender='<?php echo $_SESSION['userdata']['user_id']; ?>';
    var receiver = $('#receiver').val();
    var msg = $('#msg').val();
    $.ajax({
        type: "POST",
        url: 'ajax.php',
        data: {'do':'send_message','sender':sender,'receiver':receiver,'msg':msg},
        success: function (response) {
	$('#chatbox').html(response);
        $('#msg').val('');
        }
    }); 
    }
}, false);
    
    
function send_msg()
{
    var sender='<?php echo $_SESSION['userdata']['user_id']; ?>';
    var receiver = $('#receiver').val();
    var msg = $('#msg').val();
    $.ajax({
        type: "POST",
        url: 'ajax.php',
        data: {'do':'send_message','sender':sender,'receiver':receiver,'msg':msg},
        success: function (response) {
	$('#chatbox').html(response);
        $('#msg').val('');
        }
    });
}

setInterval(function(){
    
    var sender='<?php echo $_SESSION['userdata']['user_id']; ?>';
    var receiver = $('#receiver').val();
    var msg = $('#msg').val();
    $.ajax({
        type: "POST",
        url: 'ajax.php',
        data: {'do':'get_message','sender':sender,'receiver':receiver,'msg':msg},
        success: function (response) {
            //alert(response);
	$('#chatbox').html(response);
        }
    });
    
}, 1000);

</script>

