<div class="auth-container">
    <h2>📬 Password Reset Link Sent</h2>
    <p>A password reset link has been generated and sent to <strong><?= htmlspecialchars($email) ?></strong>.</p>
    
    <p>Please check your inbox (including the spam folder) to complete the reset process.</p>
    
    <div class="auth-links">
        <a href="/login">Return to Login</a>
    </div>

    <!-- For Training Purposes: In a real app this would be in an email, but here we display it below to simulate receiving it -->
    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; color: #888; font-size: 0.8em;">
        <p>Simulation: Received Email Content</p>
        <code><?= htmlspecialchars($reset_link) ?></code>
    </div>
</div>

<style>
.auth-container { max-width: 500px; margin: 50px auto; padding: 40px; background: #fff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center; }
.auth-links { margin-top: 30px; }
.btn-return { display: inline-block; padding: 10px 20px; background: #1D3557; color: white; text-decoration: none; border-radius: 6px; }
</style>
