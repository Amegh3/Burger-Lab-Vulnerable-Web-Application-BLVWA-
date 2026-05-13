<!-- app/views/auth/forgot_success.php -->
<div style="padding: 8rem 5% 4rem; background: #fdfaf5; min-height: 80vh; display: flex; justify-content: center; align-items: flex-start;">
    <div style="width: 100%; max-width: 500px; padding: 4rem 3rem; background: white; border-radius: 40px; box-shadow: 0 30px 70px rgba(0,0,0,0.05); text-align: center;">
        
        <div style="display: flex; justify-content: center; margin-bottom: 2.5rem;">
            <div style="background: #E63946; color: white; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; box-shadow: 0 10px 25px rgba(230, 57, 70, 0.3);">
                <i class="fa fa-envelope-open-text"></i>
            </div>
        </div>

        <h2 class="outfit-font" style="font-size: 2.2rem; color: #2B2D42; margin-bottom: 1.5rem; font-weight: 800;">Reset Link Sent</h2>
        
        <p style="color: #666; line-height: 1.8; margin-bottom: 3rem;">
            A secure recovery link has been dispatched to:<br>
            <strong style="color: #2B2D42; font-size: 1.1rem;"><?= htmlspecialchars($email) ?></strong>
        </p>

        <!-- LAB INSIGHT: Host Header Injection Simulation -->
        <div style="background: #f8f9fa; border-radius: 25px; padding: 2.5rem 2rem; text-align: left; border: 1px solid #eee; margin-bottom: 3rem;">
            <span style="display: block; font-size: 0.75rem; color: #aaa; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1.5rem; font-weight: 800;">
                <i class="fa fa-terminal"></i> Inbound Email Simulation
            </span>
            <div style="background: white; border-radius: 15px; padding: 1.5rem; border: 1px solid #f0f0f0; word-break: break-all; font-family: monospace; font-size: 0.9rem; color: #E63946; line-height: 1.5;">
                <?= htmlspecialchars($reset_link) ?>
            </div>
            <p style="margin-top: 1.5rem; font-size: 0.8rem; color: #888; line-height: 1.6;">
                <strong>VAPT Insight:</strong> Carefully analyze the generated link structure. Notice how the domain and port respond to variations in your request headers.
            </p>
        </div>

        <a href="/login" style="display: inline-block; padding: 1.2rem 3rem; background: #2B2D42; color: white; border-radius: 18px; text-decoration: none; font-weight: 700; transition: 0.3s; box-shadow: 0 10px 30px rgba(43, 45, 66, 0.2);">
            Back to Login
        </a>
    </div>
</div>
