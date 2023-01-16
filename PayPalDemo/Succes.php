<?php

$transactionid   = $_REQUEST['txn_id']; // Paypal transaction ID
$grossamt         = $_REQUEST['payment_gross']; // Paypal received amount
$paymeny_status     = $_REQUEST['payment_status']; // Paypal received currency type
//print_r($_REQUEST);
/*foreach($_REQUEST as $Key=>$value)
{
    echo $Key." ".$value."</br/>";
}
/* echo $item_no;
 echo $item_transaction;
 echo $item_price;
 echo $item_currency;
 * 
 */


//Rechecking the product price and currency details
if($paymeny_status=="Completed")
{
  echo "Thanks for buying ";
  echo "<br/>Your Transaction id is ".$transactionid."for purchasing of ".$grossamt."$";
}
else
{
    echo "<h1>Payment Failed</h1>";
}