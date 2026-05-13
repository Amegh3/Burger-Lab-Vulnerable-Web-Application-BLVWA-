<?php
// app/controllers/WalletController.php
namespace App\Controllers;

use Core\Database;

class WalletController extends Controller {

    // ─── WALLET DASHBOARD ───
    public function index() {
        $balance = $_SESSION['user']['wallet_balance'] ?? 50.00;
        $transactions = $_SESSION['wallet_transactions'] ?? [];

        $this->view('wallet/index', [
            'balance'      => $balance,
            'transactions' => $transactions
        ], 'layout');
    }

    // ─── TOP UP: VULNERABILITY — Price Tampering & Logic Flaws ───
    // Now requires a "Simulated Payment" which can be tampered with.
    public function topup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = (float)($_POST['amount'] ?? 0);
            $plan   = $_POST['plan_id'] ?? 'standard';
            
            // Simulation of a payment gateway redirect
            $this->view('wallet/pay', [
                'amount' => $amount,
                'plan'   => $plan
            ], 'layout');
            return;
        }
        $this->view('wallet/topup', [], 'layout');
    }

    public function verifyPayment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // VULNERABILITY: Blindly trusting the 'paid_amount' from the client-side POST.
            // A user can change the hidden field 'paid_amount' to a massive value,
            // or even use a negative value if the logic is flawed.
            $paidAmount = (float)($_POST['paid_amount'] ?? 0);
            $status = $_POST['status'] ?? 'failed';

            if ($status === 'success') {
                $_SESSION['user']['wallet_balance'] = 
                    ($_SESSION['user']['wallet_balance'] ?? 50.00) + $paidAmount;

                // Log transaction
                $_SESSION['wallet_transactions'][] = [
                    'type'   => 'topup',
                    'amount' => $paidAmount,
                    'date'   => date('M d, H:i'),
                    'note'   => 'Artisanal Lab Top-up (Verified)'
                ];
                
                header('Location: /wallet?success=Payment+Verified');
                exit;
            }
        }
        header('Location: /wallet?error=Payment+Failed');
    }

    // ─── TRANSFER: VULNERABILITY — IDOR + Negative Transfer + Race Condition ───
    public function transfer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $toUserId = $_POST['to_user_id'] ?? '';
            $amount   = (float)($_POST['amount'] ?? 0);
            $balance  = $_SESSION['user']['wallet_balance'] ?? 50.00;

            // VULNERABILITY 1: No proper recipient validation (IDOR)
            // VULNERABILITY 2: Negative amount → steals from recipient
            // VULNERABILITY 3: No atomic operation → race condition
            
            // Simulate a slight delay (makes race condition exploitable)
            usleep(100000); // 100ms
            
            // Check balance (but race condition means parallel requests bypass this)
            if ($amount > $balance && $amount > 0) {
                $this->view('wallet/transfer', [
                    'error' => "Insufficient balance. You have ₹" . number_format($balance, 2)
                ], 'layout');
                return;
            }

            // Deduct from sender
            $_SESSION['user']['wallet_balance'] -= $amount;

            // Log transaction
            $_SESSION['wallet_transactions'][] = [
                'type'   => 'transfer',
                'amount' => -$amount,
                'to'     => $toUserId,
                'date'   => date('M d, H:i'),
                'note'   => "Transfer to User #$toUserId"
            ];

            $this->view('wallet/transfer_success', [
                'amount'  => $amount,
                'to_user' => $toUserId,
                'balance' => $_SESSION['user']['wallet_balance']
            ], 'layout');
            return;
        }

        $this->view('wallet/transfer', [], 'layout');
    }

    // ─── API: Balance Check — VULNERABILITY: IDOR ───
    public function apiBalance() {
        // VULNERABILITY: Any user can check any user's balance
        $userId = $_GET['uid'] ?? ($_SESSION['user']['id'] ?? 1);
        $db = Database::getInstance()->getConnection();
        
        $sql = "SELECT * FROM users WHERE id = '$userId'";
        $stmt = $db->query($sql);
        $user = $stmt->fetch();

        $this->json([
            'user_id' => $userId,
            'username' => $user['username'] ?? 'Unknown',
            'balance' => $user['wallet_balance'] ?? 0,
            // VULNERABILITY: Excessive data exposure
            'email' => $user['email'] ?? '',
            'role' => $user['role'] ?? '',
            'api_key' => 'blvwa_' . md5($userId . 'burger_secret')
        ]);
    }
}
