<?php
require 'lib/class.customer.php';
require 'db/database.php';

$customer = new customer($sessionId, $conn);

if($customer->add($firstname, $lastname, $email, $streetAddress, $zipCode, $city, $phoneNumber)) 
{
    echo "onnistui";
}



