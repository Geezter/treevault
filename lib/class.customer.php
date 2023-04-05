<?php

class customer
{

    public $id;
    protected $sql;
    public $firstname;
    public $lastname;
    public $email;
    public $address;
    public $zipCode;
    public $city;
    public $phone;
    protected $sessionId;

    public function __construct($id = 0, $sql)
    {
        $this->sql = $sql;
        $this->id = $id;
    }

    public function init($id) {
        

        $result = $this->sql->query("SELECT * FROM customer WHERE id = '" . $id . "'");
        
        $row = $result->fetch_assoc();

        $this->id = $id;
        $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname'];
        $this->email = $row['email'];
        $this->address = $row['address'];
        $this->zipCode = $row['zip'];
        $this->city = $row['city'];
        $this->phone = $row['phone'];
    }

    public function add($firstname, $lastname, $address, $zipCode, $city, $phone, $email): bool {
        
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->address = $address;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->phone = $phone;

        if(mysqli_query($this->sql, "INSERT INTO customer (firstname, lastname, address, zip, city, phone, email) VALUE('" . $firstname . "', '" . $lastname . "', '" . $address . "', '" . $zipCode . "', '" . $city . "', '" . $phone . "', '" . $email . "')")) {
            $this->init(mysqli_insert_id($this->sql)); 
            return true;
        } else {
            return false;
        }
    }

    public function delete($id): bool {
        $this->id = $id;
        if ($this->sql->query("DELETE FROM customer WHERE id = '".$this->id."'")) {
            return true;
        } else {
        return false;
        }
    }


}
