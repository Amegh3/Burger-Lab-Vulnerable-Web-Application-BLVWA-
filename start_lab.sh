#!/bin/bash
# Burger Labs Startup Script

echo "[*] Initializing Burger Labs Environment..."

echo "[*] Zero-dependency Mock DB Engine activated."
echo "[*] Booting up HGEMA Exploit Engine (PHP Server)..."
echo "[*] Target Environment accessible at: http://localhost:8000"

php -S localhost:8000 -t public/
