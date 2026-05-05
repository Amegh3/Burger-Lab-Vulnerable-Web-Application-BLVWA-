<?php
// app/controllers/AdminController.php
namespace App\Controllers;

class AdminController extends Controller {
    public function secretPortal() {
        // High-level security hub for advanced training
        $this->view('admin/portal', [], 'layout');
    }

    public function networkDiagnostics() {
        $host = $_POST['host'] ?? '';
        $output = '';
        
        if ($host) {
            // VULNERABILITY #10: OS Command Injection
            // Simulating a vulnerable ping tool
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $output = shell_exec("ping " . $host);
            } else {
                $output = shell_exec("ping -c 4 " . $host);
            }
        }

        $this->view('admin/diagnostics', ['output' => $output, 'host' => $host], 'layout');
    }
}
