<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\FileUpload\InputFile;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Start Command to get you started';

    public function handle(): void
    {
        $this->replyWithChatAction(['action' => Actions::CHOOSE_STICKER]);
        $this->replyWithSticker(['sticker'=>'CAACAgIAAxkBAAICoWSzFvD2j_QQWKRDnPKwBCqSalIuAAI9AAOymJoOgqzpk7IcUtkvBA']);
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage([
            'text' => '👋 Привет! Я Бот-расписание, здесь чтобы помочь тебе организовать свою жизнь!

📅 Я могу предоставить информацию о твоём расписании занятий, чтобы ты всегда был в курсе своих дел.

💡 Вот несколько функций, которые я могу выполнить:
    - Получить своё текущее расписание занятий
    - Узнать информацию о следующем занятии
    - Просмотреть полное расписание на неделю
    - Напоминать тебе про следующюю пару благодаря рассылке

⌨️ Просто воспользуйся клавиатурой ниже, чтобы выбрать действие:',
        ]);


    }
}
