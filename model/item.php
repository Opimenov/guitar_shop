<?php

//has product_id, name, unit_price, quantity, line_price
class Item {
    private $product_id;
    private $name;
    private $unit_price;
    private $quantity;
    private $line_price;
    
    public function __construct($pr_id, $q) {
        $this->product_id = $pr_id;
        $this->quantity = $q;
    }
            
    function getProduct_id() {
        return $this->product_id;
    }

    function getName() {
        return $this->name;
    }

    function getUnit_price() {
        return $this->unit_price;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getLine_price() {
        return $this->line_price;
    }

    function setProduct_id($product_id) {
        $this->product_id = $product_id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUnit_price($unit_price) {
        $this->unit_price = $unit_price;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setLine_price($line_price) {
        $this->line_price = $line_price;
    }


}