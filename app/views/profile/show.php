<!-- app/views/profile/show.php -->
<div style="max-width: 800px; margin: 3rem auto; padding: 0 5%;">
    <div style="background: white; padding: 3rem; border-radius: 30px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <div style="display: flex; align-items: center; gap: 2.5rem; margin-bottom: 3rem;">
            <div style="position: relative;">
                <img src="<?= $profile['avatar'] ?? '/assets/images/customer_avatar.png' ?>" alt="Avatar" style="width: 120px; height: 120px; border-radius: 35px; object-fit: cover; box-shadow: 0 15px 35px rgba(0,0,0,0.1); border: 4px solid white;">
                <div style="position: absolute; bottom: -10px; right: -10px; background: <?= ($profile['role'] ?? '') === 'admin' ? '#E63946' : (($profile['role'] ?? '') === 'owner' ? '#B8860B' : '#10b981') ?>; color: white; padding: 0.4rem 1.2rem; border-radius: 12px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <?= $profile['role'] ?? 'customer' ?>
                </div>
            </div>
            <div>
                <h2 class="outfit-font" style="margin: 0; font-size: 2.2rem; color: #2B2D42;"><?= htmlspecialchars($profile['username'] ?? 'Unknown') ?></h2>
                <p style="color: #666; margin: 0.4rem 0; font-size: 1.1rem;"><?= htmlspecialchars($profile['status'] ?? 'Active Member') ?></p>
                <p style="color: #888; margin: 0; font-size: 0.9rem;"><i class="fa fa-calendar-alt"></i> Member Since <?= $profile['member_since'] ?? '2026' ?></p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2.5rem;">
            <div style="background: #f8fafc; padding: 1.8rem; border-radius: 20px; border: 1px solid #f0f0f0;">
                <p style="font-size: 0.75rem; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 0.8rem;">Internal ID</p>
                <p style="font-size: 1.8rem; font-weight: 800; color: #2B2D42; margin: 0;">#<?= $profile['id'] ?? '?' ?></p>
            </div>
            <div style="background: #f8fafc; padding: 1.8rem; border-radius: 20px; border: 1px solid #f0f0f0;">
                <p style="font-size: 0.75rem; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 0.8rem;">Wallet Credit</p>
                <p style="font-size: 1.8rem; font-weight: 800; color: #10b981; margin: 0;">₹<?= number_format($profile['wallet_balance'] ?? 0, 2) ?></p>
            </div>
        </div>

        <!-- Role Permissions Section -->
        <div style="margin-bottom: 2.5rem;">
            <h4 style="color: #2B2D42; margin-bottom: 1.2rem; font-size: 1.1rem;">Assigned Permissions</h4>
            <div style="display: flex; flex-wrap: wrap; gap: 0.8rem;">
                <?php 
                $perms = $profile['permissions'] ?? ['Order History'];
                if (is_string($perms)) $perms = explode(',', $perms); // Handle if it comes as string
                foreach ($perms as $perm): ?>
                    <span style="background: #f1f5f9; color: #475569; padding: 0.6rem 1.2rem; border-radius: 12px; font-size: 0.85rem; font-weight: 600; border: 1px solid #e2e8f0;">
                        <i class="fa fa-check-circle" style="color: #10b981; margin-right: 0.5rem;"></i> <?= htmlspecialchars($perm) ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- API Integration VULNERABILITY -->
        <div style="background: #fff9f0; padding: 2rem; border-radius: 25px; margin-bottom: 2.5rem; border: 1px solid #ffedca;">
            <p style="font-size: 0.8rem; color: #9a6d1f; margin-bottom: 0.8rem; font-weight: 700; text-transform: uppercase;">Security Token (API Key)</p>
            <div style="display: flex; align-items: center; justify-content: space-between; background: white; padding: 1rem; border-radius: 15px; border: 1px solid #ffedca;">
                <code style="font-size: 0.9rem; color: #E63946; font-weight: 700;">blvwa_<?= md5(($profile['id'] ?? 1) . 'burger_secret') ?></code>
                <span style="font-size: 0.7rem; color: #888; background: #eee; padding: 0.2rem 0.5rem; border-radius: 5px;">READ-ONLY</span>
            </div>
        </div>

        <?php if ($is_own): ?>
            <div style="display: flex; gap: 1.2rem;">
                <a href="/profile/edit" class="btn-primary" style="flex: 1; text-align: center; text-decoration: none; padding: 1.2rem; border-radius: 20px; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 0.8rem;">
                    <i class="fa fa-edit"></i> Edit Profile
                </a>
                <a href="/wallet" class="btn-primary" style="flex: 1; text-align: center; text-decoration: none; padding: 1.2rem; border-radius: 20px; background: #10b981; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 0.8rem;">
                    <i class="fa fa-wallet"></i> My Wallet
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
