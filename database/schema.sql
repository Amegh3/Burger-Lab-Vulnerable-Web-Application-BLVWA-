-- Burger Labs Enterprise Schema (SQLite Version)

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role VARCHAR(10) DEFAULT 'user',
    wallet_balance DECIMAL(10, 2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
);

-- Products Table
CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255),
    price DECIMAL(10, 2),
    description TEXT,
    category VARCHAR(100),
    image_url VARCHAR(255)
);

-- Orders Table
CREATE TABLE IF NOT EXISTS orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    burger_name VARCHAR(100) NOT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    total_price DECIMAL(10, 2) NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Reviews Table
CREATE TABLE IF NOT EXISTS reviews (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    order_id INTEGER,
    product_id INTEGER,
    rating INTEGER CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    is_approved BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

-- Messages Table
CREATE TABLE IF NOT EXISTS messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255),
    email VARCHAR(255),
    subject VARCHAR(255),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- System Configurations (Vulnerability Toggles)
CREATE TABLE IF NOT EXISTS system_config (
    setting_key VARCHAR(50) PRIMARY KEY,
    setting_value VARCHAR(255) NOT NULL,
    description TEXT
);

-- Exploit Recipes (Saved Payload Chains)
CREATE TABLE IF NOT EXISTS exploit_recipes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    recipe_name VARCHAR(100) NOT NULL,
    payload TEXT NOT NULL,
    target_module VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert Default Data
INSERT OR IGNORE INTO system_config (setting_key, setting_value, description) VALUES
('vulnerable_mode', 'true', 'Enable or disable intentional vulnerabilities globally'),
('difficulty_level', 'medium', 'Current training difficulty: soft, grilled, burnt, black_hole');

INSERT OR IGNORE INTO users (id, username, password_hash, email, role, wallet_balance) VALUES
(1, 'admin', 'admin', 'admin@burgerlabs.htb', 'admin', 9999.99),
(2, 'neo', 'neo', 'neo@matrix.htb', 'user', 50.00);

INSERT OR IGNORE INTO products (name, price, description, category, image_url) VALUES 
('Neon Double Smash', 15.99, 'Two premium beef patties, melted cyber-cheese, and our signature glitch sauce on a toasted brioche bun.', 'Classic', '/assets/images/smash.png'),
('Cyber Vegan Hologram', 12.50, '100% plant-based matrix patty, fresh lettuce, and neon-ranch dressing. Powered by pure logic.', 'Vegan', '/assets/images/vegan.png'),
('Black Hole Burger', 24.99, 'A mystery recipe so dense it warps time around your tastebuds. Currently unavailable.', 'Specials', '/assets/images/smash.png');

-- Order Sample Data
INSERT OR IGNORE INTO orders (id, user_id, burger_name, status, total_price, notes) VALUES
(1, 2, 'Neon Double Smash', 'delivered', 15.99, 'Extra glitch sauce'),
(2, 2, 'Cyber Vegan', 'pending', 12.50, 'No meat, pure logic');
