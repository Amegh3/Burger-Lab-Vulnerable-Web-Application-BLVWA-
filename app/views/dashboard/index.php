<div class="dashboard-header" style="text-align: center; margin-bottom: 3rem;">
    <h1 class="orbitron-heading neon-text" style="font-size: 3rem;">OUR CYBER MENU</h1>
    <p style="color: #aaa; font-size: 1.2rem;">Select your fuel.</p>
</div>

<!-- Search Bar - VULNERABILITY 16: Reflected XSS -->
<div style="margin-bottom: 2rem; display: flex; justify-content: center;">
    <form action="/" method="GET" style="display: flex; gap: 10px; width: 100%; max-width: 600px;">
        <input type="text" name="q" placeholder="Search the menu matrix..." class="glass-input" style="flex: 1; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid #0f0; color: #fff; font-family: 'JetBrains Mono';">
        <button type="submit" class="btn neon-btn">QUERY</button>
    </form>
</div>

<?php if(isset($_GET['q'])): ?>
    <div style="margin-bottom: 2rem; text-align: center;">
        <p style="color: #0f0;">SEARCH_RESULTS_FOR: <?= $_GET['q'] ?> (VULN_REFLECTED_XSS)</p>
    </div>
<?php endif; ?>

<!-- Category Filter - VULNERABILITY 1: SQL Injection -->
<div style="margin-bottom: 2rem; display: flex; justify-content: center; gap: 1rem;">
    <a href="/?category=Classic" class="nav-item">CLASSIC</a>
    <a href="/?category=Vegan" class="nav-item">VEGAN</a>
    <a href="/?category=Specials" class="nav-item">SPECIALS</a>
    <a href="/" class="nav-item">RESET</a>
</div>

<div class="card-grid">
    <?php
    use Core\Database;
    $db = Database::getInstance()->getConnection();
    $category = $_GET['category'] ?? null;
    
    // VULNERABILITY 1: SQL Injection
    $sql = "SELECT * FROM products";
    if ($category) {
        $sql .= " WHERE category = '$category'";
    }
    
    $stmt = $db->query($sql);
    $products = $stmt->fetchAll();

    foreach($products as $product):
    ?>
    <div class="glass-card neon-border">
        <?php if(isset($product['image_url'])): ?>
            <img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>" class="burger-showcase">
        <?php endif; ?>
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
            <h3 style="margin: 0;"><?= $product['name'] ?></h3>
            <span style="color: #0f0; font-weight: bold;">$<?= $product['price'] ?></span>
        </div>
        <p style="color: #888; font-size: 0.9rem;"><?= $product['description'] ?></p>
        
        <!-- VULNERABILITY 62: Price Parameter Tampering -->
        <button class="btn neon-btn btn-order" 
                data-id="<?= strtolower(str_replace(' ', '-', $product['name'])) ?>" 
                data-price="<?= $product['price'] ?>"
                style="width: 100%; margin-top: 1rem;">
            ADD_TO_CART
        </button>
    </div>
    <?php endforeach; ?>
</div>

<!-- Hidden Dev Info - VULNERABILITY 97: Verbose Error/Info Disclosure -->
<details style="margin-top: 5rem; opacity: 0.3;">
    <summary>SYSTEM_DEBUG_LOGS</summary>
    <pre>
        SQL_QUERY: <?= $sql ?>
        ACTIVE_USER: GUEST
        SERVER_SOFTWARE: BurgerLabs/2.0.26
    </pre>
</details>
