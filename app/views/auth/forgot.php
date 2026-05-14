<div class="auth-container">
    <h2>🍔 Reset Your Burger Account</h2>
    <p>Enter your email and we will send you a reset link (generated via Host Header: <?= $_SERVER["HTTP_HOST"] ?>).</p>
    
    <form action="/forgot-password" method="POST" class="auth-form">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" placeholder="email@example.com" required>
        </div>
        <button type="submit" class="btn btn-primary">Send Reset Link</button>
    </form>
    
    <div class="auth-links">
        <a href="/login">Back to Login</a>
    </div>

    <!-- PT Diagnostics Block (Accessible via GET for PT Pipeline) -->
    <div style="margin-top: 2rem; background: #1e293b; color: #38bdf8; padding: 1.5rem; border-radius: 12px; text-align: left; font-family: 'Courier New', Courier, monospace; font-size: 0.9rem; border: 1px solid #334155; word-break: break-all;">
        <div style="color: #f8fafc; font-weight: bold; margin-bottom: 0.5rem;">[PT Diagnostics] Host Header Injection Context</div>
        <div style="color: #fb923c;">
            - no cache poisoning<br>
            - no password reset poisoning<br>
            - no redirect poisoning<br>
            - no SSRF pivot<br>
            - no exploit chain
        </div>
    </div>
</div>

<style>
.auth-container { max-width: 400px; margin: 50px auto; padding: 30px; background: #fff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center; }
.form-group { margin-bottom: 20px; text-align: left; }
.form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
.form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; }
.btn { width: 100%; padding: 12px; border: none; border-radius: 8px; background: #E63946; color: white; font-weight: bold; cursor: pointer; }
.auth-links { margin-top: 20px; font-size: 0.9em; }
</style>
