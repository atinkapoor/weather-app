<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    use WithFaker;

    /**
     * Test page load.
     *
     * @return void
     */
    public function testHomePageLoad()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test default location.
     *
     * @return void
     */
    public function testValidDefaultLocation()
    {
        $response = $this->get('/');
        $response->assertSeeText('Feels like');
    }

    /**
     * Test valid location.
     *
     * @return void
     */
    public function testValidLocation()
    {
        $randomLocation = "United Kingdom";
        $response = $this->get('/' . $randomLocation);
        $response->assertSeeText('Feels like');
    }

    /**
     * Test invalid location.
     *
     * @return void
     */
    public function testInvalidLocation()
    {
        $randomLocation = $this->faker->name;
        $response = $this->get('/' . $randomLocation);
        $response->assertSeeText('Invalid city name');
    }
}
