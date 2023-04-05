<?php 
require 'db/database.php';
require 'lib/class.cart.php';
require 'lib/class.product.php';
session_start();
$session_id = session_id();

$cart = new cart($session_id, $conn);

$json = file_get_contents('php://input');
$json_array = json_decode($json, true);
$productId = $json_array['id'];
$product = new product($productId, $conn);
$return = (array)$product;
$quantity = $json_array['quantity'];

if ($cart->addItem($productId, $session_id, $quantity)) {
    //success
    header("Refresh:0");
} else {
    echo $conn->error;
}
echo json_encode($return, true);
