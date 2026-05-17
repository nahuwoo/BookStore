<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Catalog.php';

class CartController {
    private function requireUser() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
    }

    private function getCart() {
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        return $_SESSION['cart'];
    }

    private function setCart(array $cart) {
        $_SESSION['cart'] = array_values($cart);
    }

    private function renderPage($title, $message, $extraHtml = '') {
        include 'views/layout/header.php';
        echo '<section class="card">';
        echo '<h1>' . htmlspecialchars($title) . '</h1>';
        echo '<p>' . htmlspecialchars($message) . '</p>';
        if ($extraHtml !== '') {
            echo $extraHtml;
        }
        echo '</section>';
        include 'views/layout/footer.php';
    }

    public function browse() {
        $this->requireUser();

        $database = new Database();
        $catalog = new Catalog($database->getConnection());

        $categoryId = isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0;
        $selectedCategory = $categoryId > 0 ? $catalog->getCategoryById($categoryId) : null;
        $books = $catalog->getBooks($categoryId > 0 ? $categoryId : null);

        $categoryLinks = $catalog->getCategories(12);

        $html = '<div class="browse-header">';
        $html .= '<h1>' . htmlspecialchars($selectedCategory ? $selectedCategory['name'] : 'Browse Books') . '</h1>';
        $html .= '<p>' . htmlspecialchars($selectedCategory ? ($selectedCategory['description'] ?: 'View all books in this category.') : 'Choose a category to filter the book list.') . '</p>';
        $html .= '</div>';

        $html .= '<div class="category-strip">';
        $html .= '<a class="chip-link" href="index.php?action=browse"><span class="chip">All Books</span></a>';
        foreach ($categoryLinks as $category) {
            $html .= '<a class="chip-link" href="index.php?action=browse&category_id=' . (int) $category['id'] . '"><span class="chip">' . htmlspecialchars($category['name']) . '</span></a>';
        }
        $html .= '</div>';

        if (empty($books)) {
            $html .= '<div class="card">No books found in this category yet.</div>';
        } else {
            $html .= '<div class="book-grid">';
            foreach ($books as $book) {
                $html .= '<article class="book-card">';
                $html .= '<div class="book-cover">' . htmlspecialchars(mb_substr($book['title'], 0, 1)) . '</div>';
                $html .= '<div class="book-body">';
                $html .= '<h3>' . htmlspecialchars($book['title']) . '</h3>';
                $html .= '<div class="muted">By ' . htmlspecialchars($book['author']) . '</div>';
                $html .= '<div class="muted" style="margin-top: 6px;">Category: ' . htmlspecialchars($book['category_name'] ?? 'Uncategorized') . '</div>';
                $html .= '<p style="margin-top: 10px;">' . htmlspecialchars($book['short_description'] ?? '') . '</p>';
                $html .= '<div class="book-meta">';
                $html .= '<span class="book-price">$' . number_format((float) $book['price'], 2) . '</span>';
                $html .= '<span class="muted">View only</span>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</article>';
            }
            $html .= '</div>';
        }

        $this->renderPage('Browse Books', 'Select a category and view the available books.', $html);
    }

    public function viewCart() {
        $this->requireUser();

        $cart = $this->getCart();
        $items = '';

        if (empty($cart)) {
            $items = '<p>Your cart is empty.</p>';
        } else {
            $items = '<ul>';
            foreach ($cart as $item) {
                $name = isset($item['name']) ? $item['name'] : 'Item';
                $quantity = isset($item['quantity']) ? (int) $item['quantity'] : 1;
                $items .= '<li>' . htmlspecialchars($name) . ' x ' . $quantity . '</li>';
            }
            $items .= '</ul>';
        }

        $this->renderPage('Your Cart', 'Review the items in your cart below.', $items);
    }

    public function checkout() {
        $this->requireUser();
        $this->renderPage('Checkout', 'Checkout flow is not fully implemented yet.');
    }

    public function addToCart() {
        $this->requireUser();

        $cart = $this->getCart();
        $itemId = isset($_POST['item_id']) ? (string) $_POST['item_id'] : '';
        if ($itemId === '') {
            $itemId = isset($_POST['id']) ? (string) $_POST['id'] : '';
        }

        if ($itemId !== '') {
            $name = isset($_POST['name']) ? trim($_POST['name']) : 'Item ' . $itemId;
            $quantity = isset($_POST['quantity']) ? max(1, (int) $_POST['quantity']) : 1;
            $price = isset($_POST['price']) ? (float) $_POST['price'] : 0.0;

            $found = false;
            foreach ($cart as &$item) {
                if ((string) $item['id'] === $itemId) {
                    $item['quantity'] = (isset($item['quantity']) ? (int) $item['quantity'] : 0) + $quantity;
                    $found = true;
                    break;
                }
            }
            unset($item);

            if (!$found) {
                $cart[] = [
                    'id' => $itemId,
                    'name' => $name,
                    'price' => $price,
                    'quantity' => $quantity,
                ];
            }

            $this->setCart($cart);
        }

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'cart_count' => array_sum(array_column($this->getCart(), 'quantity'))
        ]);
        exit;
    }

    public function updateCart() {
        $this->requireUser();

        $cart = $this->getCart();
        $itemId = isset($_POST['item_id']) ? (string) $_POST['item_id'] : '';
        $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

        foreach ($cart as $index => $item) {
            if ((string) $item['id'] === $itemId) {
                if ($quantity <= 0) {
                    unset($cart[$index]);
                } else {
                    $cart[$index]['quantity'] = $quantity;
                }
                break;
            }
        }

        $this->setCart($cart);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'cart_count' => array_sum(array_column($this->getCart(), 'quantity'))]);
        exit;
    }

    public function removeCart() {
        $this->requireUser();

        $cart = $this->getCart();
        $itemId = isset($_POST['item_id']) ? (string) $_POST['item_id'] : '';

        foreach ($cart as $index => $item) {
            if ((string) $item['id'] === $itemId) {
                unset($cart[$index]);
                break;
            }
        }

        $this->setCart($cart);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'cart_count' => array_sum(array_column($this->getCart(), 'quantity'))]);
        exit;
    }

    public function apiSearch() {
        $this->requireUser();

        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'items' => [],
            'message' => 'Menu search is not implemented yet.'
        ]);
        exit;
    }
}
?>