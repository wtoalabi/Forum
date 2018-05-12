<?php

use Faker\Generator as Faker;
use App\Models\Forum\Category;
use App\Models\Forum\Thread as Thread;

$factory->define(Category::class, function(Faker $faker){
    return [
        'name' => $faker->sentence
    ];
});

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(App\User::class)->create()->id;
        },
        'title' => ($slug= $faker->sentence),
        'body' => $faker->paragraph(50),
        'category_id' => function(){
            return factory(Category::class)->create()->id;
        },
        'slug' => str_slug($slug, '-')
    ];
});

