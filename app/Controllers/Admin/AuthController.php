<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Database;

class AuthController extends BaseController {
    
    public function login() {
        if (isset($_SESSION['admin_logged_in'])) {
            header("Location: /" . $this->config['site']['admin_path']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_POST['username'] ?? '';
            $pass = $_POST['password'] ?? '';

            $stmt = $this->db->prepare("SELECT * FROM admins WHERE username = ?");
            $stmt->execute([$user]);
            $admin = $stmt->fetch();

            // Simple check (in production use password_verify)
            if ($admin && $pass === $admin['password']) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user'] = $admin['username'];
                $_SESSION['admin_role'] = $admin['role'];
                
                header("Location: /" . $this->config['site']['admin_path']);
                exit;
            } else {
                $error = "Invalid credentials";
            }
        }

        $this->render('admin/login', ['error' => $error ?? null], 'admin_empty');
    }

    public function logout() {
        session_destroy();
        header("Location: /" . $this->config['site']['admin_path'] . "/login");
        exit;
    }
}
