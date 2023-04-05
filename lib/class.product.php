<?php

class product
{

    public $id;
    protected $sql;
    public $name;
    public $in_stock;
    public $price;
    public $price_notax;
    public $description;
    public $short_desc;
    public $more_desc;
    public $img_URL;
    public $latitude;
    public $longitude;

    public function __construct($id, $sql)
    {
        $this->id = $id;
        $this->sql = $sql;
        $this->init($id, $sql);

    }

    public function init($id, $sql)
    {
        $this->id = $id;
        $this->sql = $sql;

        $result = $this->sql->query("SELECT * FROM products WHERE id = '" . $this->id . "'");

        $row = $result->fetch_assoc();

        $this->name = $row['name'];
        $this->in_stock = $row['in_stock'];
        $this->price = $row['price'];
        $this->price_notax = $row['price_notax'];
        $this->description = $row['description'];
        $this->short_desc = $row['short_desc'];
        $this->more_desc = $row['more_desc'];
        $this->img_URL = $row['img_url'];
        $this->latitude = $row['latitude'];
        $this->longitude = $row['longitude'];
    }
}