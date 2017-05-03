<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Article;

class ArticleTest extends TestCase
{
    use DatabaseTransactions;


    /** @test **/
    public function it_fetches_trending_articles()
    {
        factory(Article::class,3)->create();
        factory(Article::class)->create(['reads'=>10]);
        $mostPopular = factory(Article::class)->create(['reads'=>30]);

        // when
        $articles = Article::trending();

        // then
        $this->assertEquals($mostPopular->id, $articles->first()->id);
        $this->assertCount(3, $articles);
    }
}
