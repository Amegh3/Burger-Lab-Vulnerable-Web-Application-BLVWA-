<!-- app/views/cart/payment.php -->
<div style="padding: 6rem 5%; display: flex; justify-content: center; background: #fdfaf5; min-height: 80vh;">
    <div style="width: 100%; max-width: 500px;">
        
        <div style="background: white; padding: 3rem; border-radius: 40px; box-shadow: 0 30px 70px rgba(0,0,0,0.05); text-align: center;">
            <h2 style="font-size: 2rem; color: #2B2D42; margin-bottom: 0.5rem; font-weight: 800;">Secure Payment</h2>
            <p style="color: #888; font-size: 0.95rem; margin-bottom: 3rem;">Complete your artisanal burger order.</p>

            <?php if (isset($error)): ?>
                <div style="background: #ffebee; color: #c62828; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; font-size: 0.85rem; border-left: 5px solid #c62828; text-align: left;">
                    <i class="fa fa-exclamation-triangle" style="margin-right: 8px;"></i> <?= $error ?>
                </div>
            <?php endif; ?>

            <div style="background: linear-gradient(135deg, #2B2D42 0%, #444 100%); padding: 2rem; border-radius: 20px; color: white; text-align: left; margin-bottom: 3rem; position: relative; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
                <div style="position: absolute; right: -20px; top: -20px; font-size: 8rem; opacity: 0.1; transform: rotate(15deg);">
                    <i class="fa fa-credit-card"></i>
                </div>
                <div style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; opacity: 0.6; margin-bottom: 1.5rem;">Total Amount</div>
                <div style="font-size: 2.2rem; font-weight: 800;">₹<?= number_format((float)$total_amount, 2) ?></div>
                <div style="margin-top: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
                    <span style="font-size: 0.8rem; opacity: 0.7;">Verified Secure Gateway</span>
                    <i class="fab fa-cc-visa" style="font-size: 1.5rem;"></i>
                </div>
            </div>

            <form action="/checkout/pay" method="POST" id="payment-form">
                <!-- VULNERABILITY 64: Hidden Amount Field (Price Tampering) -->
                <input type="hidden" name="amount" value="<?= $total_amount ?>">
                
                <div style="margin-bottom: 1.5rem; text-align: left;">
                    <label style="display: block; margin-bottom: 0.8rem; font-weight: 700; font-size: 0.8rem; color: #2B2D42; text-transform: uppercase;">Card Holder Name</label>
                    <input type="text" name="card_holder" placeholder="ARUN KUMAR" class="glass-input" required>
                </div>

                <div style="margin-bottom: 1.5rem; text-align: left;">
                    <label style="display: block; margin-bottom: 0.8rem; font-weight: 700; font-size: 0.8rem; color: #2B2D42; text-transform: uppercase;">Card Number</label>
                    <div style="position: relative;">
                        <input type="text" name="card_number" id="card-num" placeholder="XXXX XXXX XXXX XXXX" class="glass-input" maxlength="16" required>
                        <i class="fa fa-lock" style="position: absolute; right: 1.5rem; top: 1.2rem; color: #ccc;"></i>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2.5rem;">
                    <div style="text-align: left;">
                        <label style="display: block; margin-bottom: 0.8rem; font-weight: 700; font-size: 0.8rem; color: #2B2D42; text-transform: uppercase;">Expiry</label>
                        <input type="text" placeholder="MM/YY" class="glass-input" required>
                    </div>
                    <div style="text-align: left;">
                        <label style="display: block; margin-bottom: 0.8rem; font-weight: 700; font-size: 0.8rem; color: #2B2D42; text-transform: uppercase;">CVV</label>
                        <input type="password" placeholder="***" class="glass-input" maxlength="3" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; padding: 1.2rem; font-size: 1.1rem; border-radius: 18px; background: #E63946; box-shadow: 0 10px 30px rgba(230, 57, 70, 0.2);">Pay & Place Order</button>
            </form>

            <p style="margin-top: 2rem; font-size: 0.75rem; color: #aaa;">
                <i class="fa fa-shield-alt"></i> Your payment is processed through a PCI-DSS compliant lab environment.
            </p>
        </div>

        <div style="margin-top: 2rem; text-align: center;">
            <a href="/checkout" style="color: #888; text-decoration: none; font-size: 0.9rem;">&larr; Back to Shipping</a>
        </div>
    </div>
</div>

<script>
    // Client-side simulation of a "Gatekeeper"
    document.getElementById('payment-form').onsubmit = function() {
        const num = document.getElementById('card-num').value;
        if(num.length < 16) {
            alert("Invalid card length. For testing, please use 16 digits.");
            return false;
        }
        return true;
    };
</script>
