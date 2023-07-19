<?php

namespace Tests\Feature;

use App\Console\Commands\ScheduleCommand;
use App\Models\Schedule;
use App\Services\ScheduleApiService;
use Artisan;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class ScheduleUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_getting_data_from_api(): void
    {

        $scheduleMock = Mockery::mock(Schedule::class);
        $test_time = Carbon::create(2023,3,1);

        Carbon::setTestNow($test_time);

        Artisan::call('schedule:update');

        // You can also assert the output of the command
        $this->assertEquals("Schedule from ".$test_time->format('Y-m-d')." to ".$test_time->addDays(30)->format('Y-m-d')." updated successfully.\n", Artisan::output());


    }

    public function test_update_schedule(): void
    {

        $test_time = Carbon::create(2023,3,1);

        Carbon::setTestNow($test_time);

        Artisan::call('schedule:update');

        $today_count = Schedule::distinct()->count('scheduleDate');
        // You can also assert the output of the command


        $test_time = Carbon::create(2023,3,2);

        Carbon::setTestNow($test_time);
        Artisan::call('schedule:update');
        $tomorrow_count = Schedule::distinct()->count('scheduleDate');

        $this->assertEquals($today_count+1,$tomorrow_count);
    }


}
