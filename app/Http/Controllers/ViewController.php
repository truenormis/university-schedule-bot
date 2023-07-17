<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $lessons = Schedule::where('scheduleDate', Carbon::today())
            ->orderBy('studyTimeBegin')
            ->get();


        return view('lessons')->with('lessons', $lessons);
    }
}
