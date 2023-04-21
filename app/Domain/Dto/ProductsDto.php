<?php

namespace App\Domain\Dto;

use App\Domain\Models\Product;

class ProductsDto
{

    public $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function getProducts()
    {
        if (count($this->products) > 0) {

            foreach ($this->products as $value) {

                $result[]  = $value;
            }

            return  $result;
        }
    }
}
