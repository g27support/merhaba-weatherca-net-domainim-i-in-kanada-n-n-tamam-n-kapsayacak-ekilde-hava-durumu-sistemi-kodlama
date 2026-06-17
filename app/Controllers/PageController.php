<?php
namespace App\Controllers;

class PageController extends BaseController {
    
    public function show(string $slug) {
        $stmt = $this->db->prepare("SELECT * FROM pages WHERE slug = ?");
        $stmt->execute([$slug]);
        $page = $stmt->fetch();

        if (!$page) {
            http_response_code(404);
            return $this->render('404');
        }

        $title = ($this->lang == 'en' ? $page['title_en'] : $page['title_fr']);

        $this->render('page', [
            'page' => $page,
            'seo' => [
                'title' => "$title | WeatherCA.net",
                'description' => $title,
                'canonical' => "{$this->config['site']['url']}/{$slug}"
            ]
        ]);
    }

    public function contact() {
        $this->render('contact', [
            'seo' => [
                'title' => ($this->lang == 'en' ? 'Contact Us' : 'Contactez-nous') . ' | WeatherCA.net',
                'canonical' => "{$this->config['site']['url']}/contact"
            ]
        ]);
    }
}
