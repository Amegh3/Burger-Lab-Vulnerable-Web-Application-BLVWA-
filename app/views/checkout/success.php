<!-- app/views/checkout/success.php -->
<div style="background: #fdfaf5; padding: 6rem 5% 8rem; min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div style="max-width: 600px; width: 100%; background: white; padding: 5rem 4rem; border-radius: 50px; box-shadow: 0 40px 100px rgba(0,0,0,0.08); text-align: center; position: relative; overflow: hidden;">
        
        <!-- Decorative Background Circle -->
        <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: #fff5f6; border-radius: 50%; z-index: 1;"></div>

        <div style="position: relative; z-index: 2;">
            <div style="width: 100px; height: 100px; background: #E63946; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3rem; margin: 0 auto 3rem; box-shadow: 0 15px 35px rgba(230, 57, 70, 0.4);">
                <i class="fa fa-check"></i>
            </div>

            <h1 class="outfit-font" style="font-size: 2.8rem; color: #2B2D42; margin-bottom: 1.5rem; font-weight: 800;">Order Received!</h1>
            <p style="color: #666; font-size: 1.1rem; line-height: 1.8; margin-bottom: 4rem;">Your artisanal lab creation is now in the grilling phase. Get ready for the perfect bite.</p>
            
            <div style="background: #fcfcfc; border: 1px solid #f0f0f0; padding: 2.5rem; border-radius: 30px; margin-bottom: 4rem;">
                <div style="margin-bottom: 2rem;">
                    <span style="display: block; font-size: 0.8rem; color: #aaa; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 0.8rem;">Order Reference</span>
                    <strong style="font-size: 1.8rem; color: #2B2D42; letter-spacing: 1px;"><?= htmlspecialchars($order_id) ?></strong>
                </div>
                <div style="border-top: 1px dashed #eee; padding-top: 2rem;">
                    <span style="display: block; font-size: 0.8rem; color: #aaa; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 0.8rem;">Amount Processed</span>
                    <strong style="font-size: 1.8rem; color: #E63946;">₹<?= number_format((float)$amount, 2) ?></strong>
                </div>
            </div>

            <div style="display: flex; gap: 1.5rem; justify-content: center;">
                <a href="/track?q=<?= urlencode($order_id) ?>" class="btn-primary" style="padding: 1.2rem 2.5rem; border-radius: 20px; font-weight: 800; font-size: 1rem;">Track Order</a>
                <a href="/" style="padding: 1.2rem 2.5rem; border-radius: 20px; text-decoration: none; color: #2B2D42; border: 1px solid #eee; font-weight: 800; font-size: 1rem;">Back Home</a>
            </div>
        </div>
    </div>
</div>
