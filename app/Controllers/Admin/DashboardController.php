<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController {
    
    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['admin_logged_in'])) {
            header("Location: /" . $this->config['site']['admin_path'] . "/login");
            exit;
        }
    }

    public function index() {
        $cityCount = $this->db->query("SELECT COUNT(*) FROM cities")->fetchColumn();
        $articleCount = $this->db->query("SELECT COUNT(*) FROM blog_posts")->fetchColumn();
        $guideCount = $this->db->query("SELECT COUNT(*) FROM guides")->fetchColumn();

        $this->render('admin/dashboard', [
            'stats' => [
                'cities' => $cityCount,
                'articles' => $articleCount,
                'guides' => $guideCount
            ]
        ], 'admin');
    }
}
