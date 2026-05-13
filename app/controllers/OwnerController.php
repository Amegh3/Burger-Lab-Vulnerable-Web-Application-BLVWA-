<?php
// app/controllers/OwnerController.php
namespace App\Controllers;

use Core\Database;

class OwnerController extends Controller {

    public function __construct() {
        parent::__construct();
        // VULNERABILITY: BFLA (Broken Function Level Authorization)
        // It checks if user is logged in (via parent), but if difficulty is NOT black_hole,
        // it fails to strictly enforce the 'owner' role check on some sub-pages.
        
        $appConfig = require __DIR__ . '/../../config/app.php';
        $difficulty = $appConfig['vulnerabilities']['difficulty'] ?? 'soft_bun';
        
        if ($difficulty === 'black_hole') {
            if (($_SESSION['user']['role'] ?? '') !== 'owner') {
                header('Location: /login');
                exit;
            }
        }
    }

    public function dashboard() {
        // VULNERABILITY: Even if difficulty is soft_bun, we might only show the page
        // but the actual sensitive data fetching should be where the BFLA lies.
        
        $db = Database::getInstance()->getConnection();
        $employees = $db->query("SELECT * FROM employees")->fetchAll();
        
        $this->view('owner/dashboard', [
            'employees' => $employees,
            'total_revenue' => "₹4,25,00,000",
            'expansion_plans' => "Opening 10 new molecular labs in Bangalore and Mumbai by Q4 2026."
        ], 'layout');
    }

    public function employeeDetails() {
        $id = $_GET['id'] ?? 1;
        $db = Database::getInstance()->getConnection();
        
        // VULNERABILITY: BFLA + IDOR
        // No strict role check here in soft_bun/grilled_bun mode
        $employees = $db->query("SELECT * FROM employees WHERE id = $id")->fetchAll();
        $employee = $employees[0] ?? null;

        $this->view('owner/employee_details', [
            'employee' => $employee
        ], 'layout');
    }

    public function updateSalary() {
        // VULNERABILITY: CSRF + BFLA
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            $newSalary = $_POST['salary'] ?? 0;
            
            // In a real app, we'd update the DB. Here we just simulate success.
            $this->view('owner/salary_success', [
                'id' => $id,
                'salary' => $newSalary
            ], 'layout');
            return;
        }
        
        header('Location: /owner/dashboard');
    }
}
