<?php
namespace App\Services;

use App\Core\Database;

class RedirectService {
    public static function check() {
        $db = Database::getInstance();
        $uri = $_SERVER['REQUEST_URI'];
        
        $stmt = $db->prepare("SELECT * FROM redirects WHERE old_url = ?");
        $stmt->execute([$uri]);
        $redirect = $stmt->fetch();

        if ($redirect) {
            header("Location: " . $redirect['new_url'], true, $redirect['http_code']);
            exit;
        }
    }
}
