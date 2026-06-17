<?php
require_once __DIR__ . '/../app/Core/Autoloader.php';

use App\Core\Database;
use App\Services\Weather\OpenWeatherMapProvider;
use App\Services\Weather\WeatherService;

$config = require __DIR__ . '/../config/config.php';
$db = Database::getInstance();

$provider = new OpenWeatherMapProvider($config['weather']['api_key']);
$weatherService = new WeatherService($provider);

// Fetch all active cities to update
$cities = $db->query("SELECT id, name_en, lat, lon FROM cities")->fetchAll();

echo "Starting weather update for " . count($cities) . " cities...\n";

foreach ($cities as $city) {
    echo "Updating {$city['name_en']}... ";
    $success = $weatherService->updateCityWeather($city['id'], $city['lat'], $city['lon']);
    echo $success ? "Done\n" : "Failed\n";
}

echo "Update complete.\n";
