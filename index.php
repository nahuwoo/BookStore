<?php
session_start();

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/models/Catalog.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/AdminController.php';
require_once __DIR__ . '/controllers/OrderController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'home':
        $database = new Database();
        $catalog = new Catalog($database->getConnection());
        $categories = $catalog->getCategories();
        $featuredBooks = $catalog->getFeaturedBooks();

        include 'views/layout/header.php';
        include 'views/home.php';
        include 'views/layout/footer.php';
        break;

    // AUTH & PROFILE
    case 'login': (new AuthController())->login(); break;
    case 'register': (new AuthController())->register(); break;
    case 'logout': (new AuthController())->logout(); break;
    case 'profile': (new AuthController())->profile(); break;

    // ADMIN MENU
    case 'admin_dashboard': (new AdminController())->dashboard(); break;
    case 'admin_categories': (new AdminController())->manageCategories(); break;
    case 'admin_menu': (new AdminController())->manageMenu(); break;
    case 'api/menu-items/toggle': (new AdminController())->toggleAvailability(); break;

    

    // ORDER MANAGEMENT
    case 'my_orders': (new OrderController())->myOrders(); break;
    case 'admin_orders': (new OrderController())->adminQueue(); break;
    case 'api/orders/status': (new OrderController())->apiStatus(); break;
    case 'api/orders/update': (new OrderController())->updateStatus(); break;
    case 'api/orders/cancel': (new OrderController())->cancelOrder(); break;

    // DEFAULT REDIRECT
    default:
        if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
            require_once __DIR__ . '/models/User.php';
            $tempDb = (new Database())->getConnection();
            $tempUserModel = new User($tempDb);

            $cookie_parts = explode(':', $_COOKIE['remember_token']);
            if (count($cookie_parts) === 2) {
                $user_id = $cookie_parts[0];
                $token = $cookie_parts[1];

                $user = $tempUserModel->getUserById($user_id);
                if ($user && password_verify($token, $user['remember_token'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['role'] = $user['role'];
                }
            }
        }

        header("Location: index.php?action=home");
        break;
}
?>