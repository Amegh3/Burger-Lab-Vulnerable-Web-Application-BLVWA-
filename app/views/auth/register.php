<!-- app/views/auth/register.php -->
<div style="padding: 5rem 5%; display: flex; justify-content: center; background: linear-gradient(135deg, #FFF9EB, #FDFCDC); min-height: 70vh;">
    <div class="burger-card" style="width: 100%; max-width: 500px; padding: 3rem; border-radius: 30px;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h2 style="font-size: 2rem; color: #2B2D42;">Join the Labs</h2>
            <p style="color: #888; font-size: 0.9rem;">Create an account to track orders and earn points</p>
        </div>

        <form action="/register" method="POST">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.85rem; color: #555;">Full Name</label>
                <!-- VULNERABILITY: Stored XSS -->
                <input type="text" name="username" placeholder="Jane Doe" class="glass-input" required>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.85rem; color: #555;">Email Address</label>
                <input type="email" name="email" placeholder="jane@example.com" class="glass-input" required>
            </div>
            
            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.85rem; color: #555;">Password</label>
                <!-- VULNERABILITY: Weak Password Policy -->
                <input type="password" name="password" placeholder="••••••••" class="glass-input" required>
                <p style="font-size: 0.7rem; color: #aaa; margin-top: 0.5rem;">At least 4 characters recommended.</p>
            </div>
            
            <button type="submit" class="btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem; border-radius: 15px;">Register Account</button>
        </form>

        <div style="text-align: center; margin-top: 2rem;">
            <p style="color: #888; font-size: 0.85rem;">Already have an account? <a href="/login" style="color: #E63946; font-weight: 600;">Sign In</a></p>
        </div>
    </div>
</div>
