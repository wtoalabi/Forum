<?php

namespace Tests\Browser\Forums\Threads;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsListTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testThreadList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://forum.loc/forums#/threads')
                    ->assertSee('Threads Page');
        });
    }
}
