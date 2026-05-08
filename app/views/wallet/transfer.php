<!-- app/views/wallet/transfer.php -->
<div style="max-width: 500px; margin: 3rem auto; padding: 0 5%;">
    <div style="background: white; padding: 3rem; border-radius: 30px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <h2 style="margin-bottom: 0.5rem; color: #2B2D42;">Transfer Funds</h2>
        <p style="color: #888; margin-bottom: 2rem;">Send money to another Burger Labs user.</p>

        <?php if (isset($error)): ?>
            <div style="background: #fff5f6; border: 1px solid #ffccd0; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; color: #E63946; font-weight: 700;"><?= $error ?></div>
        <?php endif; ?>
        
        <!-- VULNERABILITY: IDOR (to_user_id), Negative Transfer, Race Condition -->
        <form action="/wallet/transfer" method="POST">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.5rem;">Recipient User ID</label>
                <input type="number" name="to_user_id" placeholder="e.g. 2" class="glass-input" required>
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.5rem;">Amount (₹)</label>
                <!-- VULNERABILITY: No min=0 enforcement server-side. Negative = steal from recipient -->
                <input type="number" name="amount" placeholder="0.00" class="glass-input" step="0.01" required>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; padding: 1rem; border-radius: 15px;">Send Money</button>
        </form>
        <a href="/wallet" style="display: block; text-align: center; margin-top: 1.5rem; color: #888; text-decoration: none;">&larr; Back to Wallet</a>
    </div>
</div>
