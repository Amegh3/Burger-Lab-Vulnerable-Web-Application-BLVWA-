<!-- app/views/dashboard/help.php -->
<div style="background: #fdfaf5; padding: 6rem 5% 4rem; text-align: center;">
    <h1 style="font-size: 3rem; color: #2B2D42; margin-bottom: 1rem;">Customer Support Lab</h1>
    <p style="color: #666; max-width: 600px; margin: 0 auto;">Need help with an order or have a complaint? Our team of
        burger scientists is here to assist you 24/7.</p>
</div>

<div
    style="max-width: 1000px; margin: -3rem auto 5rem; padding: 0 5%; display: grid; grid-template-columns: 1fr 1.5fr; gap: 3rem;">
    <!-- Sidebar info -->
    <div
        style="background: #2B2D42; color: white; padding: 3rem; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom: 2rem; color: #E63946;">Quick Support</h3>
        <div style="margin-bottom: 2rem;">
            <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem; opacity: 0.6;">Call Us</h4>
            <p style="font-size: 1.1rem; font-weight: 700;">+91 471 2233445</p>
        </div>
        <div style="margin-bottom: 2rem;">
            <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem; opacity: 0.6;">Email</h4>
            <p style="font-size: 1.1rem; font-weight: 700;">support@burgerlabs.in</p>
        </div>
        <div style="margin-bottom: 2rem;">
            <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem; opacity: 0.6;">HQ Address</h4>
            <p style="font-size: 0.9rem; line-height: 1.6;">Vazhuthacaud, Trivandrum, Kerala, India - 695014</p>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 2rem;">
            <a href="/faq" style="color: #E63946; text-decoration: none; font-weight: 700;">View FAQs &rarr;</a>
        </div>
    </div>

    <!-- Complaint Form -->
    <div style="background: white; padding: 3.5rem; border-radius: 40px; box-shadow: 0 30px 60px rgba(0,0,0,0.05);">
        <h2 style="margin-bottom: 2rem; color: #2B2D42;">Raise a Complaint</h2>

        <form action="/help/submit" method="POST">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label
                        style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; margin-bottom: 0.8rem; text-transform: uppercase;">Your
                        Name</label>
                    <input type="text" name="name" placeholder="Kiran Vijayan" class="glass-input" required>
                </div>
                <div>
                    <label
                        style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; margin-bottom: 0.8rem; text-transform: uppercase;">Order
                        ID (Optional)</label>
                    <input type="text" name="order_id" placeholder="#1001" class="glass-input">
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label
                    style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; margin-bottom: 0.8rem; text-transform: uppercase;">Complaint
                    Category</label>
                <select name="category" class="glass-input">
                    <option>Delivery Delay</option>
                    <option>Food Quality Issue</option>
                    <option>Incorrect Item</option>
                    <option>Payment/Refund Issue</option>
                    <option>Other</option>
                </select>
            </div>

            <div style="margin-bottom: 2.5rem;">
                <label
                    style="display: block; font-weight: 700; font-size: 0.8rem; color: #555; margin-bottom: 0.8rem; text-transform: uppercase;">Description</label>
                <!-- VULNERABILITY: Stored XSS - This content is saved and viewed by 'admin' -->
                <textarea name="description" placeholder="Describe your issue in detail..." class="glass-input"
                    style="height: 150px;" required></textarea>
            </div>

            <button type="submit" class="btn-primary"
                style="width: 100%; padding: 1.2rem; font-size: 1.1rem; border-radius: 20px;">Submit Ticket</button>
        </form>
    </div>
</div>