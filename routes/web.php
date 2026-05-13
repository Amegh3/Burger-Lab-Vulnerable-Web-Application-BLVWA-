<?php
// routes/web.php
use App\Controllers\DashboardController;
use App\Controllers\MenuController;
use App\Controllers\CartController;
use App\Controllers\AuthController;
use App\Controllers\OrderController;
use App\Controllers\CheckoutController;
use App\Controllers\ProfileController;
use App\Controllers\WalletController;
use App\Controllers\CouponController;
use App\Controllers\AdminController;
use App\Controllers\StaffController;
use App\Controllers\NotificationController;
use App\Controllers\OwnerController;

// ═══════════════════════════════════════════════
//  EXECUTIVE PORTAL (Owner Only — BFLA + CSRF + IDOR)
// ═══════════════════════════════════════════════
$router->get('/owner/dashboard', [OwnerController::class, 'dashboard']);
$router->get('/owner/employee/details', [OwnerController::class, 'employeeDetails']);
$router->post('/owner/salary/update', [OwnerController::class, 'updateSalary']);

// ═══════════════════════════════════════════════
//  PUBLIC PAGES
// ═══════════════════════════════════════════════
$router->get('/', [DashboardController::class, 'index']);
$router->get('/menu', [MenuController::class, 'index']);
$router->get('/search', [MenuController::class, 'search']);
$router->get('/ai-insights', [DashboardController::class, 'aiInsights']);
$router->get('/privacy', [DashboardController::class, 'privacy']);
$router->get('/refund-policy', [DashboardController::class, 'refundPolicy']);
$router->get('/legal-disclaimer', [DashboardController::class, 'legalDisclaimer']);
$router->get('/faq', [DashboardController::class, 'faq']);

// ═══════════════════════════════════════════════
//  DASHBOARD PAGES (Vulnerable Forms)
// ═══════════════════════════════════════════════
$router->get('/reviews', [DashboardController::class, 'reviews']);
$router->post('/reviews', [DashboardController::class, 'submitReview']);

$router->get('/contact', [DashboardController::class, 'contact']);
$router->post('/contact', [DashboardController::class, 'submitContact']);

$router->get('/help', [DashboardController::class, 'help']);
$router->post('/help/submit', [DashboardController::class, 'submitHelp']);

$router->get('/careers', [DashboardController::class, 'careers']);
$router->post('/apply', [DashboardController::class, 'submitApplication']);

$router->get('/franchise', [DashboardController::class, 'franchise']);
$router->post('/franchise', [DashboardController::class, 'submitFranchise']);

$router->get('/booking', [DashboardController::class, 'booking']);
$router->post('/booking', [DashboardController::class, 'submitBooking']);

// ═══════════════════════════════════════════════
//  ORDER TRACKING (SQLi + XSS)
// ═══════════════════════════════════════════════
$router->get('/track', [OrderController::class, 'index']);
$router->get('/orders', [OrderController::class, 'index']);
$router->get('/orders/search', [OrderController::class, 'search']);

// ═══════════════════════════════════════════════
//  CART & CHECKOUT
// ═══════════════════════════════════════════════
$router->get('/cart', [CartController::class, 'index']);
$router->post('/cart/add', [CartController::class, 'add']);

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

// ═══════════════════════════════════════════════
//  AUTH (SQLi + Mass Assignment)
// ═══════════════════════════════════════════════
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'registerForm']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/forgot-password', [AuthController::class, 'forgotPasswordForm']);
$router->post('/forgot-password', [AuthController::class, 'forgotPassword']);
$router->get('/logout', [AuthController::class, 'logout']);

// ═══════════════════════════════════════════════
//  PROFILE (IDOR + Mass Assignment)
// ═══════════════════════════════════════════════
$router->get('/profile', [ProfileController::class, 'show']);
$router->get('/profile/edit', [ProfileController::class, 'edit']);
$router->post('/profile/edit', [ProfileController::class, 'edit']);

