<?php

namespace App\Http\Controllers;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Common\Update;


class GetUpdatesController extends Controller
{

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(Nutgram $bot)
    {

        $updates = $bot->getUpdates();
        dd($updates);

        /** @var Update $update */
        foreach ($updates as $update) {


        }
    }
}
