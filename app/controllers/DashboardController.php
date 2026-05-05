<?php
// app/controllers/DashboardController.php
namespace App\Controllers;

class DashboardController extends Controller {
    public function index() {
        $this->view('dashboard/home', [], 'layout');
    }

    public function reviews() {
        $this->view('dashboard/reviews', [], 'layout');
    }

    public function careers() {
        $this->view('dashboard/careers', [], 'layout');
    }

    public function franchise() {
        $this->view('dashboard/franchise', [], 'layout');
    }

    public function contact() {
        $this->view('dashboard/contact', [], 'layout');
    }

    public function faq() {
        $this->view('dashboard/faq', [], 'layout');
    }

    public function booking() {
        $this->view('dashboard/booking', [], 'layout');
    }

    public function aiInsights() {
        $topic = $_GET['topic'] ?? 'General';
        // VULNERABILITY 15: Reflected XSS
        $this->view('dashboard/ai_insights', ['topic' => $topic], 'layout');
    }

    public function help() {
        $this->view('dashboard/help', [], 'layout');
    }

    public function privacy() {
        $this->view('dashboard/privacy', [], 'layout');
    }

    public function refundPolicy() {
        $this->view('dashboard/refund_policy', [], 'layout');
    }

    public function legalDisclaimer() {
        $this->view('dashboard/legal', [], 'layout');
    }


    public function toggleLabMode() {
        $_SESSION['lab_mode'] = ($_SESSION['lab_mode'] ?? 'off') === 'on' ? 'off' : 'on';
        $this->json(['status' => 'success', 'mode' => $_SESSION['lab_mode']]);
    }
}
