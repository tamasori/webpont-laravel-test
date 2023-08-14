<?php

namespace App\Interfaces;

use App\DTOs\WeatherInformationDTO;
use App\Models\City;

interface IWeatherClient{
    public function getWeatherInformationForCity(City $city): ?WeatherInformationDTO;
}
