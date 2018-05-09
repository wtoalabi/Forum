<?php

namespace Tests\Browser\Forums\Threads;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsListTest extends DuskTestCase
{
    /**@test*/
    public function a_user_can_see_a_list_of_threads()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://forum.loc/forums#/threads')
                    ->assertSee('Threads Page');
        });
    }
}
