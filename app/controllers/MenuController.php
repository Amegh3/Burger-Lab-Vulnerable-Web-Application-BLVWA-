<?php
// app/controllers/MenuController.php
namespace App\Controllers;

use Core\Database;

class MenuController extends Controller {
    public function index() {
        $category = $_GET['category'] ?? null;
        $db = Database::getInstance()->getConnection();
        
        // VULNERABILITY 1: SQL Injection (Union Based)
        // Payload: ' UNION SELECT 1,2,3,4,5,6-- -
        if ($category) {
            $sql = "SELECT * FROM products WHERE category = '" . $category . "'";
            $stmt = $db->query($sql);
            $products = $stmt->fetchAll();
        } else {
            $products = $db->query("SELECT * FROM products")->fetchAll();
        }
        
        $this->view('menu/index', ['products' => $products, 'category' => $category], 'layout');
    }

    public function search() {
        $query = $_GET['q'] ?? '';
        $db = Database::getInstance()->getConnection();
        
        // VULNERABILITY: Reflected XSS (Query is passed raw to the view)
        // Payload: <script>alert('XSS')</script>
        
        // VULNERABILITY: SQL Injection (Searching with like)
        // This allows students to perform SQLi via the search bar
        $sql = "SELECT * FROM products WHERE name LIKE '%$query%' OR description LIKE '%$query%'";
        $stmt = $db->query($sql);
        $products = $stmt->fetchAll();
        
        $this->view('menu/search', [
            'query' => $query,
            'products' => $products
        ], 'layout');
    }
}
