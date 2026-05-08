<?php
// app/controllers/DashboardController.php
namespace App\Controllers;

use Core\Database;

class DashboardController extends Controller {
    public function index() {
        $this->view('dashboard/home', [], 'layout');
    }

    // ─── REVIEWS: VULNERABILITY — Stored XSS ───
    // User-submitted name & comment are stored in session and rendered raw
    public function reviews() {
        $reviews = $_SESSION['stored_reviews'] ?? [];
        $this->view('dashboard/reviews', ['reviews' => $reviews], 'layout');
    }

    public function submitReview() {
        $name    = $_POST['name'] ?? '';
        $comment = $_POST['comment'] ?? '';
        $rating  = $_POST['rating'] ?? '5';

        // VULNERABILITY: Stored XSS — no sanitization, stored raw in session
        if (!isset($_SESSION['stored_reviews'])) {
            $_SESSION['stored_reviews'] = [];
        }
        $_SESSION['stored_reviews'][] = [
            'name'    => $name,
            'comment' => $comment,
            'rating'  => $rating,
            'date'    => date('M d, Y')
        ];

        header('Location: /reviews');
        exit;
    }

    // ─── CONTACT: VULNERABILITY — Reflected XSS ───
    // The submitted name is echoed back raw in the thank-you page
    public function contact() {
        $this->view('dashboard/contact', [], 'layout');
    }

    public function submitContact() {
        $name    = $_POST['name'] ?? 'Guest';
        $email   = $_POST['email'] ?? '';
        $subject = $_POST['subject'] ?? '';
        $message = $_POST['message'] ?? '';

        // VULNERABILITY: Reflected XSS — name is passed raw to the view
        $this->view('dashboard/contact_success', [
            'name'    => $name,
            'email'   => $email,
            'subject' => $subject,
            'message' => $message
        ], 'layout');
    }

    // ─── HELP: VULNERABILITY — Stored XSS in Ticket ───
    // Complaint description is stored and displayed back without sanitization
    public function help() {
        $tickets = $_SESSION['help_tickets'] ?? [];
        $this->view('dashboard/help', ['tickets' => $tickets], 'layout');
    }

    public function submitHelp() {
        $name        = $_POST['name'] ?? '';
        $orderId     = $_POST['order_id'] ?? '';
        $category    = $_POST['category'] ?? '';
        $description = $_POST['description'] ?? '';

        // VULNERABILITY: Stored XSS — description is stored raw
        if (!isset($_SESSION['help_tickets'])) {
            $_SESSION['help_tickets'] = [];
        }
        $ticketId = 'TK-' . rand(10000, 99999);
        $_SESSION['help_tickets'][] = [
            'id'          => $ticketId,
            'name'        => $name,
            'order_id'    => $orderId,
            'category'    => $category,
            'description' => $description,
            'status'      => 'Open'
        ];

        $this->view('dashboard/help_success', [
            'ticket_id'   => $ticketId,
            'name'        => $name,
            'description' => $description
        ], 'layout');
    }

    // ─── CAREERS: VULNERABILITY — Unrestricted File Upload ───
    // No file type or extension validation
    public function careers() {
        $this->view('dashboard/careers', [], 'layout');
    }

    public function submitApplication() {
        $uploadDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $uploadedFile = '';
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
            // VULNERABILITY: Unrestricted File Upload — no extension or MIME check
            $filename = $_FILES['resume']['name'];
            $destination = $uploadDir . $filename;
            move_uploaded_file($_FILES['resume']['tmp_name'], $destination);
            $uploadedFile = '/uploads/' . $filename;
        }

        $this->view('dashboard/careers_success', [
            'file_path' => $uploadedFile,
            'file_name' => $_FILES['resume']['name'] ?? 'None'
        ], 'layout');
    }

    // ─── FRANCHISE: VULNERABILITY — SSRF ───
    // Portfolio URL is fetched server-side without validation
    public function franchise() {
        $this->view('dashboard/franchise', [], 'layout');
    }

    public function submitFranchise() {
        $owner    = $_POST['owner'] ?? '';
        $email    = $_POST['email'] ?? '';
        $location = $_POST['location'] ?? '';
        $portfolio = $_POST['portfolio'] ?? '';

        $preview = '';
        if ($portfolio) {
            // VULNERABILITY: SSRF — fetches any URL provided, including internal services
            $preview = @file_get_contents($portfolio);
            if ($preview === false) {
                $preview = 'Could not fetch portfolio URL.';
            } else {
                $preview = substr($preview, 0, 2000); // Limit output
            }
        }

        $this->view('dashboard/franchise_success', [
            'owner'    => $owner,
            'location' => $location,
            'portfolio' => $portfolio,
            'preview'  => $preview
        ], 'layout');
    }

    // ─── BOOKING: VULNERABILITY — Reflected XSS ───
    // Confirmation page reflects the name parameter raw
    public function booking() {
        $this->view('dashboard/booking', [], 'layout');
    }

    public function submitBooking() {
        $name    = $_POST['name'] ?? 'Guest';
        $date    = $_POST['date'] ?? '';
        $time    = $_POST['time'] ?? '';
        $guests  = $_POST['guests'] ?? '1';
        $notes   = $_POST['notes'] ?? '';

        // VULNERABILITY: Reflected XSS — name and notes rendered raw in confirmation
        $this->view('dashboard/booking_success', [
            'name'   => $name,
            'date'   => $date,
            'time'   => $time,
            'guests' => $guests,
            'notes'  => $notes
        ], 'layout');
    }

    public function aiInsights() {
        $topic = $_GET['topic'] ?? 'General';
        // VULNERABILITY 15: Reflected XSS
        $this->view('dashboard/ai_insights', ['topic' => $topic], 'layout');
    }

    public function faq() {
        $this->view('dashboard/faq', [], 'layout');
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
