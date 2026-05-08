<!-- app/views/profile/show.php -->
<div style="max-width: 800px; margin: 3rem auto; padding: 0 5%;">
    <div style="background: white; padding: 3rem; border-radius: 30px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <div style="display: flex; align-items: center; gap: 2rem; margin-bottom: 2.5rem;">
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #E63946, #a82a33); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: 800;">
                <?= strtoupper(substr($profile['username'] ?? 'U', 0, 1)) ?>
            </div>
            <div>
                <!-- VULNERABILITY: IDOR — profile data of any user shown -->
                <h2 style="margin: 0; color: #2B2D42;"><?= $profile['username'] ?? 'Unknown' ?></h2>
                <p style="color: #888; margin: 0.3rem 0;"><?= $profile['email'] ?? '' ?></p>
                <span style="background: <?= ($profile['role'] ?? '') === 'admin' ? '#E63946' : '#10b981' ?>; color: white; padding: 0.3rem 1rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">
                    <?= $profile['role'] ?? 'customer' ?>
                </span>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
            <div style="background: #f8fafc; padding: 1.5rem; border-radius: 15px;">
                <p style="font-size: 0.8rem; color: #888; text-transform: uppercase; letter-spacing: 1px;">User ID</p>
                <p style="font-size: 1.5rem; font-weight: 800; color: #2B2D42;">#<?= $profile['id'] ?? '?' ?></p>
            </div>
            <div style="background: #f8fafc; padding: 1.5rem; border-radius: 15px;">
                <p style="font-size: 0.8rem; color: #888; text-transform: uppercase; letter-spacing: 1px;">Wallet Balance</p>
                <!-- VULNERABILITY: Exposes wallet balance of any user -->
                <p style="font-size: 1.5rem; font-weight: 800; color: #10b981;">₹<?= number_format($profile['wallet_balance'] ?? 0, 2) ?></p>
            </div>
        </div>

        <!-- VULNERABILITY: API key exposed in profile view -->
        <div style="background: #fff3e0; padding: 1.5rem; border-radius: 15px; margin-bottom: 2rem;">
            <p style="font-size: 0.8rem; color: #888; margin-bottom: 0.5rem;">API Key (for integrations)</p>
            <code style="font-size: 0.85rem; color: #E63946; word-break: break-all;">blvwa_<?= md5(($profile['id'] ?? 1) . 'burger_secret') ?></code>
        </div>

        <?php if ($is_own): ?>
            <div style="display: flex; gap: 1rem;">
                <a href="/profile/edit" class="btn-primary" style="flex: 1; text-align: center; text-decoration: none; padding: 1rem; border-radius: 15px;">Edit Profile</a>
                <a href="/wallet" class="btn-primary" style="flex: 1; text-align: center; text-decoration: none; padding: 1rem; border-radius: 15px; background: #10b981;">My Wallet</a>
            </div>
        <?php endif; ?>
    </div>
</div>
