<?php
require 'lib/class.cart.php';
require 'lib/class.product.php';
require 'db/database.php';

session_start();
$sessionId = session_id();
$cart = new cart($sessionId, $conn);

$json = file_get_contents('php://input');
$json_array = json_decode($json, true);
$id = $json_array['id'];
$newQuantity = $json_array['newQuantity'];

if ($cart->updateQuantity($id, $newQuantity)) {
    
} 

echo json_encode($json, true);

?>