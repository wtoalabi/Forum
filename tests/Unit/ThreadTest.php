<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function it_has_an_owner()
    {
        $reply = factory(Reply::class)->create();
        $this->assertInstanceOf("App\User", $reply->user );
    }
}