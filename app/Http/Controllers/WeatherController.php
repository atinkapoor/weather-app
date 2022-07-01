<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\OpenWeatherMap;

class WeatherController extends Controller
{
    use OpenWeatherMap;

    public function index(Request $request, $location = '')
    {

        if (empty($location)) {
            $location = config('app.default_location');
        }

        $weatherData = array();
        $errorMessage = "";

        $informationData = $this->getWeatherInformation($location);

        if ($informationData['status'] == 'success') {
            $weatherData = $informationData['data'];
        } else {
            $errorMessage = $informationData['errorMessage'];
        }

        return view('home', compact('weatherData', 'location', 'errorMessage'));
    }
}
