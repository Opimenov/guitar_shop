<?php

require_once 'item.php';

class Cart {
    //create an empty array first
    private $itemQty;

    public function __construct() {
        $this->itemQty = array();
    }
    
    function addItem($product_id, $quantity) {
        $this->itemQty[$product_id] = $quantity;
    }

    function updateItem($product_id, $quantity) {
        $this->itemQty[$product_id] = $quantity;        
    }

    function removeItem($product_id) {
        unset($this->itemQty[$product_id]);
    }
    //for question 1 Get an array of items for the cart
    //function getItems() {
    //    return $this->itemQty;
    //}
    //for question 2 return an array of Items
    function getItems() {
        $ar = array();
        foreach ($this->itemQty as $item => $qty) {
            $item_object = new Item($item, $qty);
            //get product data from the db
            $product = ProductDB::getProduct($item);
            $list_price = $product->getPrice();
            $discount_percent = 30;
            $quantity = intval($qty);
            
            //calculate the discount
            $discount_amount = 
                    round($list_price * ($discount_percent / 100.0),2);
            $unit_price = $list_price - $discount_amount;
            $line_price = round($unit_price * $quantity, 2);
            
            //store it in item object            
            $item_object->setName($product->getName());
            $item_object->setUnit_price($unit_price);
            $item_object->setLine_price($line_price);
            print_r($item_object);
            $ar[] = $item_object;
        }
//        print_r($ar);
        unset($item);
        unset($qty);
        return $ar;
    }

    // Get the number of products in the cart
    function productCount() {
        //echo "productCount\r\n";
        $count = 0;
        foreach ($this->itemQty as $item => $qty) {
            //echo 'count is '.$count.' qty == '.$qty."\r\n";
            $count ++;
        }
        unset($item);
        unset($qty);
        //echo 'count is '.$count."\r\n";
        return $count;
    }

    // Get the number of items in the cart
    function itemCount () {
       //echo "itemCount\r\n";
       $count = 0;
        foreach ($this->itemQty as $item => $qty) {
            //echo 'count is '.$count.' qty == '.$qty."\r\n";
            $count += $qty;
        }
        unset($item);
        unset($qty);
        //echo 'count is '.$count."\r\n";
        return $count;        
    }

    // Remove all items from the cart
    function clear() {
        unset($this->itemQty);
    }
    
    function getSubtotal() {
        $items = $this->getItems();
        $st = 0;
        foreach ($items as $i) {
            //print_r($i);
            $st += $i->getUnit_price() * $i->getQuantity();
        }
        unset($i);
        return $st;
    }

}