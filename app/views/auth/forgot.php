<div class="auth-container">
    <h2>🍔 Reset Your Burger Account</h2>
    <p>Enter your email and we will send you a reset link (generated via Host Header).</p>
    
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
</div>

<style>
.auth-container { max-width: 400px; margin: 50px auto; padding: 30px; background: #fff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center; }
.form-group { margin-bottom: 20px; text-align: left; }
.form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
.form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; }
.btn { width: 100%; padding: 12px; border: none; border-radius: 8px; background: #E63946; color: white; font-weight: bold; cursor: pointer; }
.auth-links { margin-top: 20px; font-size: 0.9em; }
</style>
