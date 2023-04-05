<?php

class orderItems
{

    public $id;
    protected $sql;
    public $orderId;
    public $productId;
    public $name;
    public $price;
    public $tax;
    public $createdate;

    public function __construct($sql)
    {
        $this->sql = $sql;
    }

    public function addOrderItems($orderId, $productId, $name, $price, $tax, $quantity) {

        $request = "INSERT INTO order_items (order_id, product_id, name, price, tax, quantity) VALUE('" . $orderId . "', '" . $productId . "', '" . $name . "', '" . $price . "', '" . $tax . "', '" . $quantity . "')";
        if(mysqli_query($this->sql, $request)) {
            //success
        }
    }
}