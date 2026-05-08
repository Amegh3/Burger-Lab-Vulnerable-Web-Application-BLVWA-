<!-- app/views/dashboard/franchise_success.php -->
<!-- VULNERABILITY: SSRF — server fetches user-supplied URL and displays response -->
<div style="max-width: 800px; margin: 5rem auto; padding: 0 5%;">
    <div style="background: white; padding: 4rem; border-radius: 40px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <div style="text-align: center; margin-bottom: 3rem;">
            <div style="width: 80px; height: 80px; background: #ede7f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                <i class="fa fa-handshake" style="font-size: 2rem; color: #7c4dff;"></i>
            </div>
            <h2 style="color: #2B2D42; margin-bottom: 1rem;">Franchise Inquiry Received</h2>
            <p style="color: #666;">Thank you, <strong style="color: #E63946;"><?= $owner ?></strong>! We'll review your application for <strong><?= $location ?></strong>.</p>
        </div>
        
        <div style="background: #f8fafc; padding: 2rem; border-radius: 20px; border: 1px solid #e2e8f0; margin-bottom: 2rem;">
            <h4 style="margin-bottom: 1rem; color: #2B2D42;">Portfolio Verification Result</h4>
            <p style="font-size: 0.85rem; color: #888; margin-bottom: 0.5rem;">URL Fetched:</p>
            <p style="color: #E63946; margin-bottom: 1.5rem; word-break: break-all;"><?= $portfolio ?></p>
            
            <p style="font-size: 0.85rem; color: #888; margin-bottom: 0.5rem;">Server Response Preview:</p>
            <!-- VULNERABILITY: SSRF — raw server response displayed -->
            <div style="background: #0f172a; color: #10b981; padding: 1.5rem; border-radius: 10px; font-family: 'Space Mono', monospace; font-size: 0.8rem; max-height: 400px; overflow-y: auto; white-space: pre-wrap; word-break: break-all;">
<?= htmlspecialchars($preview) ?>
            </div>
        </div>
        
        <div style="text-align: center;">
            <a href="/franchise" style="color: #E63946; text-decoration: none; font-weight: 700;">&larr; Back to Franchise</a>
        </div>
    </div>
</div>
