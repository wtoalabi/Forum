<?php

use App\Models\Forum\Category;
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
            factory(App\User::class)->create(['email'=>'wtoalabi@gmail.com','type'=>'admin', 'confirmed'=>1]);
        }

        factory(Category::class)->create(['name' => "PHP"]);
        factory(Category::class)->create(['name' => "VueJS"]);
        factory(Category::class)->create(['name' => "Microsoft"]);
    }
}
