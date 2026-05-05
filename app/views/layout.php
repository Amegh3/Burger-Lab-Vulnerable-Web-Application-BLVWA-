<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burger Labs | Premium Artisanal Burgers</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Outfit:wght@600;800&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        .outfit-font {
            font-family: 'Outfit', sans-serif;
        }

        .logo-icon {
            background: linear-gradient(135deg, #E63946 0%, #a82a33 100%);
            color: white;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-size: 1.6rem;
            box-shadow: 0 8px 20px rgba(230, 57, 70, 0.4);
        }

        .nav-minimal {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem 6%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(15px);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid #f0f0f0;
        }

        .nav-shortcuts-group {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-right: 2rem;
        }

        .nav-shortcut {
            font-size: 0.85rem;
            font-weight: 700;
            color: #2B2D42;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            opacity: 0.7;
            transition: 0.4s;
            position: relative;
        }

        .nav-shortcut:hover {
            opacity: 1;
            color: #E63946;
        }

        .search-icon-btn {
            background: transparent;
            border: none;
            color: #2B2D42;
            font-size: 1.2rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .search-icon-btn:hover {
            color: #E63946;
            transform: scale(1.1);
        }

        /* Premium Footer Styles */
        .premium-footer {
            background: #1A1A1A;
            color: white;
            padding: 8rem 8% 3rem;
            position: relative;
            overflow: hidden;
        }

        .footer-logo-text {
            font-family: 'Outfit', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, #fff, #888);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .footer-link {
            color: #aaa;
            text-decoration: none;
            font-size: 1rem;
            transition: 0.3s;
            display: block;
            margin-bottom: 1rem;
        }

        .footer-link:hover {
            color: #E63946;
            padding-left: 8px;
        }

        .footer-social-circle {
            width: 45px;
            height: 45px;
            background: #222;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            transition: 0.3s;
            text-decoration: none;
        }

        .footer-social-circle:hover {
            background: #E63946;
            transform: translateY(-5px);
        }

        .burger-icon-decorative {
            position: absolute;
            font-size: 15rem;
            color: rgba(255, 255, 255, 0.02);
            bottom: -20px;
            right: -20px;
            transform: rotate(-15deg);
        }

        /* Force Default Browser Scrollbar */
        html,
        body {
            scrollbar-width: auto !important;
            -ms-overflow-style: auto !important;
        }

        ::-webkit-scrollbar {
            width: auto !important;
            display: block !important;
        }

        ::-webkit-scrollbar-thumb {
            background: initial !important;
        }

        ::-webkit-scrollbar-track {
            background: initial !important;
        }
    </style>
</head>

<body>

    <?php if (isset($_SESSION['user'])): ?>
        <nav class="nav-minimal">
            <a href="/" style="display: flex; align-items: center; gap: 15px; text-decoration: none;">
                <div class="logo-icon">
                    <i class="fa fa-hamburger"></i>
                </div>
                <span class="outfit-font"
                    style="font-size: 1.8rem; font-weight: 800; color: #2B2D42; letter-spacing: -1px;">Burger Labs.</span>
            </a>

            <div style="display: flex; align-items: center;">
                <div class="nav-shortcuts-group">
                    <a href="/" class="nav-shortcut">Home</a>
                    <a href="/menu" class="nav-shortcut">Menu</a>
                    <a href="/track" class="nav-shortcut">Track</a>
                    <a href="/careers" class="nav-shortcut">Careers</a>
                    <a href="/help" class="nav-shortcut">Help</a>
                </div>

                <div
                    style="display: flex; align-items: center; gap: 2rem; border-left: 2px solid #f0f0f0; padding-left: 2rem;">
                    <form action="/search" method="GET" style="display: flex; align-items: center;">
                        <input type="text" name="q" placeholder="Search the lab..."
                            style="border: none; border-bottom: 2px solid #eee; padding: 8px; outline: none; width: 0; transition: width 0.4s ease; background: transparent; font-size: 0.9rem;"
                            id="nav-search-input">
                        <button type="button" class="search-icon-btn" onclick="toggleSearch()">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <a href="/cart" style="color: #2B2D42; font-size: 1.3rem; position: relative; text-decoration: none;">
                        <i class="fa fa-shopping-bag"></i>
                        <span id="cart-count"
                            style="position: absolute; top: -10px; right: -12px; background: #E63946; color: white; font-size: 0.7rem; padding: 2px 7px; border-radius: 50%; font-weight: 800; border: 2px solid white;">
                            <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                        </span>
                    </a>

                    <a href="/logout" style="color: #E63946; font-size: 1.2rem; margin-left: 0.5rem;"><i
                            class="fa fa-power-off"></i></a>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <main>
        <?php require __DIR__ . '/' . $view . '.php'; ?>
    </main>

    <!-- Premium Footer - Cleaned Up as requested -->
    <?php if ($view === 'dashboard/home'): ?>
    <footer class="premium-footer">
        <i class="fa fa-hamburger burger-icon-decorative"></i>
        <div style="max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: 1.5fr 1fr 1fr 1.5fr; gap: 5rem;">
            <div>
                <div class="footer-logo-text" style="font-size: 2.2rem; background: none; -webkit-text-fill-color: white;">Burger Labs</div>
                <p style="color: #888; line-height: 2; font-size: 1.1rem; margin-bottom: 2.5rem; max-width: 400px;">
                    Pioneering the intersection of molecular gastronomy and artisanal comfort food. Our labs are dedicated to the perfect bite.
                </p>
                <div style="display: flex; gap: 1.2rem;">
                    <a href="https://www.linkedin.com/in/ameghayiratt/" target="_blank" class="footer-social-circle"><i class="fab fa-linkedin"></i></a>
                    <a href="mailto:ttariyahgema@gmail.com" class="footer-social-circle"><i class="fa fa-envelope"></i></a>
                </div>
            </div>
            
            <div>
                <h4 class="outfit-font" style="color: #E63946; font-size: 1.2rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 2rem;">Explore</h4>
                <a href="/menu" class="footer-link">Our Menu</a>
                <a href="/track" class="footer-link">Track Order</a>
                <a href="/careers" class="footer-link">Careers</a>
                <a href="/help" class="footer-link">Help Center</a>
            </div>

            <div>
                <h4 class="outfit-font" style="color: #E63946; font-size: 1.2rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 2rem;">Legal</h4>
                <a href="/legal-disclaimer" class="footer-link" style="color: white; font-weight: 700;">Disclaimer</a>
                <a href="/privacy" class="footer-link">Privacy Policy</a>
                <a href="/refund-policy" class="footer-link">Refund Policy</a>
            </div>

            <div style="background: #222; padding: 2.5rem; border-radius: 30px;" id="newsletter-container">
                <h4 class="outfit-font" style="color: white; font-size: 1.2rem; margin-bottom: 1.5rem;">Join the Research</h4>
                <p style="color: #888; font-size: 0.9rem; margin-bottom: 1.5rem;">Subscribe for lab updates and artisanal offers.</p>
                <form id="newsletter-form" style="display: flex; flex-direction: column; gap: 1rem;">
                    <input type="email" placeholder="Your email" required style="background: #333; border: none; padding: 1rem 1.5rem; border-radius: 15px; color: white; outline: none;">
                    <button type="submit" style="background: #E63946; color: white; border: none; padding: 1rem; border-radius: 15px; font-weight: 800; cursor: pointer; transition: 0.3s;">SIGN UP</button>
                </form>
            </div>
            <script>
                document.getElementById('newsletter-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const container = document.getElementById('newsletter-container');
                    container.style.opacity = '0';
                    setTimeout(() => {
                        container.innerHTML = `
                            <div style="text-align: center; padding: 1rem;">
                                <div style="width: 60px; height: 60px; background: #2ecc71; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; animation: scaleIn 0.4s ease;">
                                    <i class="fa fa-check" style="color: white; font-size: 1.5rem;"></i>
                                </div>
                                <h4 class="outfit-font" style="color: white; font-size: 1.2rem; margin-bottom: 0.5rem;">Welcome to the Lab!</h4>
                                <p style="color: #888; font-size: 0.85rem;">Successfully subscribed. You'll receive our next research update soon.</p>
                            </div>
                        `;
                        container.style.opacity = '1';
                    }, 300);
                });
            </script>
        </div>
        
        <div style="margin-top: 6rem; border-top: 1px solid #333; padding-top: 3rem; text-align: center; color: #555; font-size: 0.9rem;">
            <p>&copy; 2026 Burger Labs .Powered by hgema exploit</p>
        </div>
    </footer>
    <?php endif; ?>

    <script>
        function toggleSearch() {
            const input = document.getElementById('nav-search-input');
            if (input.style.width === '220px') {
                if (input.value) input.form.submit();
                else input.style.width = '0';
            } else {
                input.style.width = '220px';
                input.focus();
            }
        }
    </script>
    <script src="/assets/js/app.js"></script>
</body>

</html>