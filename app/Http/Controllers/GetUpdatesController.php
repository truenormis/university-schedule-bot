<?php

namespace App\Http\Controllers;


use App\Telegram\Commands\StartCommand;
use Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SergiX44\Nutgram\Nutgram;


class GetUpdatesController extends Controller
{


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(Nutgram $bot): void
    {

        $bot->onCommand('start', [StartCommand::class, 'handle']);
        $bot->run();
    }
}
