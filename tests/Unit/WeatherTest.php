<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Traits\OpenWeatherMap;
use Exception;
use Tests\CreatesApplication;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;

class WeatherTest extends TestCase
{
    use OpenWeatherMap;
    use CreatesApplication;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->createApplication();
    }

    /**
     * A weather controller index method.
     *
     * @return void
     */
    public function testPrepareUrl()
    {
        $testLocation = "location";
        $apiUrl = \App\Traits\OpenWeatherMap::prepareUrl($testLocation);
        $expectedResponse = "https://api.openweathermap.org/data/2.5/weather?q=" . $testLocation . "&APPID=2d5c34f669f87fefd16f5dfda6f36dd6&units=metric";
        $this->assertEquals($expectedResponse, $apiUrl);
    }    

    public function testGetFromCache()
    {
        $testLocation = "london";
        $key = "cache_" . $testLocation;
        $testCacheData = "Feels like";
        \App\Traits\OpenWeatherMap::getFromCache($testLocation);

        Cache::shouldReceive('has')->once()->with($key);

        Cache::shouldReceive('get')
            ->once()
            ->with($key)
            ->andReturn($testCacheData);        

        Cache::shouldReceive('add')
            ->once()
            >with($key);            

        $response = $this->get('/'.$testLocation);
        $response->assertSeeText($testCacheData);              

    }
}
