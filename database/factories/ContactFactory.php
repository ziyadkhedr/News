<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'email'=>fake()->email(),
            'title'=>fake()->title(),
            'body'=>fake()->paragraph(),
            'phone'=>fake()->phoneNumber(),
            'ip_address'=>fake()->ipv4(),
        ];
    }
}
