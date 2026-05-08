<!-- app/views/dashboard/contact_success.php -->
<!-- VULNERABILITY: Reflected XSS — name and message rendered raw -->
<div style="max-width: 700px; margin: 5rem auto; padding: 0 5%; text-align: center;">
    <div style="background: white; padding: 4rem; border-radius: 40px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <div style="width: 80px; height: 80px; background: #e8f5e9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
            <i class="fa fa-check" style="font-size: 2rem; color: #4caf50;"></i>
        </div>
        <h2 style="color: #2B2D42; margin-bottom: 1rem;">Message Sent!</h2>
        <!-- VULNERABILITY: Reflected XSS — name output raw -->
        <p style="color: #666; font-size: 1.1rem; margin-bottom: 2rem;">
            Thank you, <strong style="color: #E63946;"><?= $name ?></strong>! We've received your message.
        </p>
        <div style="background: #fdfaf5; padding: 2rem; border-radius: 20px; text-align: left; margin-bottom: 2rem;">
            <p style="font-size: 0.85rem; color: #888; margin-bottom: 0.5rem;">Subject:</p>
            <p style="color: #2B2D42; font-weight: 700; margin-bottom: 1.5rem;"><?= $subject ?></p>
            <p style="font-size: 0.85rem; color: #888; margin-bottom: 0.5rem;">Your Message:</p>
            <!-- VULNERABILITY: Reflected XSS — message output raw -->
            <p style="color: #555; line-height: 1.6;"><?= $message ?></p>
        </div>
        <p style="color: #aaa; font-size: 0.85rem;">We'll respond within 24 hours to <strong><?= $email ?></strong></p>
        <a href="/" style="display: inline-block; margin-top: 2rem; color: #E63946; text-decoration: none; font-weight: 700;">&larr; Back to Home</a>
    </div>
</div>
