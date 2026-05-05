<?php
// app/controllers/Controller.php
namespace App\Controllers;

class Controller {
    public function __construct() {
        // Enforce login for all pages except the login and register routes
        $current_uri = $_SERVER['REQUEST_URI'];
        $is_auth_route = (strpos($current_uri, '/login') !== false || strpos($current_uri, '/register') !== false);
        
        if (!$is_auth_route && !isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }

    protected function view($view, $data = [], $layout = 'layout') {
        extract($data);
        require_once __DIR__ . "/../views/{$layout}.php";
    }

    protected function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