// ═══════════════════════════════════════════════
//  WALLET (Price Tampering + IDOR + Race Condition)
// ═══════════════════════════════════════════════
$router->get('/wallet', [WalletController::class, 'index']);
$router->get('/wallet/topup', [WalletController::class, 'topup']);
$router->post('/wallet/topup', [WalletController::class, 'topup']);
$router->get('/wallet/transfer', [WalletController::class, 'transfer']);
$router->post('/wallet/transfer', [WalletController::class, 'transfer']);
$router->post('/wallet/verify-payment', [WalletController::class, 'verifyPayment']);

// ═══════════════════════════════════════════════
//  COUPONS (Brute Force + Reuse)
// ═══════════════════════════════════════════════
$router->get('/coupons', [CouponController::class, 'index']);
$router->post('/coupons/validate', [CouponController::class, 'validate']);

// ═══════════════════════════════════════════════
//  NOTIFICATIONS (IDOR + Stored XSS)
// ═══════════════════════════════════════════════
$router->get('/notifications', [NotificationController::class, 'index']);
$router->post('/notifications/send', [NotificationController::class, 'send']);

// ═══════════════════════════════════════════════
//  TRAINING TOGGLE
// ═══════════════════════════════════════════════
$router->post('/lab/toggle-mode', [DashboardController::class, 'toggleLabMode']);

// ═══════════════════════════════════════════════
//  ADMIN PANEL (Hidden — RCE, LFI, XXE, SSTI, BOLA)
// ═══════════════════════════════════════════════
$router->get('/admin_p0rtal_secret_path', [AdminController::class, 'secretPortal']);
$router->get('/admin/diagnostics', [AdminController::class, 'networkDiagnostics']);
$router->post('/admin/diagnostics', [AdminController::class, 'networkDiagnostics']);
$router->get('/admin/users', [AdminController::class, 'users']);
$router->get('/admin/logs', [AdminController::class, 'logs']);
$router->get('/admin/export', [AdminController::class, 'export']);
$router->post('/admin/export', [AdminController::class, 'export']);
$router->get('/admin/backup', [AdminController::class, 'backup']);
$router->get('/admin/analytics', [AdminController::class, 'analytics']);

// ═══════════════════════════════════════════════
//  STAFF PANEL (Hidden — No Role Check)
// ═══════════════════════════════════════════════
$router->get('/staff/dashboard', [StaffController::class, 'dashboard']);
$router->get('/staff/inventory', [StaffController::class, 'inventory']);
$router->post('/staff/inventory/update', [StaffController::class, 'updateStock']);
$router->get('/staff/refunds', [StaffController::class, 'refunds']);
$router->post('/staff/refunds/process', [StaffController::class, 'processRefund']);

// ═══════════════════════════════════════════════
//  VULNERABILITY LABS (105+ ENDPOINTS)
// ═══════════════════════════════════════════════

// ═══════════════════════════════════════════════
//  VULNERABILITY LABS (105+ ENDPOINTS)
// ═══════════════════════════════════════════════
$router->get('/lab/rce/{id}', ['App\Controllers\VulnerabilityLabController', 'rce_lab']);
$router->get('/lab/sqli/{id}', ['App\Controllers\VulnerabilityLabController', 'sqli_lab']);
$router->get('/lab/xss/{id}', ['App\Controllers\VulnerabilityLabController', 'xss_lab']);
$router->get('/lab/lfi/{id}', ['App\Controllers\VulnerabilityLabController', 'lfi_lab']);
$router->get('/lab/idor/{id}', ['App\Controllers\VulnerabilityLabController', 'idor_lab']);
$router->get('/lab/jwt/{id}', ['App\Controllers\VulnerabilityLabController', 'jwt_lab']);
$router->get('/lab/crlf/{id}', ['App\Controllers\VulnerabilityLabController', 'crlf_lab']);
$router->get('/lab/ssrf/{id}', ['App\Controllers\VulnerabilityLabController', 'ssrf_lab']);
$router->get('/lab/ssti/{id}', ['App\Controllers\VulnerabilityLabController', 'ssti_lab']);
