<!-- app/views/checkout/payment.php -->
<div style="background: #fdfaf5; padding: 4rem 5% 6rem;">
    <div style="max-width: 900px; margin: 0 auto;">
        
        <!-- Progress -->
        <div style="display: flex; justify-content: space-between; margin-bottom: 4rem; position: relative;">
            <div style="position: absolute; top: 15px; left: 0; right: 0; height: 2px; background: #eee; z-index: 1;"></div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-map-marker-alt"></i> Address</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-truck"></i> Delivery</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #E63946; font-weight: 800;"><i class="fa fa-credit-card"></i> Payment</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-check-circle"></i> Review</div>
        </div>

        <?php if (isset($error)): ?>
            <div style="background: #fff5f6; color: #E63946; padding: 1.5rem; border-radius: 15px; margin-bottom: 2rem; border: 1px solid #ffccd0; font-weight: 700; text-align: center;">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 3rem;">
            <div>
                <h2 style="font-size: 2rem; color: #2B2D42; margin-bottom: 2rem;">Secure Checkout</h2>
                
                <form action="/checkout/review?total=<?= $total_amount ?>" method="POST" id="payment-form">
                    
                    <!-- BurgerLab Wallet -->
                    <div class="payment-option active" onclick="selectOption('wallet')" id="opt-wallet" style="background: white; padding: 1.5rem; border-radius: 20px; border: 2px solid #E63946; margin-bottom: 1.5rem; cursor: pointer; box-sizing: border-box;">
                        <label style="display: flex; align-items: center; gap: 15px; cursor: pointer; width: 100%;">
                            <input type="radio" name="method" value="Wallet" checked style="accent-color: #E63946; width: 20px; height: 20px;">
                            <div style="flex: 1;">
                                <div style="font-weight: 800; font-size: 1.1rem;">BurgerLab Wallet</div>
                                <div style="font-size: 0.8rem; color: #2ecc71; font-weight: 700;">Available: ₹<?= number_format($wallet_balance, 2) ?></div>
                            </div>
                            <i class="fa fa-wallet" style="color: #2B2D42; font-size: 1.5rem;"></i>
                        </label>
                    </div>

                    <!-- Card Details -->
                    <div class="payment-option" onclick="selectOption('card')" id="opt-card" style="background: white; padding: 1.5rem; border-radius: 20px; border: 2px solid #eee; margin-bottom: 1.5rem; cursor: pointer; box-sizing: border-box;">
                        <label style="display: flex; align-items: center; gap: 15px; cursor: pointer; width: 100%;">
                            <input type="radio" name="method" value="Card" style="width: 20px; height: 20px;">
                            <div style="flex: 1; font-weight: 800;">Credit / Debit Card</div>
                            <div style="display: flex; gap: 5px;">
                                <i class="fab fa-cc-visa" style="color: #1A1F71; font-size: 1.5rem;"></i>
                                <i class="fab fa-cc-mastercard" style="color: #EB001B; font-size: 1.5rem;"></i>
                            </div>
                        </label>
                        <div id="card-details" class="details-pane" style="display: none; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #eee;">
                            <input type="text" placeholder="Card Number" class="glass-input" style="width: 100%; box-sizing: border-box;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                                <input type="text" placeholder="MM/YY" class="glass-input" style="width: 100%; box-sizing: border-box;">
                                <input type="text" placeholder="CVV" class="glass-input" style="width: 100%; box-sizing: border-box;">
                            </div>
                        </div>
                    </div>

                    <!-- UPI -->
                    <div class="payment-option" onclick="selectOption('upi')" id="opt-upi" style="background: white; padding: 1.5rem; border-radius: 20px; border: 2px solid #eee; margin-bottom: 1.5rem; cursor: pointer; box-sizing: border-box;">
                        <label style="display: flex; align-items: center; gap: 15px; cursor: pointer; width: 100%;">
                            <input type="radio" name="method" value="UPI" style="width: 20px; height: 20px;">
                            <div style="flex: 1; font-weight: 800;">UPI (Any App)</div>
                            <i class="fa fa-mobile-alt" style="color: #2B2D42; font-size: 1.5rem;"></i>
                        </label>
                        <div id="upi-details" class="details-pane" style="display: none; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #eee;">
                            <input type="text" placeholder="yourname@bank" class="glass-input" style="width: 100%; box-sizing: border-box;">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%; padding: 1.2rem; font-size: 1.2rem; border-radius: 20px; margin-top: 1rem;">Review Order &rarr;</button>
                </form>
            </div>

            <!-- Summary -->
            <div style="box-sizing: border-box;">
                <div style="background: white; padding: 2rem; border-radius: 30px; box-shadow: 0 20px 50px rgba(0,0,0,0.05); position: sticky; top: 120px;">
                    <h3 style="margin-bottom: 1.5rem;">Order Summary</h3>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; color: #888;">
                        <span>Subtotal</span>
                        <span>₹<?= number_format($total_amount, 2) ?></span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; color: #888;">
                        <span>Delivery Fee</span>
                        <span><span style="text-decoration: line-through; margin-right: 5px;">₹40.00</span> <span style="color: #2ecc71; font-weight: 800;">FREE</span></span>
                    </div>
                    <div style="border-top: 1px dashed #eee; margin: 1.5rem 0; padding-top: 1.5rem; display: flex; justify-content: space-between;">
                        <span style="font-weight: 800; font-size: 1.2rem;">Total Payable</span>
                        <span style="font-weight: 800; font-size: 1.2rem; color: #E63946;">₹<?= number_format($total_amount, 2) ?></span>
                    </div>

                    <?php if ($is_lab_mode): ?>
                        <div style="margin-top: 2rem; padding: 1.5rem; background: #e3f2fd; border-radius: 15px; border-left: 5px solid #2196f3;">
                            <div style="font-weight: 800; font-size: 0.75rem; color: #1565c0; text-transform: uppercase; margin-bottom: 0.5rem;"><i class="fa fa-bug"></i> Lab Hack: Parameter Manipulation</div>
                            <p style="font-size: 0.8rem; color: #1565c0; line-height: 1.5;">The system trusts the <code>total</code> parameter in the URL. Hackers set it to <strong>1</strong> or <strong>2</strong> to bypass balance checks. You can also use <strong>negative</strong> values to "recharge" your wallet!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function selectOption(type) {
    document.querySelectorAll('.payment-option').forEach(el => { el.style.borderColor = '#eee'; el.classList.remove('active'); });
    document.querySelectorAll('.details-pane').forEach(el => el.style.display = 'none');
    const opt = document.getElementById('opt-' + type);
    opt.style.borderColor = '#E63946';
    opt.querySelector('input[type="radio"]').checked = true;
    if(document.getElementById(type + '-details')) document.getElementById(type + '-details').style.display = 'block';
}
</script>
