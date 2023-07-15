<?php

namespace App\Jobs;

use App\Telegram\Commands\StartCommand;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $offset = 0;
        while (true) {
            // Get the latest updates from Telegram with the offset
            $updates =Telegram::commandsHandler(false);
            // Loop through the updates
            foreach ($updates as $update) {

                // Do something with the update, such as sending a message
                //($update);
                Telegram::sendMessage([
                    'chat_id' => $update->getMessage()->getChat()->getId(),
                    'text' => 'Hello, world!'
                ]);

                // Update the offset to the highest update_id + 1
                $offset = $update->getUpdateId() + 1;
            }
        }
    }
}
