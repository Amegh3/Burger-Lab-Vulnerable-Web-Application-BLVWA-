<!-- app/views/admin/diagnostics.php -->
<style>
    .diag-root {
        background: #0f172a;
        min-height: 100vh;
        color: #f1f5f9;
        font-family: 'Space Mono', monospace;
        padding: 100px 40px;
    }

    .diag-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .tool-box {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.1);
        padding: 50px;
        border-radius: 24px;
    }

    .diag-input {
        width: 100%;
        background: rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.1);
        padding: 15px 20px;
        color: #10b981;
        font-family: 'Space Mono', monospace;
        font-size: 1rem;
        border-radius: 8px;
        margin-top: 10px;
        outline: none;
    }

    .diag-input:focus {
        border-color: #E63946;
    }

    .terminal-output {
        background: #000;
        border: 1px solid rgba(255,255,255,0.1);
        padding: 20px;
        border-radius: 8px;
        margin-top: 30px;
        min-height: 200px;
        color: #10b981;
        white-space: pre-wrap;
        overflow-x: auto;
    }

    .btn-diag {
        background: #E63946;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 20px;
        transition: 0.3s;
    }

    .btn-diag:hover {
        background: #D62828;
    }
</style>

<div class="diag-root">
    <div class="diag-container">
        <div style="margin-bottom: 40px;">
            <a href="/admin_p0rtal_secret_path" style="color: #64748b; text-decoration: none;">&larr; Back to Portal</a>
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; color: #E63946; margin-top: 20px;">Network Diagnostics</h1>
        </div>

        <div class="tool-box">
            <p style="color: #94a3b8; margin-bottom: 30px;">Input a target hostname or IP address to verify connectivity with the Burger Labs gateway.</p>
            
            <form action="/admin/diagnostics" method="POST">
                <label style="text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; color: #64748b;">Target Host</label>
                <input type="text" name="host" class="diag-input" placeholder="e.g. 127.0.0.1" value="<?= htmlspecialchars($host) ?>">
                <button type="submit" class="btn-diag">Run Diagnostic</button>
            </form>

            <?php if ($output || $host): ?>
                <div class="terminal-output"><?= $output ?: "Error: Connection timed out or host unreachable." ?></div>
            <?php endif; ?>
        </div>

        <div style="margin-top: 60px; color: #475569; font-size: 0.8rem;">
            <p><strong>Note:</strong> This tool performs a direct system-level ICMP request. Excessive use may be flagged by the security firewall.</p>
        </div>
    </div>
</div>
