<?php

namespace App\Services;

use App\DTOs\WeatherInformationDTO;
use App\Interfaces\IWeatherClient;
use App\Models\City;
use Exception;
use Illuminate\Support\Facades\Http;

class OpenWeatherService implements IWeatherClient
{

    private $client;

    public function __construct()
    {
        $this->client = Http::accept('application/json')
            ->baseUrl(config('services.openweather.base_url'));
    }

    public function getWeatherInformationForCity(City $city): ?WeatherInformationDTO
    {
        $response = $this->client->get('', [
            'lat' => $city->latitude,
            'lon' => $city->longitude,
            'units' => 'metric',
            'appid' => config('services.openweather.api_key'),
        ]);

        return (new WeatherInformationDTO(json_decode($response->body()), $city));
    }
}
