<?php
// app/models/Order.php
namespace App\Models;

use Core\Database;

class Order {
    public static function all() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM orders");
        return $stmt->fetchAll();
    }
}
