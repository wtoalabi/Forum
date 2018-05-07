<?php

use App\User;
use App\Models\Forum\Reply;
use App\Models\Forum\Thread;
use Illuminate\Database\Seeder;

class RepliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Reply::class, 500)->create([
            'user_id'=> function(){
                return User::all()->random()->id;
            },
            'thread_id'=> function(){
                return Thread::all()->random()->id;
            },
        ]);
}
}
