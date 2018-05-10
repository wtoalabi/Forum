<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Forum\Reply;
use App\Models\Forum\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_thread_has_replies()
    {
        $thread = factory(Thread::class)->create();
        $this->assertInstanceOf("Illuminate\Database\Eloquent\Collection", $thread->replies );
    }
    /** @test */
    public function a_thread_has_a_user()
    {
        $thread = factory(Thread::class)->create();
        $this->assertInstanceOf("App\User", $thread->user );
    }
}
