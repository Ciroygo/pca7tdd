<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', ['title' => null]);

        $this->publishThread(['title' => null])->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requireds_a_body()
    {
        $this->publishThread(['body' => null])->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requireds_a_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['channel_id' => null])->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])->assertSessionHasErrors('channel_id');

    }
    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        // 得到一个登陆用户
        $this->signIn();

        // 首先我们创建得到新的文章
        $thread = make('App\Thread');
        $response = $this->post('/threads', $thread->toArray());


        // 然后我们访问这个文章
        // 我们应该能够看到这个文章
        $this->get($response->headers->get('Location'))->assertSee($thread->title)->assertSee($thread->body);
    }

    /** @test */
    public function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get('threads/create')->assertRedirect('login');

        $this->post('threads')->assertRedirect('login');
    }
    /** @test */
    public function authorized_users_can_delete_threads()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        $response = $this->json('DELETE', $thread->path());

        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    /** @test */
    public function guests_cannot_delete_threads()
    {
        //
        $this->withExceptionHandling();

        $thread = create('App\Thread');

        $response = $this->delete($thread->path());

        $response->assertRedirect('/login');
    }
    /** @test */
    public function unauthorized_users_may_not_delete_threads()
    {
        $this->withExceptionHandling();

        $thread = create('App\Thread');

        $this->delete($thread->path())->assertRedirect('/login');

        $this->signIn();

        $this->delete($thread->path())->assertStatus(403);
    }


    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $overrides);

        return $this->post('/threads', $thread->toArray());
    }
}
