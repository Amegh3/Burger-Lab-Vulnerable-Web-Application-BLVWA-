<!-- app/views/profile/show.php -->
<div style="max-width: 900px; margin: 3rem auto; padding: 0 5%;">
    <div style="background: white; padding: 3rem; border-radius: 30px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <div style="display: flex; align-items: center; gap: 2.5rem; margin-bottom: 3rem; border-bottom: 2px solid #f8fafc; padding-bottom: 3rem;">
            <div style="position: relative;">
                <img src="<?= $profile['avatar'] ?? '/assets/images/customer_avatar.png' ?>" alt="Avatar" style="width: 140px; height: 140px; border-radius: 40px; object-fit: cover; box-shadow: 0 15px 35px rgba(0,0,0,0.1); border: 5px solid white;">
                <div style="position: absolute; bottom: -10px; right: -10px; background: <?= ($profile['role'] ?? '') === 'admin' ? '#E63946' : (($profile['role'] ?? '') === 'owner' ? '#B8860B' : '#10b981') ?>; color: white; padding: 0.5rem 1.4rem; border-radius: 15px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <?= $profile['role'] ?? 'customer' ?>
                </div>
            </div>
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <h2 class="outfit-font" style="margin: 0; font-size: 2.5rem; color: #2B2D42;"><?= htmlspecialchars($profile['full_name'] ?? ($profile['username'] ?? 'Unknown')) ?></h2>
                    <span style="background: #fef2f2; color: #dc2626; padding: 0.4rem 1rem; border-radius: 10px; font-size: 0.7rem; font-weight: 800; border: 1px solid #fee2e2;">
                        <i class="fa fa-id-badge"></i> <?= $profile['employee_id'] ?? 'EXT-000' ?>
                    </span>
                </div>
                <p style="color: #666; margin: 0.6rem 0; font-size: 1.2rem; font-weight: 500;"><?= htmlspecialchars($profile['status'] ?? 'Active Member') ?></p>
                <div style="display: flex; gap: 1.5rem; margin-top: 1rem;">
                    <span style="color: #888; font-size: 0.9rem;"><i class="fa fa-envelope" style="color: #E63946;"></i> <?= $profile['email'] ?? 'n/a' ?></span>
                    <span style="color: #888; font-size: 0.9rem;"><i class="fa fa-map-marker-alt" style="color: #E63946;"></i> <?= $profile['location'] ?? 'Remote' ?></span>
                    <span style="color: #888; font-size: 0.9rem;"><i class="fa fa-calendar-alt"></i> Joined <?= $profile['member_since'] ?? '2026' ?></span>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 2.5rem;">
            <div style="background: #f8fafc; padding: 1.8rem; border-radius: 20px; border: 1px solid #f0f0f0;">
                <p style="font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 0.8rem;">Database ID</p>
                <p style="font-size: 1.8rem; font-weight: 800; color: #2B2D42; margin: 0;">#<?= $profile['id'] ?? '?' ?></p>
            </div>
            <div style="background: #f8fafc; padding: 1.8rem; border-radius: 20px; border: 1px solid #f0f0f0;">
                <p style="font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 0.8rem;">Wallet Credit</p>
                <p style="font-size: 1.8rem; font-weight: 800; color: #10b981; margin: 0;">₹<?= number_format($profile['wallet_balance'] ?? 0, 2) ?></p>
            </div>
            <div style="background: #f8fafc; padding: 1.8rem; border-radius: 20px; border: 1px solid #f0f0f0;">
                <p style="font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 0.8rem;">System Access</p>
                <p style="font-size: 1.2rem; font-weight: 800; color: #E63946; margin: 0;">VERIFIED</p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem; margin-bottom: 2.5rem;">
            <!-- Role Permissions -->
            <div>
                <h4 class="outfit-font" style="color: #2B2D42; margin-bottom: 1.2rem; font-size: 1rem; text-transform: uppercase; letter-spacing: 1px;">Privileges</h4>
                <div style="display: flex; flex-wrap: wrap; gap: 0.6rem;">
                    <?php 
                    $perms = $profile['permissions'] ?? ['Standard Access'];
                    if (is_string($perms)) $perms = explode(',', $perms);
                    foreach ($perms as $perm): ?>
                        <span style="background: #fff; color: #475569; padding: 0.5rem 1rem; border-radius: 10px; font-size: 0.8rem; font-weight: 600; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa fa-shield-alt" style="color: #10b981; font-size: 0.7rem;"></i> <?= htmlspecialchars($perm) ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Achievements -->
            <div>
                <h4 class="outfit-font" style="color: #2B2D42; margin-bottom: 1.2rem; font-size: 1rem; text-transform: uppercase; letter-spacing: 1px;">Achievements</h4>
                <div style="display: flex; flex-wrap: wrap; gap: 0.6rem;">
                    <?php 
                    $awards = $profile['achievements'] ?? ['Lab Contributor'];
                    foreach ($awards as $award): ?>
                        <span style="background: linear-gradient(135deg, #fff9c4 0%, #fffde7 100%); color: #827717; padding: 0.5rem 1rem; border-radius: 10px; font-size: 0.8rem; font-weight: 700; border: 1px solid #fbc02d; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa fa-trophy" style="color: #f9a825;"></i> <?= htmlspecialchars($award) ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- API Integration -->
        <div style="background: #1e293b; padding: 2rem; border-radius: 25px; margin-bottom: 2.5rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.2rem;">
                <p style="font-size: 0.8rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin: 0;">Employee Research Token (API Key)</p>
                <span style="font-size: 0.65rem; color: #10b981; background: rgba(16,185,129,0.1); padding: 0.3rem 0.8rem; border-radius: 5px; font-weight: 800;">ENCRYPTED</span>
            </div>
            <div style="display: flex; align-items: center; justify-content: space-between; background: rgba(255,255,255,0.05); padding: 1.2rem; border-radius: 15px; border: 1px solid rgba(255,255,255,0.1);">
                <code style="font-size: 0.95rem; color: #38bdf8; font-weight: 700; font-family: 'Courier New', monospace;">blvwa_<?= md5(($profile['id'] ?? 1) . 'burger_secret') ?></code>
                <button style="background: transparent; border: none; color: #94a3b8; cursor: pointer;"><i class="fa fa-copy"></i></button>
            </div>
            <p style="color: #64748b; font-size: 0.75rem; margin-top: 1rem;"><i class="fa fa-info-circle"></i> This token is for laboratory research and automated scanner testing only.</p>
        </div>

        <?php if ($is_own): ?>
            <div style="display: flex; gap: 1.5rem;">
                <a href="/profile/edit" class="btn-primary" style="flex: 1; text-align: center; text-decoration: none; padding: 1.2rem; border-radius: 20px; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 0.8rem;">
                    <i class="fa fa-user-edit"></i> Update Records
                </a>
                <a href="/wallet" class="btn-primary" style="flex: 1; text-align: center; text-decoration: none; padding: 1.2rem; border-radius: 20px; background: #10b981; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 0.8rem;">
                    <i class="fa fa-wallet"></i> Access Wallet
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
