<?php
// routes/api.php
use App\Controllers\CheckoutController;
use App\Controllers\OrderController;

// --- PRODUCTION API ENDPOINTS ---

// Cart & Pricing
$router->post('/api/cart/validate', [CheckoutController::class, 'apiValidateCart']);
$router->post('/api/checkout/price-quote', [CheckoutController::class, 'apiPriceQuote']);

// Orders
$router->post('/api/checkout/create-order', [CheckoutController::class, 'apiCreateOrder']);
$router->post('/api/orders/confirm', [CheckoutController::class, 'apiConfirmOrder']);
$router->get('/api/orders/{id}', [OrderController::class, 'apiGetOrder']);

// Payments
$router->post('/api/payments/intent', [CheckoutController::class, 'apiPaymentIntent']);
$router->post('/api/payments/confirm', [CheckoutController::class, 'apiPaymentConfirm']);

// Legacy/Training
$router->post('/api/orders/track', [OrderController::class, 'apiTrack']); 

// --- PHASE 2: Wallet, Coupons, Users ---
use App\Controllers\WalletController;
use App\Controllers\CouponController;
use App\Controllers\ProfileController;

// Wallet API (IDOR — any uid)
$router->get('/api/v1/wallet/balance', [WalletController::class, 'apiBalance']);

// Coupon API (No rate limit)
$router->post('/api/v1/coupons/validate', [CouponController::class, 'apiValidate']);

// User API (Excessive Data Exposure — returns password_hash, api_key)
$router->get('/api/v1/users/{id}', [ProfileController::class, 'show']);

