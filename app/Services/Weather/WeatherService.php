<?php
namespace App\Services\Weather;

use App\Core\Database;

class WeatherService {
    private $provider;
    private $db;

    public function __construct(WeatherProviderInterface $provider) {
        $this->provider = $provider;
        $this->db = Database::getInstance();
    }

    public function updateCityWeather(int $cityId, float $lat, float $lon) {
        // Fetch data in both languages to cache both
        $dataEn = $this->provider->getCurrentWeather($lat, $lon, 'en');
        $dataFr = $this->provider->getCurrentWeather($lat, $lon, 'fr');

        if (empty($dataEn)) return false;

        $currentEn = WeatherNormalizer::normalizeCurrent($dataEn);
        $currentFr = WeatherNormalizer::normalizeCurrent($dataFr);

        // Update Current Weather Cache
        $stmt = $this->db->prepare("
            INSERT INTO weather_current 
            (city_id, temp, feels_like, humidity, wind_speed, wind_deg, condition_code, condition_text_en, condition_text_fr, uv_index, visibility)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            temp=VALUES(temp), feels_like=VALUES(feels_like), humidity=VALUES(humidity), 
            wind_speed=VALUES(wind_speed), wind_deg=VALUES(wind_deg), condition_code=VALUES(condition_code), 
            condition_text_en=VALUES(condition_text_en), condition_text_fr=VALUES(condition_text_fr), 
            uv_index=VALUES(uv_index), visibility=VALUES(visibility), updated_at=CURRENT_TIMESTAMP
        ");
        
        $stmt->execute([
            $cityId, $currentEn['temp'], $currentEn['feels_like'], $currentEn['humidity'],
            $currentEn['wind_speed'], $currentEn['wind_deg'], $currentEn['condition_code'],
            $currentEn['condition_text'], $currentFr['condition_text'],
            $currentEn['uv_index'], $currentEn['visibility']
        ]);

        // Update Forecast Cache
        $forecasts = WeatherNormalizer::normalizeForecast($dataEn);
        foreach ($forecasts as $f) {
            $stmt = $this->db->prepare("
                INSERT INTO weather_forecasts (city_id, forecast_date, temp_min, temp_max, condition_code, pop)
                VALUES (?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                temp_min=VALUES(temp_min), temp_max=VALUES(temp_max), 
                condition_code=VALUES(condition_code), pop=VALUES(pop), updated_at=CURRENT_TIMESTAMP
            ");
            $stmt->execute([$cityId, $f['date'], $f['temp_min'], $f['temp_max'], $f['condition_code'], $f['pop']]);
        }

        return true;
    }
}
