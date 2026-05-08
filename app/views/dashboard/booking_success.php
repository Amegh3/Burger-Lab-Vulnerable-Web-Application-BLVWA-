<!-- app/views/dashboard/booking_success.php -->
<!-- VULNERABILITY: Reflected XSS — name and notes rendered raw -->
<div style="max-width: 700px; margin: 5rem auto; padding: 0 5%; text-align: center;">
    <div style="background: white; padding: 4rem; border-radius: 40px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <div style="width: 80px; height: 80px; background: #e8f5e9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
            <i class="fa fa-calendar-check" style="font-size: 2rem; color: #4caf50;"></i>
        </div>
        <h2 style="color: #2B2D42; margin-bottom: 1rem;">Reservation Confirmed!</h2>
        <!-- VULNERABILITY: Reflected XSS — name output raw -->
        <p style="color: #666; font-size: 1.1rem; margin-bottom: 2rem;">
            Thank you, <strong style="color: #E63946;"><?= $name ?></strong>! Your table is reserved.
        </p>
        
        <div style="background: #fdfaf5; padding: 2rem; border-radius: 20px; text-align: left;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <p style="font-size: 0.8rem; color: #888; text-transform: uppercase;">Date</p>
                    <p style="font-weight: 700; color: #2B2D42;"><?= $date ?></p>
                </div>
                <div>
                    <p style="font-size: 0.8rem; color: #888; text-transform: uppercase;">Time</p>
                    <p style="font-weight: 700; color: #2B2D42;"><?= $time ?></p>
                </div>
                <div>
                    <p style="font-size: 0.8rem; color: #888; text-transform: uppercase;">Guests</p>
                    <p style="font-weight: 700; color: #2B2D42;"><?= $guests ?></p>
                </div>
            </div>
            <?php if ($notes): ?>
                <div style="border-top: 1px dashed #eee; padding-top: 1.5rem;">
                    <p style="font-size: 0.8rem; color: #888; text-transform: uppercase; margin-bottom: 0.5rem;">Special Requests</p>
                    <!-- VULNERABILITY: Reflected XSS — notes output raw -->
                    <p style="color: #555;"><?= $notes ?></p>
                </div>
            <?php endif; ?>
        </div>
        
        <a href="/" style="display: inline-block; margin-top: 2rem; color: #E63946; text-decoration: none; font-weight: 700;">&larr; Back to Home</a>
    </div>
</div>
