<?php


class ProductDB {
    public static function getProduct($product_id) {
        if ($product_id == 1) {
            return new Product('cat1', 'strat', 'Stratocaster', 700);
        }
        if ($product_id == 2) {
            return new Product('cat2', 'sg', 'SG', 2500);            
        }
    }
    
}
