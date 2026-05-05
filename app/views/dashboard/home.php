<!-- app/views/dashboard/home.php -->
<section class="hero">
    <div class="hero-text">
        <div
            style="background: rgba(230, 57, 70, 0.1); color: #E63946; display: inline-block; padding: 0.5rem 1rem; border-radius: 50px; font-weight: 700; font-size: 0.8rem; margin-bottom: 1.5rem;">
            ✨ NOW OPEN IN THIRUVANANTHAPURAM</div>
        <h1>Authentic <span>Coastal</span> Burger Labs.</h1>
        <p>Savour the rich aromas & flavours of our signature Zinger burgers and Coastal-Konkani inspired sides. Fresh,
            juicy, and bold.</p>
        <div style="display: flex; gap: 1rem;">
            <a href="/menu" class="btn-primary">Order Now</a>
            <a href="/booking" class="btn-primary"
                style="background: white; color: #2B2D42; border: 1px solid #eee;">Book a Table</a>
        </div>
    </div>
    <div class="hero-image">
        <img src="/assets/images/hero.png" alt="Signature Zinger Burger">
    </div>
</section>

<!-- About Section -->
<section style="padding: 5rem 5%; background: white;">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; gap: 4rem; align-items: center;">
        <div style="flex: 1;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem; color: #2B2D42;">About Burger Labs</h2>
            <p style="color: #666; line-height: 1.8; margin-bottom: 2rem;">
                Diners like our restaurant's delicious and fresh burgers, especially the <strong>Zinger Burger</strong>
                and <strong>Loaded Fries</strong>, which are often highlighted as must-try items. We pride ourselves on
                our cozy, peaceful, and aesthetic ambiance, making it a great spot for friends or family.
            </p>
            <p style="color: #666; line-height: 1.8;">
                Guests appreciate the friendly, polite, and quick service, along with the affordable and quality food.
                Whether you're here for a quick bite or a relaxed evening, Burger Labs is your coastal culinary
                destination.
            </p>
            <div style="display: flex; gap: 2rem; margin-top: 3rem;">
                <div>
                    <h4 style="font-size: 2rem; color: #E63946; margin-bottom: 0.5rem;">4.8</h4>
                    <p style="font-size: 0.8rem; color: #888;">Google Rating</p>
                </div>
                <div>
                    <h4 style="font-size: 2rem; color: #E63946; margin-bottom: 0.5rem;">15k+</h4>
                    <p style="font-size: 0.8rem; color: #888;">Happy Diners</p>
                </div>
                <div>
                    <h4 style="font-size: 2rem; color: #E63946; margin-bottom: 0.5rem;">Halal</h4>
                    <p style="font-size: 0.8rem; color: #888;">Certified Quality</p>
                </div>
            </div>
        </div>
        <div style="flex: 1; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <img src="/assets/images/beef.png" style="width: 100%; border-radius: 20px;">
            <img src="/assets/images/zinger.png" style="width: 100%; border-radius: 20px; margin-top: 2rem;">
            <img src="/assets/images/vegan.png" style="width: 100%; border-radius: 20px; margin-top: -2rem;">
            <img src="/assets/images/fries.png" style="width: 100%; border-radius: 20px;">
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section style="padding: 5rem 5%; background: #FDFCDC;">
    <div class="section-header">
        <h2>What People Are Saying</h2>
        <div
            style="background: white; display: inline-block; padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.8rem; margin-top: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
            🤖 Summarised by AI | <a href="/ai-insights?topic=reviews"
                style="color: #E63946; text-decoration: none;">Learn more</a>
            <!-- VULNERABILITY 15: Reflected XSS in 'topic' parameter of AI insights page -->
        </div>
    </div>

    <div class="grid" style="grid-template-columns: repeat(3, 1fr);">
        <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <div style="color: #F4A261; margin-bottom: 1rem;">★★★★★</div>
            <p style="font-style: italic; color: #555; margin-bottom: 1.5rem;">"Nice presentation good customer service.
                The fries are absolutely legendary!"</p>
            <div style="display: flex; align-items: center; gap: 15px;">
                <img src="/assets/images/face1.png"
                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                <div>
                    <strong style="display: block;">Kiran Vijayan</strong>
                    <span style="font-size: 0.75rem; color: #aaa;">Local Guide</span>
                </div>
            </div>
        </div>
        <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <div style="color: #F4A261; margin-bottom: 1rem;">★★★★★</div>
            <p style="font-style: italic; color: #555; margin-bottom: 1.5rem;">"Yummy food, peaceful atmosphere and nice
                service… Best zinger in the city."</p>
            <div style="display: flex; align-items: center; gap: 15px;">
                <img src="/assets/images/face2.png"
                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                <div>
                    <strong style="display: block;">Maneesh Ramesh</strong>
                    <span style="font-size: 0.75rem; color: #aaa;">Verified Buyer</span>
                </div>
            </div>
        </div>
        <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <div style="color: #F4A261; margin-bottom: 1rem;">★★★★★</div>
            <p style="font-style: italic; color: #555; margin-bottom: 1.5rem;">"Chicken fried strips - was very crispy
                outside and juicy chicken strips."</p>
            <div style="display: flex; align-items: center; gap: 15px;">
                <img src="/assets/images/face3.png"
                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                <div>
                    <strong style="display: block;">Dilip CS</strong>
                    <span style="font-size: 0.75rem; color: #aaa;">Food Critic</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Times -->
<section style="padding: 5rem 5%; background: white; text-align: center;">
    <h3 style="margin-bottom: 3rem;">Popular Times</h3>
    <div
        style="max-width: 800px; margin: 0 auto; display: flex; align-items: flex-end; justify-content: space-between; height: 200px; padding-bottom: 2rem; border-bottom: 1px solid #eee;">
        <div style="width: 12%; height: 40%; background: #eee; border-radius: 5px 5px 0 0;"></div>
        <div style="width: 12%; height: 60%; background: #eee; border-radius: 5px 5px 0 0;"></div>
        <div style="width: 12%; height: 80%; background: #eee; border-radius: 5px 5px 0 0;"></div>
        <div style="width: 12%; height: 95%; background: #E63946; border-radius: 5px 5px 0 0;"></div>
        <div style="width: 12%; height: 70%; background: #eee; border-radius: 5px 5px 0 0;"></div>
        <div style="width: 12%; height: 50%; background: #eee; border-radius: 5px 5px 0 0;"></div>
        <div style="width: 12%; height: 30%; background: #eee; border-radius: 5px 5px 0 0;"></div>
    </div>
    <div
        style="max-width: 800px; margin: 1rem auto; display: flex; justify-content: space-between; color: #888; font-size: 0.8rem;">
        <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
    </div>
    <p style="margin-top: 2rem; color: #888;">8 PM: Usually not too busy | Up to 15 mins wait</p>
</section>