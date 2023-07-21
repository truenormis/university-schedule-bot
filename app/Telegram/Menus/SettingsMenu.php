<?php

namespace App\Telegram\Menus;

use Faker\Provider\Text;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;

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
        $mes = "<b>Ты попал в раздел настроек!</b>
😊⚙️ Здесь ты можешь кастомизировать свой опыт с нашим университетским расписанием.

Заметили, что иногда уведомления могут быть многословными? Не переживай, мы можем помочь! Если ты хочешь приостановить уведомления о расписании пар, просто нажми на кнопочку <code>Отключить рассылку</code>. Так ты будешь получать лишь самые важные сообщения. 😌🔕

А, кстати, если у тебя возникнут какие-либо вопросы или понадобится помощь, всегда можешь обратиться к разработчику @truenormis. Он всегда готов помочь тебе! 🤝🧑‍💻

Спасибо за то, что ты с нами! Мы всегда стараемся сделать твой опыт с нашим ботом еще лучше! 😊🤖";


        $this->bot->sendMessage(
            text: $mes,
            parse_mode: ParseMode::HTML,
            reply_markup: $this->keyboard(),

        );


        $mes = "Выбери пункт в меню настроек, ня~ 😊💖";


        $this->bot->sendMessage(
            text: $mes,
            parse_mode: ParseMode::HTML,
            reply_markup: InlineKeyboardMarkup::make()
                ->addRow(
                    InlineKeyboardButton::make('A', callback_data: 'type:a'),
                    InlineKeyboardButton::make('B', callback_data: 'type:b')
                ),

        );
    }
}
