<?php
// app/controllers/AuthController.php
namespace App\Controllers;

use Core\Database;

class AuthController extends Controller {
    public function loginForm() {
        $this->view('auth/login', [], 'layout');
    }

    public function login() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $db = Database::getInstance()->getConnection();
        
        // VULNERABILITY: SQL Injection (Auth Bypass)
        // This query is intentionally insecure to allow for training (Payload: admin' OR '1'='1)
        $sql = "SELECT * FROM users WHERE username = '$username' AND password_hash = '$password'";
        $stmt = $db->query($sql);
        $user = $stmt->fetch();
        
        // STRICT CHECK: Only allow if the query actually returns a valid user from our mock DB
        if ($user && isset($user['username'])) {
            // Predictable Session ID for training purposes
            $token = base64_encode(json_encode(['id' => $user['id'], 'role' => $user['role'], 'username' => $user['username']]));
            setcookie('auth_token', $token, time() + 3600, '/');
            $_SESSION['user'] = $user;
            header('Location: /');
            exit;
        }
        
        $this->view('auth/login', ['error' => 'Invalid credentials. Unauthorized access attempt logged.'], 'layout');
    }

    public function registerForm() {
        $this->view('auth/register', [], 'layout');
    }

    public function register() {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $db = Database::getInstance()->getConnection();
        
        // VULNERABILITY: No Check for Existing User (Business Logic)
        // VULNERABILITY: Stored XSS in username
        // VULNERABILITY: Insecure Direct Object Reference (returning ID)
        
        $sql = "INSERT INTO users (username, email, password_hash, role) VALUES ('$username', '$email', '$password', 'customer')";
        $db->query($sql);
        
        $this->view('auth/login', ['success' => 'Registration successful! You can now login.'], 'layout');
    }

    public function logout() {
        setcookie('auth_token', '', time() - 3600, '/');
        session_destroy();
        header('Location: /');
        exit;
    }

    // ─── FORGOT PASSWORD: VULNERABILITY — Host Header Injection ───
    // Generates a reset link using the Host header without validation.
    public function forgotPasswordForm() {
        $this->view('auth/forgot', [], 'layout');
    }

    public function forgotPassword() {
        $email = $_POST['email'] ?? '';
        
        // VULNERABILITY: Host Header Injection via X-Forwarded-Host
        // The application blindly trusts the X-Forwarded-Host header (common behind proxies like Render).
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'] ?? $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
        $resetToken = bin2hex(random_bytes(16));
        $resetLink = "http://" . $host . "/reset-password?token=" . $resetToken;
        
        // In a real app, this would be emailed. Here we display it for training.
        $this->view('auth/forgot_success', [
            'email' => $email,
            'reset_link' => $resetLink
        ], 'layout');
    }
}
