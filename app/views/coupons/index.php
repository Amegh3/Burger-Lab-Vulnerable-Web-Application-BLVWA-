<!-- app/views/coupons/index.php -->
<div style="max-width: 700px; margin: 3rem auto; padding: 0 5%;">
    <div style="background: linear-gradient(135deg, #fdfcdc, #fff); padding: 3rem; border-radius: 30px; border: 2px dashed #F4A261; margin-bottom: 2rem; text-align: center;">
        <h2 style="color: #2B2D42; margin-bottom: 0.5rem;">🎟️ Coupon Center</h2>
        <p style="color: #888;">Enter a promotional code to get discounts on your orders.</p>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div style="background: #e8f5e9; border: 1px solid #a5d6a7; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; color: #2e7d32; font-weight: 700;">
            ✅ Coupon <?= $_GET['success'] ?> applied! <?= $_GET['discount'] ?? '' ?>% discount activated.
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <div style="background: #fff5f6; border: 1px solid #ffccd0; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; color: #E63946; font-weight: 700;">
            ❌ Invalid coupon code. Try again.
        </div>
    <?php endif; ?>

    <div style="background: white; padding: 2.5rem; border-radius: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        <!-- VULNERABILITY: No rate limiting — brute force possible -->
        <!-- VULNERABILITY: Reflected XSS via success parameter -->
        <form action="/coupons/validate" method="POST" style="display: flex; gap: 1rem; margin-bottom: 2rem;">
            <input type="text" name="code" placeholder="Enter coupon code (e.g. LAB10)" class="glass-input" style="flex: 1;" required>
            <button type="submit" class="btn-primary" style="padding: 0 2rem; border-radius: 12px;">Apply</button>
        </form>

        <h4 style="margin-bottom: 1rem; color: #2B2D42;">Applied Coupons</h4>
        <?php if (empty($applied)): ?>
            <p style="color: #888; text-align: center;">No coupons applied yet.</p>
        <?php else: ?>
            <?php foreach ($applied as $c): ?>
                <div style="display: flex; justify-content: space-between; padding: 1rem; background: #f8fafc; border-radius: 12px; margin-bottom: 0.5rem;">
                    <div>
                        <strong style="color: #E63946;"><?= $c['code'] ?></strong>
                        <span style="color: #888; font-size: 0.85rem; margin-left: 1rem;"><?= $c['applied'] ?></span>
                    </div>
                    <span style="color: #10b981; font-weight: 800;"><?= $c['discount'] ?>% OFF</span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px dashed #eee;">
            <p style="font-size: 0.8rem; color: #aaa;">💡 Hint: Try codes like LAB10, LAB25, LAB50. Some hidden codes give 100% off!</p>
        </div>
    </div>
</div>
