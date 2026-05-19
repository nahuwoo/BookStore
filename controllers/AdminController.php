<?php
class AdminController {
    private function requireAdmin() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

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

    public function dashboard() {
        $this->requireAdmin();
        $this->renderPage('Admin Dashboard', 'Admin tools are available from the navigation links.');
    }

    public function manageCategories() {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_name'])) {
            $_SESSION['flash'] = 'Category action received.';
            header('Location: index.php?action=admin_categories');
            exit;
        }

        $this->renderPage('Manage Categories', 'Category management is not fully implemented yet.');
    }

    public function manageMenu() {
        $this->requireAdmin();
        $this->renderPage('Manage Menu', 'Menu management is not fully implemented yet.');
    }

    public function toggleAvailability() {
        $this->requireAdmin();

        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Menu item availability toggling is not implemented yet.'
        ]);
        exit;
    }
}
?>