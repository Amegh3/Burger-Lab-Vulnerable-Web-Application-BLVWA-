<?php
// app/controllers/NotificationController.php
namespace App\Controllers;

class NotificationController extends Controller {

    // ─── NOTIFICATIONS: VULNERABILITY — IDOR + Stored XSS ───
    public function index() {
        // VULNERABILITY: IDOR — user_id from URL, no ownership check
        $userId = $_GET['user_id'] ?? ($_SESSION['user']['id'] ?? 1);
        
        // Simulate notifications with some containing XSS
        $defaultNotifications = [
            ['id' => 1, 'user_id' => 1, 'message' => '🎉 Welcome to Burger Labs! Your account is ready.', 'is_read' => true, 'date' => 'May 05'],
            ['id' => 2, 'user_id' => 1, 'message' => '🍔 Your order #BL-1001 is out for delivery!', 'is_read' => true, 'date' => 'May 06'],
            ['id' => 3, 'user_id' => 1, 'message' => '💰 ₹50 bonus added to your wallet.', 'is_read' => false, 'date' => 'May 07'],
            ['id' => 4, 'user_id' => 2, 'message' => '🔑 Password reset requested. If not you, contact support.', 'is_read' => false, 'date' => 'May 08'],
            ['id' => 5, 'user_id' => 2, 'message' => '📦 Order #BL-2001 delivered. Rate your experience!', 'is_read' => false, 'date' => 'May 08'],
        ];

        $custom = $_SESSION['notifications'] ?? [];
        $all = array_merge($defaultNotifications, $custom);
        
        // Filter by user_id (but IDOR lets you see anyone's)
        $filtered = array_filter($all, function($n) use ($userId) {
            return $n['user_id'] == $userId;
        });

        $this->view('notifications/index', [
            'notifications' => array_values($filtered),
            'user_id'       => $userId
        ], 'layout');
    }

    // ─── SEND NOTIFICATION: VULNERABILITY — Stored XSS ───
    public function send() {
        $userId  = $_POST['user_id'] ?? 1;
        $message = $_POST['message'] ?? '';

        // VULNERABILITY: Stored XSS — message stored raw
        if (!isset($_SESSION['notifications'])) {
            $_SESSION['notifications'] = [];
        }
        $_SESSION['notifications'][] = [
            'id'      => rand(100, 999),
            'user_id' => $userId,
            'message' => $message, // NO SANITIZATION
            'is_read' => false,
            'date'    => date('M d')
        ];

        header('Location: /notifications?user_id=' . $userId);
        exit;
    }
}
