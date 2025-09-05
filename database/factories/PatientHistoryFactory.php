<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientHistory>
 */
class PatientHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => User::whereHas('roles', fn($q) => $q->where('name', 'patient'))->inRandomOrder()->first()->id ?? User::factory(),
            // 'description' => $this->faker->paragraph,
            'diagnosis' => $this->faker->sentence,
            'treatment' => $this->faker->sentence,
            'visit_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
