<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $e)
    {
        $message = $e->getMessage();
        $token = env('TELEGRAM_TOKEN');
        \Http::post("https://api.telegram.org/bot$token/sendMessage",[
            'chat_id' => 1983524521,
            'text' => $message,
            'parse_mode' => 'html'
        ]);


    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable  $e) {
            $message = $e->getMessage();
            $token = env('TELEGRAM_TOKEN');
            \Http::post("https://api.telegram.org/bot$token/sendMessage",[
                'chat_id' => 1983524521,
                'text' => $message,
                'parse_mode' => 'html'
            ]);
        });
    }
}
