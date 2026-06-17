<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SettingsController extends BaseController {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['admin_logged_in'])) {
            header("Location: /" . $this->config['site']['admin_path'] . "/login");
            exit;
        }
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $settings = $_POST['settings'] ?? [];
            foreach ($settings as $key => $value) {
                $stmt = $this->db->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?, updated_at = CURRENT_TIMESTAMP");
                $stmt->execute([$key, $value, $value]);
            }
            $success = "Settings updated successfully.";
        }

        $res = $this->db->query("SELECT * FROM settings")->fetchAll();
        $settings = [];
        foreach ($res as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }

        $this->render('admin/settings', [
            'settings' => $settings,
            'success' => $success ?? null
        ], 'admin');
    }
}
