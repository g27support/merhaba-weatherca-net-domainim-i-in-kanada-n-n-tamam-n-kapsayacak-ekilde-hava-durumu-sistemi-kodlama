<?php
namespace App\Services;

class SeoService {
    private $config;
    private $lang;

    public function __construct(string $lang) {
        $this->config = require __DIR__ . '/../../config/config.php';
        $this->lang = $lang;
    }

    public function getHomeSeo(): array {
        return [
            'title' => ($this->lang == 'en' ? 'Canadian Weather Forecasts & Alerts' : 'Prévisions Météo et Alertes au Canada') . ' | WeatherCA.net',
            'description' => $this->lang == 'en' ? 'Accurate weather forecasts for all Canadian cities.' : 'Prévisions météo précises pour toutes les villes canadiennes.',
            'canonical' => $this->config['site']['url'],
            'hreflang' => [
                'en' => $this->config['site']['url'],
                'fr' => $this->config['site']['url'] . '?lang=fr'
            ]
        ];
    }

    public function getCitySeo(array $city, array $province): array {
        $name = ($this->lang == 'en' ? $city['name_en'] : $city['name_fr']);
        $pName = ($this->lang == 'en' ? $province['name_en'] : $province['name_fr']);
        return [
            'title' => "Weather in $name, $pName | WeatherCA.net",
            'description' => "Get the latest weather forecast for $name, $pName.",
            'canonical' => "{$this->config['site']['url']}/weather/{$province['slug']}/{$city['slug']}",
            'hreflang' => [
                'en' => "{$this->config['site']['url']}/weather/{$province['slug']}/{$city['slug']}",
                'fr' => "{$this->config['site']['url']}/weather/{$province['slug']}/{$city['slug']}?lang=fr"
            ]
        ];
    }
    
    // More methods can be added for blog, guides, etc.
}
