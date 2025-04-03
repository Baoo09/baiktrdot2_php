<?php
require_once 'app/models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
        // Khởi tạo session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Hiển thị form đăng nhập
    public function login() {
        if (isset($_SESSION['user'])) {
            header('Location: index.php?controller=student&action=index');
            exit();
        }
        require_once 'app/views/login.php';
    }

    // Xử lý đăng nhập
    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->login($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php?controller=student&action=index');
                exit();
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
                require_once 'app/views/login.php';
            }
        }
    }

    // Đăng xuất
    public function logout() {
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit();
    }
}
?>