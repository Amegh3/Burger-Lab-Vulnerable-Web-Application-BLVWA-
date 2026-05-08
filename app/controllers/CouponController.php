<?php
// app/controllers/CouponController.php
namespace App\Controllers;

class CouponController extends Controller {

    private $validCoupons = [
        'LAB10'    => ['discount' => 10, 'min_order' => 100],
        'LAB25'    => ['discount' => 25, 'min_order' => 200],
        'LAB50'    => ['discount' => 50, 'min_order' => 300],
        'BURGER100'=> ['discount' => 100, 'min_order' => 0],  // 100% off — hidden
        'ADMIN2026'=> ['discount' => 100, 'min_order' => 0],  // hidden admin coupon
    ];

    // ─── COUPON PAGE ───
    public function index() {
        $applied = $_SESSION['applied_coupons'] ?? [];
        $this->view('coupons/index', ['applied' => $applied], 'layout');
    }

    // ─── VALIDATE: VULNERABILITY — No Rate Limit + Reuse ───
    public function validate() {
        $code = strtoupper(trim($_POST['code'] ?? ''));
        
        // VULNERABILITY 1: No rate limiting — brute force LAB01-LAB99
        // VULNERABILITY 2: No usage tracking — same coupon reusable
        // VULNERABILITY 3: 100% discount coupon exists (BURGER100)
        
        if (isset($this->validCoupons[$code])) {
            $coupon = $this->validCoupons[$code];
            
            // Store in session (no single-use enforcement)
            $_SESSION['applied_coupons'][] = [
                'code'     => $code,
                'discount' => $coupon['discount'],
                'applied'  => date('M d, H:i')
            ];

            if ($_SERVER['CONTENT_TYPE'] ?? '' === 'application/json' || 
                strpos($_SERVER['REQUEST_URI'], '/api/') !== false) {
                $this->json([
                    'status'   => 'valid',
                    'code'     => $code,
                    'discount' => $coupon['discount'] . '%',
                    'message'  => "Coupon applied! {$coupon['discount']}% off your order."
                ]);
                return;
            }

            header('Location: /coupons?success=' . $code . '&discount=' . $coupon['discount']);
            exit;
        }

        if ($_SERVER['CONTENT_TYPE'] ?? '' === 'application/json' ||
            strpos($_SERVER['REQUEST_URI'], '/api/') !== false) {
            $this->json(['status' => 'invalid', 'message' => 'Invalid coupon code.'], 404);
            return;
        }

        header('Location: /coupons?error=invalid');
        exit;
    }

    // ─── API VALIDATE (same logic, JSON only) ───
    public function apiValidate() {
        $this->validate();
    }
}
