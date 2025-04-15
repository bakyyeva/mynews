<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(2),
            'author_id' =>  User::inRandomOrder()->first()?->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
