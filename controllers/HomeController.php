<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Catalog.php';

class HomeController {
    private $catalog;

    public function __construct() {
        $database = new Database();
        $this->catalog = new Catalog($database->getConnection());
    }

    public function index() {
        $categories = $this->catalog->getCategories();
        $featuredBooks = $this->catalog->getFeaturedBooks();

        include 'views/layout/header.php';
        include 'views/home.php';
        include 'views/layout/footer.php';
    }
}
?>