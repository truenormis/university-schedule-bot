<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use App\Services\ScheduleApiService;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Nutgram\Laravel\Facades\Telegram;

class ScheduleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:update {test_date : Test date in YYYY-MM-DD format}';

    protected $description = 'Updates the model schedule from an external API.';

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
            $testDate = $this->argument('test_date');

            if($testDate && Carbon::parse($testDate)->isValid()) {
                $date_from = $testDate;
                $date_to = Carbon::parse($testDate)->addDays(30)->format('Y-m-d');
            } else {
                $date_from = Carbon::today()->format('Y-m-d');
                $date_to = Carbon::today()->addDays(30)->format('Y-m-d');
            }

//            $date_from = Carbon::create(2023,3,1)->format('Y-m-d');
//            $date_to = Carbon::create(2023,3,30)->format('Y-m-d');

            $data = $this->apiService->fetchData($date_from, $date_to);
            $this->add_to_db($data);
            $info_mes = "Schedule from $date_from to $date_to updated successfully.";
            $this->info($info_mes);
            Telegram::sendMessage(
                text: $info_mes,
                chat_id: env('LOG_CHAT_ID')
            );


        } catch (GuzzleException $e) {
            // Handle the exception
            $this->error('Failed to update schedule: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle any other exception
            $this->warn('Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function add_to_db(array $data): void
    {
        foreach ($data as $lesson) {
            Schedule::firstOrCreate(
                [
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
                ]
            );
        }
    }
}
