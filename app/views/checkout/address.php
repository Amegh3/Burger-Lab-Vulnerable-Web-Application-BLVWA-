<!-- app/views/checkout/address.php -->
<div style="background: #fdfaf5; padding: 4rem 5% 6rem;">
    <div style="max-width: 900px; margin: 0 auto;">
        
        <div style="display: flex; justify-content: space-between; margin-bottom: 4rem; position: relative;">
            <div style="position: absolute; top: 15px; left: 0; right: 0; height: 2px; background: #eee; z-index: 1;"></div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #E63946; font-weight: 800;"><i class="fa fa-map-marker-alt"></i> Address</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-truck"></i> Delivery</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-credit-card"></i> Payment</div>
            <div style="z-index: 2; background: #fdfaf5; padding: 0 10px; color: #ccc;"><i class="fa fa-check-circle"></i> Review</div>
        </div>

        <div style="background: white; padding: 4rem; border-radius: 40px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
            <h2 style="font-size: 2.2rem; margin-bottom: 2.5rem; color: #2B2D42;">Delivery Address</h2>
            
            <form action="/checkout/delivery" method="POST">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.8rem;">Full Name</label>
                        <input type="text" name="full_name" placeholder="Arun Kumar" class="glass-input" required>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.8rem;">Mobile Number</label>
                        <input type="tel" name="phone" placeholder="+91 99887 76655" class="glass-input" required>
                    </div>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.8rem;">Street Address / Building</label>
                    <input type="text" name="street" placeholder="Vazhuthacaud Junction" class="glass-input" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 2rem; margin-bottom: 3rem;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.8rem;">City</label>
                        <input type="text" name="city" value="Thiruvananthapuram" class="glass-input" readonly>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.8rem;">State</label>
                        <input type="text" name="state" value="Kerala" class="glass-input" readonly>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.8rem;">Pincode</label>
                        <input type="text" name="pincode" placeholder="695014" class="glass-input" required>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn-primary" style="flex: 1; padding: 1.2rem; border-radius: 20px; font-size: 1.1rem;">Continue to Delivery &rarr;</button>
                    <a href="/cart" style="padding: 1.2rem 2.5rem; border-radius: 20px; border: 1px solid #eee; text-decoration: none; color: #888; font-weight: 600;">Back to Cart</a>
                </div>
            </form>
        </div>
    </div>
</div>
