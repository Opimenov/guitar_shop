<?php
require 'item.php';
require 'cart.php';
require 'product.php';
require 'mock_product_db.php';

$cart = new Cart();
$cart->addItem(1, 2);
$cart->addItem(2, 3);
echo 'product count shoud be 2 == '.$cart->productCount()."\r\n";
echo 'item count shoud be 5 == '.$cart->itemCount()."\r\n";

//get an array of items
$a = $cart->getItems();
print_r($a);

echo 'calling subtotal should be 6230 == '.
        $cart->getSubtotal()."\n\r";
unset($a);
unset($cart);

