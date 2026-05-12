# scanner/config.py
"""Global configuration for the BLVWA Scanner."""

TARGET_URL = "http://127.0.0.1:8000"

# Auth credentials (SQLi bypass + normal)
CREDENTIALS = {
    "admin_sqli": {"username": "admin' OR '1'='1", "password": "anything"},
    "guest": {"username": "admin' OR '1'='1", "password": "anything"},
}

# Session cookies are stored here after login
SESSION_FILE = "scanner/.session.json"

# Evidence output
EVIDENCE_DIR = "scanner/evidence"
REPORTS_DIR = "scanner/reports"

# Timeouts
REQUEST_TIMEOUT = 5
PAGE_TIMEOUT = 10000  # Playwright ms

# Concurrent workers
MAX_WORKERS = 5
