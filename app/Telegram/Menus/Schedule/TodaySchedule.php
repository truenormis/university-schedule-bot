<?php

namespace App\Telegram\Menus\Schedule;
use App\Telegram\Menus\MainMenu;
use App\Telegram\Menus\Menu;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class TodaySchedule extends Menu
{
    protected string $name = 'Help';
    protected string $state = 'help.menu';
    protected array $commands = [
        '🏠 Главное меню' => MainMenu::class,
    ];
    public function show(): void
    {


    }


    public function transfer(): void
    {
        $mes = "👉 Для использования этих функций, пожалуйста, вернитесь в главное меню, нажав на кнопку <code>Главное меню</code>  или используя команду /start.

Вот некоторые функции, которые я могу выполнить:

Получить своё текущее расписание занятий 📅
Узнать информацию о следующем занятии 💡
Просмотреть полное расписание на неделю 🗓️
Напоминать тебе про следующую пару благодаря рассылке ⏰
Просто воспользуйся клавиатурой ниже, чтобы выбрать действие:";


        $this->bot->sendMessage(
            text: $mes,
            parse_mode: ParseMode::HTML,
            reply_markup: $this->keyboard()
        );
    }
}

