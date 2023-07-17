<?php

namespace App\Telegram\Menus;

use App\Telegram\Menus\Schedule\TodaySchedule;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class LessonMenu extends Menu
{
    protected string $name = 'Help';
    protected string $state = 'help.menu';
    protected array $commands = [
        '📅 Расписание на сегодня' => TodaySchedule::class,
        '📆 Расписание на завтра' => TomorrowSchedule::class,
        '🔍 Какая следующая пара?' => NextLesson::class,
        '🏠 Главное меню' => MainMenu::class,
    ];
    public function show(): void
    {
        $this->wait_command();

    }


    public function transfer(): void
    {
        $mes = "Тут будут уроки";


        $this->bot->sendMessage(
            text: $mes,
            parse_mode: ParseMode::HTML,
            reply_markup: $this->keyboard()
        );
    }
}
