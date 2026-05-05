document.addEventListener('DOMContentLoaded', () => {
    // Animate UI Entry
    gsap.from('.hero-text', { x: -50, opacity: 0, duration: 1, ease: "power3.out" });
    gsap.from('.hero-image', { x: 50, opacity: 0, duration: 1, ease: "power3.out" });

    // Add to Cart Logic
    const orderBtns = document.querySelectorAll('.btn-order');
    orderBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const btn = e.target;
            const itemId = btn.getAttribute('data-id');
            const itemName = btn.getAttribute('data-name');
            const price = btn.getAttribute('data-price');
            
            const formData = new URLSearchParams();
            formData.append('item_id', itemId);
            formData.append('item_name', itemName);
            formData.append('price', price);
            formData.append('quantity', '1');

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: formData.toString()
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    // Update Cart Count in UI
                    const cartCount = document.getElementById('cart-count');
                    if(cartCount) cartCount.innerText = data.cart_count;

                    // Show Notification
                    const notification = document.createElement('div');
                    notification.innerText = `Added ${itemName} to cart!`;
                    notification.style.position = 'fixed';
                    notification.style.bottom = '20px';
                    notification.style.right = '20px';
                    notification.style.background = '#E63946';
                    notification.style.color = 'white';
                    notification.style.padding = '15px 25px';
                    notification.style.borderRadius = '15px';
                    notification.style.boxShadow = '0 10px 30px rgba(0,0,0,0.1)';
                    notification.style.zIndex = '10000';
                    document.body.appendChild(notification);
                    
                    setTimeout(() => {
                        notification.remove();
                    }, 3000);
                }
            });
        });
    });
});
