<!-- app/views/cart/success.php -->
<div style="padding: 6rem 5%; display: flex; justify-content: center; background: #fdfaf5; min-height: 80vh;">
    <div style="width: 100%; max-width: 600px; padding: 4rem 3rem; background: white; border-radius: 40px; box-shadow: 0 30px 70px rgba(0,0,0,0.05); text-align: center;">
        
        <div style="width: 80px; height: 80px; background: #E63946; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 2rem; box-shadow: 0 10px 25px rgba(230, 57, 70, 0.3);">
            <i class="fa fa-check"></i>
        </div>

        <h2 style="font-size: 2.5rem; color: #2B2D42; margin-bottom: 1rem; font-weight: 800;">Order Confirmed!</h2>
        <p style="color: #888; font-size: 1.1rem; margin-bottom: 3rem;">Your burgers are being prepared in our artisanal labs.</p>
        
        <div style="background: #f9f9f9; padding: 2rem; border-radius: 20px; display: inline-block; min-width: 300px; margin-bottom: 3rem;">
            <div style="margin-bottom: 1.5rem;">
                <span style="display: block; font-size: 0.8rem; color: #aaa; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Order Reference</span>
                <strong style="font-size: 1.5rem; color: #2B2D42;"><?= htmlspecialchars($order_id) ?></strong>
            </div>
            <div style="border-top: 1px dashed #eee; padding-top: 1.5rem;">
                <span style="display: block; font-size: 0.8rem; color: #aaa; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Total Paid</span>
                <strong style="font-size: 1.5rem; color: #E63946;">₹<?= number_format((float)$amount, 2) ?></strong>
            </div>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: center;">
            <a href="/track?q=<?= urlencode($order_id) ?>" class="btn-primary" style="padding: 1rem 2rem; border-radius: 50px;">Track My Order</a>
            <a href="/" class="btn-primary" style="padding: 1rem 2rem; border-radius: 50px; background: white; color: #2B2D42; border: 1px solid #eee;">Return Home</a>
        </div>

        <p style="margin-top: 4rem; font-size: 0.8rem; color: #ccc;">
            A confirmation receipt has been sent to your registered email.
        </p>
    </div>
</div>
