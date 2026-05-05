<!-- app/views/dashboard/franchise.php -->
<div class="section-header">
    <h2>Franchise Opportunities</h2>
    <p>Bring the Labs to your city.</p>
</div>

<div style="max-width: 900px; margin: 0 auto; padding: 0 5% 5rem; display: flex; gap: 3rem; align-items: flex-start;">
    <div style="flex: 1;">
        <h3 style="margin-bottom: 1rem;">Join the Revolution</h3>
        <p style="color: #666; line-height: 1.6; margin-bottom: 2rem;">Burger Labs is expanding rapidly across the globe. We are looking for visionary partners who understand that a burger is not just food—it's a science.</p>
        
        <ul style="color: #666; line-height: 2; margin-bottom: 2rem;">
            <li>✅ Proven business model</li>
            <li>✅ Proprietary glitch sauce recipes</li>
            <li>✅ Full staff training in burger chemistry</li>
            <li>✅ Global brand recognition</li>
        </ul>
    </div>

    <div style="flex: 1; background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom: 1.5rem;">Franchise Inquiry</h3>
        <form action="/franchise" method="POST">
            <input type="text" name="owner" placeholder="Full Name" class="glass-input" required>
            <input type="email" name="email" placeholder="Email Address" class="glass-input" required>
            <input type="text" name="location" placeholder="Target City/Region" class="glass-input" required>
            
            <!-- VULNERABILITY 79: Blind SSRF -->
            <label style="display: block; font-size: 0.8rem; color: #888; margin-bottom: 0.5rem;">Your Portfolio/Business Website (Required for verification):</label>
            <input type="url" name="portfolio" placeholder="https://yourwebsite.com" class="glass-input" required>
            
            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 1rem;">Submit Application</button>
        </form>
    </div>
</div>
