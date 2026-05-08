<!-- app/views/wallet/transfer_success.php -->
<div style="max-width: 500px; margin: 5rem auto; padding: 0 5%; text-align: center;">
    <div style="background: white; padding: 3rem; border-radius: 30px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <div style="width: 70px; height: 70px; background: #e8f5e9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
            <i class="fa fa-check" style="font-size: 2rem; color: #4caf50;"></i>
        </div>
        <h2 style="color: #2B2D42; margin-bottom: 1rem;">Transfer Complete</h2>
        <p style="color: #666;">₹<?= number_format($amount, 2) ?> sent to User #<?= $to_user ?></p>
        <p style="color: #888; font-size: 0.9rem; margin-top: 1rem;">Remaining balance: <strong style="color: #10b981;">₹<?= number_format($balance, 2) ?></strong></p>
        <a href="/wallet" style="display: inline-block; margin-top: 2rem; color: #E63946; text-decoration: none; font-weight: 700;">&larr; Back to Wallet</a>
    </div>
</div>
