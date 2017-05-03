<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Product;
use App\Order;

class OrderTest extends TestCase
{
    /** @test **/
    public function an_order_consists_of_products()
    {

        $order =$this->createOrderWithProducts();

        $this->assertEquals(2, count($order->products()));
        //===
        $this->assertCount(2, $order->products());
    }


    /** @test **/
    public function an_order_gets_the_cost()
    {
        $order =new Order();

        $product =new Product('Fa', "12");
        $product2=new Product('Aa', "21");

        $order->add($product);
        $order->add($product2);

        $this->assertEquals(33, $order->total());
    }

    protected function createOrderWithProducts() {
      $order =new Order();

      $product =new Product('Fa', "12");
      $product2=new Product('Aa', "21");

      $order->add($product);
      $order->add($product2);

      return $order;
    }
}
