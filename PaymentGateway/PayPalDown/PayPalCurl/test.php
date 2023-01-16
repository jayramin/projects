<?php 
$ch = curl_init();
$clientId = "Acu1tiyVPuYlO0fSsfCinb4aHYNReh1LpeCpkMzEw3OSOjxGI26jjshyDCYXAQHf01L44uw3fdT1UFP0";
$secret = "EFF_SefibJm1vpZ3lw1ygTST_FMMVtadyuL20buZSfnaxtdwBvtYCmvRP_7PqhirGw-xQmgGAQVpus8b";

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$result = curl_exec($ch);

if(empty($result)){
    die("Error: No response."); 
}
else
{
    $json = json_decode($result);
    print_r($json->access_token);
    // A21AAF652s1hfPrs-A4Vltw9AI4DH75QpdInhkl-9vQPKN2Y6LWeZvOVQ1q1iJTyi4qM9xWF6LsvSQVsp3RdyK24hRlKlI5Fg
}

curl_close($ch);

