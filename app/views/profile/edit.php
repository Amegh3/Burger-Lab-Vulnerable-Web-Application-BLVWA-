<!-- app/views/profile/edit.php -->
<div style="max-width: 600px; margin: 3rem auto; padding: 0 5%;">
    <div style="background: white; padding: 3rem; border-radius: 30px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <h2 style="margin-bottom: 2rem; color: #2B2D42;">Edit Profile</h2>
        
        <!-- VULNERABILITY: Mass Assignment — all fields sent to backend without filtering -->
        <!-- Attacker can add hidden field: role=admin or wallet_balance=99999 -->
        <form action="/profile/edit" method="POST">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.5rem;">Username</label>
                <input type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" class="glass-input">
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.5rem;">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" class="glass-input">
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; text-transform: uppercase; margin-bottom: 0.5rem;">Bio</label>
                <textarea name="bio" placeholder="Tell us about yourself..." class="glass-input" style="height: 100px;"></textarea>
            </div>
            <!-- The form DOES NOT have role/wallet fields, but backend accepts ANY field -->
            <!-- Exploit: Add role=admin via Burp/DevTools to escalate privileges -->
            <button type="submit" class="btn-primary" style="width: 100%; padding: 1rem; border-radius: 15px;">Save Changes</button>
        </form>
        
        <a href="/profile" style="display: block; text-align: center; margin-top: 1.5rem; color: #888; text-decoration: none;">&larr; Back to Profile</a>
    </div>
</div>
