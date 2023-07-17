<?php

namespace App\Telegram\Menus;

use App\Models\State;
use Exception;
use phpDocumentor\Reflection\Types\This;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Keyboard\KeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardMarkup;

abstract class Menu
{
    protected Nutgram $bot;
    protected string $name; // Имя меню
    protected string $state; // Состояние, соответствующее меню

    protected array $commands;

    public function __construct(Nutgram $bot)
    {
        // Сохраняем экземпляр бота в свойстве класса
        $this->bot = $bot;
        // Обновляем состояние пользователя в базе
        $this->update_state();
    }

    // Абстрактный метод, который должен быть реализован в каждом подклассе
    abstract public function show(): void;
    abstract public function transfer(): void;
    // Метод для обновления состояния пользователя в базе
    private function update_state(): void
    {
        $state_count = State::where('chat_id',$this->bot->chatId())
            ->where('state',$this->state)->count();
        if($state_count == 0){
            try {
                State::updateOrCreate(
                    ['chat_id' => $this->bot->chatId()],
                    ['state' => $this->state]
                );
            } catch (Exception $e) {
                // Обрабатываем исключения и выводим сообщение об ошибке
                $errorMessage = "Произошла ошибка: " . $e->getMessage();
                $this->bot->sendMessage($errorMessage);
            }
            $this->transfer();
        }else{
            $this->show();
        }


    }


    protected function keyboard(): ReplyKeyboardMarkup
    {
        $reply_markup = ReplyKeyboardMarkup::make();
        foreach ($this->commands as $key => $value){
            $reply_markup->addRow(KeyboardButton::make($key));
        }
        return $reply_markup;
    }


    protected function wait_command(): void
    {
        foreach ($this->commands as $key => $value){
            if ($key == $this->bot->message()->text) {
                $command = new $this->commands[$key]($this->bot);
                return;
            }
        }
        $this->bot->sendMessage("Извините, я не знаю такой комманды, пожалуйста выберите что-то из спика:");
    }
}
