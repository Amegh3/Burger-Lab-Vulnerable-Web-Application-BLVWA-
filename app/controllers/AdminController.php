<?php
// app/controllers/AdminController.php
namespace App\Controllers;

use Core\Database;

class AdminController extends Controller {

    // ─── ADMIN PORTAL ───
    public function secretPortal() {
        $this->view('admin/portal', [], 'layout');
    }

    // ─── NETWORK DIAGNOSTICS: VULNERABILITY — RCE ───
    public function networkDiagnostics() {
        $host = $_POST['host'] ?? '';
        $output = '';
        
        if ($host) {
            // VULNERABILITY: OS Command Injection
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $output = shell_exec("ping " . $host);
            } else {
                $output = shell_exec("ping -c 4 " . $host);
            }
        }

        $this->view('admin/diagnostics', ['output' => $output, 'host' => $host], 'layout');
    }

    // ─── USER MANAGEMENT: VULNERABILITY — BOLA + Mass Assignment ───
    public function users() {
        $db = Database::getInstance()->getConnection();
        $users = $db->query("SELECT * FROM users")->fetchAll();
        
        $this->view('admin/users', ['users' => $users], 'layout');
    }

    // ─── SYSTEM LOGS: VULNERABILITY — LFI + Log Injection ───
    public function logs() {
        $logFile = $_GET['file'] ?? 'access.log';
        $logContent = '';

        // VULNERABILITY: LFI — path traversal via file parameter
        // Payload: ?file=../../../etc/passwd
        $logDir = __DIR__ . '/../../storage/logs/';
        $fullPath = $logDir . $logFile;
        
        if (file_exists($fullPath)) {
            $logContent = file_get_contents($fullPath);
        } else {
            // Simulate log content with injected entries
            $logContent = "[2026-05-08 10:00:01] INFO: Server started successfully\n";
            $logContent .= "[2026-05-08 10:00:15] INFO: Database connection established\n";
            $logContent .= "[2026-05-08 10:01:22] WARN: Rate limit threshold approaching for IP 192.168.1.45\n";
            $logContent .= "[2026-05-08 10:05:00] INFO: User 'admin' logged in from 10.0.0.1\n";
            $logContent .= "[2026-05-08 10:12:33] ERROR: Failed login attempt for user 'root' from 203.0.113.5\n";
            $logContent .= "[2026-05-08 10:15:00] INFO: Backup job completed — /storage/backups/db_dump_2026.sql.gz\n";
            $logContent .= "[2026-05-08 10:20:44] WARN: Unusual query pattern detected on /orders/search\n";
            $logContent .= "[2026-05-08 10:30:00] INFO: Cache cleared by admin\n";
            
            // VULNERABILITY: Log Injection — if a username contained \n, it appears here
            if (isset($_GET['inject'])) {
                $logContent .= $_GET['inject'];
            }
        }

        $this->view('admin/logs', [
            'log_content' => $logContent,
            'log_file'    => $logFile
        ], 'layout');
    }

    // ─── DATA EXPORT: VULNERABILITY — XXE ───
    public function export() {
        $result = '';
        $xmlInput = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $xmlInput = $_POST['xml_data'] ?? '';
            
            if ($xmlInput) {
                // VULNERABILITY: XXE — XML External Entity Injection
                // libxml_disable_entity_loader is NOT called
                $doc = new \DOMDocument();
                $doc->loadXML($xmlInput, LIBXML_NOENT | LIBXML_DTDLOAD);
                $result = $doc->textContent ?? 'Parsed successfully.';
            }
        }

        $this->view('admin/export', [
            'result'    => $result,
            'xml_input' => $xmlInput
        ], 'layout');
    }

    // ─── BACKUP: VULNERABILITY — Exposed Archives ───
    public function backup() {
        $backups = [
            ['name' => 'db_dump_2026-05-01.sql.gz', 'size' => '2.4 MB', 'date' => 'May 01, 2026'],
            ['name' => 'db_dump_2026-04-15.sql.gz', 'size' => '2.1 MB', 'date' => 'Apr 15, 2026'],
            ['name' => 'full_backup_2026-03-01.tar.gz', 'size' => '48 MB', 'date' => 'Mar 01, 2026'],
        ];
        
        $this->view('admin/backup', ['backups' => $backups], 'layout');
    }

    // ─── ANALYTICS: VULNERABILITY — SSTI ───
    public function analytics() {
        $template = $_GET['report'] ?? 'Monthly Sales Summary';
        $output = '';
        
        // VULNERABILITY: Server-Side Template Injection
        // If user sends {{7*7}}, it evaluates
        if (preg_match('/\{\{(.+?)\}\}/', $template, $matches)) {
            try {
                $output = eval("return " . $matches[1] . ";");
            } catch (\Throwable $e) {
                $output = "Template Error: " . $e->getMessage();
            }
        }
        
        $this->view('admin/analytics', [
            'template' => $template,
            'output'   => $output
        ], 'layout');
    }
}
