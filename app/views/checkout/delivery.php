<!-- app/views/checkout/delivery.php -->
<div style="background: #fdfaf5; padding: 4rem 5% 6rem;">
    <div style="max-width: 900px; margin: 0 auto;">
        
        <!-- Progress Bar -->
        <div style="display: flex; justify-content: space-between; margin-bottom: 4rem; position: relative;">
            <div style="position: absolute; top: 15px; left: 0; right: 0; height: 2px; background: #eee; z-index: 1;"></div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-map-marker-alt"></i> Address</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #E63946; font-weight: 800;"><i class="fa fa-truck"></i> Delivery</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-credit-card"></i> Payment</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-check-circle"></i> Review</div>
        </div>

        <div style="background: white; padding: 4rem; border-radius: 40px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
            <h2 style="font-size: 2.2rem; margin-bottom: 2.5rem; color: #2B2D42;">Delivery Options</h2>
            
            <form action="/checkout/payment" method="POST">
                <div style="background: #f9f9f9; padding: 2rem; border-radius: 20px; border: 2px solid #E63946; margin-bottom: 1.5rem; cursor: pointer; display: flex; align-items: center; gap: 20px;">
                    <input type="radio" name="speed" value="standard" checked style="accent-color: #E63946; width: 22px; height: 22px;">
                    <div style="flex: 1;">
                        <div style="font-weight: 800; font-size: 1.1rem; color: #2B2D42;">Lab-Fresh Delivery (Standard)</div>
                        <p style="color: #666; font-size: 0.9rem;">Delivered within 30-45 mins. Guaranteed fresh.</p>
                    </div>
                    <div style="font-weight: 800; color: #2B2D42;">FREE</div>
                </div>

                <div style="background: white; padding: 2rem; border-radius: 20px; border: 2px solid #eee; margin-bottom: 3rem; opacity: 0.5; display: flex; align-items: center; gap: 20px;">
                    <input type="radio" name="speed" value="express" disabled style="width: 22px; height: 22px;">
                    <div style="flex: 1;">
                        <div style="font-weight: 800; font-size: 1.1rem; color: #2B2D42;">Atomic Delivery (Priority)</div>
                        <p style="color: #666; font-size: 0.9rem;">Delivered within 15-20 mins. Currently unavailable.</p>
                    </div>
                    <div style="font-weight: 800; color: #ccc;">+ ₹99</div>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn-primary" style="flex: 1; padding: 1.2rem; border-radius: 20px; font-size: 1.1rem;">Continue to Payment &rarr;</button>
                    <a href="/checkout/address" style="padding: 1.2rem 2.5rem; border-radius: 20px; border: 1px solid #eee; text-decoration: none; color: #888; font-weight: 600;">Back to Address</a>
                </div>
            </form>
        </div>
    </div>
</div>
