<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use App\Services\ScheduleApiService;
use Carbon\Carbon;
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
     * The schedule API service instance.
     *
     * @var ScheduleApiService
     */
    protected ScheduleApiService $apiService;

    /**
     * Create a new command instance.
     *
     * @param ScheduleApiService $apiService
     */
    public function __construct(ScheduleApiService $apiService)
    {
        parent::__construct();

        $this->apiService = $apiService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        try {

            $data = $this->apiService->fetchData(Carbon::today()->format('Y-m-d'), Carbon::today()->addDays(30)->format('Y-m-d'));
            foreach ($data as $lesson) {
                foreach ($data as $lesson) {
                    Schedule::firstOrCreate([
                        'disciplineName' => $lesson['disciplineName'],
                        'studyTimeName' => $lesson['studyTimeName'],
                        'studyTimeBegin' => Carbon::parse($lesson['studyTimeBegin'])->format('H:i'),
                        'studyTimeEnd' => Carbon::parse($lesson['studyTimeEnd'])->format('H:i'),
                        'scheduleDate' => Carbon::parse($lesson['scheduleDate'])->format('Y-m-d'),
                        'cabinetNumber' => $lesson['cabinetNumber'],
                        'positionName' => $lesson['positionName'],
                        'positionShortName' => $lesson['positionShortName'],
                        'empFullName' => $lesson['empFullName'],
                        'lastName' => $lesson['lastName'],
                        'firstName' => $lesson['firstName'],
                        'middleName' => $lesson['middleName'],
                        'subgroupName' => $lesson['subgroupName'],
                        'contentNotes' => $lesson['contentNotes'],
                        'studyTypeName' => $lesson['studyTypeName']
                    ]);
                }
            }
            // Do something with the data
            $this->info('Schedule updated successfully.');
        } catch (GuzzleException $e) {
            // Handle the exception
            $this->error('Failed to update schedule: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle any other exception
            $this->warn('Something went wrong: ' . $e->getMessage());
        }
    }
}
