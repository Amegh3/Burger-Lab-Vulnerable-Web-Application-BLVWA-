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
