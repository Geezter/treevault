<?php


class cart
{

    protected $id;
    protected $sql;
    public $customerId;
    public $productId;  
    protected $sessionId;

    public function __construct($sessionId, $sql)
    {
        $this->sessionId = $sessionId;
        $this->sql = $sql;
    }

    public function addItem($productId, $sessionId, $quantity)
    {
        if ($this->sql->query("INSERT INTO cart (customer_id, product_id, sessionid, quantity) VALUES ('" . null . "', '" . $productId . "', '" . $sessionId . "', '" . $quantity . "')")) {
            // success
        } else {
            echo $this->sql->error;
        }
    }

    
    public function update(): bool {
       
        if ($this->sql->query("UPDATE cart SET customer_id = '" . $this->customerId . "' WHERE sessionid = '" . $this->sessionId . "'")) {
            return true;
        }
        return false; 
    }

    public function updateQuantity($itemId, $newQuantity): bool {
        if ($this->sql->query("UPDATE cart SET quantity = '" . $newQuantity . "' WHERE id = '" . $itemId . "'")) {
            return true;
        }
        return false;
    }


    public function deleteItem($itemId): bool
    {
        if ($this->sql->query("DELETE FROM cart WHERE id = '" . $itemId . "'")) {
            return true;
        } else {
            return false;
        }
    }


    public function getCartItems(): array
    {
        $result = mysqli_query($this->sql, "SELECT * FROM cart WHERE sessionid = '" . $this->sessionId . "'");
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $json;
    }


    public function getTotalCostOfCartProduct($productId): int {
        $allCartItems = $this->getCartItems($this->sessionId);
        $i = 0;
        $totalPrice = 0;

        while(count($allCartItems) > $i) {
    
            if ($productId === $allCartItems[$i]['product_id']) {
                $quantity = $allCartItems[$i]['quantity'];
                $product = new product($productId, $this->sql);
                $totalPrice = $product->price*$quantity;
                $i++;

            }

            return $totalPrice;
           
        }

        return $totalPrice;
    }

    public function getCostOfWholeCart(): int {
        $totalPrice = 0;
        $i = 0;
        $allCartItems = $this->getCartItems();

        while(count($allCartItems) > $i) {

            $productId = $allCartItems[$i]['product_id'];
            $quantity = $allCartItems[$i]['quantity'];
            $product = new product($productId, $this->sql);
            $totalPrice = $totalPrice + $product->price*$quantity;
            $i++;

        }

        return $totalPrice;
    }

    public function getCostOfWholeCartNotax(): int {
        $totalPrice = 0;
        $i = 0;
        $allCartItems = $this->getCartItems();

        while(count($allCartItems) > $i) {

            $productId = $allCartItems[$i]['product_id'];
            $quantity = $allCartItems[$i]['quantity'];
            $product = new product($productId, $this->sql);
            $totalPrice = $totalPrice + $product->price_notax*$quantity;
            $i++;

        }

        return $totalPrice;
    }

    public function emptyCart(): bool {
        if ($this->sql->query("DELETE FROM cart WHERE sessionid = '" . $this->sessionId . "'")) {
            return true;
        } else {
            return false;
        }
    }
}
