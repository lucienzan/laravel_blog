<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        $paragraph = $this->faker->realText(2000);
        return [
            'title'=>$title,
            'slug'=> Str::slug($title),
            'description'=>$paragraph,
            'excerpt'=>Str::words($paragraph,30,"..."),
            'category_id'=>Category::inRandomOrder()->first()->id,
            'user_id'=>User::inRandomOrder()->first()->id,

        ];
    }
}
