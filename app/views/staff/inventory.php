<!-- app/views/staff/inventory.php -->
<div style="max-width: 800px; margin: 3rem auto; padding: 0 5%;">
    <a href="/staff/dashboard" style="color: #888; text-decoration: none;">&larr; Back to Staff</a>
    <h2 style="color: #2B2D42; margin-top: 1rem;">Inventory Management</h2>
    <p style="color: #888; margin-bottom: 2rem;">Update stock levels for menu items.</p>

    <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <?php foreach ($products as $p): ?>
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.2rem 0; border-bottom: 1px solid #f1f5f9;">
            <div>
                <strong style="color: #2B2D42;"><?= $p['name'] ?></strong>
                <span style="color: #888; font-size: 0.85rem; margin-left: 1rem;">₹<?= $p['price'] ?></span>
            </div>
            <!-- VULNERABILITY: Negative stock → unlimited items -->
            <form action="/staff/inventory/update" method="POST" style="display: flex; align-items: center; gap: 10px;">
                <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                <input type="number" name="stock" value="<?= $p['stock'] ?>" style="width: 80px; padding: 8px; border: 1px solid #eee; border-radius: 8px; text-align: center;">
                <button type="submit" style="background: #10b981; color: white; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 700; font-size: 0.8rem;">Update</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</div>
