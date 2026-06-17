<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ContentController extends BaseController {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['admin_logged_in'])) {
            header("Location: /" . $this->config['site']['admin_path'] . "/login");
            exit;
        }
    }

    public function blog() {
        $stmt = $this->db->query("SELECT p.*, c.name_en as cat_name FROM blog_posts p LEFT JOIN blog_categories c ON p.category_id = c.id ORDER BY p.created_at DESC");
        $posts = $stmt->fetchAll();
        $this->render('admin/blog/index', ['posts' => $posts], 'admin');
    }

    public function blog_create() {
        $categories = $this->db->query("SELECT * FROM blog_categories")->fetchAll();
        $this->render('admin/blog/form', ['categories' => $categories], 'admin');
    }

    public function guides() {
        $guides = $this->db->query("SELECT * FROM guides ORDER BY id DESC")->fetchAll();
        $this->render('admin/guides/index', ['guides' => $guides], 'admin');
    }
}
