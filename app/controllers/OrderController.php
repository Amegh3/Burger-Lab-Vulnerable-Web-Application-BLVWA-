<?php
// app/controllers/OrderController.php
namespace App\Controllers;

use Core\Database;

class OrderController extends Controller
{

    public function index()
    {
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
    public function search()
    {
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
            if ($difficulty === 'soft_bun') {
                // Soft Bun (Easy): Direct unescaped concatenation.
                // Payload: ' UNION SELECT 1,username,password_hash,email,5,6,7 FROM users-- -
                $sql = "SELECT * FROM orders WHERE burger_name LIKE '%" . $queryParam . "%'";
                $stmt = $db->query($sql);
                $results = $stmt->fetchAll();
            } elseif ($difficulty === 'grilled_bun') {
                // Grilled Bun (Medium): Simple addslashes, can be bypassed if encoding issues or just use boolean blind if not fully protected.
                // Actually, let's use a weak filter. Removing 'UNION' or 'SELECT'
                $queryParam = preg_replace('/UNION|SELECT/i', '', $queryParam);
                $sql = "SELECT * FROM orders WHERE burger_name LIKE '%" . $queryParam . "%'";
                $stmt = $db->query($sql);
                $results = $stmt->fetchAll();
            } elseif ($difficulty === 'burnt_bun') {
                // Burnt Bun (Hard): Strict WAF simulation. Block common keywords and spaces.
                if (preg_match('/UNION|SELECT|OR|AND|--|#|\s/i', $queryParam)) {
                    throw new \Exception("WAF Alert: Malicious payload detected!");
                }
                $sql = "SELECT * FROM orders WHERE burger_name LIKE '%" . $queryParam . "%'";
                $stmt = $db->query($sql);
                $results = $stmt->fetchAll();
            } else {
                // Black Hole Burger (Impossible / Secure): Prepared Statements
                $sql = "SELECT * FROM orders WHERE burger_name LIKE ?";
                $stmt = $db->prepare($sql);
                $stmt->execute(['%' . $queryParam . '%']);
                $results = $stmt->fetchAll();
            }
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

    public function store()
    {
        // ... vulnerable insert logic could go here
    }

    public function apiIndex()
    {
        // ...
    }

    public function apiTrack()
    {
        // ...
    }
}
