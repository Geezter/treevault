<?php

class order
{

    public $id;
    protected $sql;
    public $customerId;
    public $finishDate;
    public $price;
    public $price_notax;
    public $status;

    public function __construct($customerId, $price, $price_notax, $sql)
    {
        $this->sql = $sql;
        $this->customerId = $customerId;
        $this->price = $price;
        $this->price_notax = $price_notax;
    }

    public function addOrder() {
        $request = "INSERT INTO orders (customer_id, price, price_notax) VALUE('" . $this->customerId . "', '" . $this->price . "', '" . $this->price_notax . "')";
        if(mysqli_query($this->sql, $request)) {
            $this->id = mysqli_insert_id($this->sql);
        }
    }

    public function finishOrder($status) {
        if ($this->sql->query("UPDATE orders SET finishdate = (now()), status = '" . $status . "' WHERE id = '" . $this->id . "'")) {
            return true;
        }
        return false;
    }

    public function getDate() {
        $result = $this->sql->query("SELECT createdate FROM orders WHERE id = '" . $this->id . "'");
        $row = mysqli_fetch_assoc($result);
        return $row['createdate'];
    }

}