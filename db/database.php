<?php

define("DB_HOST", "");
define("DB_USER", "");
define("DB_PASS", "");
define("DB_NAME", "");

// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// check connection
if($conn->connect_error) {
    die("Connection failed " . $conn->connect_error);
}
