<?php

namespace App\Telegram\Menus\Schedule;
use App\Models\Schedule;
use App\Telegram\Menus\LessonMenu;
use App\Telegram\Menus\MainMenu;
use App\Telegram\Menus\Menu;
use App\Telegram\Services\ScheduleMessage;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class TomorrowSchedule extends Menu
{
    protected string $name = 'Today';
    protected string $state = 'lesson.today';
    protected array $commands = [
    ];
    public function show(): void
    {
        new LessonMenu($this->bot);
    }


    public function transfer(): void
    {
        $lessons =  Schedule::where('scheduleDate', '2023-03-10')
            ->orderBy('studyTimeBegin')
            ->get();
        $sm = new ScheduleMessage();
        $mes = $sm->collection_to_string($lessons);

        $this->bot->sendMessage(
            text: $mes,
            parse_mode: ParseMode::HTML,
        );

        new LessonMenu($this->bot);
    }
}

