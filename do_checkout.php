<?php
require 'lib/class.cart.php';
require 'lib/class.customer.php';
require 'lib/class.orders.php';
require 'lib/class.order_items.php';
require 'lib/class.product.php';
require 'db/database.php';

session_start();
$sessionId = session_id();


// fetch data

$json = file_get_contents('php://input');
$json_array = json_decode($json, true);
$email = filter_var($json_array['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$firstname = filter_var($json_array['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastname = filter_var($json_array['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$address = filter_var($json_array['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$zipcode = filter_var($json_array['zipcode'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$city = filter_var($json_array['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$phone = filter_var($json_array['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// add customer

$customer = new customer(null, $conn);

if($customer->add($firstname, $lastname, $address, $zipcode, $city, $phone, $email)) 
{
    
    $cart = new cart($sessionId, $conn);
    $cart->customerId = $customer->id;
    $cart->update();
    $order = new order($cart->customerId, $cart->getCostOfWholeCart(), $cart->getCostOfWholeCartNotax(), $conn);
    $order->addOrder();
    $order_items = new orderItems($conn);
    $cartItems = $cart->getCartItems();

    // add ordered items to database

    for ($i=0;count($cartItems) > $i; $i++) {
        $product = new product($cartItems[$i]['product_id'], $conn);
        $tax = $product->price/$product->price_notax-1;
        $formatted_tax = round($tax, 2);
        if ($order_items->addOrderItems($order->id, $product->id, $product->name, $product->price, $formatted_tax, $cartItems[$i]['quantity'])) {
        }
        $order->finishOrder("done");
    }
     
        // send email confirmation to customer
        
        $allCartItems = $cart->getCartItems();
        $i = 0;
        $totalCartPrice = 0;
        $fdate = $order->getDate();

        $to = $customer->email;
        $subject = "Receipt from TreeVault";
        $message = "<h1>Your order from TreeVault</h1>";
        $message .= "<br>";
        $message .= "<h2>Your information</h2>";
        $message .= "<p>Order date: $fdate";
        $message .= "<p>First name: $customer->firstname";
        $message .= "<p>Last name: $customer->lastname";
        $message .= "<p>Address: $customer->address";
        $message .= "<p>ZipCode: $customer->zipCode";
        $message .= "<p>City: $customer->city ";
        $message .= "<p>Phone number: $customer->phone ";
        $message .= "<br>";

        $message .= "<h2>Your purchase:</h1>";

        while(count($allCartItems) > $i) {

            $productItem = new product($allCartItems[$i]['product_id'], $conn);
            $productName = $productItem->name;
            $productQuantity = $allCartItems[$i]['quantity'];
            $productPrices = $productItem->price*$productQuantity;
            $totalCartPrice = $totalCartPrice + $productPrices;
        
            $message .= "<h3>" . $productName . "\r\n " . $productQuantity . "-year badge. Price: " . $productPrices . " € (incl. taxes)</h3>";
            $i++;
        }

        $message .= "<h3>Total price: " . $totalCartPrice . " € (incl. taxes)</h3>";
        $message .= "<h4>Thank you for your purchase for better future. - TreeVault - </h4>";
        $header = "From:TreeVault\r\n";
        $header .= "Cc:\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        
        $retval = mail ($to,$subject,$message,$header);
        if ($cart->emptyCart()) {
        
            if( $retval == true ) {
            
            }else {
            echo "Message could not be sent...";
            }

        
     } else {
        echo "$conn->error";
     }
    echo json_encode($json, true);
    
}
?>