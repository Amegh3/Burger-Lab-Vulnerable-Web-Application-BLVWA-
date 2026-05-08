<!-- app/views/orders/index.php -->
<div style="background: #1A1A1A; padding: 6rem 5% 10rem; color: white; text-align: center; position: relative;">
    <div style="margin-bottom: 2rem; display: flex; justify-content: center;">
        <div style="position: relative; width: 100px; height: 100px; background: rgba(230, 57, 70, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; animation: float 3s ease-in-out infinite;">
            <i class="fa fa-motorcycle" style="font-size: 3rem; color: #E63946;"></i>
            <div style="position: absolute; right: -15px; top: 35px; width: 25px; height: 3px; background: #E63946; border-radius: 10px; opacity: 0.5; animation: speedLine 0.5s linear infinite;"></div>
        </div>
    </div>
    <h1 class="outfit-font" style="font-size: 3rem; margin-bottom: 1rem; font-weight: 800;">Track Your Order</h1>
</div>

<div style="max-width: 800px; margin: -5rem auto 5rem; padding: 0 5%; position: relative; z-index: 5;">
    <div style="background: white; padding: 4rem 3rem; border-radius: 35px; box-shadow: 0 40px 100px rgba(0,0,0,0.15); text-align: center;">
        
        <form action="/track" method="GET" style="max-width: 600px; margin: 0 auto 3rem;">
            <div style="position: relative; display: flex; align-items: center; width: 100%; box-sizing: border-box;">
                <i class="fa fa-receipt" style="position: absolute; left: 1.5rem; color: #ccc;"></i>
                <input type="text" name="q" placeholder="Enter Order ID (e.g. BL-123456)" value="<?= htmlspecialchars($order_id ?? '') ?>"
                       style="width: 100%; padding: 1.2rem 1.2rem 1.2rem 3.5rem; border-radius: 15px; border: 2px solid #eee; font-size: 1rem; outline: none;">
                <button type="submit" style="position: absolute; right: 10px; background: #E63946; color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 10px; font-weight: 800; cursor: pointer;">Track</button>
            </div>
        </form>

        <?php if ($order): ?>
            <!-- Swiggy-Style Tracking Dashboard -->
            <div style="text-align: left; background: #fdfaf5; padding: 2rem; border-radius: 25px; border: 1px solid #f0e0d0;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2.5rem;">
                    <div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;"><?= $order['burger_name'] ?></h3>
                        <p style="color: #888; font-size: 0.9rem;">Order ID: <span style="color: #2B2D42; font-weight: 800;"><?= $order['id'] ?></span></p>
                    </div>
                    <div style="text-align: right;">
                        <span style="background: #2ecc71; color: white; padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.8rem; font-weight: 800;"><?= $order['status'] ?></span>
                    </div>
                </div>

                <!-- Tracking Timeline -->
                <div style="position: relative; padding-left: 3rem;">
                    <div style="position: absolute; left: 10px; top: 0; bottom: 0; width: 2px; background: #eee;"></div>
                    
                    <div style="position: relative; margin-bottom: 2rem;">
                        <div style="position: absolute; left: -26px; top: 0; width: 12px; height: 12px; border-radius: 50%; background: #2ecc71; box-shadow: 0 0 0 5px rgba(46, 204, 113, 0.2);"></div>
                        <h4 style="margin: 0; font-size: 1rem;">Order Placed</h4>
                        <p style="color: #888; font-size: 0.8rem; margin-top: 0.3rem;">We have received your artisanal request.</p>
                    </div>

                    <div style="position: relative; margin-bottom: 2rem;">
                        <div style="position: absolute; left: -26px; top: 0; width: 12px; height: 12px; border-radius: 50%; background: #2ecc71;"></div>
                        <h4 style="margin: 0; font-size: 1rem;">Lab Preparation</h4>
                        <p style="color: #888; font-size: 0.8rem; margin-top: 0.3rem;">Our chefs are grilling your burger to perfection.</p>
                    </div>

                    <div style="position: relative;">
                        <div style="position: absolute; left: -26px; top: 0; width: 12px; height: 12px; border-radius: 50%; background: #eee;"></div>
                        <h4 style="margin: 0; font-size: 1rem; color: #ccc;">Out for Delivery</h4>
                        <p style="color: #ccc; font-size: 0.8rem; margin-top: 0.3rem;">Our delivery partner is arriving at the lab.</p>
                    </div>
                </div>

                <div style="margin-top: 3rem; border-top: 1px dashed #ddd; padding-top: 2rem; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="font-size: 0.8rem; color: #888; margin-bottom: 0.5rem;">Total Amount Paid</p>
                        <h4 style="font-size: 1.4rem; color: #E63946;">₹<?= number_format($order['total_price'], 2) ?></h4>
                    </div>
                    <button onclick="alert('Contacting Delivery Partner...')" style="background: white; border: 2px solid #eee; padding: 0.8rem 1.5rem; border-radius: 12px; font-weight: 700; cursor: pointer;">Help?</button>
                </div>
            </div>
        <?php elseif ($order_id): ?>
            <div style="padding: 3rem; background: #fff5f6; border-radius: 25px; border: 1px solid #ffccd0;">
                <i class="fa fa-search" style="font-size: 2rem; color: #E63946; margin-bottom: 1rem;"></i>
                <h3 style="color: #E63946;">Order Not Found</h3>
                <p style="color: #888; margin-top: 1rem;">We couldn't find any order with ID "<?= $order_id ?>". Please check the ID and try again.</p>
            </div>
        <?php else: ?>
            <div style="padding: 2rem; color: #888;">
                <p>Enter your Order ID above to see the real-time tracking dashboard.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<style>
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
    @keyframes speedLine { 0% { transform: translateX(0); opacity: 0.5; } 100% { transform: translateX(-30px); opacity: 0; } }
</style>
