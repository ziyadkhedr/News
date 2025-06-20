<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
    public function definition(): array
    {   $date=fake()->date('Y-m-d h:i:s');
        return [
            'title'=>fake()->sentence(3),
            'description'=>fake()->paragraph(5),
            'status'=>rand(0,1),
            'num_of_views'=>rand(0,100),
            'comment_able'=>rand(0,1),
            'user_id'=>User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory()->create()->id,
            'created_at'=>$date,
            'updated_at'=>$date,
        ];
            
    }
}
