<?php 
function logout() {
        if (isset($_SESSION['user_id'])) {
            $this->userModel->updateRememberToken($_SESSION['user_id'], NULL);
        }
        session_destroy();
        setcookie('remember_token', '', time() - 3600, '/');
        header("Location: index.php?action=login");
        exit;
    }
?>