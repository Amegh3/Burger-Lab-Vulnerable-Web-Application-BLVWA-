<!-- app/views/owner/employee_details.php -->
<div style="padding: 4rem 8%; background: #fdfaf5; min-height: 100vh;">
    <div style="max-width: 900px; margin: 0 auto;">
        
        <a href="/owner/dashboard" style="text-decoration: none; color: #888; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 2rem; transition: 0.3s;" onmouseover="this.style.color='#E63946'" onmouseout="this.style.color='#888'">
            <i class="fa fa-arrow-left"></i> BACK TO AUDIT
        </a>

        <div style="background: white; padding: 4rem; border-radius: 50px; box-shadow: 0 40px 100px rgba(0,0,0,0.05); border: 1px solid #f0f0f0; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; right: 0; padding: 2rem; background: #fdfaf5; border-bottom-left-radius: 40px; font-weight: 800; color: #2B2D42; letter-spacing: 1px; font-size: 0.8rem;">
                DOSSIER ID: #<?= $employee['id'] ?>
            </div>

            <div style="display: flex; gap: 3rem; align-items: center; margin-bottom: 4rem;">
                <div style="width: 120px; height: 120px; background: linear-gradient(135deg, #2B2D42, #1a1c29); border-radius: 35px; display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; font-weight: 800; box-shadow: 0 20px 40px rgba(43,45,66,0.2);">
                    <?= substr($employee['name'] ?? 'E', 0, 1) ?>
                </div>
                <div>
                    <h1 class="outfit-font" style="font-size: 2.5rem; color: #2B2D42; margin: 0;"><?= $employee['name'] ?></h1>
                    <p style="font-size: 1.2rem; color: #E63946; font-weight: 700; margin: 0.5rem 0;"><?= $employee['designation'] ?></p>
                    <p style="color: #888; margin: 0;"><i class="fa fa-map-marker-alt" style="margin-right: 8px;"></i> <?= $employee['address'] ?></p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 4rem;">
                <div style="background: #f8fafc; padding: 2rem; border-radius: 25px;">
                    <p style="font-size: 0.8rem; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem;">Financial Data</p>
                    <div style="margin-bottom: 1rem;">
                        <span style="display: block; font-size: 0.75rem; color: #aaa;">Current Salary</span>
                        <span style="font-size: 1.8rem; font-weight: 800; color: #10b981;">₹<?= number_format($employee['salary'], 2) ?></span>
                    </div>
                    <div>
                        <span style="display: block; font-size: 0.75rem; color: #aaa;">PF Account</span>
                        <span style="font-size: 1.1rem; font-weight: 700; color: #2B2D42;"><?= $employee['pf_account'] ?></span>
                    </div>
                </div>
                <div style="background: #f8fafc; padding: 2rem; border-radius: 25px;">
                    <p style="font-size: 0.8rem; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem;">Salary History</p>
                    <div style="display: flex; align-items: flex-end; gap: 10px; height: 80px;">
                        <?php foreach (($employee['salary_history'] ?? []) as $hist): ?>
                            <div style="flex: 1; background: #E63946; border-radius: 5px; height: <?= ($hist/90000)*100 ?>%; opacity: 0.6; position: relative;" title="₹<?= number_format($hist) ?>"></div>
                        <?php endforeach; ?>
                    </div>
                    <p style="font-size: 0.7rem; color: #aaa; margin-top: 10px; text-align: center;">Fiscal Year Growth Chart</p>
                </div>
            </div>

            <div style="border-top: 2px dashed #eee; padding-top: 3rem; margin-bottom: 3rem;">
                <h3 class="outfit-font" style="font-size: 1.2rem; color: #2B2D42; margin-bottom: 1.5rem;"><i class="fa fa-user-secret" style="margin-right: 10px; color: #E63946;"></i> Private Executive Notes</h3>
                <p style="line-height: 1.8; color: #555; background: #fff9f0; padding: 1.5rem; border-radius: 20px; border-left: 5px solid #ffcc80;">
                    <?= $employee['private_notes'] ?>
                </p>
            </div>

            <div style="background: #2B2D42; padding: 3rem; border-radius: 40px; color: white;">
                <h3 class="outfit-font" style="margin-top: 0; font-size: 1.4rem;">Modify Compensation</h3>
                <p style="color: rgba(255,255,255,0.6); margin-bottom: 2rem;">Adjust the annual CTC for this employee. This will be reflected in the next billing cycle.</p>
                
                <form action="/owner/salary/update" method="POST" style="display: flex; gap: 1rem;">
                    <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                    <div style="flex: 1; position: relative;">
                        <span style="position: absolute; left: 1.5rem; top: 50%; transform: translateY(-50%); color: #888; font-weight: 800;">₹</span>
                        <input type="number" name="salary" value="<?= $employee['salary'] ?>" style="width: 100%; background: #333; border: none; padding: 1.2rem; padding-left: 2.5rem; border-radius: 18px; color: white; outline: none; font-size: 1.1rem; font-weight: 800;">
                    </div>
                    <button type="submit" style="background: #E63946; color: white; border: none; padding: 0 2.5rem; border-radius: 18px; font-weight: 800; cursor: pointer; transition: 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        UPDATE CTC
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
