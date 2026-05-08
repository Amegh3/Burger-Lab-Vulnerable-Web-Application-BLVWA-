<!-- app/views/wallet/topup.php -->
<div style="max-width: 500px; margin: 3rem auto; padding: 0 5%;">
    <div style="background: white; padding: 3rem; border-radius: 30px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <h2 style="margin-bottom: 0.5rem; color: #2B2D42;">Add Money</h2>
        <p style="color: #888; margin-bottom: 2rem;">Top up your Burger Labs wallet.</p>
        
        <!-- VULNERABILITY: Amount from client, no server validation -->
        <!-- Exploit: Send amount=-99999 via Burp to drain wallet or amount=99999 for free money -->
        <form action="/wallet/topup" method="POST">
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2rem;">
                <button type="button" onclick="setAmount(100)" style="padding: 1rem; border: 2px solid #eee; border-radius: 12px; background: white; font-weight: 700; cursor: pointer; font-size: 1rem;">₹100</button>
                <button type="button" onclick="setAmount(500)" style="padding: 1rem; border: 2px solid #eee; border-radius: 12px; background: white; font-weight: 700; cursor: pointer; font-size: 1rem;">₹500</button>
                <button type="button" onclick="setAmount(1000)" style="padding: 1rem; border: 2px solid #eee; border-radius: 12px; background: white; font-weight: 700; cursor: pointer; font-size: 1rem;">₹1000</button>
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.5rem;">Custom Amount</label>
                <input type="number" name="amount" id="topup-amount" placeholder="Enter amount" class="glass-input" step="0.01" required>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; padding: 1rem; border-radius: 15px;">Add to Wallet</button>
        </form>
        <a href="/wallet" style="display: block; text-align: center; margin-top: 1.5rem; color: #888; text-decoration: none;">&larr; Back to Wallet</a>
    </div>
</div>
<script>
function setAmount(val) {
    document.getElementById('topup-amount').value = val;
}
</script>
