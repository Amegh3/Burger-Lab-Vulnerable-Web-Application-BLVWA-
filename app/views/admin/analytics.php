<style>.diag-root{background:#0f172a;min-height:100vh;color:#f1f5f9;font-family:"Space Mono",monospace;padding:100px 40px;}.diag-container{max-width:800px;margin:0 auto;}.tool-box{background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.1);padding:50px;border-radius:24px;}.diag-input{width:100%;background:rgba(0,0,0,0.2);border:1px solid rgba(255,255,255,0.1);padding:15px 20px;color:#10b981;font-family:"Space Mono",monospace;font-size:1rem;border-radius:8px;margin-top:10px;outline:none;}.diag-input:focus{border-color:#E63946;}.terminal-output{background:#000;border:1px solid rgba(255,255,255,0.1);padding:20px;border-radius:8px;margin-top:30px;min-height:200px;color:#10b981;white-space:pre-wrap;overflow-x:auto;}.btn-diag{background:#E63946;color:white;border:none;padding:12px 30px;border-radius:8px;font-weight:700;cursor:pointer;margin-top:20px;transition:0.3s;}.btn-diag:hover{background:#D62828;}</style>
<!-- app/views/admin/analytics.php -->
<div class="diag-root">
    <div class="diag-container">
        <a href="/admin_p0rtal_secret_path" style="color: #64748b; text-decoration: none;">&larr; Back to Portal</a>
        <h1 style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; color: #E63946; margin-top: 20px;">Analytics Engine</h1>
        <p style="color: #94a3b8; margin-bottom: 30px;">Generate custom reports using our template engine.</p>

        <div class="tool-box">
            <form action="/admin/analytics" method="GET">
                <label style="text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; color: #64748b;">Report Template</label>
                <!-- VULNERABILITY: SSTI — template expressions like {{7*7}} are evaluated -->
                <input type="text" name="report" class="diag-input" value="<?= htmlspecialchars($template) ?>" placeholder="Enter report name or template expression...">
                <button type="submit" class="btn-diag">Generate Report</button>
            </form>

            <div class="terminal-output" style="margin-top: 20px;">
                <strong style="color: #64748b;">Report: </strong><span style="color: #f1f5f9;"><?= $template ?></span>
                <?php if ($output): ?>
                    <br><br><strong style="color: #E63946;">Template Output: </strong><?= $output ?>
                <?php endif; ?>
                <br><br>
                <span style="color: #64748b;">── Revenue Summary ──</span><br>
                Total Orders: 1,247<br>
                Revenue: ₹4,82,350<br>
                Avg Order Value: ₹386.80<br>
                Top Item: Signature Zinger (342 orders)<br>
            </div>
        </div>

        <div style="margin-top: 30px; color: #475569; font-size: 0.8rem;">
            <p><strong>Hint:</strong> The template engine supports expressions like <code>{{expression}}</code> for dynamic reports.</p>
        </div>
    </div>
</div>
