<!-- app/views/dashboard/careers_success.php -->
<!-- VULNERABILITY: Unrestricted File Upload — uploaded file path disclosed -->
<div style="max-width: 700px; margin: 5rem auto; padding: 0 5%; text-align: center;">
    <div style="background: white; padding: 4rem; border-radius: 40px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <div style="width: 80px; height: 80px; background: #e3f2fd; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
            <i class="fa fa-cloud-upload-alt" style="font-size: 2rem; color: #2196f3;"></i>
        </div>
        <h2 style="color: #2B2D42; margin-bottom: 1rem;">Application Submitted!</h2>
        <p style="color: #666; font-size: 1.1rem; margin-bottom: 2rem;">Your application has been received by our HR team.</p>
        
        <div style="background: #f8fafc; padding: 2rem; border-radius: 20px; text-align: left; border: 1px solid #e2e8f0;">
            <p style="font-size: 0.85rem; color: #888; margin-bottom: 0.5rem;">Uploaded File:</p>
            <!-- VULNERABILITY: Path Disclosure — full upload path shown -->
            <p style="font-weight: 700; color: #2B2D42; margin-bottom: 1rem;"><?= $file_name ?></p>
            
            <?php if ($file_path): ?>
                <p style="font-size: 0.85rem; color: #888; margin-bottom: 0.5rem;">Accessible at:</p>
                <!-- VULNERABILITY: Direct file access link — uploaded file is web-accessible -->
                <a href="<?= $file_path ?>" target="_blank" style="color: #E63946; word-break: break-all;"><?= $file_path ?></a>
            <?php endif; ?>
        </div>
        
        <a href="/careers" style="display: inline-block; margin-top: 2rem; color: #E63946; text-decoration: none; font-weight: 700;">&larr; Back to Careers</a>
    </div>
</div>
