<?php
// core/Database.php
namespace Core;

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $this->connection = new MockPDO();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

class MockPDO
{
    public $orders = [
        ['id' => 1001, 'user_id' => 2, 'burger_name' => 'Signature Zinger', 'status' => 'Out for Delivery', 'total_price' => 299, 'notes' => 'Extra spicy', 'created_at' => '2026-05-05 08:30:00'],
        ['id' => 1002, 'user_id' => 2, 'burger_name' => 'Loaded Truffle Fries', 'status' => 'Preparing', 'total_price' => 199, 'notes' => 'No onions', 'created_at' => '2026-05-05 11:15:00']
    ];

    public $users = [
        [
            'id' => 1, 
            'username' => 'admin', 
            'password_hash' => 'pass2026', 
            'email' => 'admin@burgerlabs.htb', 
            'role' => 'admin', 
            'wallet_balance' => 99999.00,
            'avatar' => '/assets/images/admin_avatar.png',
            'member_since' => 'Jan 2024',
            'permissions' => ['Full Lab Control', 'WAF Management', 'System Logs', 'User Escalation'],
            'status' => 'Active • Systems Administrator'
        ],
        [
            'id' => 2, 
            'username' => 'guest', 
            'password_hash' => 'guest', 
            'email' => 'guest@example.com', 
            'role' => 'customer', 
            'wallet_balance' => 5000.00,
            'avatar' => '/assets/images/customer_avatar.png',
            'member_since' => 'May 2026',
            'permissions' => ['Order Placement', 'Wallet Transfer', 'Support Tickets'],
            'status' => 'Active • Valued Customer'
        ],
        [
            'id' => 3, 
            'username' => 'owner', 
            'password_hash' => 'owner', 
            'email' => 'founder@burgerlabs.htb', 
            'role' => 'owner', 
            'wallet_balance' => 1500000.00,
            'avatar' => '/assets/images/owner_avatar.png',
            'member_since' => 'Oct 2023',
            'permissions' => ['Total Authority', 'Equity Access', 'Staff Payroll', 'Executive Command'],
            'status' => 'Active • Founder & CEO'
        ],
        [
            'id' => 4, 
            'username' => 'alex', 
            'password_hash' => 'alex', 
            'email' => 'alex@burgerlabs.htb', 
            'role' => 'staff', 
            'wallet_balance' => 25000.00,
            'avatar' => '/assets/images/chef_avatar.png',
            'member_since' => 'Mar 2024',
            'permissions' => ['Kitchen Authority', 'Menu Management', 'Inventory Control'],
            'status' => 'Active • Executive Chef'
        ],
        [
            'id' => 5, 
            'username' => 'abhinand', 
            'password_hash' => 'abhinand', 
            'email' => 'abhinand@burgerlabs.htb', 
            'role' => 'staff', 
            'wallet_balance' => 18000.00,
            'avatar' => '/assets/images/manager_avatar.png',
            'member_since' => 'Jun 2024',
            'permissions' => ['Staff Scheduling', 'POS Access', 'Daily Reports'],
            'status' => 'Active • Store Manager'
        ],
        [
            'id' => 6, 
            'username' => 'nikhil', 
            'password_hash' => 'nikhil', 
            'email' => 'nikhil@burgerlabs.htb', 
            'role' => 'staff', 
            'wallet_balance' => 8000.00,
            'avatar' => '/assets/images/staff_avatar_1.png',
            'member_since' => 'Jan 2025',
            'permissions' => ['Kitchen Access', 'Stock Replenishment'],
            'status' => 'Active • Kitchen Staff'
        ],
        [
            'id' => 7, 
            'username' => 'vishnu', 
            'password_hash' => 'vishnu', 
            'email' => 'vishnu@burgerlabs.htb', 
            'role' => 'staff', 
            'wallet_balance' => 12000.00,
            'avatar' => '/assets/images/staff_avatar_2.png',
            'member_since' => 'Feb 2025',
            'permissions' => ['Wallet Management', 'Coupon Validation', 'Transaction Logs'],
            'status' => 'Active • Head Cashier'
        ]
    ];

