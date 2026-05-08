<!-- app/views/wallet/index.php -->
<div style="max-width: 800px; margin: 3rem auto; padding: 0 5%;">
    <div style="background: linear-gradient(135deg, #0f172a, #1e293b); padding: 3rem; border-radius: 30px; color: white; margin-bottom: 2rem;">
        <p style="font-size: 0.85rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px;">Wallet Balance</p>
        <h1 style="font-size: 3.5rem; font-weight: 800; margin: 0.5rem 0;">₹<?= number_format($balance, 2) ?></h1>
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <a href="/wallet/topup" style="background: #10b981; color: white; padding: 0.8rem 2rem; border-radius: 12px; text-decoration: none; font-weight: 700;">+ Add Money</a>
            <a href="/wallet/transfer" style="background: rgba(255,255,255,0.1); color: white; padding: 0.8rem 2rem; border-radius: 12px; text-decoration: none; font-weight: 700; border: 1px solid rgba(255,255,255,0.2);">Transfer</a>
        </div>
    </div>

    <div style="background: white; padding: 2rem; border-radius: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom: 1.5rem; color: #2B2D42;">Recent Transactions</h3>
        <?php if (empty($transactions)): ?>
            <p style="color: #888; text-align: center; padding: 2rem 0;">No transactions yet.</p>
        <?php else: ?>
            <?php foreach (array_reverse($transactions) as $tx): ?>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; border-bottom: 1px solid #f1f5f9;">
                    <div>
                        <p style="font-weight: 700; color: #2B2D42; margin: 0;"><?= $tx['note'] ?></p>
                        <p style="font-size: 0.8rem; color: #888; margin: 0.3rem 0 0;"><?= $tx['date'] ?></p>
                    </div>
                    <span style="font-weight: 800; color: <?= $tx['amount'] >= 0 ? '#10b981' : '#E63946' ?>; font-size: 1.1rem;">
                        <?= $tx['amount'] >= 0 ? '+' : '' ?>₹<?= number_format($tx['amount'], 2) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
