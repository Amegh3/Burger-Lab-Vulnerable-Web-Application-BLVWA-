<style>.diag-root{background:#0f172a;min-height:100vh;color:#f1f5f9;font-family:"Space Mono",monospace;padding:100px 40px;}.diag-container{max-width:800px;margin:0 auto;}.tool-box{background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.1);padding:50px;border-radius:24px;}.diag-input{width:100%;background:rgba(0,0,0,0.2);border:1px solid rgba(255,255,255,0.1);padding:15px 20px;color:#10b981;font-family:"Space Mono",monospace;font-size:1rem;border-radius:8px;margin-top:10px;outline:none;}.diag-input:focus{border-color:#E63946;}.terminal-output{background:#000;border:1px solid rgba(255,255,255,0.1);padding:20px;border-radius:8px;margin-top:30px;min-height:200px;color:#10b981;white-space:pre-wrap;overflow-x:auto;}.btn-diag{background:#E63946;color:white;border:none;padding:12px 30px;border-radius:8px;font-weight:700;cursor:pointer;margin-top:20px;transition:0.3s;}.btn-diag:hover{background:#D62828;}</style>
<!-- app/views/admin/logs.php -->
<div class="diag-root">
    <div class="diag-container">
        <a href="/admin_p0rtal_secret_path" style="color: #64748b; text-decoration: none;">&larr; Back to Portal</a>
        <h1 style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; color: #E63946; margin-top: 20px;">System Logs</h1>
        
        <!-- VULNERABILITY: LFI — change file param to traverse paths -->
        <div style="display: flex; gap: 10px; margin: 30px 0;">
            <a href="/admin/logs?file=access.log" style="background: rgba(255,255,255,0.05); padding: 8px 16px; border-radius: 8px; color: #94a3b8; text-decoration: none; border: 1px solid rgba(255,255,255,0.1);">access.log</a>
            <a href="/admin/logs?file=error.log" style="background: rgba(255,255,255,0.05); padding: 8px 16px; border-radius: 8px; color: #94a3b8; text-decoration: none; border: 1px solid rgba(255,255,255,0.1);">error.log</a>
            <a href="/admin/logs?file=audit.log" style="background: rgba(255,255,255,0.05); padding: 8px 16px; border-radius: 8px; color: #94a3b8; text-decoration: none; border: 1px solid rgba(255,255,255,0.1);">audit.log</a>
        </div>
        
        <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 10px;">Viewing: <strong style="color: #10b981;"><?= $log_file ?></strong></p>
        
        <!-- VULNERABILITY: Log content rendered raw → log injection visible -->
        <div style="background: #000; border: 1px solid rgba(255,255,255,0.1); padding: 20px; border-radius: 12px; color: #10b981; font-family: 'Space Mono', monospace; font-size: 0.8rem; white-space: pre-wrap; max-height: 500px; overflow-y: auto; line-height: 1.8;"><?= $log_content ?></div>
        
        <p style="color: #475569; font-size: 0.8rem; margin-top: 20px;">
            <strong>Note:</strong> Log files are stored in <code>/storage/logs/</code>. Use the <code>file</code> parameter to switch between log files.
        </p>
    </div>
</div>
