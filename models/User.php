<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($name, $email, $password, $address, $role = 'customer', $phone = '') {
        // ensure email is unique
        if ($this->emailExists($email)) {
            return "Email already exists.";
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (name, email, password_hash, delivery_address, role, phone) VALUES (:name, :email, :hash, :address, :role, :phone)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':hash', $hash);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':phone', $phone);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return (bool) $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login($email, $password) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return false;
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($id, $name, $email, $address) {
        $stmt = $this->conn->prepare("UPDATE users SET name = :name, email = :email, delivery_address = :address WHERE id = :id");
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':address' => $address,
            ':id' => $id
        ]);
    }

    public function updatePassword($id, $new_password) {
        $hash = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("UPDATE users SET password_hash = :hash WHERE id = :id");
        return $stmt->execute([':hash' => $hash, ':id' => $id]);
    }

    public function updateRememberToken($id, $token_hash) {
        $stmt = $this->conn->prepare("UPDATE users SET remember_token = :token WHERE id = :id");
        return $stmt->execute([':token' => $token_hash, ':id' => $id]);
    }
}
?>