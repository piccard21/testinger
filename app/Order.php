<?php

namespace App;

class Order
{
    protected $products =[];
    protected $price;

    public function add(Product $product)
    {
      $this->products[] = $product;
    }

    public function products()
    {
        return $this->products;
    }

    public function total()
    {
        $total =0;

        foreach ($this->products as $product) {
          $total += $product->price();
        }

        return $total;
    }
}
