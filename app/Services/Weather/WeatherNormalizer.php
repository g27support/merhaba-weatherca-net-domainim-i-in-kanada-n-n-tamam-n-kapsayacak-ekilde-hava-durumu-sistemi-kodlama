<?php
namespace App\Services\Weather;

class WeatherNormalizer {
    public static function normalizeCurrent(array $data): array {
        if (empty($data['current'])) return [];
        
        return [
            'temp' => $data['current']['temp'] ?? 0,
            'feels_like' => $data['current']['feels_like'] ?? 0,
            'humidity' => $data['current']['humidity'] ?? 0,
            'wind_speed' => ($data['current']['wind_speed'] ?? 0) * 3.6, // m/s to km/h
            'wind_deg' => $data['current']['wind_deg'] ?? 0,
            'condition_code' => $data['current']['weather'][0]['icon'] ?? '01d',
            'condition_text' => $data['current']['weather'][0]['description'] ?? '',
            'uv_index' => $data['current']['uvi'] ?? 0,
            'visibility' => $data['current']['visibility'] ?? 0,
        ];
    }

    public static function normalizeForecast(array $data): array {
        $forecasts = [];
        if (empty($data['daily'])) return [];

        foreach ($data['daily'] as $day) {
            $forecasts[] = [
                'date' => date('Y-m-d', $day['dt']),
                'temp_min' => $day['temp']['min'] ?? 0,
                'temp_max' => $day['temp']['max'] ?? 0,
                'condition_code' => $day['weather'][0]['icon'] ?? '01d',
                'pop' => ($day['pop'] ?? 0) * 100
            ];
        }
        return $forecasts;
    }

    public static function getWindDirection(int $deg): string {
        $directions = ['N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW'];
        return $directions[round($deg / 45) % 8];
    }
}
