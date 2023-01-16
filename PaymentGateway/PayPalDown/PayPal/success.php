<?php


// echo "<pre>";
// print_r($_REQUEST);
// exit;
echo $item_no            = $_REQUEST['item_number'];
echo $item_transaction   = $_REQUEST['tx']; // Paypal transaction ID
echo $item_price         = $_REQUEST['amt']; // Paypal received amount
echo $item_currency      = $_REQUEST['cc']; // Paypal received currency type
 exit;
$price = '10.00';
$currency='USD';
 
//Rechecking the product price and currency details
if($item_price==$price && $item_currency==$currency)
{
    echo "<h1>Welcome, Guest</h1>";
    echo "<h1>Payment Successful</h1>";
}
else
{
    echo "<h1>Payment Failed</h1>";
}
?>