<?php
 $clientt="";
    $secrett="";
     $ch = curl_init();
     //curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");    //https://api.paypal.com/v1/oauth2/token
    curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/oauth2/token");    //https://api.sandbox.paypal.com/v1/oauth2/token
    $requestNvp = array(

    'USER' => $paypalusername,

    'PWD' => $paypalpassword,

    'SIGNATURE' => $paypalsignature,

  

    'VERSION' => '93',

    'METHOD'=> 'SetExpressCheckout',

  

    'PAYMENTREQUEST_0_CURRENCYCODE' => $currency,

    'PAYMENTREQUEST_0_AMT' => $total_amount,

    'PAYMENTREQUEST_0_ITEMAMT' => $total_amount,

    'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',

    'PAYMENTREQUEST_0_DESC' => 'Report',

    'PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID' => $paypalemail,

    'PAYMENTREQUEST_0_PAYMENTREQUESTID' => 'VID-PAYMENT0',

  

    'L_PAYMENTREQUEST_0_NAME0' => 'Report Purchase',

    'L_PAYMENTREQUEST_0_NUMBER0' => 'SS-101',

    'L_PAYMENTREQUEST_0_QTY0' => '1',

    'L_PAYMENTREQUEST_0_AMT0' => $total_amount,

  

    'RETURNURL' => $paypalsuccessurl,

    'CANCELURL' => $paypalcancelurl,

    'BUTTONSOURCE' => 'BR_EC_EMPRESA'

  );
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_USERPWD, $clientt.":".$secrett);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    $result = curl_exec($ch);

    $json = json_decode($result);
    $CardNumber1 = "4111111111111111";
    $CardType1 = "Visa"; 
     $data = '{
  "intent": "sale",
  "payer": {
    "payment_method": "credit_card",
    "funding_instruments": [
      {
        "credit_card": {
          "number": "'.$CardNumber1.'",
          "type": "'.$CardType1.'",
          "expire_month": "01",
          "expire_year": "2020",
          "cvv2": "123",
          "first_name": "Jay",
          "last_name": "Amin"
        }
      }
    ]
  },
  "transactions": [
    {
      "amount": {
        "total": "12",
        "currency": "USD"
      },
      "description": "This is the payment transaction description."
    }
  ]
}';

    $ch1 = curl_init();
    //curl_setopt($ch1, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment");      //https://api.paypal.com/v1/payments/payment
    curl_setopt($ch1, CURLOPT_URL, "https://api.paypal.com/v1/payments/payment");      //https://api.sandbox.paypal.com/v1/payments/payment
    curl_setopt($ch1, CURLOPT_HEADER, false);
    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch1, CURLOPT_POST, true);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch1, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch1, CURLOPT_HTTPHEADER, array("Content-Type:application/json","Authorization: Bearer ".$json->access_token));
     $result1 = curl_exec($ch1);

?>