<?php
//require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../autoload.php';
//require '../autoload.php';

$password = "myPassword";
//$base64Encrypted = "AgGXutvFqW9RqQuokYLjehbfM7F+8OO/2sD8g3auA+oNCQFoarRmc59qcKJve7FHyH9MkyJWZ4Cj6CegDU+UbtpXKR0ND6UlfwaZncRUNkw53jy09cgUkHRJI0gCfOsS4rXmRdiaqUt+ukkkaYfAJJk/o3HBvqK/OI4qttyo+kdiLbiAop5QQwWReG2LMQ08v9TAiiOQgFWhd1dc+qFEN7Cv";
$base64Encrypted = @$_REQUEST['data'];

$cryptor = new \RNCryptor\Decryptor();
$plaintext = $cryptor->decrypt($base64Encrypted, $password);
echo $plaintext;
//echo "Base64 Encrypted:\n$base64Encrypted\n\n<br>";
//echo "Plaintext:\n$plaintext\n\n";
