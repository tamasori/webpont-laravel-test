<?php

namespace App\Console\Commands;

use App\Interfaces\IWeatherClient;
use App\Models\City;
use App\Models\WeatherInformation;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GatherWeatherInformationForCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:gather-information';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gathers weather information for every city';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $weatherClient = resolve(IWeatherClient::class);

        City::all()->each(function (City $city) use($weatherClient){
            try {
                $weatherInformation = $weatherClient->getWeatherInformationForCity($city);

                WeatherInformation::create([
                    'measured_at' => $weatherInformation->measuredAt,
                    'city_id' => $weatherInformation->city->getKey(),
                    'temperature' => $weatherInformation->temperature,
                    'pressure' => $weatherInformation->pressure,
                    'humidity' => $weatherInformation->humidity,
                    'min_temperature' => $weatherInformation->minTemperature,
                    'max_temperature' => $weatherInformation->maxTemperature,
                ]);
            } catch (Exception $exception){
                Log::error(sprintf("Fetching data for %s went wrong: %s", $city->name, $exception->getMessage()));
            }
        });

        return Command::SUCCESS;
    }
}
