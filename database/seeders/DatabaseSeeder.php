<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'role' => '0',
            'roleName' => 'Admin',
        ]);
        
        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
        ]);

        $photos =Storage::allFiles('public');
        array_shift($photos);
        Storage::delete($photos);
    }
}
