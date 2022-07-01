<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Exception;

trait OpenWeatherMap
{

    /**
     * @param Request $request
     * @return $data
     */
    public function getWeatherInformation($location = '')
    {

        $data = "";
        $errorMessage = "";
        $status = "success";

        $cachedData = $this->getFromCache($location);

        if ($cachedData) {
            $data = $cachedData;
        } else {
            $openWeatherMapCurrentApiUrl = $this->prepareUrl($location);

            try {
                $response = Http::get($openWeatherMapCurrentApiUrl);

                // Check if everything is fine
                if ($response->successful()) {
                    $data = $response->json();
                    $this->storeCache($location, $data);
                } else {
                    // Managing some errors
                    $status = "error";
                    if ($response->clientError()) {
                        $errorMessage = "Invalid city name, ZIP-code or city ID. Error performing request. Status code: " . $response->getStatusCode();
                    } elseif ($response->serverError()) {
                        $errorMessage = "Error from Server. Status code: " . $response->getStatusCode();
                    } else {
                        $errorMessage = "Error! Status code: " . $response->getStatusCode();
                    }
                }
            } catch (Exception $e) {
                $status = "error";
                $errorMessage = "Exception: " . $e->getMessage();
            }
        }

        $contentResponse = [
            'status' => $status,
            'errorMessage' => $errorMessage,
            'data' => $data
        ];

        return $contentResponse;
    }

    public function prepareUrl($location)
    {

        $openWeatherMapApiKey = config('app.openweathermap_api_key');
        $openWeatherMapCurrentApiUrl = config('app.openweathermap_current_api_url');

        $openWeatherMapCurrentApiUrl = str_replace('##LOCATION##', $location, $openWeatherMapCurrentApiUrl);
        $openWeatherMapCurrentApiUrl = str_replace('##API_KEY##', $openWeatherMapApiKey, $openWeatherMapCurrentApiUrl);

        return $openWeatherMapCurrentApiUrl;
    }

    public function getFromCache($location)
    {
        $cachedData = "";
        $cacheKey = 'cache_' . strtolower($location);
        if (Cache::has($cacheKey)) {
            $cachedData = Cache::get($cacheKey);
        }
        return $cachedData;
    }

    public function storeCache($location, $data)
    {
        $cacheKey = 'cache_' . strtolower($location);
        $cacheDuration = config('app.cache_duration_in_seconds');
        Cache::add($cacheKey, $data, $cacheDuration);
        return true;
    }
}
