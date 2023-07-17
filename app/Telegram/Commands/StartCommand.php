<?php

namespace App\Telegram\Commands;

use App\Models\State;
use Exception;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Keyboard\KeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardMarkup;


class StartCommand extends Command
{
    protected string $command = 'start';

    protected ?string $description = 'A lovely description.';

    public function handle(Nutgram $bot): void
    {
//        $this->replyWithChatAction(['action' => Actions::CHOOSE_STICKER]);
//        $this->replyWithSticker(['sticker' => 'CAACAgIAAxkBAAICoWSzFvD2j_QQWKRDnPKwBCqSalIuAAI9AAOymJoOgqzpk7IcUtkvBA']);
//        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $bot->sendSticker('CAACAgIAAxkBAAICoWSzFvD2j_QQWKRDnPKwBCqSalIuAAI9AAOymJoOgqzpk7IcUtkvBA');
        $this->sendWelcomeMessage($bot);
        $this->UpdateState($bot);


    }

    /**
     * @return void
     */
    public function sendWelcomeMessage(Nutgram $bot): void
    {
        $reply_markup = ReplyKeyboardMarkup::make()
            ->addRow(KeyboardButton::make('📅 Узнать рассписание'))
            ->addRow(KeyboardButton::make('❓ Помощь по боту'))
            ->addRow(KeyboardButton::make('⚙️ Настройки'));

        $HelloMes = '👋 Привет! Я Бот-расписание, здесь чтобы помочь тебе организовать свою жизнь!

📅 Я могу предоставить информацию о твоём расписании занятий, чтобы ты всегда был в курсе своих дел.

💡 Вот несколько функций, которые я могу выполнить:
    - Получить своё текущее расписание занятий
    - Узнать информацию о следующем занятии
    - Просмотреть полное расписание на неделю
    - Напоминать тебе про следующюю пару благодаря рассылке

⌨️ Просто воспользуйся клавиатурой ниже, чтобы выбрать действие:';
        $bot->sendMessage(
            text: $HelloMes,
            reply_markup: $reply_markup
        );

    }


    private function UpdateState(Nutgram $bot): void
    {
        try {
            $state = State::updateOrCreate(
                ['chat_id' => $bot->chatId()],
                ['state' => 'main.menu']
            );

            if ($state == null) {
                $errorMessage = "Error updating state.";
                $bot->sendMessage($errorMessage);
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred: " . $e->getMessage();
            $bot->sendMessage($errorMessage);
        }
    }


}
