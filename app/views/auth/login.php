<!-- app/views/auth/login.php -->
<div style="padding: 6rem 5%; display: flex; justify-content: center; background: #fdfaf5; min-height: 80vh;">
    <div
        style="width: 100%; max-width: 420px; padding: 4rem 3rem; background: white; border-radius: 40px; box-shadow: 0 30px 70px rgba(0,0,0,0.05); text-align: center;">

        <!-- Burger Lab Logo Icon -->
        <div style="display: flex; justify-content: center; margin-bottom: 2rem;">
            <div
                style="background: #E63946; color: white; width: 70px; height: 70px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; box-shadow: 0 10px 25px rgba(230, 57, 70, 0.4);">
                <i class="fa fa-hamburger"></i>
            </div>
        </div>

        <h2 style="font-size: 2.2rem; color: #2B2D42; margin-bottom: 3rem; font-weight: 800; font-family: 'Outfit', sans-serif;">Burger Labs</h2>

        <?php if (isset($error)): ?>
            <div
                style="background: #ffebee; color: #c62828; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; font-size: 0.85rem; border-left: 5px solid #c62828; text-align: left;">
                <i class="fa fa-exclamation-triangle" style="margin-right: 8px;"></i> <?= $error ?>
            </div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div
                style="background: #e8f5e9; color: #2e7d32; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; font-size: 0.85rem; border-left: 5px solid #2e7d32; text-align: left;">
                <i class="fa fa-check-circle" style="margin-right: 8px;"></i> <?= $success ?>
            </div>
        <?php endif; ?>

        <!-- VULNERABILITY 3: Auth Bypass SQLi -->
        <form action="/login" method="POST">
            <div style="margin-bottom: 1.5rem; text-align: left;">
                <label
                    style="display: block; margin-bottom: 0.8rem; font-weight: 700; font-size: 0.8rem; color: #2B2D42; text-transform: uppercase; letter-spacing: 1px;">Username
                    or Email</label>
                <input type="text" name="username" placeholder="admin@burgerlabs.htb"
                    style="width: 100%; padding: 1.2rem; border-radius: 15px; border: 1px solid #eee; background: #fcfcfc; outline: none; transition: 0.3s;"
                    onfocus="this.style.borderColor='#E63946'" onblur="this.style.borderColor='#eee'" required>
            </div>

            <div style="margin-bottom: 2.5rem; text-align: left;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.8rem;">
                    <label
                        style="font-weight: 700; font-size: 0.8rem; color: #2B2D42; text-transform: uppercase; letter-spacing: 1px;">Password</label>
                    <a href="/forgot-password" style="color: #aaa; font-size: 0.75rem; text-decoration: none;">Forgot?</a>
                </div>
                <input type="password" name="password" placeholder="••••••••"
                    style="width: 100%; padding: 1.2rem; border-radius: 15px; border: 1px solid #eee; background: #fcfcfc; outline: none; transition: 0.3s;"
                    onfocus="this.style.borderColor='#E63946'" onblur="this.style.borderColor='#eee'" required>
            </div>

            <button type="submit" class="btn-primary"
                style="width: 100%; padding: 1.2rem; font-size: 1.1rem; border-radius: 18px; background: #2B2D42; box-shadow: 0 10px 30px rgba(43, 45, 66, 0.2);">Sign
                In to Account</button>
        </form>

        <div style="margin-top: 3rem; font-size: 0.8rem; color: #ccc;">
            <p>&copy; 2026 Burger Labs Secure Access Port</p>
        </div>
    </div>
</div>
