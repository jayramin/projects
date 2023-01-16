<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='jay.amin@tops-int.com'; // Business email ID
?>
<h4>Welcome, Guest</h4>
 
<div class="product">            
    <div class="image">
        <img src="http://www.phpgang.com/wp-content/uploads/gang.jpg" />
    </div>
    <div class="name">
        PHPGang Payment
    </div>
    <div class="price">
        Price:$10
    </div>
    <div class="btn">
    <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="PHPGang Payment">
    <input type="hidden" name="item_number" value="2">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" value="100">
   <!--  <div id = "item_1" class = "itemwrap">
        <input name = "item_name_1" value = "Gold Tickets" type = "hidden">
        <input name = "quantity_1" value = "4" type = "hidden">
        <input name = "amount_1" value = "30" type = "hidden">
        <input name = "shipping_1" value = "0" type = "hidden">
    </div>
    <div id = "item_2" class = "itemwrap">
        <input name = "item_name_2" value = "Silver Tickets" type = "hidden">
        <input name = "quantity_2" value = "2" type = "hidden">
        <input name = "amount_2" value = "20" type = "hidden">
        <input name = "shipping_2" value = "0" type = "hidden">
    </div>
    <div id = "item_3" class = "itemwrap">
        <input name = "item_name_3" value = "Bronze Tickets" type = "hidden">
        <input name = "quantity_3" value = "2" type = "hidden">
        <input name = "amount_3" value = "15" type = "hidden">
        <input name = "shipping_3" value = "0" type = "hidden">
    </div>-->
    <input type="hidden" name="cpp_header_image" value="http://www.phpgang.com/wp-content/uploads/gang.jpg">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="http://localhost:88/PayPalDemo/Cancel.php">
    <input type="hidden" name="return" value="http://localhost:88/PayPalDemo/Succes.php">
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form> 
    </div>
</div>
    </body>
</html>
