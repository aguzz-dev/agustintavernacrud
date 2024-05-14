<?php
namespace App\Controllers;

use app\Models\Product;

class PriceController
{
    public function moneyConverter()
    {
        $res = (new Product)-> moneyConverter();
        return $res;
    }   
}