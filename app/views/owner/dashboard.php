<!-- app/views/owner/dashboard.php -->
<div style="padding: 4rem 8%; background: #fdfaf5; min-height: 100vh;">
    <div style="max-width: 1400px; margin: 0 auto;">
        
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 4rem;">
            <div>
                <span style="color: #E63946; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; font-size: 0.85rem;">Executive Portal</span>
                <h1 class="outfit-font" style="font-size: 3.5rem; color: #2B2D42; margin: 0.5rem 0;">Founder's Command Centre</h1>
            </div>
            <div style="text-align: right;">
                <p style="color: #888; margin-bottom: 0.5rem;">Current Fiscal Revenue</p>
                <h2 style="font-size: 2.2rem; color: #10b981; margin: 0; font-weight: 800;"><?= $total_revenue ?></h2>
            </div>
        </div>

        <!-- High-Level Stats -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2.5rem; margin-bottom: 4rem;">
            <div style="background: white; padding: 2.5rem; border-radius: 40px; box-shadow: 0 30px 60px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
                <i class="fa fa-chart-line" style="font-size: 2rem; color: #E63946; margin-bottom: 1.5rem;"></i>
                <h3 style="margin: 0; color: #2B2D42; font-size: 1.2rem;">Growth Projections</h3>
                <p style="color: #666; margin-top: 1rem; line-height: 1.6;"><?= $expansion_plans ?></p>
            </div>
            <div style="background: white; padding: 2.5rem; border-radius: 40px; box-shadow: 0 30px 60px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
                <i class="fa fa-users-cog" style="font-size: 2rem; color: #4361ee; margin-bottom: 1.5rem;"></i>
                <h3 style="margin: 0; color: #2B2D42; font-size: 1.2rem;">Operational Health</h3>
                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">All 4 molecular kitchens are operating at 98% efficiency. Staff churn is below 5%.</p>
            </div>
            <div style="background: #2B2D42; padding: 2.5rem; border-radius: 40px; box-shadow: 0 30px 60px rgba(43,45,66,0.2); color: white;">
                <i class="fa fa-vault" style="font-size: 2rem; color: #ffd700; margin-bottom: 1.5rem;"></i>
                <h3 style="margin: 0; color: white; font-size: 1.2rem;">The Vault (Encrypted)</h3>
                <p style="color: rgba(255,255,255,0.7); margin-top: 1rem; line-height: 1.6;">Secret Sauce Formula: Version 4.2.0-beta. Locked behind biometric auth.</p>
            </div>
        </div>

        <!-- Employee Payroll & Records -->
        <div style="background: white; padding: 3.5rem; border-radius: 50px; box-shadow: 0 40px 100px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
                <h2 class="outfit-font" style="font-size: 2.2rem; color: #2B2D42; margin: 0;">Executive Payroll Auditor</h2>
                <button style="background: #f8fafc; border: 1px solid #eee; padding: 0.8rem 1.5rem; border-radius: 15px; font-weight: 700; color: #666; cursor: pointer;">
                    <i class="fa fa-download" style="margin-right: 10px;"></i> Export Q3 Audit
                </button>
            </div>

            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid #f8fafc;">
                        <th style="padding: 1.5rem 1rem; color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Employee</th>
                        <th style="padding: 1.5rem 1rem; color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Designation</th>
                        <th style="padding: 1.5rem 1rem; color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Current Salary</th>
                        <th style="padding: 1.5rem 1rem; color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Bank Account</th>
                        <th style="padding: 1.5rem 1rem; color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $emp): ?>
                        <tr style="border-bottom: 1px solid #f8fafc; transition: 0.3s;" onmouseover="this.style.background='#fcfcfc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1.8rem 1rem;">
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div style="width: 40px; height: 40px; background: #eee; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #aaa;">
                                        <?= substr($emp['name'], 0, 1) ?>
                                    </div>
                                    <span style="font-weight: 700; color: #2B2D42;"><?= $emp['name'] ?></span>
                                </div>
                            </td>
                            <td style="padding: 1.8rem 1rem; color: #666;"><?= $emp['designation'] ?></td>
                            <td style="padding: 1.8rem 1rem; font-weight: 800; color: #10b981;">₹<?= number_format($emp['salary'], 2) ?></td>
                            <td style="padding: 1.8rem 1rem; font-family: monospace; color: #888;"><?= $emp['bank_acc'] ?></td>
                            <td style="padding: 1.8rem 1rem;">
                                <a href="/owner/employee/details?id=<?= $emp['id'] ?>" style="color: #E63946; text-decoration: none; font-weight: 800; font-size: 0.9rem;">VIEW DOSSIER</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
