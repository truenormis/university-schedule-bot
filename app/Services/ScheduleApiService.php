<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ScheduleApiService
{
    protected Client $client;
    private string $accessToken;

    /**
     * @throws GuzzleException
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://webcab.stu.cn.ua',
            'verify' => false,

        ]);
        $this->authenticate();
    }

    /**
     * @throws GuzzleException
     */


    public function fetchData()
    {
        $headers = [
            'headers' => [
                'Authorization' => "Bearer $this->accessToken",
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'dateFrom' => '2023-04-09T00:00:00',
                'dateTo' => '2023-04-11T00:00:00'
            ]
        ];

        $response = $this->client->post('/WebDk/api/schedule/get', $headers);

        return json_decode($response->getBody(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function authenticate()
    {
        $username = config('app.api_username');
        $password = config('app.api_password');

        $response = $this->client->post('/WebDk/token', [
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
