<?php
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='jay.amin@tops-int.com'; // Business email ID and pass: 

// customer paypal id: jay.amin.buyesr@tops-int.com, pass: 

// paypal
?>
<h4>Welcome, User</h4>
 
<form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
  <input type="hidden" name="item_name" value="Memorex 256MB Memory Stick">
  <!-- <input type="hidden" name="item_number" value="MEM32507725"> -->
  <input type="hidden" name="amount" value="302">
  <!-- <input type="hidden" name="tax" value="1"> -->
  <input type="hidden" name="quantity" value="1">
  <input type="hidden" name="currency_code" value="USD">

  <!-- Enable override of buyers's address stored with PayPal . -->
  <!-- <input type="hidden" name="address_override" value="1"> -->
  <!-- Set variables that override the address stored with PayPal. -->
  <!-- <input type="hidden" name="first_name" value="John">
  <input type="hidden" name="last_name" value="Doe">
  <input type="hidden" name="address1" value="345 Lark Ave">
  <input type="hidden" name="city" value="San Jose">
  <input type="hidden" name="state" value="CA">
  <input type="hidden" name="zip" value="95121">
  <input type="hidden" name="country" value="US"> -->
  <input type="image" name="submit"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">
</form>