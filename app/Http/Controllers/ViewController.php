<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nutgram\Laravel\Facades\Telegram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class ViewController extends Controller
{
    public function __invoke()
    {
        $lessons = Schedule::where('scheduleDate', '2023-03-09')
            ->orderBy('studyTimeBegin')
            ->get();
        $data = [
            'lessons' => $lessons
        ];
        
        return view('lessons')->with('lessons',$lessons);
    }
}
