<?php

namespace Tests\Feature\Telegram;

use App\Models\State;
use App\Telegram\Commands\StartCommand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use SergiX44\Nutgram\Nutgram;
use Tests\TestCase;

class StartCommandTest extends TestCase
{
    /**
     * A basic feature test example.
     * @throws \ReflectionException
     */
    public function test_update_state(): void
    {
        $chatId = 12342131;
        $mock = Mockery::mock(Nutgram::class);
        $mock->shouldReceive('chatId')
            ->andReturn($chatId)->once();


        $command = New StartCommand();

        $ref_class = new \ReflectionClass($command);
        $method = $ref_class->getMethod('UpdateState');

        $method->invoke($command,$mock);

        $this->assertEquals(State::find(1)->chat_id,$chatId);
    }
}
