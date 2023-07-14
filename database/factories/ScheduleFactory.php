<?php

namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'disciplineName' => fake()->word,
            'studyTimeName' => fake()->randomElement(['Morning', 'Afternoon', 'Evening']),
            'studyTimeBegin' => fake()->time,
            'studyTimeEnd' => fake()->time,
            'scheduleDate' => fake()->date,
            'cabinetNumber' => fake()->optional()->numberBetween(1, 100),
            'positionName' => fake()->jobTitle,
            'positionShortName' => fake()->word,
            'empFullName' => fake()->name,
            'lastName' => fake()->lastName,
            'firstName' => fake()->firstName,
            'middleName' => fake()->lastName,
            'subgroupName' => fake()->optional()->word,
            'contentNotes' => fake()->optional()->text,
            'studyTypeName' => fake()->randomElement(['Lecture', 'Seminar', 'Lab', 'Practice']),
        ];
    }
}
