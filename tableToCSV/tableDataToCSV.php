<?php 
include "config.php";
?>

<div class="container">
 
 <form method='post' action='download.php'>
  <input type='submit' value='Export' name='Export'>
 
  <table border='1' style='border-collapse:collapse;'>
    <tr>
     <th>ID</th>
     <th>Username</th>
     <th>Name</th>
     <th>Gender</th>
     <th>Email</th>
    </tr>
    <?php 
     $query = "SELECT * FROM users ORDER BY id asc";
     $result = mysqli_query($con,$query);
     $user_arr = array();
     while($row = mysqli_fetch_array($result)){
      $id = $row['id'];
      $uname = $row['username'];
      $name = $row['fullname'];
      $gender = $row['gender'];
      $email = $row['email'];
      $user_arr[] = array($id,$uname,$name,$gender,$email);
   ?>
      <tr>
       <td><?php echo $id; ?></td>
       <td><?php echo $uname; ?></td>
       <td><?php echo $name; ?></td>
       <td><?php echo $gender; ?></td>
       <td><?php echo $email; ?></td>
      </tr>
   <?php
    }
   ?>
   </table>
   <?php 
    $serialize_user_arr = serialize($user_arr);
   ?>
  <textarea name='export_data' style='display: none;'><?php echo $serialize_user_arr; ?></textarea>
 </form>
</div>