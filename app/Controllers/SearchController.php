<?php
namespace App\Controllers;

class SearchController extends BaseController {
    public function api() {
        $query = $_GET['q'] ?? '';
        if (strlen($query) < 2) {
            echo json_encode([]);
            return;
        }

        $stmt = $this->db->prepare("
            SELECT c.name_en, c.name_fr, c.slug as city_slug, p.slug as province_slug, p.code as province_code
            FROM cities c 
            JOIN provinces p ON c.province_id = p.id 
            WHERE c.name_en LIKE ? OR c.name_fr LIKE ? 
            LIMIT 10
        ");
        $stmt->execute(["%$query%", "%$query%"]);
        $results = $stmt->fetchAll();

        header('Content-Type: application/json');
        echo json_encode($results);
    }
}
