<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProphecyTest extends TestCase
{
    public function testBasicTest()
    {
        // $directive =$this->prophesize(BladeDirective::class);
        // // $directive->foo()->shouldBeCalled();
        // // $directive->foo('bar')->shouldBeCalled();
        // // MOCK:
        // $directive->foo('bar')->shouldBeCalled()->willReturn('foobar');
        //
        // //Ausgabe in UnnitTest
        // // die(var_dump($directive));
        // // die(var_dump($directive->reveal()));
        // // $directive->reveal()->foo();
        // // $directive->reveal()->foo('bar');
        // $response =$directive->reveal()->foo('bar');
        // $this->assertEquals('foobar', $response);

      $cache =$this->prophesize(RussianCache::class);
      $directive = new BladeDirective($cache->reveal());

      $cache->has('cache-key')->shouldBeCalled();

      $directive->setUp('cache-key');

    }
}


class BladeDirective
{

    protected $cache;

    public function __construct(RussianCache $cache) {
      $this->cache =$cache;
    }

    public function setUp($key)
    {
      $this->cache->has($key);
    }
}




class RussianCache
{
    public function has()
    {
    }
}
