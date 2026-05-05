<?php
// app/controllers/CartController.php
namespace App\Controllers;

class CartController extends Controller {
    public function add() {
        $itemId = $_POST['item_id'] ?? 0;
        $quantity = (int)($_POST['quantity'] ?? 1);
        $price = (float)($_POST['price'] ?? 0);
        $name = $_POST['item_name'] ?? 'Unknown Item';

        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

        if (isset($_SESSION['cart'][$name])) {
            $_SESSION['cart'][$name]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$name] = ['quantity' => $quantity, 'price' => $price];
        }

        $this->json(['status' => 'success', 'cart_count' => count($_SESSION['cart'])]);
    }

    public function index() {
        $this->view('cart/index', ['cart' => $_SESSION['cart'] ?? []], 'layout');
    }

    public function checkout() {
        if (empty($_SESSION['cart'])) {
            header('Location: /menu');
            exit;
        }
        $this->view('cart/checkout', [], 'layout');
    }

    public function payment() {
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $total = $subtotal + 40;

        $this->view('cart/payment', [
            'total_amount' => $total,
            'address' => $_POST['address'] ?? 'N/A'
        ], 'layout');
    }

    public function pay() {
        // VULNERABILITY: Price Tampering
        $amount = (float)($_POST['amount'] ?? 0);
        $cardNumber = str_replace(' ', '', $_POST['card_number'] ?? '');
        
        // --- NEW "STRICT" SECURITY LOGIC ---
        // We now only allow the "Official Lab Testing Card"
        $validCard = "4242424242424242"; // Common stripe test card, but here it's our "only" valid card
        
        // VULNERABILITY 66: Logic Flaw - The "Free Order" Bypass
        // If the amount is 0 or less, the system assumes it's a promotional/free order 
        // and skips the credit card gateway entirely!
        if ($amount <= 0) {
             return $this->processOrder(0, "BYPASS_VULN_EXPLOITED");
        }

        // VULNERABILITY 67: Logic Flaw - Trusted Status Parameter
        // If an attacker adds 'status=SUCCESS' to the POST request, the card check is ignored.
        if (isset($_POST['status']) && $_POST['status'] === 'SUCCESS') {
             return $this->processOrder($amount, "STATUS_INJECTION_VULN");
        }

        // Standard payment path - now "impossible" to pass with random 16 digits
        if ($cardNumber !== $validCard) {
            // Force re-calculation for the view but keep the "fraud" error
            $subtotal = 0;
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) $subtotal += $item['price'] * $item['quantity'];
            }
            $this->view('cart/payment', [
                'error' => '❌ PAYMENT DECLINED: High Fraud Risk Detected. Your card has been flagged.',
                'total_amount' => $subtotal + 40
            ], 'layout');
            return;
        }

        return $this->processOrder($amount, "VALID_CARD_PAYMENT");
    }

    private function processOrder($amount, $method) {
        // Create a realistic Order ID
        $orderId = "BL-" . rand(10000, 99999);
        $_SESSION['last_order_id'] = $orderId;
        $_SESSION['last_order_amount'] = $amount;
        $_SESSION['cart'] = []; // Clear cart
        
        header('Location: /checkout/success');
        exit;
    }

    public function success() {
        $amount = $_SESSION['last_order_amount'] ?? 0;
        $orderId = $_SESSION['last_order_id'] ?? 'N/A';
        $this->view('cart/success', ['amount' => $amount, 'order_id' => $orderId], 'layout');
    }
}
