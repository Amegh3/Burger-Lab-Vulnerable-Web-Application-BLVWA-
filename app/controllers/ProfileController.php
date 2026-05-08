<?php
// app/controllers/ProfileController.php
namespace App\Controllers;

use Core\Database;

class ProfileController extends Controller {

    // ─── VIEW PROFILE: VULNERABILITY — IDOR ───
    // Any user can view any profile by changing the ID
    public function show() {
        $db = Database::getInstance()->getConnection();
        
        // VULNERABILITY: IDOR — user_id from URL, no ownership check
        $userId = $_GET['id'] ?? ($_SESSION['user']['id'] ?? 1);
        
        $sql = "SELECT * FROM users WHERE id = '$userId'";
        $stmt = $db->query($sql);
        $user = $stmt->fetch();

        $this->view('profile/show', [
            'profile' => $user,
            'is_own'  => ($userId == ($_SESSION['user']['id'] ?? 0))
        ], 'layout');
    }

    // ─── EDIT PROFILE: VULNERABILITY — Mass Assignment ───
    // Accepts ANY field from POST including 'role' and 'wallet_balance'
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = Database::getInstance()->getConnection();
            
            // VULNERABILITY: Mass Assignment — all POST fields accepted
            // Attacker can send role=admin or wallet_balance=99999
            $fields = [];
            foreach ($_POST as $key => $value) {
                $fields[] = "$key = '$value'";
            }
            $userId = $_SESSION['user']['id'] ?? 1;
            $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = '$userId'";
            $db->query($sql);

            // Simulate the update in session
            foreach ($_POST as $key => $value) {
                if (isset($_SESSION['user'][$key])) {
                    $_SESSION['user'][$key] = $value;
                }
            }
            // VULNERABILITY: If role was sent, update session role too
            if (isset($_POST['role'])) {
                $_SESSION['user']['role'] = $_POST['role'];
                // Re-encode the auth token with new role
                $token = base64_encode(json_encode([
                    'id' => $_SESSION['user']['id'],
                    'role' => $_POST['role'],
                    'username' => $_SESSION['user']['username']
                ]));
                setcookie('auth_token', $token, time() + 3600, '/');
            }

            header('Location: /profile?id=' . $userId);
            exit;
        }

        $this->view('profile/edit', [
            'user' => $_SESSION['user'] ?? []
        ], 'layout');
    }
}
