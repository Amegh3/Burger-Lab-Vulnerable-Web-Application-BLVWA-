<style>.diag-root{background:#0f172a;min-height:100vh;color:#f1f5f9;font-family:"Space Mono",monospace;padding:100px 40px;}.diag-container{max-width:800px;margin:0 auto;}.tool-box{background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.1);padding:50px;border-radius:24px;}.diag-input{width:100%;background:rgba(0,0,0,0.2);border:1px solid rgba(255,255,255,0.1);padding:15px 20px;color:#10b981;font-family:"Space Mono",monospace;font-size:1rem;border-radius:8px;margin-top:10px;outline:none;}.diag-input:focus{border-color:#E63946;}.terminal-output{background:#000;border:1px solid rgba(255,255,255,0.1);padding:20px;border-radius:8px;margin-top:30px;min-height:200px;color:#10b981;white-space:pre-wrap;overflow-x:auto;}.btn-diag{background:#E63946;color:white;border:none;padding:12px 30px;border-radius:8px;font-weight:700;cursor:pointer;margin-top:20px;transition:0.3s;}.btn-diag:hover{background:#D62828;}</style>
<!-- app/views/admin/users.php -->
<div class="diag-root">
    <div class="diag-container" style="max-width: 1000px;">
        <a href="/admin_p0rtal_secret_path" style="color: #64748b; text-decoration: none;">&larr; Back to Portal</a>
        <h1 style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; color: #E63946; margin-top: 20px;">User Management</h1>
        <p style="color: #94a3b8; margin-bottom: 30px;">All registered users in the system.</p>

        <!-- VULNERABILITY: BOLA — all user data including passwords exposed -->
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-family: 'Space Mono', monospace; font-size: 0.85rem;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <th style="text-align: left; padding: 15px; color: #64748b;">ID</th>
                        <th style="text-align: left; padding: 15px; color: #64748b;">Username</th>
                        <th style="text-align: left; padding: 15px; color: #64748b;">Email</th>
                        <th style="text-align: left; padding: 15px; color: #64748b;">Password</th>
                        <th style="text-align: left; padding: 15px; color: #64748b;">Role</th>
                        <th style="text-align: left; padding: 15px; color: #64748b;">Wallet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 15px; color: #94a3b8;"><?= $u['id'] ?></td>
                        <!-- VULNERABILITY: Stored XSS if malicious username was registered -->
                        <td style="padding: 15px; color: #f1f5f9; font-weight: 700;"><?= $u['username'] ?></td>
                        <td style="padding: 15px; color: #94a3b8;"><?= $u['email'] ?></td>
                        <!-- VULNERABILITY: Password hash exposed in admin panel -->
                        <td style="padding: 15px; color: #E63946;"><?= $u['password_hash'] ?></td>
                        <td style="padding: 15px;"><span style="background: <?= $u['role'] === 'admin' ? '#E63946' : '#10b981' ?>; padding: 4px 12px; border-radius: 50px; font-size: 0.75rem; color: white;"><?= $u['role'] ?></span></td>
                        <td style="padding: 15px; color: #10b981;">₹<?= number_format($u['wallet_balance'] ?? 0, 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
