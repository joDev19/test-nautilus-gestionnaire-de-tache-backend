<?php

namespace Database\Factories;

use App\Consts;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->unique()->safeEmail(),
            'end_date' => now(),
            'status' => fake()->randomElement([Consts::$STATUS_EN_ATTENTE,Consts::$STATUS_EN_COURS, Consts::$STATUS_TERMINE]),
        ];;
    }
}
