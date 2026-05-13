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
            $userId = $_SESSION['user']['id'] ?? 1;
            
            // --- UNRESTRICTED FILE UPLOAD VULNERABILITY ---
            // No extension check, no MIME check. Allows uploading .php files.
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                
                $fileName = basename($_FILES['avatar']['name']);
                $uploadFile = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                    // Update user's avatar path in DB
                    $avatarPath = '/uploads/' . $fileName;
                    $db->query("UPDATE users SET avatar = '$avatarPath' WHERE id = '$userId'");
                    $_SESSION['user']['avatar'] = $avatarPath;
                }
            }

            // VULNERABILITY: Mass Assignment — all POST fields accepted
            $fields = [];
            foreach ($_POST as $key => $value) {
                // Skip if it's not a valid field or just a placeholder
                if ($key === 'avatar' || empty($key)) continue;
                $fields[] = "$key = '$value'";
            }
            
            if (!empty($fields)) {
                $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = '$userId'";
                $db->query($sql);

                // Update session
                foreach ($_POST as $key => $value) {
                    if (isset($_SESSION['user'][$key])) {
                        $_SESSION['user'][$key] = $value;
                    }
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

    // --- SIMULATED WP-JSON USER ENUMERATION ---
    public function apiWordPressUsers() {
        $db = Database::getInstance()->getConnection();
        $users = $db->query("SELECT id, username, email FROM users")->fetchAll();
        
        $wpUsers = [];
        foreach ($users as $user) {
            $wpUsers[] = [
                'id' => $user['id'],
                'name' => $user['username'],
                'slug' => strtolower($user['username']),
                'link' => "http://127.0.0.1:8000/author/" . strtolower($user['username']),
                'description' => "Vulnerable Lab User",
            ];
        }
        
        header('Content-Type: application/json');
        echo json_encode($wpUsers);
        exit;
    }
}
