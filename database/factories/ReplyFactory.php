<?php

use App\User;
use App\Models\Forum\Reply;
use App\Models\Forum\Thread;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
        'thread_id'=> function (){
            return factory(Thread::class)->create()->id;
        },
        'body' => $faker->realText(200)
    ];
});
