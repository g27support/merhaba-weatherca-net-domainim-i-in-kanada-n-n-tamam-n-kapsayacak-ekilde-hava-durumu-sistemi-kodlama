<?php
namespace App\Controllers;

use App\Core\Database;

class BaseController {
    protected $db;
    protected $config;
    protected $lang;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->config = require __DIR__ . '/../../config/config.php';
        
        // Language detection logic
        $uri = $_SERVER['REQUEST_URI'];
        $lang = $this->config['default_lang'];

        if (strpos($uri, '/fr/') === 0 || $uri === '/fr') {
            $lang = 'fr';
        } elseif (isset($_SESSION['lang'])) {
            $lang = $_SESSION['lang'];
        }

        $this->lang = $lang;
        $_SESSION['lang'] = $lang;
        \App\Core\Lang::load($lang);
    }

    protected function render(string $view, array $data = [], string $layout = 'main') {
        extract($data);
        $lang = $this->lang;
        $config = $this->config;
        
        // Start buffering for content
        ob_start();
        include __DIR__ . "/../../views/{$view}.php";
        $content = ob_get_clean();

        // Render layout
        ob_start();
        include __DIR__ . "/../../views/layouts/{$layout}.php";
        $output = ob_get_clean();

        // Save to cache if enabled and it's a public layout
        if ($layout === 'main' && !isset($_SESSION['admin_logged_in'])) {
            \App\Core\Cache::set($_SERVER['REQUEST_URI'] . '_' . $this->lang, $output);
        }

        echo $output;
    }

    protected function sanitize($data) {
        if (is_array($data)) {
            return array_map([$this, 'sanitize'], $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}
