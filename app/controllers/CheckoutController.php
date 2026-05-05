<?php
// app/controllers/CheckoutController.php
namespace App\Controllers;

use Core\Database;

class CheckoutController extends Controller {

    private function isLabMode() {
        return ($_SESSION['lab_mode'] ?? 'off') === 'on';
    }

    public function addressStep() {
        if (empty($_SESSION['cart'])) {
            header('Location: /menu');
            exit;
        }
        $this->view('checkout/address', [], 'layout');
    }

    public function deliveryStep() {
        $_SESSION['checkout_data']['address'] = $_POST;
        $this->view('checkout/delivery', [], 'layout');
    }

    public function paymentStep() {
        $_SESSION['checkout_data']['delivery'] = $_POST;
        
        // VULNERABILITY: Trusting URL parameter for total amount
        $serverTotal = $this->calculateTotal();
        $total = isset($_GET['total']) ? (float)$_GET['total'] : $serverTotal;
        
        // Wallet Persistence in Session
        if (!isset($_SESSION['wallet_balance'])) {
            $_SESSION['wallet_balance'] = 50.00;
        }

        // VULNERABILITY: Negative subtraction bug (The user wants this bug kept but with better logic for standard usage)
        if ($total < 0) {
            $_SESSION['wallet_balance'] -= $total; 
        }

        $this->view('checkout/payment', [
            'total_amount' => $total,
            'wallet_balance' => $_SESSION['wallet_balance'],
            'is_lab_mode' => $this->isLabMode()
        ], 'layout');
    }

    public function reviewStep() {
        $method = $_POST['method'] ?? 'Wallet';
        $total = isset($_GET['total']) ? (float)$_GET['total'] : $this->calculateTotal();
        
        $walletBalance = $_SESSION['wallet_balance'] ?? 50.00;

        if ($method === 'Wallet' && $total > $walletBalance) {
             // Standard Check: Only allow if balance is enough
             // BUT: If total is 1 or 2 (exploit), we allow it
             if ($total > 2) {
                 $this->view('checkout/payment', [
                    'error' => "❌ WALLET ERROR: Insufficient Balance (₹" . number_format($walletBalance, 2) . "). Please adjust your total or use a different method.",
                    'total_amount' => $total,
                    'wallet_balance' => $walletBalance,
                    'is_lab_mode' => $this->isLabMode()
                ], 'layout');
                return;
             }
        }

        // Rejection of manual details to force URL/Wallet exploit
        if ($method !== 'Wallet' && $method !== 'COD') {
             $this->view('checkout/payment', [
                'error' => '❌ SYSTEM ERROR: Secure Tunnel Busy. Please use BurgerLab Wallet or authorized bypass.',
                'total_amount' => $total,
                'wallet_balance' => $walletBalance,
                'is_lab_mode' => $this->isLabMode()
            ], 'layout');
            return;
        }

        $_SESSION['checkout_data']['payment_method'] = $method;
        $_SESSION['checkout_data']['total'] = $total;

        $this->view('checkout/review', [
            'cart' => $_SESSION['cart'] ?? [],
            'total' => $total,
            'address' => $_SESSION['checkout_data']['address'] ?? [],
            'payment_method' => $method
        ], 'layout');
    }

    public function confirmOrder() {
        $finalTotal = $_SESSION['checkout_data']['total'] ?? $this->calculateTotal();
        $method = $_SESSION['checkout_data']['payment_method'] ?? '';

        // Deduct from wallet if used
        if ($method === 'Wallet') {
            $_SESSION['wallet_balance'] -= $finalTotal;
        }

        $orderId = "BL-" . rand(100000, 999999);
        $_SESSION['last_order_id'] = $orderId;
        $_SESSION['last_order_amount'] = $finalTotal;
        $_SESSION['cart'] = [];
        unset($_SESSION['checkout_data']);

        header('Location: /checkout/success');
        exit;
    }

    public function successPage() {
        $this->view('checkout/success', [
            'order_id' => $_SESSION['last_order_id'] ?? 'N/A',
            'amount' => $_SESSION['last_order_amount'] ?? 0
        ], 'layout');
    }

    public function calculateTotal() {
        $subtotal = 0;
        if (!isset($_SESSION['cart'])) return 0;
        $db = Database::getInstance()->getConnection();
        $products = $db->query("SELECT * FROM products")->fetchAll();
        foreach ($_SESSION['cart'] as $name => $item) {
            foreach ($products as $p) {
                if ($p['name'] === $name) {
                    $subtotal += $p['price'] * $item['quantity'];
                    break;
                }
            }
        }
        return $subtotal;
    }
}
