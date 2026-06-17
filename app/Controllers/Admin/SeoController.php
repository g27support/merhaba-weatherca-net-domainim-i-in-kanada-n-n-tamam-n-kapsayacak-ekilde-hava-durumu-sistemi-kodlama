<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SeoController extends BaseController {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['admin_logged_in'])) {
            header("Location: /" . $this->config['site']['admin_path'] . "/login");
            exit;
        }
    }

    public function redirects() {
        $redirects = $this->db->query("SELECT * FROM redirects ORDER BY id DESC")->fetchAll();
        $this->render('admin/seo/redirects', ['redirects' => $redirects], 'admin');
    }

    public function add_redirect() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = $_POST['old_url'] ?? '';
            $new = $_POST['new_url'] ?? '';
            $code = (int)($_POST['http_code'] ?? 301);

            if ($old && $new) {
                $stmt = $this->db->prepare("INSERT INTO redirects (old_url, new_url, http_code) VALUES (?, ?, ?)");
                $stmt->execute([$old, $new, $code]);
                header("Location: /" . $this->config['site']['admin_path'] . "/seo/redirects");
                exit;
            }
        }
    }

    public function delete_redirect(int $id) {
        $stmt = $this->db->prepare("DELETE FROM redirects WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: /" . $this->config['site']['admin_path'] . "/seo/redirects");
        exit;
    }
}
