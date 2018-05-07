<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!App\User::where('email', 'wtoalabi@gmail.com')->first()){
            factory(App\User::class)->create(['email'=>'wtoalabi@gmail.com','type'=>'admin']);
        }
    }
}
