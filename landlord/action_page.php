<?php

$dateTime = $_POST['birthdaytime'];
$dateTimeObject = DateTime::createFromFormat('Y-m-d\TH:i', $dateTime);
$formattedDateTime = $dateTimeObject->format('Y-m-d H:i:s');


var_dump($formattedDateTime);
?>
