<?php
require_once 'app/models/EmployeeModel.php';

class EmployeeController {
    private $model;

    public function __construct() {
        $this->model = new EmployeeModel();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        // Phân trang
        $records_per_page = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $records_per_page;

        // Lấy dữ liệu từ Model
        $employees = $this->model->getEmployees($offset, $records_per_page);
        $total_records = $this->model->getTotalEmployees();
        $total_pages = ceil($total_records / $records_per_page);

        // Gửi dữ liệu sang View
        require_once 'app/views/employee/employee_list.php';
    }

    // Hiển thị form thêm nhân viên
    public function add() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?controller=employee&action=index');
            exit();
        }
        $departments = $this->model->getDepartments();
        require_once 'app/views/employee/add_employee.php';
    }

    // Xử lý thêm nhân viên
    public function handleAdd() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?controller=employee&action=index');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ma_nv = $_POST['ma_nv'];
            $ten_nv = $_POST['ten_nv'];
            $phai = $_POST['phai'];
            $noi_sinh = $_POST['noi_sinh'];
            $ma_phong = $_POST['ma_phong'];
            $luong = $_POST['luong'];

            if ($this->model->addEmployee($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong)) {
                header('Location: index.php?controller=employee&action=index');
                exit();
            } else {
                $error = "Thêm nhân viên thất bại!";
                $departments = $this->model->getDepartments();
                require_once 'app/views/employee/add_employee.php';
            }
        }
    }

    // Hiển thị form sửa nhân viên
    public function edit() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?controller=employee&action=index');
            exit();
        }
        $ma_nv = $_GET['ma_nv'];
        $employee = $this->model->getEmployeeById($ma_nv);
        $departments = $this->model->getDepartments();
        require_once 'app/views/employee/edit_employee.php';
    }

    // Xử lý sửa nhân viên
    public function handleEdit() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?controller=employee&action=index');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ma_nv = $_POST['ma_nv'];
            $ten_nv = $_POST['ten_nv'];
            $phai = $_POST['phai'];
            $noi_sinh = $_POST['noi_sinh'];
            $ma_phong = $_POST['ma_phong'];
            $luong = $_POST['luong'];

            if ($this->model->updateEmployee($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong)) {
                header('Location: index.php?controller=employee&action=index');
                exit();
            } else {
                $error = "Sửa nhân viên thất bại!";
                $employee = $this->model->getEmployeeById($ma_nv);
                $departments = $this->model->getDepartments();
                require_once 'app/views/employee/edit_employee.php';
            }
        }
    }

    // Xử lý xóa nhân viên
    public function delete() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?controller=employee&action=index');
            exit();
        }
        $ma_nv = $_GET['ma_nv'];
        $this->model->deleteEmployee($ma_nv);
        header('Location: index.php?controller=employee&action=index');
        exit();
    }
}
?>