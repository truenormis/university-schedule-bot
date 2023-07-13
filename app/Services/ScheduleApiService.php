<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ScheduleApiService
{
    protected const BASE_URI = 'https://webcab.stu.cn.ua';
    protected const SCHEDULE_PATH = '/WebDk/api/schedule/get';
    protected const TOKEN_PATH = '/WebDk/token';

    protected Client $client;
    private string $accessToken;

    /**
     * @throws GuzzleException
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'verify' => false,

        ]);
        $this->authenticate();
    }

    /**
     * @throws GuzzleException
     * @return array
     */
    public function fetchData($date_from,$date_to): array
    {
        $headers = [
            'headers' => [
                'Authorization' => "Bearer $this->accessToken",
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'dateFrom' => "$date_from",
                'dateTo' => "$date_to"
            ]
        ];

        $response = $this->client->request('POST', self::SCHEDULE_PATH, $headers);

        return json_decode($response->getBody(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function authenticate(): void
    {
        $username = config('app.api_username');
        $password = config('app.api_password');

        $response = $this->client->request('POST', self::TOKEN_PATH, [
            'form_params' => [
                'grant_type' => 'password',
                'username' => $username,
                'password' => $password,
                'version' => '2.9',
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        $this->accessToken = $data['access_token'];
    }

}
