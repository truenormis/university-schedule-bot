<?php

namespace App\Console\Commands;

use App\Services\ScheduleApiService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class ScheduleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:update';
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws GuzzleException
     */
    public function handle()
    {
        $apiService = new ScheduleApiService();

        $data = $apiService->fetchData();
        dd($data);
    }
}
