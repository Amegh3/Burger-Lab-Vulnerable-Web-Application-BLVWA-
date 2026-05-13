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
            // VULNERABILITY: The 'gateway_signature' is used to verify the payment.
            // However, the signature is just an MD5 hash of the amount!
            // A "normal" user will fail because the gateway doesn't provide a signature.
            // An "attacker" will calculate md5(amount) and bypass the payment.
            
            $paidAmount = (float)($_POST['paid_amount'] ?? 0);
            $status = $_POST['status'] ?? 'failed';
            $signature = $_POST['gateway_signature'] ?? '';

            // The " Artisanal Secret" is actually just the amount itself.
            $expectedSignature = md5($paidAmount);

            if ($status === 'success' && $signature === $expectedSignature) {
                $_SESSION['user']['wallet_balance'] = 
                    ($_SESSION['user']['wallet_balance'] ?? 50.00) + $paidAmount;

                // Log transaction
                $_SESSION['wallet_transactions'][] = [
                    'type'   => 'topup',
                    'amount' => $paidAmount,
                    'date'   => date('M d, H:i'),
                    'note'   => 'Secure Gateway Top-up (Verified via Signature)'
                ];
                
                header('Location: /wallet?success=Payment+Verified+via+Signature');
                exit;
            } else {
                // Default state: Always fail for non-exploiters
                $reason = ($signature !== $expectedSignature) ? "Invalid Gateway Signature" : "Transaction Refused";
                header('Location: /wallet?error=' . urlencode($reason));
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
