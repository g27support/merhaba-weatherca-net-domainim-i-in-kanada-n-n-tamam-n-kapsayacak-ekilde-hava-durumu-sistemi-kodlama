<?php
namespace App\Controllers;

use App\Services\Weather\OpenWeatherMapProvider;
use App\Services\Weather\WeatherService;

class WeatherController extends BaseController {
    
    public function province(string $slug) {
        $stmt = $this->db->prepare("SELECT * FROM provinces WHERE slug = ? AND is_active = 1");
        $stmt->execute([$slug]);
        $province = $stmt->fetch();

        if (!$province) {
            http_response_code(404);
            return $this->render('404');
        }

        // Fetch cities in this province with weather
        $stmt = $this->db->prepare("
            SELECT c.*, wc.temp, wc.condition_code 
            FROM cities c 
            LEFT JOIN weather_current wc ON c.id = wc.city_id 
            WHERE c.province_id = ?
            ORDER BY c.name_en ASC
        ");
        $stmt->execute([$province['id']]);
        $cities = $stmt->fetchAll();

        $name = ($this->lang == 'en' ? $province['name_en'] : $province['name_fr']);

        $this->render('province', [
            'province' => $province,
            'cities' => $cities,
            'seo' => [
                'title' => "Weather in {$name}, Canada | WeatherCA.net",
                'description' => "Current weather and forecasts for all cities in {$name}.",
                'canonical' => "{$this->config['site']['url']}/weather/{$slug}"
            ]
        ]);
    }

    public function city(string $provinceSlug, string $citySlug) {
        $stmt = $this->db->prepare("
            SELECT c.*, p.name_en as province_en, p.name_fr as province_fr, p.code as province_code
            FROM cities c 
            JOIN provinces p ON c.province_id = p.id 
            WHERE c.slug = ? AND p.slug = ?
        ");
        $stmt->execute([$citySlug, $provinceSlug]);
        $city = $stmt->fetch();

        if (!$city) {
            http_response_code(404);
            return $this->render('404');
        }

        // Check cache freshness (30 mins)
        $stmt = $this->db->prepare("SELECT *, TIMESTAMPDIFF(MINUTE, updated_at, NOW()) as age FROM weather_current WHERE city_id = ?");
        $stmt->execute([$city['id']]);
        $current = $stmt->fetch();

        if (!$current || $current['age'] > 30) {
            $provider = new OpenWeatherMapProvider($this->config['weather']['api_key']);
            $service = new WeatherService($provider);
            $service->updateCityWeather($city['id'], $city['lat'], $city['lon']);
            
            // Re-fetch updated data
            $stmt = $this->db->prepare("SELECT * FROM weather_current WHERE city_id = ?");
            $stmt->execute([$city['id']]);
            $current = $stmt->fetch();
        }

        // Fetch 7-day forecast
        $stmt = $this->db->prepare("SELECT * FROM weather_forecasts WHERE city_id = ? AND forecast_date >= CURDATE() ORDER BY forecast_date ASC LIMIT 7");
        $stmt->execute([$city['id']]);
        $forecast = $stmt->fetchAll();

        $cityName = ($this->lang == 'en' ? $city['name_en'] : $city['name_fr']);

        $this->render('city', [
            'city' => $city,
            'current' => $current,
            'forecast' => $forecast,
            'seo' => [
                'title' => "{$cityName}, {$city['province_code']} Weather Forecast | WeatherCA.net",
                'description' => "Current temperature, humidity, and 7-day weather forecast for {$cityName}.",
                'canonical' => "{$this->config['site']['url']}/weather/{$provinceSlug}/{$citySlug}"
            ]
        ]);
    }
}
