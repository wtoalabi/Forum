<?php

use App\User;
use App\Models\Forum\Category;
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
        $amount = 0;
        while ($amount <= 50) {
            $amount++;
            factory(\App\Models\Forum\Thread::class)->create([
                'user_id' => function(){
                    return User::all()->random()->id;
                },
            'category_id' => Category::all()->random()->id,
            ]);
        }
    }
}
