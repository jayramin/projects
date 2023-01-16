<?php
 $ch = curl_init();
 
$client = "Acu1tiyVPuYlO0fSsfCinb4aHYNReh1LpeCpkMzEw3OSOjxGI26jjshyDCYXAQHf01L44uw3fdT1UFP0";
$secret = "EFF_SefibJm1vpZ3lw1ygTST_FMMVtadyuL20buZSfnaxtdwBvtYCmvRP_7PqhirGw-xQmgGAQVpus8b";

 curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
 /*curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/oauth2/token");*/
 curl_setopt($ch, CURLOPT_HEADER, false);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_USERPWD, $client.":".$secret);
 curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
 $result = curl_exec($ch);
 if(empty($result))die("Error: No response.");
 else
 {
  $json = json_decode($result);
  /*print_r($json->access_token);*/
 }
 /* Now doing txn after getting the token */
 
 
 
 $ch = curl_init();
 $data = '{
 "intent": "sale",
 "payer": {
 "payment_method": "credit_card",
 "payer_info": {
 "email": "jay.amin@tops-int.com",
 "shipping_address": {
 "recipient_name": "Jay Amin",
 "line1": "Address",
 "city": "City",
 "country_code": "AD",
 "postal_code": "456123",
 "state": "state",
 "phone": "9879879877"
 },
 "billing_address": {
 "line1": "Address",
 "city": "Ahmedabad",
 "state": "Gujarat",
 "postal_code": "38001",
 "country_code": "AD",
 "phone": "9877899877"
 }
 },
 "funding_instruments": [{
 "credit_card": {
 "number": "4111111111111111",
 "type": "visa",
 "expire_month": "01",
 "expire_year": "2021",
 "cvv2": "123",
 "first_name": "Jay",
 "last_name": "Amin",
 "billing_address": {
 "line1": "Address",
 "city": "Ahmedabad",
 "country_code": "AD",
 "postal_code": "380001",
 "state": "Gujarat",
 "phone": "9877899877"
 }
 
 }
 }]
 },
 "transactions": [{
 "amount": {
 "total": "1223",
 "currency": "USD"
 },
 "description": "This is the payment transaction description.",
 "item_list": {
 "shipping_address": {
 "recipient_name": "Jay Amin",
 "line1": "Address",
 "city": "Ahmedabad",
 "country_code": "AD",
 "postal_code": "380001",
 "state": "Gujarat",
 "phone": "9877899877"
 }
 }
 }]
 }';
 curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment");
 /*curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/payments/payment");*/
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$json->access_token));
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $result = curl_exec($ch);
 //curl_close($ch);
 if(empty($result))die("Error: No response.");
 else
 {
  $json = json_decode($result);
  echo "<pre>";
  print_r($json);
  //if($json->name=="")
  // {
  if($json->state=="approved")
  {
   $transactions=$json->transactions;
   $related_resources=$transactions[0]->related_resources;
   $related_resources[0]->sale->id;
   global $wpdb;
   $invoice_number=$related_resources[0]->sale->id;
   $sql_insert="INSERT INTO `bharat_kudecha_user_donation` (`id`, `fname`, `lname`, `email`, `phone`, `Country`, `Address`, `City`, `cost`, `recurring`, `invoice_number`, `status`, `create_date`, `txn_id`, `receiver_id`) VALUES
   (NULL, '". $fname."', '". $lname."', '". $email."', '". $phone."', '". $country."', '". $address."', '". $city."', ".$cost1.", '". $recurring."', '". $invoice_number."', '1',  now())";
   $wpdb->query($sql_insert);
   
   $actual_link = "https://example.org/donations/thank-you/";
   echo "<script> window.location.href='".$actual_link."'; </script>"; /* REDIRECT CODE HERE*/
  } else{
   
   echo "<div class='fail'>".$json->state;
   echo"</div>";
  }
}
 ?>