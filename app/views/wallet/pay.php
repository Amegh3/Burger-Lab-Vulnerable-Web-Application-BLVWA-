<!-- app/views/wallet/pay.php -->
<div style="max-width: 600px; margin: 4rem auto; padding: 0 5%;">
    <div style="background: white; padding: 3.5rem; border-radius: 40px; box-shadow: 0 30px 80px rgba(0,0,0,0.08); border: 1px solid #f0f0f0; text-align: center;">
        
        <div style="margin-bottom: 2.5rem;">
            <div style="width: 70px; height: 70px; background: #E63946; color: white; border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; font-size: 2rem; margin-bottom: 1.5rem; box-shadow: 0 10px 25px rgba(230, 57, 70, 0.3);">
                <i class="fa fa-shield-alt"></i>
            </div>
            <h2 class="outfit-font" style="font-size: 2rem; color: #2B2D42; margin: 0;">Secure Payment Gateway</h2>
            <p style="color: #888; margin-top: 0.5rem;">Simulated Transaction Environment</p>
        </div>

        <div style="background: #f8fafc; padding: 2rem; border-radius: 25px; margin-bottom: 3rem; text-align: left;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="color: #666;">Transaction ID</span>
                <span style="font-weight: 700; color: #2B2D42;">#TXN-<?= rand(100000, 999999) ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="color: #666;">Selected Plan</span>
                <span style="font-weight: 700; color: #2B2D42; text-transform: uppercase;"><?= htmlspecialchars($plan) ?></span>
            </div>
            <hr style="border: none; border-top: 1px solid #eee; margin: 1.5rem 0;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span style="color: #2B2D42; font-weight: 800;">Total Payable</span>
                <span style="font-size: 1.8rem; font-weight: 800; color: #E63946;">₹<?= number_format($amount, 2) ?></span>
            </div>
        </div>

        <p style="color: #888; font-size: 0.9rem; margin-bottom: 2.5rem; line-height: 1.6;">
            By clicking "Verify & Complete", you simulate a successful handshake with the bank. In a vulnerable lab, this handshake is blindly trusted.
        </p>

        <!-- VULNERABILITY: This form contains the 'paid_amount' as a hidden field. 
             Attacker can intercept this request and change 'paid_amount' to any value. -->
        <form action="/wallet/verify-payment" method="POST">
            <input type="hidden" name="paid_amount" value="<?= $amount ?>">
            <input type="hidden" name="status" value="success">
            <input type="hidden" name="plan_id" value="<?= htmlspecialchars($plan) ?>">
            
            <button type="submit" style="width: 100%; background: #2B2D42; color: white; border: none; padding: 1.2rem; border-radius: 18px; font-weight: 800; font-size: 1.1rem; cursor: pointer; transition: 0.3s; box-shadow: 0 15px 35px rgba(43, 45, 66, 0.2);" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='none'">
                VERIFY & COMPLETE PAYMENT
            </button>
        </form>

        <a href="/wallet" style="display: block; margin-top: 1.5rem; color: #888; text-decoration: none; font-weight: 700; font-size: 0.9rem;">Cancel Transaction</a>
    </div>
</div>
