<?php
namespace App\Services\Weather;

interface WeatherProviderInterface {
    public function getCurrentWeather(float $lat, float $lon, string $lang): array;
    public function getForecast(float $lat, float $lon, string $lang): array;
    public function getAlerts(float $lat, float $lon, string $lang): array;
}
