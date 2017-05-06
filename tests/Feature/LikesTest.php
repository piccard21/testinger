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

    /** @test */
    public function a_user_can_like_a_post()
    {

      $post =factory(Post::class)->create();
      $user = factory(User::class)->create();

      // $this->be($user);
      // ===
      $this->actingAs($user);
      $post->like();

      // $this->assertTrue($post->isLiked());
      $this->assertDatabaseHas('likes', [
        'user_id' =>$user->id,
        'likeable_id' => $post->id,
        'likeable_type' => get_class($post),
      ]);


      $this->assertTrue($post->isLiked());
    }


    /** @test */
    public function a_user_can_unlike_a_post() {

      $post =factory(Post::class)->create();
      $user = factory(User::class)->create();

      // $this->be($user);
      // ===
      $this->actingAs($user);
      $post->like();
      $post->unlike();

      // $this->assertTrue($post->isLiked());
      // $this->assertDatabaseMissing('likes', [
      //   'user_id' =>$user->id,
      //   'likeable_id' => $post->id,
      //   'likeable_type' => get_class($post),
      // ]);


      $this->assertFalse($post->isLiked());
    }


    /** @test */
    public function a_user_can_toggle_a_post_status() {

      $post =factory(Post::class)->create();
      $user = factory(User::class)->create();

      // $this->be($user);
      // ===
      $this->actingAs($user);
      $post->toggle();
      $this->assertTrue($post->isLiked());
      $post->toggle();
      $this->assertFalse($post->isLiked());
    }

    /** @test */
    public function a_post_knows_number_of_likes() {

      $post =factory(Post::class)->create();
      $user = factory(User::class)->create();

      // $this->be($user);
      // ===
      $this->actingAs($user);
      $post->toggle();
      //ruft auf: getLikesCountAttribute 
      $this->assertEquals(1, $post->likesCount);
    }
}
