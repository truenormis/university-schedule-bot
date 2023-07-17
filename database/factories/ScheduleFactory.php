<?php

namespace Database\Factories;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     *
     * @return array<string, mixed>
     */
    protected $model = Schedule::class;

    public function definition(): array
    {
        // Генерируем номер пары от 1 до 6

        $studyTimeDate = Carbon::now()->addDay(rand(0, 1))->format('Y-m-d');
        $studyTimeName = fake()->numberBetween(1, 6);
        while (Schedule::where('studyTimeName',$studyTimeName)->where('scheduleDate',$studyTimeDate)->count() !== 0){
            $studyTimeName = fake()->numberBetween(1, 6);
        }
        switch ($studyTimeName) {
            case 1:
                $studyTimeBegin = '08:30';
                $studyTimeEnd = '10:00';
                break;
            case 2:
                $studyTimeBegin = '10:10';
                $studyTimeEnd = '11:40';
                break;
            case 3:
                $studyTimeBegin = '12:00';
                $studyTimeEnd = '13:30';
                break;
            case 4:
                $studyTimeBegin = '13:40';
                $studyTimeEnd = '15:10';
                break;
            case 5:
                $studyTimeBegin = '15:20';
                $studyTimeEnd = '16:50';
                break;
            default:
                $studyTimeBegin = '17:00';
                $studyTimeEnd = '18:30';
        }

        // Генерируем остальные данные
        return [
            'disciplineName' => fake()->word,

            'studyTimeName' => $studyTimeName,
            'studyTimeBegin' => $studyTimeBegin,
            'studyTimeEnd' => $studyTimeEnd,
            // Проверяем, что дата не в прошлом и не в выходной день
            'scheduleDate' => $studyTimeDate,
            // Проверяем, что номер кабинета не пустой и не больше 100
            'cabinetNumber' => fake()->optional()->numberBetween(1, 100) == null
            ? "-"
            : fake()->optional()->numberBetween(1, 100),
            'positionName' => fake()->jobTitle,
            'positionShortName' => fake()->word,
            'empFullName' => fake()->name,
            'lastName' => fake()->lastName,
            'firstName' => fake()->firstName,
            'middleName' => fake()->lastName,
            'subgroupName' => fake()->optional()->numberBetween(1, 2),
            'contentNotes' => fake()->optional()->text,
            // Проверяем, что тип занятия один из четырех возможных
            'studyTypeName' => fake()->randomElement(['Lecture', 'Seminar', 'Lab', 'Practice']),
        ];
    }
}