    public $employees = [
        [
            'id' => 1, 
            'name' => 'Alex Idicula', 
            'designation' => 'Executive Chef', 
            'salary' => 85000, 
            'pf_account' => 'PF-IND-8821', 
            'bank_acc' => 'SBI-1100223344', 
            'address' => 'Vazhuthacaud, Trivandrum', 
            'salary_history' => [80000, 82000, 85000], 
            'private_notes' => 'Top performer. Head of molecular gastronomy.',
            'avatar' => '/assets/images/chef_avatar.png',
            'permissions' => ['Kitchen Authority', 'Menu Management', 'Inventory Control']
        ],
        [
            'id' => 2, 
            'name' => 'Abhinand ', 
            'designation' => 'Store Manager', 
            'salary' => 65000, 
            'pf_account' => 'PF-IND-9910', 
            'bank_acc' => 'HDFC-4455667788', 
            'address' => 'Pattom, Trivandrum', 
            'salary_history' => [60000, 65000], 
            'private_notes' => 'Manages operations and staff shifts.',
            'avatar' => '/assets/images/manager_avatar.png',
            'permissions' => ['Staff Scheduling', 'POS Access', 'Daily Reports']
        ],
        [
            'id' => 3, 
            'name' => 'Nikhil', 
            'designation' => 'Kitchen Staff', 
            'salary' => 25000, 
            'pf_account' => 'PF-IND-1122', 
            'bank_acc' => 'ICICI-9988776655', 
            'address' => 'Kazhakkoottam, Trivandrum', 
            'salary_history' => [22000, 25000], 
            'private_notes' => 'Specialist in artisanal bun preparation.',
            'avatar' => '/assets/images/staff_avatar_1.png',
            'permissions' => ['Kitchen Access', 'Stock Replenishment']
        ],
        [
            'id' => 4, 
            'name' => 'Vishnu 2', 
            'designation' => 'Cashier', 
            'salary' => 22000, 
            'pf_account' => 'PF-IND-3344', 
            'bank_acc' => 'AXIS-5544332211', 
            'address' => 'Peroorkada, Trivandrum', 
            'salary_history' => [20000, 22000], 
            'private_notes' => 'Excellent handling of premium customer wallet top-ups.',
            'avatar' => '/assets/images/staff_avatar_2.png',
            'permissions' => ['Wallet Management', 'Coupon Validation', 'Transaction Logs']
        ]
    ];

    public $system_config = [
        ['id' => 1, 'key' => 'razorpay_api_key', 'value' => 'rzp_live_5v9k2m8n4b3v1'],
        ['id' => 2, 'key' => 'smtp_password', 'value' => 'burger_labs_secure_mail_2026'],
        ['id' => 3, 'key' => 'admin_portal_v3_beta_url', 'value' => '/admin_p0rtal_secret_path']
    ];

