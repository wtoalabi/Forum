<?php

namespace Tests\Browser\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/register")
                    ->type("name", "Hello")
                    ->type("email", "wtoalabi@gmail.com")
                    ->type("password", "secret")
                    ->type("password_confirmation", "secret")
                    ->press("Register")
                    ->assertSee("Dashboard");
        });
    }
}
