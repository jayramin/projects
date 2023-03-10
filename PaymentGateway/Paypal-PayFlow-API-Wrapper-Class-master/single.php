<?php
/**
 * Single Transaction
 */

require_once('Class.PayFlow.php');

// Single Transaction
// $paypalUser 	= "paypaltest";
// 			$paypalVendor 	= "tshah142";
// 			$paypalPartner 	= "PayPal";
// 			$paypalPW 		= "testing2@";
$PayFlow = new PayFlow('tshah142', 'PayPal', 'paypaltest', 'testing2@', 'single');
print_r($PayFlow);
// exit;
$PayFlow->setEnvironment('test');                           // test or live
$PayFlow->setTransactionType('S');                          // S = Sale transaction, R = Recurring, C = Credit, A = Authorization, D = Delayed Capture, V = Void, F = Voice Authorization, I = Inquiry, N = Duplicate transaction
$PayFlow->setPaymentMethod('C');                            // A = Automated clearinghouse, C = Credit card, D = Pinless debit, K = Telecheck, P = PayPal.
$PayFlow->setPaymentCurrency('USD');                        // 'USD', 'EUR', 'GBP', 'CAD', 'JPY', 'AUD'.

$PayFlow->setAmount('15.00', FALSE);
$PayFlow->setCCNumber('4111111111111111');
$PayFlow->setCVV('123');
$PayFlow->setExpiration('0120');
$PayFlow->setCreditCardName('Richard Castera');

$PayFlow->setCustomerFirstName('Richard');
$PayFlow->setCustomerLastName('Castera');
$PayFlow->setCustomerAddress('589 8th Ave Suite 10');
$PayFlow->setCustomerCity('New York');
$PayFlow->setCustomerState('NY');
$PayFlow->setCustomerZip('10018');
$PayFlow->setCustomerCountry('US');
$PayFlow->setCustomerPhone('212-123-1234');
$PayFlow->setCustomerEmail('email@gmail.com');
$PayFlow->setPaymentComment('New Regular Transaction');
$PayFlow->setPaymentComment2('Product 233');

if($PayFlow->processTransaction()):
  echo('Transaction Processed Successfully!');
else:
  echo('Transaction could not be processed at this time.');
endif;
 
echo('<h2>Name Value Pair String:</h2>');
echo('<pre>');
print_r($PayFlow->debugNVP('array'));
echo('</pre>');
 
echo('<h2>Response From Paypal:</h2>');
echo('<pre>');
print_r($PayFlow->getResponse());
echo('</pre>');
 
unset($PayFlow);
?>
