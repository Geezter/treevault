<?php

// get data and send contact email

$json = file_get_contents('php://input');
$json_array = json_decode($json, true);
$email = $json_array['email'];
$phone = $json_array['phone'];
$messageContact = $json_array['message'];


    $to = "rissanenjarkko@gmail.com";
    $subject = "Feedback to TreeVault";
    

    $message = "<h1>Contact from TreeVault</h1>";
    $message .= "<h4>" . $messageContact . "\r\n </h4> <br> <h5> Phone: " . $phone . "</h5>";
    
    $header = "From:". $email ."\r\n";
    $header .= "Cc:\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    
    $retval = mail ($to,$subject,$message,$header);
    
    if( $retval == true ) {
    echo json_encode($json, true);
    }else {
    echo "Message could not be sent...";
    }
?>

