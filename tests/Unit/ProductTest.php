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

    /** @test **/
    public function a_product_has_a_name()
    {
        $this->assertEquals('Fa', $this->product->name());
    }

    // public function testProductHasPrice()
    public function test_a_product_has_a_name_price()
    {
        $this->assertEquals('12', $this->product->price());
    }
}
