<?php

namespace App\Jobs;

use App\Models\State;
use App\Services\HandleMessageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\Update;

class TelegramUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected int $offset;
    protected $state;
    private HandleMessageService $handleMessageService;

    public function __construct()
    {
        $this->offset = 0;
        $this->handleMessageService = new HandleMessageService($this);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        while (true){
            // Get the latest updates from Telegram with the offset
            $updates = $this->get_updates();

            // Loop through the updates
            $this->loopThroughTheUpdates($updates);
        }


    }

    /**
     * @return array|Update
     */
    private function get_updates(): Update|array
    {
        return Telegram::commandsHandler(false);
    }

    /**
     * @param array|Update $updates
     * @return void
     */
    public function loopThroughTheUpdates(array|Update $updates): void
    {
        foreach ($updates as $update) {
            if ($update->isMessageType) {
                $this->loadState($update);

                $this->handleMessageService->handleMessage($update);
                $this->offset = $update->getUpdateId() + 1;
            }
        }
    }



    /**
     * @param mixed $update
     * @return void
     */
    public function loadState(mixed $update): void
    {
        $state = State::where('chat_id', $update->getMessage()->getChat()->getId())
            ->first();

        if ($state) {
            $this->state = $state->state;
        } else {
            $this->state = 'menu.main';

            State::updateOrCreate(
                ['chat_id' => $update->getMessage()->getChat()->getId()],
                ['state' => $this->state]
            );
        }
    }



    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }
}
