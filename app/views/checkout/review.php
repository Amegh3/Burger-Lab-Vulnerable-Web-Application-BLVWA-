<!-- app/views/checkout/review.php -->
<div style="background: #fdfaf5; padding: 4rem 5% 6rem;">
    <div style="max-width: 900px; margin: 0 auto;">
        
        <!-- Progress -->
        <div style="display: flex; justify-content: space-between; margin-bottom: 4rem; position: relative;">
            <div style="position: absolute; top: 15px; left: 0; right: 0; height: 2px; background: #eee; z-index: 1;"></div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-map-marker-alt"></i> Address</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-truck"></i> Delivery</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-credit-card"></i> Payment</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #E63946; font-weight: 800;"><i class="fa fa-check-circle"></i> Review</div>
        </div>

        <div style="background: white; padding: 4rem; border-radius: 40px; box-shadow: 0 30px 80px rgba(0,0,0,0.05);">
            <h2 style="font-size: 2.2rem; margin-bottom: 3rem; color: #2B2D42;">Final Review</h2>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; margin-bottom: 3rem; border-bottom: 1px solid #f0f0f0; padding-bottom: 3rem;">
                <div>
                    <h4 style="color: #aaa; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 2px; margin-bottom: 1.5rem;">Delivery To</h4>
                    <p style="font-weight: 800; color: #2B2D42; font-size: 1.1rem; margin-bottom: 0.5rem;"><?= htmlspecialchars($address['full_name'] ?? 'Guest User') ?></p>
                    <p style="color: #666; line-height: 1.6;">
                        <?= htmlspecialchars($address['street'] ?? 'Vazhuthacaud') ?><br>
                        <?= htmlspecialchars($address['city'] ?? 'Trivandrum') ?>, <?= htmlspecialchars($address['pincode'] ?? '695014') ?>
                    </p>
                </div>
                <div>
                    <h4 style="color: #aaa; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 2px; margin-bottom: 1.5rem;">Payment Method</h4>
                    <div style="display: flex; align-items: center; gap: 12px; font-weight: 800; color: #2B2D42; font-size: 1.1rem;">
                        <i class="fa fa-shield-check" style="color: #E63946;"></i>
                        <?= htmlspecialchars($payment_method) ?>
                    </div>
                    <p style="font-size: 0.8rem; color: #888; margin-top: 0.5rem;">Verified Lab Testing Connection</p>
                </div>
            </div>

            <div style="margin-bottom: 3rem;">
                <h4 style="color: #aaa; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 2px; margin-bottom: 1.5rem;">Your Selection</h4>
                <?php 
                $itemCount = count($cart);
                $isTampered = ($total != $this->calculateTotal());
                foreach ($cart as $name => $item): 
                    // If tampered, we "distribute" the total to the items for visual consistency
                    $displayPrice = $isTampered ? ($total / $itemCount) : ($item['price'] * $item['quantity']);
                ?>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1.2rem;">
                        <div>
                            <span style="font-weight: 700; color: #2B2D42;"><?= htmlspecialchars($name) ?></span>
                            <span style="color: #888; margin-left: 10px;">x <?= $item['quantity'] ?></span>
                        </div>
                        <span style="font-weight: 700; color: #2B2D42;">₹<?= number_format($displayPrice, 2) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Coupon Lab -->
            <div style="background: #f9f9f9; padding: 2rem; border-radius: 20px; margin-bottom: 3rem; border: 1px dashed #ddd;">
                <h4 style="font-size: 0.9rem; margin-bottom: 1rem; color: #2B2D42;">Apply Lab Coupon</h4>
                <div style="display: flex; gap: 10px;">
                    <input type="text" id="coupon-code" placeholder="Enter code (e.g. LAB50)" class="glass-input" style="background: white;">
                    <button type="button" class="btn-primary" style="padding: 0.8rem 1.5rem; font-size: 0.85rem; border-radius: 12px;">Apply</button>
                </div>
                <p id="coupon-msg" style="font-size: 0.75rem; color: #888; margin-top: 10px;">Scientific discounts applied here.</p>
            </div>

            <!-- Billing -->
            <div style="background: #2B2D42; color: white; padding: 3rem; border-radius: 30px; margin-bottom: 3rem; position: relative; overflow: hidden;">
                <i class="fa fa-hamburger" style="position: absolute; right: -20px; bottom: -20px; font-size: 10rem; opacity: 0.05;"></i>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem; opacity: 0.7;">
                    <span>Scientific Subtotal</span>
                    <span>₹<?= number_format($total - 40, 2) ?></span>
                </div>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 2rem;">
                    <div>
                        <span>Delivery & Lab Handling</span>
                        <span style="display: block; font-size: 0.7rem; color: #E63946;">✨ FREE PROMO APPLIED</span>
                    </div>
                    <span style="text-decoration: line-through; opacity: 0.5;">₹40.00</span>
                </div>

                <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 2rem; display: flex; justify-content: space-between; align-items: flex-end;">
                    <div>
                        <span style="display: block; font-size: 0.8rem; opacity: 0.6; text-transform: uppercase; letter-spacing: 2px;">Total Payable</span>
                        <strong style="font-size: 2.5rem; color: white;" id="display-total">₹<?= number_format($total, 2) ?></strong>
                    </div>
                    
                    <form action="/checkout/confirm" method="POST" id="confirm-form">
                        <input type="hidden" name="amount" value="<?= $total ?>">
                        <input type="hidden" name="token" value="lab_confirm_<?= rand(1000, 9999) ?>">
                        
                        <button type="submit" class="btn-primary" style="padding: 1.2rem 3rem; font-size: 1.2rem; border-radius: 20px; background: #E63946; box-shadow: 0 10px 30px rgba(230, 57, 70, 0.4);">
                            Finalize Order &rarr;
                        </button>
                    </form>
                </div>
            </div>

            <p style="text-align: center; color: #aaa; font-size: 0.8rem;">
                <i class="fa fa-lock"></i> All transactions are protected by Burger Labs Security Protocols.
            </p>
        </div>
    </div>
</div>
