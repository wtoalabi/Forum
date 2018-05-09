<?php

use Faker\Generator as Faker;
use App\Models\Forum\Thread as Thread;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(App\User::class)->create()->id;
        },
        'title' => ($slug= $faker->sentence),
        'body' => $faker->paragraph(50),
        'slug' => str_slug($slug, '-')
    ];
});