<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Article;

class ArticleTest extends TestCase
{
    /** @test **/
    public function it_fetches_trending_articles()
    {
        factory(Article::class,3)->create();
        factory(Article::class)->create(['reads'=>10]);
        $mostPopular = factory(Article::class)->create(['reads'=>30]);

        // when
        $article = Article::trending();

        // then
        $this->assertEquals($mostPopular->id, $articles->first()->id);
    }
}
