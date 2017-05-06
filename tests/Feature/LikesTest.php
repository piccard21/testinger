<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LikesTest extends TestCase
{
    use DatabaseTransactions;

    protected $post;

    public function setUp()
    {
        parent::setup();

        // $this->post =factory(Post::class)->create();
        $this->post = createPost();

        $this->signIn();
    }




    /** @test */
    public function a_user_can_like_a_post()
    {
      $this->post->like();

      // $this->assertTrue($this->post->isLiked());
      $this->assertDatabaseHas('likes', [
        'user_id' =>$this->user->id,
        'likeable_id' => $this->post->id,
        'likeable_type' => get_class($this->post),
      ]);


      $this->assertTrue($this->post->isLiked());
    }


    /** @test */
    public function a_user_can_unlike_a_post() {

      $this->post->like();
      $this->post->unlike();

      // $this->assertTrue($this->post->isLiked());
      // $this->assertDatabaseMissing('likes', [
      //   'user_id' =>$this->user->id,
      //   'likeable_id' => $this->post->id,
      //   'likeable_type' => get_class($this->post),
      // ]);


      $this->assertFalse($this->post->isLiked());
    }


    /** @test */
    public function a_user_can_toggle_a_post_status() {

      $this->post->toggle();
      $this->assertTrue($this->post->isLiked());
      $this->post->toggle();
      $this->assertFalse($this->post->isLiked());
    }

    /** @test */
    public function a_post_knows_number_of_likes() {

      $this->post->toggle();
      //ruft auf: getLikesCountAttribute
      $this->assertEquals(1, $this->post->likesCount);
    }
}
