<?php
// core/Logger.php
namespace Core;

class Logger {
    public static function logPayload($module, $payload) {
        // Payload Logging System
        // Logs all user inputs for the Attack Analytics Dashboard
        
        $db = Database::getInstance()->getConnection();
        
        // Let's pretend there's an exploit_logs table
        $sql = "INSERT INTO exploit_recipes (user_id, recipe_name, payload, target_module) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        
        // Hardcoded user_id for demonstration (e.g. Neo)
        $stmt->execute([2, 'Auto-Logged Payload', $payload, $module]);
    }
    
    public static function logError($message) {
        $logFile = __DIR__ . '/../logs/error.log';
        $timestamp = date('Y-m-d H:i:s');
        file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
    }
}
