<?php

namespace Tests\Browser\Forums\Threads;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\Forum\Reply;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum\Thread as Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends DuskTestCase
{
    use DatabaseMigrations;
    public $threads;
    public $thread;
    public $reply;
    public $url = "http://forum.loc/forums#/threads/";
    public function setUp (){
        parent::setUp();
        $this->threads = factory(Thread::class, 1)->create([
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
            $browser->visit($this->url)
                    ->pause(10000)        
                    ->assertSee($this->thread->title);
        });
    }

    /** @test  */
        public function a_user_can_see_a_specific_thread (){
            $this->browse(function(Browser $browser){        
                $browser->visit($this->url . $this->thread->slug)
                ->pause(10000)        
                ->assertSee($this->thread->title);
            });
        }

    /** @test  */
        public function a_user_can_see_a_specific_thread_replies (){
            $this->browse(function(Browser $browser){        
                $browser->visit($this->url .$this->thread->slug)
                ->pause(1000)        
                ->assertSee($this->reply->body)
                ->assertSee($this->reply->user->name);
            });
        }
 /** 
  * @test 
  * @group can_create 
 */
        public function a_registered_user_can_create_a_thread (){
            $this->browse(function(Browser $browser){   
                //$user = factory(\App\User::class, 1)->create();
                $browser->visit("http://forum.loc/register")
                ->type("name", "Hello") 
                ->type("email", "wtoalabi@gmail.com")
                ->type("password", "secret") 
                ->type("password_confirmation","secret") 
                ->press("Register") 
                ->assertSee("Dashboard")
                ->visit($this->url)
                ->click("@createNew")  
                ->type('title', "New Thread!!!!")
                ->type('body', "New Thread Body...")
                ->press("Submit")
                ->pause(10000)
                ->assertSee("Posted!");
            });
        }
    }
