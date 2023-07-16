<?php

namespace App\Services;

use App\Jobs\TelegramUpdateJob;
use Telegram\Bot\Laravel\Facades\Telegram;

class HandleMessageService
{

    private TelegramUpdateJob $telegramUpdateJob;

    public function __construct(TelegramUpdateJob $telegramUpdateJob)
    {
        $this->telegramUpdateJob = $telegramUpdateJob;
    }

    public function handleMessage($update): void
    {
        switch ($this->telegramUpdateJob->getState()) {
            case 'menu.main':
                $this->handleMenuMain($update);
                break;
            case 'settings.main':
                $this->handleSettingsMain($update);
                break;
            default:
                Telegram::sendMessage([
                    'chat_id' => $update->getMessage()->getChat()->getId(),
                    'text' => 'Извините, я не понимаю вашего запроса.'
                ]);
                break;
        }
    }


    private function handleMenuMain($update): void
    {
        // Здесь можно реализовать логику для главного меню, например:
        // - Показать список доступных опций
        // - Перейти в другое состояние в зависимости от выбора пользователя
        // - Отправить сообщение с результатом или подтверждением
        Telegram::sendMessage([
            'chat_id' => $update->getMessage()->getChat()->getId(),
            'text' => $this->telegramUpdateJob->getState()
        ]);
    }

    private function handleSettingsMain($update)
    {
        // Здесь можно реализовать логику для настроек, например:
        // - Показать список доступных настроек
        // - Изменить настройку в зависимости от выбора пользователя
        // - Отправить сообщение с результатом или подтверждением

        // Ваш пример кода можно перенести сюда, например:

    }


}
