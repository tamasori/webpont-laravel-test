<?php

namespace App\DTOs;

use App\Models\City;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;

class WeatherInformationDTO{
   public CarbonInterface $measuredAt;
   public City $city;
   public float $temperature;
   public int $pressure;
   public int $humidity;
   public float $minTemperature;
   public float $maxTemperature;

   public function __construct(object $dataFromOpenWeather, City $city)
   {
       $this->measuredAt = CarbonImmutable::parse($dataFromOpenWeather->dt);
       $this->city = $city;
       $this->temperature = floatval($dataFromOpenWeather->main->temp);
       $this->pressure = intval($dataFromOpenWeather->main->pressure);
       $this->humidity = intval($dataFromOpenWeather->main->humidity);
       $this->minTemperature = floatval($dataFromOpenWeather->main->temp_min);
       $this->maxTemperature = floatval($dataFromOpenWeather->main->temp_max);

   }
}
