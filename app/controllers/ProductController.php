<?php
require_once 'app/models/Product.php';
require_once 'app/models/Category.php'; // Thêm để lấy danh sách danh mục
require_once 'config/database.php';

class ProductController {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $database = new Database();
        $this->productModel = new Product($database->getConnection());
        $this->categoryModel = new Category($database->getConnection());
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        require 'app/views/products/index.php';
    }
    public function show($id) {
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            die("Sản phẩm không tồn tại!");
        }
        require 'app/views/products/show.php';
    }

    public function add() {
        $categories = $this->categoryModel->getAllCategories(); // Lấy danh sách danh mục
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $price = trim($_POST['price'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $category_id = $_POST['category_id'] ?? null;
            $image = null;

            if (empty($name) || empty($price) || empty($description) || !is_numeric($price)) {
                $error = "Vui lòng điền đầy đủ thông tin và đảm bảo giá là số hợp lệ!";
                require 'app/views/products/create.php';
                return;
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $image = $uploadDir . $imageName;
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                    $error = "Lỗi khi upload ảnh!";
                    require 'app/views/products/create.php';
                    return;
                }
            }

            if ($this->productModel->addProduct($name, (float)$price, $description, $image, $category_id)) {
                header("Location: ?controller=product&action=index");
                exit();
            } else {
                $error = "Lỗi khi thêm sản phẩm!";
                require 'app/views/products/create.php';
            }
        } else {
            require 'app/views/products/create.php';
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            die("ID sản phẩm không hợp lệ!");
        }

        $product = $this->productModel->getProductById($id);
        $categories = $this->categoryModel->getAllCategories(); // Lấy danh sách danh mục
        if (!$product) {
            die("Sản phẩm không tồn tại!");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $price = trim($_POST['price'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $category_id = $_POST['category_id'] ?? null;
            $image = $_POST['existing_image'] ?? $product['image'];

            if (empty($name) || empty($price) || empty($description) || !is_numeric($price)) {
                $error = "Vui lòng điền đầy đủ thông tin và đảm bảo giá là số hợp lệ!";
                require 'app/views/products/edit.php';
                return;
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $image = $uploadDir . $imageName;
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                    $error = "Lỗi khi upload ảnh!";
                    require 'app/views/products/edit.php';
                    return;
                }
            }

            if ($this->productModel->updateProduct($id, $name, (float)$price, $description, $image, $category_id)) {
                header("Location: ?controller=product&action=index");
                exit();
            } else {
                $error = "Lỗi khi cập nhật sản phẩm!";
                require 'app/views/products/edit.php';
            }
        } else {
            require 'app/views/products/edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            die("ID sản phẩm không hợp lệ!");
        }

        if ($this->productModel->deleteProduct($id)) {
            header("Location: ?controller=product&action=index");
            exit();
        } else {
            die("Lỗi khi xóa sản phẩm!");
        }
    }
}
?>