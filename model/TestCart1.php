<?php
require 'cart.php';
//create Cart object
$cart = new Cart();
//test getItems
//print_r($cart->getItems());
//add 2 units of product 1
$cart->addItem(1, 2);
//print_r($cart->getItems());
//add 3 units of product 2
$cart->addItem(2, 3);
//print_r($cart->getItems());
//call productCount should be 2
echo 'product count shoud be 2 == '.$cart->productCount()."\r\n";
//call itemCount should be 5
echo 'item count shoud be 5 == '.$cart->itemCount()."\r\n";
//update product 2 to qty 1 
$cart->updateItem(2, 1);
//print_r($cart->getItems());
//repeat 2 count calls
echo 'product count shoud be 2 == '.$cart->productCount()."\r\n";
echo 'product count shoud be 3 == '.$cart->itemCount()."\r\n";



