<?php
// core/Auth.php
namespace Core;

class Auth {
    // Intentional Auth Vulnerabilities
    // - JWT without signature validation
    // - Predictable Session IDs
    // - Hardcoded credentials
    
    public static function check() {
        // Vulnerable implementation: trusts user input cookie directly
        if (isset($_COOKIE['auth_token']) && $_COOKIE['auth_token'] === 'admin_token') {
            return true;
        }
        return false;
    }

    public static function login($username, $password) {
        $db = Database::getInstance()->getConnection();
        
        // Vulnerable to SQLi if not using prepared statements, 
        // but let's say this one is secure, to force them to find the other ones.
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Generate vulnerable token
            $token = base64_encode(json_encode(['id' => $user['id'], 'role' => $user['role']]));
            setcookie('auth_token', $token, time() + 3600, '/');
            return true;
        }
        return false;
    }
}
