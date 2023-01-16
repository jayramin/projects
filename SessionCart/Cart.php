<?php
include 'controller.php';
?>
<html>
    <head></head>
    <body>
            <table border = "1">
                <tr>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Delete</th>
                </tr>
                <?php 
                foreach ($_SESSION['Cart'] as $key=>$value){  ?>
                    <tr>
                    <td><label><?php echo $value['ProductName']?></label></td>
                    <td><label><?php echo $value['ProductPrice']?></label></td>
                    <td><input id="Qty_<?php echo $value['ProductCode']; ?>" type="number" name="Qut" value="<?php echo $value['Qty']?>"></td>
                    <td><form action=""  method="post"><input type="hidden" name="Code" value="<?php echo $value['ProductCode']; ?>"><input type="submit"  value="Delete" name="Delete"></form></td>
                   </tr>
              <?php  }
                ?>
            </table>
    </body>
</html>