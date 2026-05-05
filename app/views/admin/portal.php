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

            <div class="module-card" style="opacity: 0.5; cursor: not-allowed;">
                <i class="fas fa-file-invoice"></i>
                <h3>Log Analytics</h3>
                <p>Access raw server logs and transaction history. (Module currently under maintenance)</p>
            </div>
            
            <div class="module-card" style="opacity: 0.5; cursor: not-allowed;">
                <i class="fas fa-user-shield"></i>
                <h3>User Integrity</h3>
                <p>Audit user accounts and privilege levels. (Module currently under maintenance)</p>
            </div>

            <div class="module-card" style="opacity: 0.5; cursor: not-allowed;">
                <i class="fas fa-database"></i>
                <h3>Database Ops</h3>
                <p>Direct SQL console for authorized data scientists. (Module currently under maintenance)</p>
            </div>
        </div>
    </div>
</div>
