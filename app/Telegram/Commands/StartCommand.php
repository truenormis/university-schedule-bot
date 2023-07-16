<?php

namespace App\Telegram\Commands;

use App\Models\State;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;


class StartCommand extends Command
{
    protected string $command = 'start';

    protected ?string $description = 'A lovely description.';

    public function handle(Nutgram $bot): void
    {
//        $this->replyWithChatAction(['action' => Actions::CHOOSE_STICKER]);
//        $this->replyWithSticker(['sticker' => 'CAACAgIAAxkBAAICoWSzFvD2j_QQWKRDnPKwBCqSalIuAAI9AAOymJoOgqzpk7IcUtkvBA']);
//        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $this->sendWelcomeMessage($bot);
        $this->UpdateState();


    }

    /**
     * @return void
     */
    public function sendWelcomeMessage(Nutgram $bot): void
    {
//        $keyboard = [
//            ['📅 Узнать рассписание'],
//            ['❓ Помощь по боту'],
//            ['⚙️ Настройки']
//        ];
//        $reply_markup = Keyboard::make([
//            'keyboard' => $keyboard,
//            'resize_keyboard' => false,
//            'one_time_keyboard' => true
//        ]);


        $HelloMes = '👋 Привет! Я Бот-расписание, здесь чтобы помочь тебе организовать свою жизнь!

📅 Я могу предоставить информацию о твоём расписании занятий, чтобы ты всегда был в курсе своих дел.

💡 Вот несколько функций, которые я могу выполнить:
    - Получить своё текущее расписание занятий
    - Узнать информацию о следующем занятии
    - Просмотреть полное расписание на неделю
    - Напоминать тебе про следующюю пару благодаря рассылке

⌨️ Просто воспользуйся клавиатурой ниже, чтобы выбрать действие:';
        $bot->sendMessage('dqweqweq');
    }


    /**
     * @return void
     */
    public function UpdateState(): void
    {
        State::updateOrCreate(
            ['chat_id' => $this->getUpdate()->getChat()->getId()],
            ['state' => 'menu.main']
        );
    }
}
