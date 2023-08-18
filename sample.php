<?php 
$password = '12345678';
$salt = bin2hex(random_bytes(16));
$hashedPassword = hash('sha256', $password . $salt);

var_dump($salt, $hashedPassword);

?>