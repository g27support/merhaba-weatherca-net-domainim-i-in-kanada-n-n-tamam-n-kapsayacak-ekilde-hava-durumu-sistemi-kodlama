<?php
namespace App\Services;

use App\Core\Database;

class SitemapService {
    private $db;
    private $siteUrl;

    public function __construct() {
        $this->db = Database::getInstance();
        $config = require __DIR__ . '/../../config/config.php';
        $this->siteUrl = $config['site']['url'];
    }

    public function generateIndex(): string {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $xml .= '<sitemap><loc>' . $this->siteUrl . '/sitemap-weather.xml</loc></sitemap>';
        $xml .= '<sitemap><loc>' . $this->siteUrl . '/sitemap-blog.xml</loc></sitemap>';
        $xml .= '<sitemap><loc>' . $this->siteUrl . '/sitemap-guides.xml</loc></sitemap>';
        $xml .= '</sitemapindex>';
        return $xml;
    }

    public function generateWeatherSitemap(): string {
        $cities = $this->db->query("
            SELECT c.slug as city_slug, p.slug as province_slug 
            FROM cities c 
            JOIN provinces p ON c.province_id = p.id
        ")->fetchAll();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($cities as $city) {
            $xml .= '<url><loc>' . $this->siteUrl . '/weather/' . $city['province_slug'] . '/' . $city['city_slug'] . '</loc><priority>0.8</priority></url>';
        }
        $xml .= '</urlset>';
        return $xml;
    }
}
