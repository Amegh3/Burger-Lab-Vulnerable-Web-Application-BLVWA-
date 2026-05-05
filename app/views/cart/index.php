<!-- app/views/cart/index.php -->
<div style="padding: 5rem 5%; min-height: 70vh;">
    <h2 class="section-title">Your Order Summary</h2>
    
    <div style="max-width: 1000px; margin: 0 auto; display: flex; gap: 4rem;">
        <div style="flex: 2;">
            <?php if (empty($cart)): ?>
                <div style="background: white; padding: 4rem; border-radius: 25px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                    <div style="font-size: 4rem; margin-bottom: 1.5rem;">🛒</div>
                    <h3>Your cart is empty</h3>
                    <p style="color: #888; margin-bottom: 2rem;">Looks like you haven't added any burgers to your cart yet.</p>
                    <a href="/menu" class="btn-primary">Browse Menu</a>
                </div>
            <?php else: ?>
                <div style="background: white; border-radius: 25px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr style="background: #f9f9f9; border-bottom: 1px solid #eee;">
                                <th style="padding: 1.5rem;">Item</th>
                                <th style="padding: 1.5rem;">Price</th>
                                <th style="padding: 1.5rem;">Quantity</th>
                                <th style="padding: 1.5rem;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $grandTotal = 0; ?>
                            <?php foreach ($cart as $id => $item): ?>
                                <?php 
                                    $itemTotal = $item['quantity'] * $item['price']; 
                                    $grandTotal += $itemTotal;
                                ?>
                                <tr style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 1.5rem;">
                                        <strong><?= htmlspecialchars($id) ?></strong>
                                    </td>
                                    <td style="padding: 1.5rem;">₹<?= number_format((float)$item['price'], 2) ?></td>
                                    <td style="padding: 1.5rem;">
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <!-- VULNERABILITY 61: Negative Quantity Logic Flaw -->
                                            <button style="width: 30px; height: 30px; border-radius: 50%; border: 1px solid #eee; background: white; cursor: pointer;">-</button>
                                            <span><?= $item['quantity'] ?></span>
                                            <button style="width: 30px; height: 30px; border-radius: 50%; border: 1px solid #eee; background: white; cursor: pointer;">+</button>
                                        </div>
                                    </td>
                                    <td style="padding: 1.5rem; font-weight: bold;">₹<?= number_format((float)$itemTotal, 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <div style="flex: 1;">
            <div style="background: white; padding: 2rem; border-radius: 25px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); position: sticky; top: 120px;">
                <h3 style="margin-bottom: 1.5rem;">Order Total</h3>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; color: #666;">
                    <span>Subtotal</span>
                    <span>₹<?= number_format((float)($grandTotal ?? 0), 2) ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; color: #666;">
                    <span>Delivery Fee</span>
                    <span>₹40.00</span>
                </div>
                <div style="border-top: 2px dashed #eee; margin: 1.5rem 0; padding-top: 1.5rem; display: flex; justify-content: space-between;">
                    <strong>Total</strong>
                    <strong style="color: #E63946; font-size: 1.5rem;">₹<?= number_format((float)(($grandTotal ?? 0) + 40), 2) ?></strong>
                </div>
                
                <a href="/checkout/address" class="btn-primary" style="width: 100%; text-align: center; display: block; padding: 1.2rem; margin-top: 1rem;">Proceed to Payment</a>
                
                <div style="margin-top: 2rem; display: flex; gap: 10px; justify-content: center;">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" style="height: 25px; opacity: 0.5;">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196566.png" style="height: 25px; opacity: 0.5;">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196565.png" style="height: 25px; opacity: 0.5;">
                </div>
            </div>
        </div>
    </div>
</div>
