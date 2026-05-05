<!-- app/views/menu/index.php -->
<div class="section-header">
    <h1>Our Full Menu</h1>
    <p>Discover our range of artisanal creations.</p>
</div>

<div style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 3rem; padding: 0 5%;">
    <button class="btn-category active" onclick="filterMenu('all')">All Items</button>
    <button class="btn-category" onclick="filterMenu('Beef')">Beef Burgers</button>
    <button class="btn-category" onclick="filterMenu('Chicken')">Chicken Burgers</button>
    <button class="btn-category" onclick="filterMenu('Vegan')">Vegan</button>
    <button class="btn-category" onclick="filterMenu('Sides')">Sides</button>
    <button class="btn-category" onclick="filterMenu('Drinks')">Drinks</button>
</div>

<div class="grid" id="menu-grid">
    <?php
    foreach($products as $product):
    ?>
    <div class="burger-card menu-item" data-category="<?= $product['category'] ?>">
        <img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>" class="card-img">
        <div class="card-content">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3><?= $product['name'] ?></h3>
                <span class="price">₹<?= $product['price'] ?></span>
            </div>
            <div class="ingredients"><?= $product['category'] ?> | Quality Guaranteed</div>
            <p class="description"><?= $product['description'] ?></p>
            
            <button class="btn-order" 
                    data-id="<?= $product['id'] ?>" 
                    data-name="<?= $product['name'] ?>"
                    data-price="<?= $product['price'] ?>">
                Add to Cart
            </button>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<style>
.btn-category {
    padding: 0.6rem 1.5rem;
    border: 2px solid #E63946;
    background: transparent;
    color: #E63946;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-category.active, .btn-category:hover {
    background: #E63946;
    color: white;
}
</style>

<script>
function filterMenu(category) {
    const items = document.querySelectorAll('.menu-item');
    const buttons = document.querySelectorAll('.btn-category');
    
    buttons.forEach(btn => {
        if(btn.innerText.includes(category) || (category === 'all' && btn.innerText === 'All Items')) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });

    items.forEach(item => {
        if(category === 'all' || item.getAttribute('data-category') === category) {
            item.style.display = 'flex';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
