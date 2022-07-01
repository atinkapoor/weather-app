<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WeatherDataWidget extends Component
{
    public $weatherData;
    public $location;
    public $errorMessage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($weatherData, $location, $errorMessage)
    {
        $this->weatherData = $weatherData;
        $this->location = $location;
        $this->errorMessage = $errorMessage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.weather-data-widget');
    }
}
