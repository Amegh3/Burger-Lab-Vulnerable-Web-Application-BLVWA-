<!-- app/views/cart/checkout.php -->
<div class="section-header">
    <h1>Shipping Details</h1>
    <p>Where should we deliver your scientific masterpiece?</p>
</div>

<div style="max-width: 700px; margin: 0 auto 5rem; padding: 0 5%;">
    <div style="background: white; padding: 3rem; border-radius: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.05);">
        <form action="/checkout/payment" method="POST">
            <div style="margin-bottom: 2rem;">
                <h3 style="margin-bottom: 1.5rem; color: #2B2D42;">Delivery Address</h3>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #555;">Full Name</label>
                    <input type="text" name="name" placeholder="Arun Kumar" class="glass-input" required>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #555;">Complete Address</label>
                    <textarea name="address" placeholder="Building, Street, Landmark..." class="glass-input" style="height: 100px;" required></textarea>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #555;">Phone Number</label>
                        <input type="tel" name="phone" placeholder="+91 XXXX XXXXXX" class="glass-input" required>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #555;">Pincode</label>
                        <input type="text" name="pincode" placeholder="695014" class="glass-input" required>
                    </div>
                </div>
            </div>

            <div style="border-top: 1px dashed #eee; padding-top: 2rem; margin-top: 2rem;">
                <button type="submit" class="btn-primary" style="width: 100%; padding: 1.2rem; font-size: 1.1rem; border-radius: 20px;">Proceed to Payment &rarr;</button>
            </div>
        </form>
    </div>
</div>
