<?php
namespace App\Controllers;

class GuideController extends BaseController {
    
    public function index() {
        $stmt = $this->db->prepare("SELECT * FROM guides ORDER BY is_sticky DESC, id DESC");
        $stmt->execute();
        $guides = $stmt->fetchAll();

        $title = ($this->lang == 'en' ? 'Canada Weather & Safety Guides' : 'Guides Météo et Sécurité Canada');

        $this->render('guides/index', [
            'guides' => $guides,
            'seo' => [
                'title' => "$title | WeatherCA.net",
                'description' => $this->lang == 'en' ? 'Learn how to stay safe in Canadian weather conditions with our expert guides.' : 'Apprenez à rester en sécurité dans les conditions météorologiques canadiennes grâce à nos guides experts.',
                'canonical' => "{$this->config['site']['url']}/guides"
            ]
        ]);
    }

    public function show(string $slug) {
        $stmt = $this->db->prepare("SELECT * FROM guides WHERE slug = ?");
        $stmt->execute([$slug]);
        $guide = $stmt->fetch();

        if (!$guide) {
            http_response_code(404);
            return $this->render('404');
        }

        $title = ($this->lang == 'en' ? $guide['title_en'] : $guide['title_fr']);

        $this->render('guides/show', [
            'guide' => $guide,
            'seo' => [
                'title' => "$title | WeatherCA.net",
                'description' => $title,
                'canonical' => "{$this->config['site']['url']}/guides/{$slug}",
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'HowTo',
                    'name' => $title,
                    'description' => $title,
                    'step' => [
                        [
                            '@type' => 'HowToStep',
                            'text' => 'Read our comprehensive guide to stay safe.'
                        ]
                    ]
                ]
            ]
        ]);
    }
}
