<?php
class OrderController {
    private function requireUser() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
    }

    private function requireAdmin() {
        $this->requireUser();

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?action=browse');
            exit;
        }
    }

    private function renderPage($title, $message) {
        include 'views/layout/header.php';
        echo '<section class="card">';
        echo '<h1>' . htmlspecialchars($title) . '</h1>';
        echo '<p>' . htmlspecialchars($message) . '</p>';
        echo '</section>';
        include 'views/layout/footer.php';
    }

    public function myOrders() {
        $this->requireUser();
        $this->renderPage('My Orders', 'Order history is not fully implemented yet.');
    }

    public function adminQueue() {
        $this->requireAdmin();
        $this->renderPage('Order Queue', 'Admin order management is not fully implemented yet.');
    }

    public function apiStatus() {
        $this->requireUser();

        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Order status lookup is not implemented yet.'
        ]);
        exit;
    }

    public function updateStatus() {
        $this->requireAdmin();

        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Order status updates are not implemented yet.'
        ]);
        exit;
    }

    public function cancelOrder() {
        $this->requireUser();

        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Order cancellation is not implemented yet.'
        ]);
        exit;
    }
}
?>