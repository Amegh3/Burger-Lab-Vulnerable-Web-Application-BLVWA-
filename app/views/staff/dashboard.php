<!-- app/views/staff/dashboard.php -->
<!-- VULNERABILITY: No role check — any authenticated user can access -->
<div style="max-width: 1000px; margin: 3rem auto; padding: 0 5%;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h2 style="color: #2B2D42; margin: 0;">Staff Dashboard</h2>
            <p style="color: #888;">Internal operations panel — authorized personnel only.</p>
        </div>
        <div style="display: flex; gap: 1rem;">
            <a href="/staff/inventory" class="btn-primary" style="text-decoration: none; padding: 0.8rem 1.5rem; border-radius: 12px;">Inventory</a>
            <a href="/staff/refunds" class="btn-primary" style="text-decoration: none; padding: 0.8rem 1.5rem; border-radius: 12px; background: #10b981;">Refunds</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 2.5rem;">
        <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <p style="color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Active Orders</p>
            <h3 style="font-size: 2rem; color: #E63946;"><?= count($orders) ?></h3>
        </div>
        <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <p style="color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Menu Items</p>
            <h3 style="font-size: 2rem; color: #10b981;"><?= count($products) ?></h3>
        </div>
        <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <p style="color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Today's Revenue</p>
            <h3 style="font-size: 2rem; color: #2B2D42;">₹12,450</h3>
        </div>
        <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <p style="color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Pending Refunds</p>
            <h3 style="font-size: 2rem; color: #F4A261;">3</h3>
        </div>
    </div>

    <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom: 1.5rem;">Recent Orders</h3>
        <?php foreach ($orders as $o): ?>
        <div style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid #f1f5f9;">
            <div>
                <strong>#<?= $o['id'] ?></strong> — <?= $o['burger_name'] ?>
                <span style="color: #888; font-size: 0.85rem; margin-left: 1rem;"><?= $o['status'] ?></span>
            </div>
            <span style="color: #10b981; font-weight: 700;">₹<?= $o['total_price'] ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>
