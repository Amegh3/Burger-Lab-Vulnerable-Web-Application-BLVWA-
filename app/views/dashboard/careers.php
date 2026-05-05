<!-- app/views/dashboard/careers.php -->
<div style="background: linear-gradient(135deg, #E63946 0%, #a82a33 100%); padding: 8rem 5% 6rem; color: white; text-align: center;">
    <h1 style="font-size: 3.5rem; margin-bottom: 1.5rem; font-weight: 800;">Join the <span style="background: white; color: #E63946; padding: 0 15px; border-radius: 10px;">Lab</span> Squad.</h1>
    <p style="opacity: 0.9; max-width: 700px; margin: 0 auto; font-size: 1.2rem;">We are looking for creative chefs, logistic geniuses, and burger enthusiasts to help us redefine the science of fast food.</p>
</div>

<div style="max-width: 1100px; margin: -4rem auto 5rem; padding: 0 5%;">
    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 3rem;">
        
        <!-- Application Form -->
        <div style="background: white; padding: 3.5rem; border-radius: 40px; box-shadow: 0 30px 60px rgba(0,0,0,0.08);">
            <h2 style="margin-bottom: 2rem; color: #2B2D42;">Send your Resume</h2>
            
            <form action="/apply" method="POST" enctype="multipart/form-data">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; margin-bottom: 0.8rem; text-transform: uppercase;">Full Name</label>
                        <input type="text" placeholder="Arun Kumar" class="glass-input" required>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; margin-bottom: 0.8rem; text-transform: uppercase;">Email</label>
                        <input type="email" placeholder="arun@example.com" class="glass-input" required>
                    </div>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; margin-bottom: 0.8rem; text-transform: uppercase;">Position</label>
                    <select class="glass-input">
                        <option>Burger Architect (Chef)</option>
                        <option>Logistics Lead</option>
                        <option>Customer Experience Manager</option>
                        <option>Frontend Server</option>
                    </select>
                </div>

                <!-- VULNERABILITY: Unrestricted File Upload -->
                <div style="border: 2px dashed #E63946; padding: 3rem; border-radius: 20px; text-align: center; background: #fff9fa; margin-bottom: 2.5rem;">
                    <i class="fa fa-cloud-upload-alt" style="font-size: 3rem; color: #E63946; margin-bottom: 1.5rem;"></i>
                    <h4 style="color: #2B2D42; margin-bottom: 0.5rem;">Upload CV / Portfolio</h4>
                    <p style="font-size: 0.85rem; color: #888; margin-bottom: 2rem;">Supported formats: PDF, DOCX (Max 5MB)</p>
                    
                    <input type="file" name="resume" id="cv-upload" style="display: none;">
                    <label for="cv-upload" class="btn-primary" style="padding: 0.8rem 2rem; border-radius: 50px; cursor: pointer;">Select File</label>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; padding: 1.2rem; font-size: 1.1rem; border-radius: 20px;">Submit Application</button>
            </form>
        </div>

        <!-- Job Details Sidebar -->
        <div>
            <div style="background: #2B2D42; color: white; padding: 2.5rem; border-radius: 30px; margin-bottom: 2rem;">
                <h3 style="margin-bottom: 1.5rem; color: #E63946;">Why us?</h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 1rem; display: flex; gap: 10px; font-size: 0.9rem; opacity: 0.9;">
                        <i class="fa fa-check-circle" style="color: #E63946; margin-top: 4px;"></i>
                        Competitive Salary & PF Benefits
                    </li>
                    <li style="margin-bottom: 1rem; display: flex; gap: 10px; font-size: 0.9rem; opacity: 0.9;">
                        <i class="fa fa-check-circle" style="color: #E63946; margin-top: 4px;"></i>
                        Global Training Programs
                    </li>
                    <li style="margin-bottom: 1rem; display: flex; gap: 10px; font-size: 0.9rem; opacity: 0.9;">
                        <i class="fa fa-check-circle" style="color: #E63946; margin-top: 4px;"></i>
                        Free Burger meals daily!
                    </li>
                </ul>
            </div>

            <div style="background: white; padding: 2.5rem; border-radius: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                <h4 style="margin-bottom: 1.2rem;">Our HQ Lab</h4>
                <p style="font-size: 0.85rem; color: #888; line-height: 1.8;">
                    Vazhuthacaud, Trivandrum<br>
                    Kerala, India - 695014<br><br>
                    <strong>Email:</strong> hr@burgerlabs.in<br>
                    <strong>Phone:</strong> +91 471 2233445
                </p>
            </div>
        </div>

    </div>
</div>
