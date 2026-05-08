<style>.diag-root{background:#0f172a;min-height:100vh;color:#f1f5f9;font-family:"Space Mono",monospace;padding:100px 40px;}.diag-container{max-width:800px;margin:0 auto;}.tool-box{background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.1);padding:50px;border-radius:24px;}.diag-input{width:100%;background:rgba(0,0,0,0.2);border:1px solid rgba(255,255,255,0.1);padding:15px 20px;color:#10b981;font-family:"Space Mono",monospace;font-size:1rem;border-radius:8px;margin-top:10px;outline:none;}.diag-input:focus{border-color:#E63946;}.terminal-output{background:#000;border:1px solid rgba(255,255,255,0.1);padding:20px;border-radius:8px;margin-top:30px;min-height:200px;color:#10b981;white-space:pre-wrap;overflow-x:auto;}.btn-diag{background:#E63946;color:white;border:none;padding:12px 30px;border-radius:8px;font-weight:700;cursor:pointer;margin-top:20px;transition:0.3s;}.btn-diag:hover{background:#D62828;}</style>
<!-- app/views/admin/backup.php -->
<div class="diag-root">
    <div class="diag-container">
        <a href="/admin_p0rtal_secret_path" style="color: #64748b; text-decoration: none;">&larr; Back to Portal</a>
        <h1 style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; color: #E63946; margin-top: 20px;">System Backups</h1>
        <p style="color: #94a3b8; margin-bottom: 30px;">Database and system backup archives.</p>

        <!-- VULNERABILITY: Backup files accessible without proper auth -->
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <?php foreach ($backups as $b): ?>
            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); padding: 25px; border-radius: 16px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="color: #f1f5f9; font-weight: 700; font-family: 'Space Mono', monospace;"><?= $b['name'] ?></p>
                    <p style="color: #64748b; font-size: 0.85rem; margin-top: 5px;"><?= $b['date'] ?> • <?= $b['size'] ?></p>
                </div>
                <!-- VULNERABILITY: Direct download link to backup files -->
                <a href="/storage/backups/<?= $b['name'] ?>" style="background: #E63946; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0.85rem;">Download</a>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="margin-top: 40px; background: rgba(230,57,70,0.1); padding: 20px; border-radius: 12px; border: 1px solid rgba(230,57,70,0.2);">
            <p style="color: #E63946; font-weight: 700; margin-bottom: 5px;">⚠️ Security Notice</p>
            <p style="color: #94a3b8; font-size: 0.85rem;">Ensure backup files are not publicly accessible. Current status: <span style="color: #E63946; font-weight: 700;">EXPOSED</span></p>
        </div>
    </div>
</div>
