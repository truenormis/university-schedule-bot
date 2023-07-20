<?php

namespace App\Telegram\Menus;

use App\Telegram\Menus\Schedule\NextLesson;
use App\Telegram\Menus\Schedule\TodaySchedule;
use App\Telegram\Menus\Schedule\TomorrowSchedule;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class LessonMenu extends Menu
{
    protected string $name = 'Lessons';
    protected string $state = 'lesson.menu';
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
        $mes = collect([
            "Чтобы узнать расписание на сегодня, выбери соответствующий пункт меню ⏰",
            "Жми на кнопку 'Расписание на завтра', чтобы посмотреть пары 📆",
            "Для просмотра следующей пары, выбери пункт меню 'Следующая пара' 👨‍🏫",
            "Расписание на сегодня доступно в меню бота. Посмотри! 📖",
            "Чтобы узнать завтрашние пары, нажми на пункт 'Расписание на завтра' 📚",
            "Выбери в меню 'Следующая пара', чтобы узнать что будет дальше ⏭",
            "Посмотреть сегодняшнее расписание можно в соответствующем пункте 🗓",
            "Для просмотра завтрашних пар, выбери меню 'Расписание на завтра' 📅",
            "Чтобы узнать следующую пару, нажми на пункт меню! ⏱",
            "Расписание на сегодня ждет тебя в меню! Выбирай 👌",
            "Завтрашние пары - смотри в пункте 'Расписание на завтра' 📒",
            "Узнать свою следующую пару просто - выбери соответствующий пункт! 😉",
            "Сегодняшние пары в соответствующем разделе меню 🗓",
            "Чтобы узнать следующую пару, выбери этот пункт в меню ⏱",
            "Завтрашнее расписание доступно в разделе 'Расписание на завтра' 📆"
        ]);



        $this->bot->sendMessage(
            text: $mes->random(),
            parse_mode: ParseMode::HTML,
            reply_markup: $this->keyboard()
        );
    }
}
