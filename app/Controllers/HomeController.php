<?php
namespace App\Controllers;

class HomeController extends BaseController {
    public function index() {
        // Fetch featured cities
        $stmt = $this->db->prepare("
            SELECT c.*, p.name_en as province_en, p.name_fr as province_fr, wc.temp, wc.condition_code 
            FROM cities c 
            JOIN provinces p ON c.province_id = p.id 
            LEFT JOIN weather_current wc ON c.id = wc.city_id
            WHERE c.is_featured = 1 OR c.search_count > 0
            LIMIT 6
        ");
        $stmt->execute();
        $featuredCities = $stmt->fetchAll();

        // Fetch latest blog posts
        $stmt = $this->db->prepare("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC LIMIT 3");
        $stmt->execute();
        $latestPosts = $stmt->fetchAll();

        $this->render('home', [
            'featuredCities' => $featuredCities,
            'latestPosts' => $latestPosts,
            'seo' => [
                'title' => ($this->lang == 'en' ? 'Canadian Weather Forecasts & Alerts' : 'Prévisions Météo et Alertes au Canada') . ' | WeatherCA.net',
                'description' => $this->lang == 'en' ? 'Get accurate 15-day weather forecasts for all Canadian cities.' : 'Obtenez des prévisions météo précises sur 15 jours pour toutes les villes canadiennes.',
                'canonical' => $this->config['site']['url']
            ]
        ]);
    }
}
