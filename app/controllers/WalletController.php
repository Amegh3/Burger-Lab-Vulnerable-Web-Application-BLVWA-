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

    // ─── TOP UP: VULNERABILITY — Price Tampering ───
    // Amount comes from client-side, no server validation
    public function topup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // VULNERABILITY: Accepts any amount including negative
            $amount = (float)($_POST['amount'] ?? 0);
            
            $_SESSION['user']['wallet_balance'] = 
                ($_SESSION['user']['wallet_balance'] ?? 50.00) + $amount;

            // Log transaction
            $_SESSION['wallet_transactions'][] = [
                'type'   => 'topup',
                'amount' => $amount,
                'date'   => date('M d, H:i'),
                'note'   => 'Wallet Top-up'
            ];

            header('Location: /wallet');
            exit;
        }
        $this->view('wallet/topup', [], 'layout');
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
