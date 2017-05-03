<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Product;

class ProductTest extends TestCase
{
    public function setup() {
        $this->product =new Product('Fa', "12");
    }

    public function testProductHasName()
    { 
        $this->assertEquals('Fa', $this->product->name());
    }

    public function testProductHasPrice()
    {
        $this->assertEquals('12', $this->product->price());
    }
}
