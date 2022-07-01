# Genome
A simple weather application to show the current weather in a given location.

## Name
Genome weather application

## Description
A simple weather application to show the current weather in a given location.

## Configuration
All configurations are inside .env file
Configurations are related to :
APP_URL
OpenWeatherMap API
Caching

## Structure
app/
┣ Console/
┃ ┗ Commands/
┃   ┣ WeatherData.php
┣ Http/
┃ ┗ Controllers/
┃   ┣ WeatherController.php
┣ Traits/
┃   ┣ OpenWeatherMap.php
┣ View/
┃ ┗ Components/
┃   ┣ WeatherDataWidget.php
┣ resources/
┃ ┗ views/
┃   ┗ components/
┃       ┣ weather-data-widget.blade.php
┃   ┣ home.blade.php
┗ tests/
┃ ┗ Feature/
┃   ┣ WeatherTest.php
┃ ┗ Unit/
┃   ┣ WeatherTest.php

## Installation
composer install

## To run the command
If no location is passed default location "london" will be used
xxxxx can be any location

php artisan weather:data "xxxxxxx"


## To run using browser
xxxxx can be any location

https://genome.local.test/xxxxxxxx


## To run test cases
./vendor/bin/phpunit

