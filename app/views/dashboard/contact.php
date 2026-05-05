<!-- app/views/dashboard/contact.php -->
<div class="section-header">
    <h2>Get in Touch</h2>
    <p>We'd love to hear from you.</p>
</div>

<div style="max-width: 1000px; margin: 0 auto; padding: 0 5% 5rem; display: flex; gap: 4rem;">
    <div style="flex: 1;">
        <h3 style="margin-bottom: 1.5rem; font-size: 1.8rem;">Contact Information</h3>
        <p style="color: #666; margin-bottom: 2rem;">Whether you have a question about our menu, need help with an
            order, or just want to say hi, our team is here for you.</p>

        <div style="margin-bottom: 1.5rem;">
            <h4 style="color: #E63946;">Email</h4>
            <p style="color: #666;">support@burgerlabs.htb</p>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <h4 style="color: #E63946;">Phone</h4>
            <p style="color: #666;">+1 (555) BURG-LAB</p>
        </div>

        <div>
            <h4 style="color: #E63946;">Location</h4>
            <p style="color: #666;">123 Culinary Drive, Flavor Town, FL</p>
        </div>
    </div>

    <div
        style="flex: 1.5; background: white; padding: 3rem; border-radius: 25px; box-shadow: 0 10px 40px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom: 2rem;">Send a Message</h3>
        <form action="/contact" method="POST">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <input type="text" name="name" placeholder="Name" class="glass-input" required>
                <!-- VULNERABILITY: SMTP Header Injection in Email field -->
                <input type="email" name="email" placeholder="Email" class="glass-input" required>
            </div>
            <input type="text" name="subject" placeholder="Subject" class="glass-input" required>
            <textarea name="message" placeholder="How can we help?" class="glass-input" style="height: 150px;"
                required></textarea>

            <button type="submit" class="btn-primary" style="width: 100%; padding: 1rem;">Submit Message</button>
        </form>
    </div>
</div>