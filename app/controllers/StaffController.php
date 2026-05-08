<?php
// app/controllers/StaffController.php
namespace App\Controllers;

use Core\Database;

class StaffController extends Controller {

    // ─── STAFF DASHBOARD ───
    // VULNERABILITY: No role check — any logged-in user can access
    public function dashboard() {
        $db = Database::getInstance()->getConnection();
        $orders = $db->query("SELECT * FROM orders")->fetchAll();
        $products = $db->query("SELECT * FROM products")->fetchAll();

        $this->view('staff/dashboard', [
            'orders'   => $orders,
            'products' => $products
        ], 'layout');
    }

    // ─── INVENTORY: VULNERABILITY — Negative Stock Manipulation ───
    public function inventory() {
        $products = [];
        $db = Database::getInstance()->getConnection();
        $products = $db->query("SELECT * FROM products")->fetchAll();
        
        // Add stock field
        foreach ($products as &$p) {
            $p['stock'] = $_SESSION['inventory'][$p['id']] ?? 100;
        }

        $this->view('staff/inventory', ['products' => $products], 'layout');
    }

    public function updateStock() {
        $productId = $_POST['product_id'] ?? '';
        $newStock   = (int)($_POST['stock'] ?? 0);
        
        // VULNERABILITY: Negative stock accepted → unlimited items
        if (!isset($_SESSION['inventory'])) {
            $_SESSION['inventory'] = [];
        }
        $_SESSION['inventory'][$productId] = $newStock;

        header('Location: /staff/inventory');
        exit;
    }

    // ─── REFUNDS: VULNERABILITY — Double Refund (Race Condition) ───
    public function refunds() {
        $refunds = $_SESSION['processed_refunds'] ?? [];
        $this->view('staff/refunds', ['refunds' => $refunds], 'layout');
    }

    public function processRefund() {
        $orderId = $_POST['order_id'] ?? '';
        $amount  = (float)($_POST['amount'] ?? 0);

        // VULNERABILITY: No duplicate check → submit twice = double refund
        // VULNERABILITY: Race condition — no locking mechanism
        usleep(200000); // 200ms delay makes race condition exploitable
        
        if (!isset($_SESSION['processed_refunds'])) {
            $_SESSION['processed_refunds'] = [];
        }

        $_SESSION['processed_refunds'][] = [
            'order_id' => $orderId,
            'amount'   => $amount,
            'date'     => date('M d, H:i'),
            'ref_id'   => 'REF-' . rand(10000, 99999)
        ];

        // Credit wallet
        $_SESSION['user']['wallet_balance'] = 
            ($_SESSION['user']['wallet_balance'] ?? 0) + $amount;

        $this->json([
            'status'  => 'success',
            'message' => "Refund of ₹$amount processed for order $orderId",
            'new_balance' => $_SESSION['user']['wallet_balance']
        ]);
    }
}
