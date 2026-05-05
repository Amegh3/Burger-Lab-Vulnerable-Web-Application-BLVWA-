<!-- app/views/dashboard/reviews.php -->
<div class="section-header">
    <h2>Customer Reviews</h2>
    <p>What our burger enthusiasts are saying.</p>
</div>

<div style="max-width: 800px; margin: 0 auto; padding: 0 5% 5rem;">
    <!-- Add Review Form - VULNERABILITY 17: Stored XSS -->
    <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 3rem;">
        <h3 style="margin-bottom: 1.5rem;">Leave a Review</h3>
        <form action="/reviews" method="POST">
            <input type="text" name="name" placeholder="Your Name" class="glass-input" required>
            <textarea name="comment" placeholder="Your burger experience..." class="glass-input" style="height: 150px;" required></textarea>
            <div style="margin-bottom: 1.5rem;">
                <label>Rating:</label>
                <select name="rating" class="glass-input">
                    <option value="5">5 Stars - Mind-blowing</option>
                    <option value="4">4 Stars - Delicious</option>
                    <option value="3">3 Stars - Good</option>
                    <option value="2">2 Stars - Average</option>
                    <option value="1">1 Star - Not my bun</option>
                </select>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%;">Post Review</button>
        </form>
    </div>

    <!-- Review List -->
    <div id="reviews-list">
        <div style="background: white; padding: 1.5rem; border-radius: 15px; margin-bottom: 1.5rem; border-left: 5px solid #F4A261;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <strong>Neo</strong>
                <span style="color: #F4A261;">★★★★★</span>
            </div>
            <p style="color: #666; font-size: 0.95rem;">The Neon Double Smash is a glitch in the best way possible. Absolutely delicious!</p>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 15px; margin-bottom: 1.5rem; border-left: 5px solid #F4A261;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <strong>Trinity</strong>
                <span style="color: #F4A261;">★★★★★</span>
            </div>
            <!-- VULNERABILITY: This would be where stored XSS executes -->
            <p style="color: #666; font-size: 0.95rem;">I followed the white rabbit and it led me to the best burger in the city.</p>
        </div>
    </div>
</div>
