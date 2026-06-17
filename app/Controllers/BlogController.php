<?php
namespace App\Controllers;

class BlogController extends BaseController {
    
    public function index() {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name_en as cat_name_en, c.name_fr as cat_name_fr, c.slug as cat_slug 
            FROM blog_posts p 
            LEFT JOIN blog_categories c ON p.category_id = c.id 
            WHERE p.status = 'published' 
            ORDER BY p.created_at DESC
        ");
        $stmt->execute();
        $posts = $stmt->fetchAll();

        $title = ($this->lang == 'en' ? 'Canada Weather Blog' : 'Blogue Météo Canada');

        $this->render('blog/index', [
            'posts' => $posts,
            'seo' => [
                'title' => "$title | WeatherCA.net",
                'description' => $this->lang == 'en' ? 'Latest weather news, seasonal reports, and safety tips for Canada.' : 'Dernières nouvelles météo, rapports saisonniers et conseils de sécurité pour le Canada.',
                'canonical' => "{$this->config['site']['url']}/blog"
            ]
        ]);
    }

    public function post(string $slug) {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name_en as cat_name_en, c.name_fr as cat_name_fr, c.slug as cat_slug 
            FROM blog_posts p 
            LEFT JOIN blog_categories c ON p.category_id = c.id 
            WHERE p.slug = ? AND p.status = 'published'
        ");
        $stmt->execute([$slug]);
        $post = $stmt->fetch();

        if (!$post) {
            http_response_code(404);
            return $this->render('404');
        }

        $title = ($this->lang == 'en' ? $post['title_en'] : $post['title_fr']);

        $this->render('blog/post', [
            'post' => $post,
            'seo' => [
                'title' => "$title | WeatherCA.net",
                'description' => ($this->lang == 'en' ? $post['meta_desc_en'] : $post['meta_desc_fr']),
                'canonical' => "{$this->config['site']['url']}/blog/{$slug}",
                'image' => $post['featured_image'] ?? null,
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'BlogPosting',
                    'headline' => $title,
                    'image' => $post['featured_image'] ?? '',
                    'datePublished' => $post['created_at'],
                    'author' => [
                        '@type' => 'Organization',
                        'name' => 'WeatherCA.net'
                    ]
                ]
            ]
        ]);
    }
}
