<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Lucien',
            'email' => 'lucien@gmail.com',
            'password' => Hash::make('littlezan'),
        ]);
        
        $categories = ['News','Daily Blogs','Health','Movie','Foods & Drinks','Music','Science','IT','Arts & Entertainment','Sports & Gamings','lifestyle'];
        
        foreach($categories as $category){
            Category::factory()->create([
                'title' => $category,
                'slug' => Str::slug($category),
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        };

        Post::factory(50)->create();
    }
}
