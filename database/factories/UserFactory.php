<?php

use Faker\Generator as Faker;
use App\Models\Forum\Thread as Thread;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'confirmed' => false,
        'email' => $faker->unique()->safeEmail,
        'username' => str_slug($name, '-'),
        'confirmation_token' => str_random(25),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});