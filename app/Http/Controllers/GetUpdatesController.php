<?php

namespace App\Http\Controllers;

use App\Jobs\TelegramUpdateJob;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;

class GetUpdatesController extends Controller
{
    /**
     * @throws TelegramSDKException
     */
    public function __invoke()
    {
        TelegramUpdateJob::dispatch();
        return response()->json(['message' => 'Job dispatched.']);

    }
}
