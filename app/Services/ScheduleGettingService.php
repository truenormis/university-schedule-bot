<?php

namespace App\Services;

use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleGettingService
{
    public function get_today(): array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
    {
        return Schedule::where('scheduleDate', Carbon::today()->format('Y-m-d'))->orderBy('studyTimeBegin')->get();
    }

    public function get_tomorrow(): array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
    {
        return Schedule::where('scheduleDate', Carbon::today()->addDay(1)->format('Y-m-d'))->orderBy('studyTimeBegin')->get();
    }

    public function get_next_lesson(): Schedule
    {
        $lesson = Schedule::query();

        $lesson->where('scheduleDate',Carbon::today()->format('Y-m-d'));
        $lesson->where('studyTimeBegin','>',Carbon::now()->format('H:i:s'));
        $lesson->orderBy('studyTimeBegin');
        return  $lesson->first();
    }
}
