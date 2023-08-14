<?php

namespace App\Http\Resources;

use App\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherInformationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'measured_at' => $this->resource->measured_at,
            'city' => CityResource::make($this->resource->city),
            'temperature' => $this->resource->temperature,
            'pressure' => $this->resource->pressure,
            'humidity' => $this->resource->humidity,
            'min_temperature' => $this->resource->min_temperature,
            'max_temperature' => $this->resource->max_temperature,
        ];
    }
}
