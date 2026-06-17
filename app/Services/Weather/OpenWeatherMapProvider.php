<?php
namespace App\Services\Weather;

class OpenWeatherMapProvider implements WeatherProviderInterface {
    private $apiKey;
    private $baseUrl = "https://api.openweathermap.org/data/3.0/onecall";

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getCurrentWeather(float $lat, float $lon, string $lang): array {
        return $this->fetchData($lat, $lon, $lang);
    }

    public function getForecast(float $lat, float $lon, string $lang): array {
        return $this->fetchData($lat, $lon, $lang);
    }

    public function getAlerts(float $lat, float $lon, string $lang): array {
        return $this->fetchData($lat, $lon, $lang);
    }

    private function fetchData(float $lat, float $lon, string $lang): array {
        $url = "{$this->baseUrl}?lat={$lat}&lon={$lon}&appid={$this->apiKey}&units=metric&lang={$lang}";
        $response = @file_get_contents($url);
        if ($response === false) return [];
        return json_decode($response, true) ?: [];
    }
}
