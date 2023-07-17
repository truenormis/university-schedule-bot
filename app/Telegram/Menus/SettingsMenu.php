<?php

namespace App\Telegram\Menus;

use Faker\Provider\Text;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class SettingsMenu extends Menu
{
    protected string $name = 'Help';
    protected string $state = 'help.menu';
    protected array $commands = [
        '🏠 Главное меню' => MainMenu::class,
    ];
    public function show(): void
    {
        $this->wait_command();

    }


    public function transfer(): void
    {
        $mes = "Это Меню";


        $this->bot->sendMessage(
            text: $mes,
            parse_mode: ParseMode::HTML,
            reply_markup: $this->keyboard()
        );
    }
}
