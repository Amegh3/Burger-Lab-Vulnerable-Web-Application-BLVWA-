<!-- app/views/staff/refunds.php -->
<div style="max-width: 700px; margin: 3rem auto; padding: 0 5%;">
    <a href="/staff/dashboard" style="color: #888; text-decoration: none;">&larr; Back to Staff</a>
    <h2 style="color: #2B2D42; margin-top: 1rem;">Process Refunds</h2>
    <p style="color: #888; margin-bottom: 2rem;">Issue refunds to customer wallets.</p>

    <div style="background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 2rem;">
        <!-- VULNERABILITY: Double refund — no duplicate check, race condition exploitable -->
        <form id="refund-form">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.5rem;">Order ID</label>
                <input type="text" name="order_id" id="refund-order" placeholder="BL-1001" class="glass-input" required>
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.5rem;">Refund Amount (₹)</label>
                <input type="number" name="amount" id="refund-amount" placeholder="299" class="glass-input" step="0.01" required>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; padding: 1rem; border-radius: 15px;">Process Refund</button>
        </form>
        <div id="refund-result" style="margin-top: 1.5rem;"></div>
    </div>

    <h3 style="margin-bottom: 1rem; color: #2B2D42;">Refund History</h3>
    <div style="background: white; padding: 1.5rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <?php if (empty($refunds)): ?>
            <p style="color: #888; text-align: center;">No refunds processed yet.</p>
        <?php else: ?>
            <?php foreach (array_reverse($refunds) as $r): ?>
            <div style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid #f1f5f9;">
                <div>
                    <strong style="color: #2B2D42;"><?= $r['ref_id'] ?></strong>
                    <span style="color: #888; margin-left: 1rem;">Order <?= $r['order_id'] ?></span>
                </div>
                <span style="color: #10b981; font-weight: 700;">+₹<?= number_format($r['amount'], 2) ?></span>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
document.getElementById('refund-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const data = new FormData(this);
    fetch('/staff/refunds/process', {
        method: 'POST',
        body: data
    }).then(r => r.json()).then(d => {
        document.getElementById('refund-result').innerHTML = 
            '<div style="background: #e8f5e9; padding: 1rem; border-radius: 12px; color: #2e7d32; font-weight: 700;">' +
            '✅ ' + d.message + '<br>New balance: ₹' + d.new_balance + '</div>';
    });
});
</script>
