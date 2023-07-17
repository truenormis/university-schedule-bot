<?php

namespace App\Telegram\Menus;


use phpDocumentor\Reflection\Types\This;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class MainMenu extends Menu
{
    protected string $name = 'name';
    protected string $state = 'main.menu';
    protected array $commands = [
        '📅 Узнать рассписание' => LessonMenu::class,
        '❓ Помощь по боту' => HelpMenu::class,
        '⚙️ Настройки' => SettingsMenu::class,
    ];
    public function show(): void
    {
        $this->wait_command();

    }

    public function transfer(): void
    {
        $mes = "🤖 Привет!
Ты сейчас находишься в главном меню!
Просто воспользуйся клавиатурой ниже, чтобы выбрать действие: 👇";


        $this->bot->sendMessage(
            text: $mes,
            parse_mode: ParseMode::HTML,
            reply_markup: $this->keyboard()
        );
    }
}
