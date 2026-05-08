<!-- app/views/notifications/index.php -->
<div style="max-width: 700px; margin: 3rem auto; padding: 0 5%;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h2 style="color: #2B2D42; margin: 0;">Notifications</h2>
            <!-- VULNERABILITY: IDOR — shows whose notifications -->
            <p style="color: #888;">Showing notifications for User #<?= $user_id ?></p>
        </div>
    </div>

    <!-- Send notification form (admin/staff feature) -->
    <div style="background: #fdfcdc; padding: 1.5rem; border-radius: 15px; margin-bottom: 2rem; border: 1px dashed #F4A261;">
        <h4 style="margin-bottom: 1rem; color: #2B2D42;">Send Notification</h4>
        <form action="/notifications/send" method="POST" style="display: flex; gap: 10px;">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <!-- VULNERABILITY: Stored XSS — message rendered raw -->
            <input type="text" name="message" placeholder="Type a notification message..." class="glass-input" style="flex: 1;" required>
            <button type="submit" class="btn-primary" style="padding: 0 2rem; border-radius: 12px;">Send</button>
        </form>
    </div>

    <div style="background: white; padding: 1.5rem; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <?php if (empty($notifications)): ?>
            <p style="color: #888; text-align: center; padding: 2rem 0;">No notifications.</p>
        <?php else: ?>
            <?php foreach (array_reverse($notifications) as $n): ?>
            <div style="display: flex; align-items: center; gap: 15px; padding: 1.2rem 0; border-bottom: 1px solid #f1f5f9; <?= $n['is_read'] ? 'opacity: 0.6;' : '' ?>">
                <div style="width: 10px; height: 10px; border-radius: 50%; background: <?= $n['is_read'] ? '#ccc' : '#E63946' ?>; flex-shrink: 0;"></div>
                <div style="flex: 1;">
                    <!-- VULNERABILITY: Stored XSS — message rendered raw -->
                    <p style="color: #2B2D42; margin: 0;"><?= $n['message'] ?></p>
                    <span style="color: #aaa; font-size: 0.8rem;"><?= $n['date'] ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
