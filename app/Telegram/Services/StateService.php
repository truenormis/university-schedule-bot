<?php

namespace App\Telegram\Services;

use App\Models\State;
use App\Telegram\Menus\HelpMenu;
use App\Telegram\Menus\LessonMenu;
use App\Telegram\Menus\MainMenu;
use App\Telegram\Menus\SettingsMenu;
use Exception;
use SergiX44\Nutgram\Nutgram;

class StateService
{
    protected int $chat_id;
    protected string $state;

    public function __invoke(Nutgram $bot): void
    {
        $this->chat_id = $bot->chatId();
        $this->state = $this->get_state();

        // Создаем массив с соответствием состояний и классов меню
        $menus = [
            'main.menu' => MainMenu::class,
            'help.menu' => HelpMenu::class,
            'lesson.menu' => LessonMenu::class,
            'settings.menu' => SettingsMenu::class,
            // Добавляем другие меню по необходимости
        ];

        // Проверяем, есть ли класс меню для текущего состояния
        if (isset($menus[$this->state])) {
            // Создаем экземпляр класса меню и вызываем его метод show
            $menu = new $menus[$this->state]($bot);
        } else {
            // Если нет, устанавливаем состояние в 'menu.main' и выводим сообщение об этом
            try {
                State::updateOrCreate(
                    ['chat_id' => $bot->chatId()],
                    ['state' => 'main.menu']
                );

                $bot->sendMessage("Ваше состояние было сброшено. Вы находитесь в главном меню.");
            } catch (Exception $e) {
                // Обрабатываем исключения и выводим сообщение об ошибке
                $errorMessage = "Произошла ошибка: " . $e->getMessage();
                $bot->sendMessage($errorMessage);
            }
        }
    }

    private function get_state(): string
    {
        // Используем метод firstOrFail вместо first, чтобы выбросить исключение, если запись не найдена
        $state = State::where('chat_id', $this->chat_id)->firstOrFail();

        return $state->state;
    }
}
