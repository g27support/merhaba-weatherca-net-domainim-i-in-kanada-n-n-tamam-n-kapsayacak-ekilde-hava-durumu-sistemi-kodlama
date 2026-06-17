<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class WeatherMonitorController extends BaseController {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['admin_logged_in'])) {
            header("Location: /" . $this->config['site']['admin_path'] . "/login");
            exit;
        }
    }

    public function index() {
        $stmt = $this->db->query("
            SELECT c.name_en, c.province_id, p.code as province_code, wc.updated_at,
                   TIMESTAMPDIFF(MINUTE, wc.updated_at, NOW()) as age_mins
            FROM cities c
            JOIN provinces p ON c.province_id = p.id
            LEFT JOIN weather_current wc ON c.id = wc.city_id
            ORDER BY wc.updated_at ASC
        ");
        $cities = $stmt->fetchAll();

        $this->render('admin/weather/monitor', ['cities' => $cities], 'admin');
    }
}
