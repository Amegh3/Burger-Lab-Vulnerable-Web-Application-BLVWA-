<?php
// app/controllers/Controller.php
namespace App\Controllers;

class Controller {
    public function __construct() {
        // Enforce login for all pages except auth routes and APIs
        $current_uri = $_SERVER['REQUEST_URI'];
        $public_routes = ['/login', '/register', '/api/', '/phpinfo', '/.env', '/robots.txt'];
        $is_public = false;
        foreach ($public_routes as $route) {
            if (strpos($current_uri, $route) !== false) {
                $is_public = true;
                break;
            }
        }
        
        if (!$is_public && !isset($_SESSION['user'])) {
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
