<?php
// app/controllers/OrderController.php
namespace App\Controllers;

use Core\Database;

class OrderController extends Controller {

    public function index() {
        $orderId = $_GET['q'] ?? '';
        $db = Database::getInstance()->getConnection();
        $order = null;

        if ($orderId) {
            // Find order in mock DB (Vulnerable to SQLi)
            $sql = "SELECT * FROM orders WHERE id = '$orderId'";
            $stmt = $db->query($sql);
            $order = $stmt->fetch();
        }

        $this->view('orders/index', [
            'order' => $order,
            'order_id' => $orderId
        ], 'layout');
    }

    // Intentional SQL Injection Implementation
    public function search() {
        $queryParam = $_GET['q'] ?? '';
        $appConfig = require __DIR__ . '/../../config/app.php';
        $difficulty = $appConfig['vulnerabilities']['difficulty'] ?? 'medium';
        $vulnerable = $appConfig['vulnerabilities']['enabled'] ?? true;

        $db = Database::getInstance()->getConnection();
        $results = [];
        $error = null;

        if (!$vulnerable) {
            $difficulty = 'black_hole'; // Force secure if vulnerabilities disabled
        }

        try {
            // 100% VULNERABLE MODE: Direct unescaped concatenation. No WAF, No Protection.
            // Payload: ' UNION SELECT 1,username,password_hash,email,5,6,7 FROM users-- -
            $sql = "SELECT * FROM orders WHERE burger_name LIKE '%" . $queryParam . "%'";
            $stmt = $db->query($sql);
            $results = $stmt->fetchAll();
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        $this->view('orders/search', [
            'results' => $results,
            'query' => $queryParam,
            'error' => $error,
            'difficulty' => $difficulty
        ], 'layout');
    }

    public function store() {
        // ... vulnerable insert logic could go here
    }

    public function apiIndex() {
        // ...
    }

    public function apiTrack() {
        // ...
    }
}
