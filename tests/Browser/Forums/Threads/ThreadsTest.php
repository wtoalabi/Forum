<?php

namespace Tests\Browser\Forums\Threads;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\Forum\Reply;
use App\Models\Forum\Thread as Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends DuskTestCase
{
    use DatabaseMigrations;
    public $threads;
    public $thread;
    public $reply;
    public $url = "http://forum.loc/";
    public function setUp (){
        parent::setUp();
        $this->threads = factory(Thread::class, 2)->create([
            'user_id' => function(){
                return factory(\App\User::class)->create()->id;
            },
        ])->each(function($thread){
            return factory(Reply::class, 2)->create([
                'thread_id'=> $thread->id,
                'user_id' => $thread->user_id,
            ]);
        });
        $this->thread = $this->threads->first();
        $this->reply = $this->thread->replies->first();
    }

    /** @test */
    public function a_user_can_see_a_list_of_threads()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->url.'forums#/threads')
                    ->pause(500)        
                    ->assertSee($this->thread->title);
        });
    }

    /** @test  */
        public function a_user_can_see_a_specific_thread (){
            $this->browse(function(Browser $browser){        
                $browser->visit($this->url . 'forums#/thread/' . $this->thread->slug)
                ->pause(500)        
                ->assertSee($this->thread->title);
            });
        }

    /** @test  */
        public function a_user_can_see_a_specific_thread_replies (){
            $this->browse(function(Browser $browser){        
                $browser->visit($this->url . 'forums#/thread/' . $this->thread->slug)
                ->pause(500)        
                ->assertSee($this->reply->body)
                ->assertSee($this->reply->user->name);
            });
        }
    }
