<?php

namespace App\Telegram\Services;

use Illuminate\Database\Eloquent\Collection;

class ScheduleMessage
{
    public function collection_to_string(Collection $collection): string
    {
        return (string)view('lessons')->with('lessons',$collection);
    }
}
