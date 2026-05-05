<?php
// routes/web.php
use App\Controllers\DashboardController;
use App\Controllers\MenuController;
use App\Controllers\CartController;
use App\Controllers\AuthController;
use App\Controllers\OrderController;
use App\Controllers\CheckoutController;

$router->get('/', [DashboardController::class, 'index']);
$router->get('/menu', [MenuController::class, 'index']);
$router->get('/track', [OrderController::class, 'index']);
$router->get('/orders', [OrderController::class, 'index']);
$router->get('/orders/search', [OrderController::class, 'search']);
$router->get('/booking', [DashboardController::class, 'booking']);
$router->get('/search', [MenuController::class, 'search']);
$router->get('/ai-insights', [DashboardController::class, 'aiInsights']);
$router->get('/help', [DashboardController::class, 'help']);
$router->get('/privacy', [DashboardController::class, 'privacy']);
$router->get('/refund-policy', [DashboardController::class, 'refundPolicy']);
$router->get('/legal-disclaimer', [DashboardController::class, 'legalDisclaimer']);
$router->get('/careers', [DashboardController::class, 'careers']);
$router->get('/faq', [DashboardController::class, 'faq']);

// Cart & Legacy Checkout (kept for backward compatibility or redirected)
$router->get('/cart', [CartController::class, 'index']);
$router->post('/cart/add', [CartController::class, 'add']);

// --- NEW PRODUCTION-GRADE CHECKOUT FLOW ---
$router->get('/checkout/address', [CheckoutController::class, 'addressStep']);
$router->get('/checkout/delivery', [CheckoutController::class, 'deliveryStep']);
$router->post('/checkout/delivery', [CheckoutController::class, 'deliveryStep']);
$router->get('/checkout/payment', [CheckoutController::class, 'paymentStep']);
$router->post('/checkout/payment', [CheckoutController::class, 'paymentStep']);
$router->get('/checkout/review', [CheckoutController::class, 'reviewStep']);
$router->post('/checkout/review', [CheckoutController::class, 'reviewStep']);
$router->get('/checkout/confirm', [CheckoutController::class, 'confirmOrder']);
$router->post('/checkout/confirm', [CheckoutController::class, 'confirmOrder']);
$router->get('/checkout/success', [CheckoutController::class, 'successPage']);

// Auth
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

// Training Toggle
$router->post('/lab/toggle-mode', [DashboardController::class, 'toggleLabMode']);

// --- ADMINISTRATIVE & ADVANCED TRAINING (SECRET) ---
use App\Controllers\AdminController;
$router->get('/admin_p0rtal_secret_path', [AdminController::class, 'secretPortal']);
$router->get('/admin/diagnostics', [AdminController::class, 'networkDiagnostics']);
$router->post('/admin/diagnostics', [AdminController::class, 'networkDiagnostics']);
