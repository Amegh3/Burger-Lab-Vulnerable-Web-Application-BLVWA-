<!-- app/views/admin/portal.php -->
<style>
    .admin-root {
        background: #0f172a;
        min-height: 100vh;
        color: #f1f5f9;
        font-family: 'Inter', sans-serif;
        padding: 100px 40px;
    }

    .admin-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .terminal-header {
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding-bottom: 40px;
        margin-bottom: 60px;
    }

    .terminal-header h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 3.5rem;
        color: #E63946;
        margin: 0;
    }

    .module-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }

    .module-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.1);
        padding: 40px;
        border-radius: 24px;
        transition: 0.3s;
        text-decoration: none;
        color: inherit;
    }

    .module-card:hover {
        background: rgba(230, 57, 70, 0.05);
        border-color: #E63946;
        transform: translateY(-5px);
    }

    .module-card i {
        font-size: 2rem;
        color: #E63946;
        margin-bottom: 20px;
        display: block;
    }

    .module-card h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .module-card p {
        color: #94a3b8;
        line-height: 1.6;
    }
</style>

<div class="admin-root">
    <div class="admin-container">
        <header class="terminal-header">
            <span style="font-family: 'Space Mono', monospace; color: #64748b; letter-spacing: 2px;">ADMIN_ACCESS_GRANTED // LEVEL_04</span>
            <h1>Secret Research Portal</h1>
            <p style="color: #94a3b8; margin-top: 15px;">Advanced diagnostic and integrity modules for Burger Labs infrastructure.</p>
        </header>

        <div class="module-grid">
            <a href="/admin/diagnostics" class="module-card">
                <i class="fas fa-terminal"></i>
                <h3>Network Diagnostics</h3>
                <p>Verify server connectivity and latency via institutional ping protocols. Includes OS-level integration tests.</p>
            </a>

            <a href="/admin/logs" class="module-card">
                <i class="fas fa-file-invoice"></i>
                <h3>System Logs</h3>
                <p>Access raw server logs, audit trails, and transaction history. Supports custom log file paths.</p>
            </a>
            
            <a href="/admin/users" class="module-card">
                <i class="fas fa-user-shield"></i>
                <h3>User Management</h3>
                <p>Audit user accounts, privilege levels, and credential integrity across the platform.</p>
            </a>

            <a href="/admin/export" class="module-card">
                <i class="fas fa-file-export"></i>
                <h3>Data Export</h3>
                <p>Import XML data and generate custom reports. Supports external entity resolution.</p>
            </a>

            <a href="/admin/backup" class="module-card">
                <i class="fas fa-database"></i>
                <h3>System Backups</h3>
                <p>View and download database dumps and full system backup archives.</p>
            </a>

            <a href="/admin/analytics" class="module-card">
                <i class="fas fa-chart-bar"></i>
                <h3>Analytics Engine</h3>
                <p>Generate dynamic reports using our template engine with custom expressions.</p>
            </a>
        </div>
    </div>
</div>
