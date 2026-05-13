<!-- app/views/auth/forgot_success.php -->
<div style="padding: 8rem 5% 4rem; background: #fdfaf5; min-height: 80vh; display: flex; justify-content: center; align-items: flex-start;">
    <div style="width: 100%; max-width: 500px; padding: 5rem 3rem; background: white; border-radius: 40px; box-shadow: 0 30px 70px rgba(0,0,0,0.05); text-align: center;">
        
        <div style="display: flex; justify-content: center; margin-bottom: 2.5rem;">
            <div style="background: #2B2D42; color: white; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; box-shadow: 0 10px 25px rgba(43, 45, 66, 0.2);">
                <i class="fa fa-paper-plane"></i>
            </div>
        </div>

        <h2 class="outfit-font" style="font-size: 2.2rem; color: #2B2D42; margin-bottom: 1.5rem; font-weight: 800;">Recovery Dispatched</h2>
        
        <p style="color: #666; line-height: 1.8; margin-bottom: 1rem;">
            If an account exists for the provided address, a secure password recovery link has been dispatched to:
        </p>
        
        <p style="color: #2B2D42; font-size: 1.2rem; font-weight: 700; margin-bottom: 3rem;">
            <?= htmlspecialchars($email) ?>
        </p>

        <p style="color: #999; font-size: 0.9rem; line-height: 1.8; margin-bottom: 3rem; background: #fcfcfc; padding: 1.5rem; border-radius: 20px;">
            The link will remain active for the next 60 minutes. Please check your inbox and follow the instructions to reset your credentials.
        </p>

        <a href="/login" style="display: inline-block; width: 100%; padding: 1.2rem; background: #2B2D42; color: white; border-radius: 18px; text-decoration: none; font-weight: 700; transition: 0.3s; box-shadow: 0 10px 30px rgba(43, 45, 66, 0.2);">
            Return to Secure Access
        </a>
    </div>
</div>
