<?php

use App\User;
use Illuminate\Database\Seeder;

class ThreadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Forum\Thread::class, 50)->create([
            'user_id' => function(){
                return User::all()->random()->id;
            }
        ]);
    }
}
