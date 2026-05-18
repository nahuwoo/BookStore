<?php
class Catalog {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCategories($limit = 8) {
        $stmt = $this->conn->prepare("SELECT id, name, description FROM categories ORDER BY name ASC LIMIT :limit");
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFeaturedBooks($limit = 6) {
        $sql = "SELECT b.id, b.title, b.author, b.price, b.cover_image, b.category_id, c.name AS category_name
                FROM books b
                LEFT JOIN categories c ON c.id = b.category_id
                ORDER BY b.created_at DESC, b.id DESC
                LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($categoryId) {
        $stmt = $this->conn->prepare("SELECT id, name, description FROM categories WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => (int) $categoryId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   
}
?>