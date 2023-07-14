<?php

namespace Tests\Feature;

use App\Models\Schedule;
use App\Services\ScheduleGettingService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleGettingServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testGetToday()
    {
        // Создаем тестовые данные

        $time_start_test = Carbon::createFromTime(9)->format('H:i:s');
        $time_end_test = Carbon::createFromTime(9)->addMinutes(90)->format('H:i:s');

        Schedule::factory()->create([
            'scheduleDate' => Carbon::today()->format('Y-m-d'),
            'studyTimeBegin' => $time_start_test,
            'studyTimeEnd' => $time_end_test,
        ]);
        Schedule::factory()->create([
            'scheduleDate' => Carbon::tomorrow()->format('Y-m-d'),
            'studyTimeBegin' => $time_start_test,
            'studyTimeEnd' => $time_end_test,
        ]);


        $service = new ScheduleGettingService();


        $results = $service->get_today();


        foreach ($results as $result){
            $this->assertEquals($time_start_test, $result->studyTimeBegin);
        }
    }

    public function testGetTomorrow()
    {
        $time_start_test = Carbon::createFromTime(9);
        $time_end_test = Carbon::createFromTime(9)->addMinutes(90);

        Schedule::factory()->create([
            'scheduleDate' => Carbon::today()->format('Y-m-d'),
            'studyTimeBegin' => $time_start_test->format('H:i:s'),
            'studyTimeEnd' => $time_end_test->format('H:i:s'),
        ]);
        Schedule::factory()->create([
            'scheduleDate' => Carbon::tomorrow()->format('Y-m-d'),
            'studyTimeBegin' => $time_start_test->addHour(1)->format('H:i:s'),
            'studyTimeEnd' => $time_end_test->addHour(1)->format('H:i:s'),
        ]);

        // Создаем экземпляр сервиса
        $service = new ScheduleGettingService();


        $results = $service->get_tomorrow();
        foreach ($results as $result){
            $this->assertEquals($time_start_test->format('H:i:s'), $result->studyTimeBegin);
        }

    }
}
