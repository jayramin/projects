<?php
//require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../autoload.php';
//require '../autoload.php';

$password = "myPassword";
//$plaintext = "Here is my test vector. It's not too long, but more than a block and needs padding.";
$plaintext = @$_REQUEST['data'];

$cryptor = new \RNCryptor\Encryptor();
$base64Encrypted = $cryptor->encrypt($plaintext, $password);
echo $base64Encrypted;
//echo "Plaintext:\n$plaintext\n\n<br>";
//echo "Base64 Encrypted:\n$base64Encrypted\n\n";
