<!-- app/views/menu/search.php -->
<style>
    .search-hero {
        background: #ffffff;
        padding: 80px 6%;
        border-bottom: 1px solid #f1f5f9;
        text-align: center;
    }

    .search-bar-premium {
        max-width: 600px;
        margin: 40px auto 0;
        display: flex;
        background: #f8fafc;
        padding: 8px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .search-bar-premium input {
        flex: 1;
        background: transparent;
        border: none;
        padding: 15px 25px;
        font-size: 1.1rem;
        outline: none;
        color: #0f172a;
    }

    .search-bar-premium button {
        background: #E63946;
        color: white;
        border: none;
        padding: 0 30px;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
    }

    .search-bar-premium button:hover {
        background: #D62828;
        transform: translateY(-2px);
    }

    .results-grid {
        max-width: 1400px;
        margin: 60px auto;
        padding: 0 6%;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 40px;
    }

    .result-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid #f1f5f9;
        transition: 0.4s;
    }

    .result-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.05);
        border-color: #E63946;
    }

    .result-img {
        width: 100%;
        height: 240px;
        object-fit: cover;
    }

    .result-content {
        padding: 30px;
    }

    .result-category {
        color: #E63946;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        display: block;
        margin-bottom: 10px;
    }

    .result-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        color: #0f172a;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .result-price {
        color: #E63946;
        font-weight: 800;
    }

    .result-desc {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .btn-add {
        width: 100%;
        background: #f1f5f9;
        color: #0f172a;
        border: none;
        padding: 15px;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-add:hover {
        background: #E63946;
        color: white;
    }
</style>

<div class="search-hero">
    <span style="font-family: 'Space Mono', monospace; color: #E63946; font-weight: 700; letter-spacing: 3px;">RESEARCH_DATABASE_QUERY</span>
    <h1 style="font-family: 'Outfit', sans-serif; font-size: 3.5rem; color: #0f172a; margin-top: 15px;">Search Results</h1>
    <p style="color: #64748b; font-size: 1.2rem; margin-top: 10px;">
        Showing <?= count($products) ?> matches for "<span style="color: #E63946; font-weight: 700;"><?= $query ?></span>"
    </p>

    <form action="/search" method="GET" class="search-bar-premium">
        <input type="text" name="q" value="<?= htmlspecialchars($query) ?>" placeholder="Search the lab again...">
        <button type="submit">SEARCH</button>
    </form>
</div>

<div class="results-grid">
    <?php if (!empty($products)): ?>
        <?php foreach($products as $product): ?>
            <div class="result-card">
                <img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>" class="result-img">
                <div class="result-content">
                    <span class="result-category"><?= $product['category'] ?></span>
                    <div class="result-title">
                        <?= $product['name'] ?>
                        <span class="result-price">₹<?= $product['price'] ?></span>
                    </div>
                    <p class="result-desc"><?= $product['description'] ?></p>
                    <button class="btn-add btn-order" 
                            data-id="<?= $product['id'] ?>" 
                            data-name="<?= $product['name'] ?>"
                            data-price="<?= $product['price'] ?>">
                        Add to Cart
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div style="grid-column: 1 / -1; text-align: center; padding: 100px 0;">
            <div style="font-size: 5rem; color: #f1f5f9; margin-bottom: 30px;"><i class="fas fa-search-minus"></i></div>
            <h2 style="font-family: 'Outfit', sans-serif; font-size: 2rem; color: #0f172a;">No items found in the Lab Database</h2>
            <p style="color: #64748b; margin-top: 15px; font-size: 1.1rem;">Try searching for "Zinger", "Angus", or "Shake".</p>
            <a href="/menu" class="btn-add" style="display: inline-block; width: auto; padding: 15px 40px; margin-top: 30px; text-decoration: none;">Back to Full Menu</a>
        </div>
    <?php endif; ?>
</div>
