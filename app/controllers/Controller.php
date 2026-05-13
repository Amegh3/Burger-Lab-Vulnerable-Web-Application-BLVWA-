<?php
// app/controllers/Controller.php
namespace App\Controllers;

class Controller {
    public function __construct() {
        // PROTECTION REMOVED: 100% Vulnerable Mode Enabled.
        // Authentication is no longer required to access internal pages.
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
