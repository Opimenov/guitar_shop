<?php
//require_once '../util/main.php';
//require_once 'util/validation.php';

require_once '../model/cart.php';
require_once '../model/product_db.php';
require_once '../model/product.php';
require_once '../model/category_db.php';
require_once '../model/category.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view';
    }
}
//exit();
//adding cart array to the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}
switch ($action) {
    case 'view':
//        $cart = cart_get_items();
        $cart = $_SESSION['cart']->getItems();
        break;
    case 'add':
        $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_POST, 'quantity');
 
        // validate the quantity entry
        if ($quantity === null) {
            display_error('You must enter a quantity.');
        } elseif ($quantity < 1) {
            display_error('Quantity must be 1 or more.');
        }
        //get product object from the DB
       $product = ProductDB::getProduct($product_id);
        $_SESSION['cart']->addItem($product_id, $quantity);

        $_SESSION['last_category_id'] = $product->getCategory()->getId();
        $_SESSION['last_category_name'] = 
                CategoryDB::getCategory($_SESSION['last_category_id'])
                                                              ->getName();
        $cart = $_SESSION['cart']->getItems();        
        break;
    case 'update':
        $items = filter_input(INPUT_POST, 'items', FILTER_DEFAULT, 
                FILTER_REQUIRE_ARRAY);
        foreach ( $items as $product_id => $quantity ) {
            if ($quantity == 0) {
//                cart_remove_item($product_id);
                $_SESSION['cart']->removeItem($product_id);
            } else {
//                cart_update_item($product_id, $quantity);
                $_SESSION['cart']->updateItem($product_id, $quantity);
            }
        }
//        $cart = cart_get_items();
        $cart = $_SESSION['cart']->getItems();        
        break;
    default:
        add_error("Unknown cart action: " . $action);
        break;
}
include './cart_view.php';

?>