    public $products = [
        // Burgers
        ['id' => 1, 'name' => 'Signature Zinger', 'price' => 299, 'description' => 'Crispy fried chicken breast, spicy mayo, lettuce, and brioche bun.', 'category' => 'Chicken', 'image_url' => '/assets/images/zinger.png'],
        ['id' => 2, 'name' => 'Classic Angus', 'price' => 349, 'description' => '100% Angus beef, aged cheddar, pickles, and our secret sauce.', 'category' => 'Beef', 'image_url' => '/assets/images/beef.png'],
        ['id' => 3, 'name' => 'Mexican Heatwave', 'price' => 379, 'description' => 'Beef patty, jalapeños, avocado, pepper jack cheese, and chipotle sauce.', 'category' => 'Beef', 'image_url' => '/assets/images/beef.png'],
        ['id' => 4, 'name' => 'Green Matrix', 'price' => 329, 'description' => 'Beyond Meat patty, vegan cheese, avocado, and fresh sprouts.', 'category' => 'Vegan', 'image_url' => '/assets/images/vegan.png'],
        ['id' => 5, 'name' => 'Truffle Overload', 'price' => 499, 'description' => 'Double beef patty, swiss cheese, and rich black truffle mushroom sauce.', 'category' => 'Beef', 'image_url' => '/assets/images/truffle.png'],
        ['id' => 6, 'name' => 'Malabar Spicy', 'price' => 389, 'description' => 'Malabar crispy chicken, curry leaf tempura, and spicy coconut mayo.', 'category' => 'Chicken', 'image_url' => '/assets/images/malabar.png'],

        // Sides
        ['id' => 10, 'name' => 'Loaded Truffle Fries', 'price' => 199, 'description' => 'Hand-cut fries topped with truffle oil, parmesan, and chives.', 'category' => 'Sides', 'image_url' => '/assets/images/fries.png'],
        ['id' => 11, 'name' => 'Crunchy Chicken Strips', 'price' => 249, 'description' => '6 pieces of golden-fried juicy chicken strips with honey mustard.', 'category' => 'Sides', 'image_url' => '/assets/images/zinger.png'],

        // Drinks
        ['id' => 20, 'name' => 'Mojito', 'price' => 149, 'description' => 'Minty, zesty, and refreshing scientific blend.', 'category' => 'Drinks', 'image_url' => '/assets/images/mojito.png'],
        ['id' => 21, 'name' => 'Cyber Shake', 'price' => 199, 'description' => 'Thick chocolate shake with artisanal cocoa.', 'category' => 'Drinks', 'image_url' => '/assets/images/shake.png'],
        ['id' => 22, 'name' => 'Iced Lab Coffee', 'price' => 179, 'description' => 'Cold brew coffee with a touch of vanilla and lab-made cream.', 'category' => 'Drinks', 'image_url' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?auto=format&fit=crop&q=80&w=800'],
        ['id' => 23, 'name' => 'Blueberry Fusion', 'price' => 159, 'description' => 'Electric blue lemonade infused with fresh mountain berries.', 'category' => 'Drinks', 'image_url' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&q=80&w=800']
    ];

    public function query($sql)
    {
        $stmt = new MockPDOStatement($this, $sql);
        $stmt->execute();
        return $stmt;
    }

    public function prepare($sql)
    {
        return new MockPDOStatement($this, $sql);
    }
}

class MockPDOStatement
{
    private $pdo;
    private $sql;
    private $params = [];

    public function __construct($pdo, $sql)
    {
        $this->pdo = $pdo;
        $this->sql = $sql;
    }

    public function execute($params = [])
    {
        $this->params = $params;
        $sql = trim(strtolower($this->sql));

        // SIMULATE PERSISTENCE: Handle UPDATE users SET ...
        if (strpos($sql, 'update users') !== false) {
            // Extract ID
            if (preg_match("/where id = ['\"]?(\d+)['\"]?/i", $this->sql, $matches)) {
                $userId = (int)$matches[1];
                
                // Find user in mock DB
                $userIndex = -1;
                foreach ($this->pdo->users as $idx => $u) {
                    if ($u['id'] === $userId) {
                        $userIndex = $idx;
                        break;
                    }
                }

                if ($userIndex !== -1) {
                    // Extract fields being updated
                    // Matches pattern like avatar = '/uploads/dhoni.png'
                    if (preg_match_all("/([a-z0-9_]+) = ['\"]([^'\"]*)['\"]/i", $this->sql, $matches, PREG_SET_ORDER)) {
                        foreach ($matches as $match) {
                            $field = $match[1];
                            $value = $match[2];
                            if ($field !== 'where' && $field !== 'id') {
                                $this->pdo->users[$userIndex][$field] = $value;
                            }
                        }
                    }
                }
            }
        }

        return true;
    }

    public function fetchAll()
    {
        $results = [];
        $sql = trim(strtolower($this->sql));
        
        // --- 1. CLEANING & PRE-PROCESSING ---
        $clean_sql = preg_replace('/(--|#|\/\*).*$/', '', $sql);
        $clean_sql = trim($clean_sql);

        // --- 2. USER AUTHENTICATION (HIGHEST PRIORITY) ---
        if (strpos($sql, 'from users') !== false) {
            // A. BROAD BYPASS: If any common SQLi payload is found, return the super-admin
            if (preg_match("/' or|--|#|union|select/i", $this->sql)) {
                return [$this->pdo->users[0]];
            }

            // B. ULTRA-PERMISSIVE MATCHING: Search for username and password anywhere in the SQL
            foreach ($this->pdo->users as $u) {
                $username = strtolower($u['username']);
                $password = $u['password_hash'];
                $u_regex = "/['\"]" . preg_quote($username, '/') . "['\"]/i";
                $p_regex = "/['\"]" . preg_quote($password, '/') . "['\"]/i";
                if (preg_match($u_regex, $this->sql) && preg_match($p_regex, $this->sql)) {
                    return [$u];
                }
            }

            // C. Fallback for ID-based lookup
            if (preg_match("/id = ['\"]?(\d+)['\"]?/i", $this->sql, $matches)) {
                $id = (int)$matches[1];
                foreach ($this->pdo->users as $u) {
                    if ($u['id'] === $id) return [$u];
                }
            }
            return [];
        }

        // --- 3. SQLMAP HEURISTIC: ORDER BY (Column Counting) ---
        if (preg_match("/order by (\d+)/", $clean_sql, $m)) {
            $colCount = (int)$m[1];
            return ($colCount <= 7) ? [['1','1','1','1','1','1','1']] : [];
        }

        // --- 4. SQLMAP HEURISTIC: BOOLEAN-BASED BLIND (Specific to non-auth queries) ---
        // Only trigger if we are NOT searching users, to avoid collision with 'WHERE username = alex'
        if (preg_match("/(and|or)\s+(['\"]?[a-z0-9_.]+['\"]?)\s*=\s*(['\"]?[a-z0-9_.]+['\"]?)$/i", $clean_sql, $m)) {
            $left = trim($m[2], "'\" ");
            $right = trim($m[3], "'\" ");
            if ($left === $right) {
                return [['id' => 1337, 'burger_name' => 'Signature Zinger', 'notes' => 'Fries']];
            }
            return [];
        }

        // --- 5. SQLMAP HEURISTIC: UNION-BASED ---

        return $results;
    }

    public function fetch()
    {
        $all = $this->fetchAll();
        return $all[0] ?? false;
    }
}
