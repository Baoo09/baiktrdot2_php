<?php
require_once 'app/models/Category.php';
require_once 'config/database.php';

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $database = new Database();
        $this->categoryModel = new Category($database->getConnection());
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories();
        require 'app/views/categories/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            // Kiểm tra dữ liệu đầu vào
            if (empty($name)) {
                $error = "Vui lòng nhập tên danh mục!";
                require 'app/views/categories/create.php';
                return;
            }

            // Thêm danh mục
            if ($this->categoryModel->addCategory($name, $description)) {
                header("Location: ?controller=category&action=index");
                exit();
            } else {
                $error = "Lỗi khi thêm danh mục!";
                require 'app/views/categories/create.php';
            }
        } else {
            require 'app/views/categories/create.php';
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            die("ID danh mục không hợp lệ!");
        }

        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            die("Danh mục không tồn tại!");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            // Kiểm tra dữ liệu đầu vào
            if (empty($name)) {
                $error = "Vui lòng nhập tên danh mục!";
                require 'app/views/categories/edit.php';
                return;
            }

            // Cập nhật danh mục
            if ($this->categoryModel->updateCategory($id, $name, $description)) {
                header("Location: ?controller=category&action=index");
                exit();
            } else {
                $error = "Lỗi khi cập nhật danh mục!";
                require 'app/views/categories/edit.php';
            }
        } else {
            require 'app/views/categories/edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            die("ID danh mục không hợp lệ!");
        }

        if ($this->categoryModel->deleteCategory($id)) {
            header("Location: ?controller=category&action=index");
            exit();
        } else {
            die("Lỗi khi xóa danh mục!");
        }
    }
}
?>