<?php

namespace App\Http\Controllers;

use App\Http\Resources\WeatherInformationResource;
use App\Models\City;
use App\Models\WeatherInformation;
use Illuminate\Http\Request;

class WeatherApiController extends Controller
{
    public function index()
    {
        $weatherInformations = WeatherInformation::with('city')->paginate();

        return WeatherInformationResource::collection($weatherInformations);
    }

    public function search(Request $request)
    {
        $request->validate([
            'city' => ['required', 'exists:cities,name'],
        ]);

        $city = City::whereName($request->city)->first();

        $weatherInformations = $city->weatherInformations()->where('measured_at', '>=', now()->subDay())->get();

        return WeatherInformationResource::collection($weatherInformations);
    }
}
