#!/bin/bash
# Burger Labs Startup Script

echo "[*] Initializing Burger Labs Environment..."

# Initialize SQLite Database (Optional: Fallback to Mock if driver missing)
if [ ! -f "database/burger_labs.sqlite" ]; then
    echo "[*] Attempting to initialize SQLite database..."
    php database/init.php 2>/dev/null || echo "[!] SQLite driver not found. Falling back to Mock DB Engine."
fi

echo "[*] Zero-dependency Mock DB Engine activated."
echo "[*] Booting up HGEMA Exploit Engine (PHP Server)..."
echo "[*] Target Environment accessible at: http://localhost:8000"

php -S localhost:8000 -t public/
