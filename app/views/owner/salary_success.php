<!-- app/views/owner/salary_success.php -->
<div style="background: linear-gradient(135deg, #2B2D42 0%, #1a1a1a 100%); padding: 8rem 5% 4rem; color: white; text-align: center;">
    <div style="width: 100px; height: 100px; background: #4BB543; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3rem; margin: 0 auto 2rem; box-shadow: 0 10px 30px rgba(75, 181, 67, 0.4);">
        <i class="fa fa-check"></i>
    </div>
    <h1 style="font-size: 2.5rem; margin-bottom: 1rem;" class="outfit-font">Payroll Updated Successfully</h1>
    <p style="opacity: 0.8; font-size: 1.1rem;">The executive compensation for Employee ID #<?= htmlspecialchars($id) ?> has been synchronized with the central ledger.</p>
</div>

<div style="max-width: 800px; margin: -3rem auto 5rem; padding: 0 5%;">
    <div style="background: white; padding: 4rem; border-radius: 30px; box-shadow: 0 20px 50px rgba(0,0,0,0.1); text-align: center;">
        <div style="margin-bottom: 3rem;">
            <span style="display: block; font-size: 0.9rem; color: #888; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1rem;">New Annual Salary</span>
            <h2 style="font-size: 3.5rem; color: #2B2D42; font-weight: 800;">₹<?= number_format($salary) ?></h2>
        </div>
        
        <div style="display: flex; gap: 1.5rem; justify-content: center;">
            <a href="/owner/dashboard" class="btn-primary" style="padding: 1.2rem 2.5rem; text-decoration: none; border-radius: 15px; background: #2B2D42;">Back to Dashboard</a>
            <a href="/owner/employee/details?id=<?= htmlspecialchars($id) ?>" style="padding: 1.2rem 2.5rem; text-decoration: none; border-radius: 15px; border: 2px solid #eee; color: #2B2D42; font-weight: 700;">View Profile</a>
        </div>
    </div>

    <!-- Lab Security Insight -->
    <div style="margin-top: 3rem; background: #fff3cd; border-radius: 20px; padding: 2rem; border: 1px solid #ffeeba; color: #856404;">
        <h5 style="margin-bottom: 1rem; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">🛠️ Lab Insight: CSRF Success</h5>
        <p style="font-size: 0.9rem; line-height: 1.6;">
            If you reached this page via a third-party link without clicking any buttons yourself, you have successfully performed a <strong>CSRF (Cross-Site Request Forgery)</strong> attack. The application failed to validate the origin of the request.
        </p>
    </div>
</div>
