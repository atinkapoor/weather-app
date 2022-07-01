<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Traits\OpenWeatherMap;

class WeatherData extends Command
{
    use OpenWeatherMap;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:data {location=Harrow}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to show the current weather in a given location';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $locationName = $this->argument('location');

        if(empty($locationName)){
            $locationName = config('app.default_location');
        }

        $informationData = $this->getWeatherInformation($locationName);
        
        if($informationData['status'] == 'success'){
            $weatherData = $informationData['data'];

            $this->info('Weather Info for loction: ' .$locationName);
            $this->info("Temprature: ". $weatherData['main']['temp']);
            $this->info("Feels like: ". $weatherData['main']['feels_like']);
            $this->info("Humidity: ". $weatherData['main']['humidity']);        

        }else{
            $errorMessage = $informationData['errorMessage'];
            $this->error($errorMessage);
        }

    }
}
