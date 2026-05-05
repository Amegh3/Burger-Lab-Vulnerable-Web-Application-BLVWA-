<!-- app/views/orders/search.php -->
<div style="background: linear-gradient(135deg, #2B2D42 0%, #1a1a1a 100%); padding: 6rem 5% 4rem; color: white; text-align: center;">
    <h1 style="font-size: 3rem; margin-bottom: 1rem;">Tracking Results</h1>
    <p style="opacity: 0.8;">Searching for Order ID: <strong><?= htmlspecialchars($query) ?></strong></p>
</div>

<div style="max-width: 1000px; margin: -3rem auto 5rem; padding: 0 5%;">
    <?php if ($error): ?>
        <div style="background: #ffebee; color: #c62828; padding: 1.5rem; border-radius: 20px; margin-bottom: 2rem; border-left: 5px solid #c62828; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
            <h4 style="margin-bottom: 0.5rem;">⚠️ System Error</h4>
            <p style="font-size: 0.9rem;"><?= htmlspecialchars($error) ?></p>
        </div>
    <?php endif; ?>

    <div style="background: white; padding: 3rem; border-radius: 30px; box-shadow: 0 20px 50px rgba(0,0,0,0.1);">
        <?php if (!empty($results)): ?>
            <?php foreach($results as $order): ?>
                <div style="border-bottom: 1px solid #eee; padding: 2rem 0; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <span style="display: block; font-size: 0.8rem; color: #aaa; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Order Reference</span>
                        <h3 style="color: #2B2D42; margin-bottom: 0.5rem;">#<?= htmlspecialchars($order['id'] ?? 'N/A') ?></h3>
                        <p style="color: #666; font-size: 0.95rem;"><?= htmlspecialchars($order['burger_name'] ?? 'N/A') ?></p>
                    </div>
                    <div style="text-align: right;">
                        <span style="display: inline-block; padding: 0.5rem 1rem; border-radius: 50px; background: #E63946; color: white; font-size: 0.8rem; font-weight: 700; margin-bottom: 0.5rem;">
                            <?= htmlspecialchars($order['status'] ?? 'Processing') ?>
                        </span>
                        <p style="display: block; font-size: 1.2rem; font-weight: 800; color: #2B2D42;">₹<?= number_format((float)($order['total_price'] ?? 0), 2) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="text-align: center; padding: 3rem;">
                <div style="font-size: 3rem; margin-bottom: 1.5rem;">🔍</div>
                <h3>No order found</h3>
                <p style="color: #888; margin-bottom: 2rem;">We couldn't find any order matching that reference ID. Please check your receipt.</p>
                <a href="/track" class="btn-primary" style="display: inline-block;">Try Again</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Developer Console (Security Training) -->
    <div style="margin-top: 4rem; background: #f8f9fa; border-radius: 20px; padding: 2rem; border: 1px solid #eee;">
        <h5 style="color: #888; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 2px; margin-bottom: 1.5rem;">🛠️ Dev Console: SQL Query Observation</h5>
        <div style="font-family: monospace; font-size: 0.85rem; color: #444; line-height: 1.6;">
            <p><strong>Query Execution Parameter:</strong> <?= htmlspecialchars($query) ?></p>
            <p><strong>Security Level:</strong> <?= htmlspecialchars($difficulty) ?></p>
            <?php if (strpos(strtolower($query), 'union') !== false): ?>
                <div style="margin-top: 1rem; padding: 1rem; background: #fff3cd; color: #856404; border-radius: 10px; font-size: 0.8rem;">
                    <strong>[DEBUG]</strong> Detected SQL injection keywords. In a real scenario, this should be blocked.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
