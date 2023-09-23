<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Categories;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $user = new \App\Models\User;
        // \App\Models\User::factory(10)->create();
        Post::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'saseka@gmail.com',
            'password' => bcrypt('sasekaapp')
        ]);

        Categories::create([
            'name' => 'musik',
        ]);
        
        Categories::create([
            'name' => 'rupa',
        ]);

        Categories::create([
            'name' => 'sastra',
        ]);
    }
}
