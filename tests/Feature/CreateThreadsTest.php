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
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        // 得到一个登陆用户
        $this->signIn();

        // 首先我们创建得到新的文章
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());

        // 然后我们访问这个文章
        // 我们应该能够看到这个文章
        $this->get($thread->path())->assertSee($thread->title)->assertSee($thread->body);
    }

    /** @test */
    public function guests_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = factory('App\Thread')->make();

        $this->post('/threads', $thread->toArray());
    }
}
