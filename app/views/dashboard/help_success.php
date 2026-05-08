<!-- app/views/dashboard/help_success.php -->
<!-- VULNERABILITY: Stored XSS — ticket description rendered raw -->
<div style="max-width: 700px; margin: 5rem auto; padding: 0 5%; text-align: center;">
    <div style="background: white; padding: 4rem; border-radius: 40px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);">
        <div style="width: 80px; height: 80px; background: #fff3e0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
            <i class="fa fa-ticket-alt" style="font-size: 2rem; color: #F4A261;"></i>
        </div>
        <h2 style="color: #2B2D42; margin-bottom: 1rem;">Ticket Created</h2>
        <p style="color: #666; margin-bottom: 2rem;">Your complaint has been registered, <strong style="color: #E63946;"><?= $name ?></strong>.</p>
        
        <div style="background: #f8fafc; padding: 2rem; border-radius: 20px; text-align: left; border: 1px solid #e2e8f0;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem;">
                <div>
                    <p style="font-size: 0.75rem; color: #888; text-transform: uppercase; letter-spacing: 1px;">Ticket ID</p>
                    <p style="font-size: 1.3rem; font-weight: 800; color: #E63946;"><?= $ticket_id ?></p>
                </div>
                <span style="background: #fff3e0; color: #F4A261; padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.8rem; font-weight: 700; height: fit-content;">Open</span>
            </div>
            <p style="font-size: 0.85rem; color: #888; margin-bottom: 0.5rem;">Description:</p>
            <!-- VULNERABILITY: Stored XSS — description output raw -->
            <p style="color: #555; line-height: 1.6; background: white; padding: 1rem; border-radius: 10px;"><?= $description ?></p>
        </div>
        
        <a href="/help" style="display: inline-block; margin-top: 2rem; color: #E63946; text-decoration: none; font-weight: 700;">&larr; View All Tickets</a>
    </div>
</div>
