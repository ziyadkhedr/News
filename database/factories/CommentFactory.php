<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use League\CommonMark\Node\Block\Paragraph;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment'=>fake()->Paragraph(3),
            'status'=>rand(0,1),
            'ip_address'=>fake()->ipv4(),
            'post_id'=>Post::inRandomOrder()->first()->id,
            'user_id'=>User::inRandomOrder()->first()->id,
        ];
    }
}
