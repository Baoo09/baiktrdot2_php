<?php
require_once __DIR__ . '/../models/HocPhan.php';
require_once __DIR__ . '/../models/DangKy.php';

class HocPhanController {
    private $hocPhanModel;
    private $dangKyModel;

    public function __construct($db) {
        $this->hocPhanModel = new HocPhan($db);
        $this->dangKyModel = new DangKy($db);
    }

    // Hiển thị danh sách học phần
    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 4; // 4 học phần mỗi trang
        $hocPhans = $this->hocPhanModel->getAll($page, $perPage);
        $totalHocPhans = $this->hocPhanModel->getTotal();
        $totalPages = ceil($totalHocPhans / $perPage);
        require_once 'app/views/hocphan/index.php';
    }

    // Đăng ký học phần
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maSV = $_POST['MaSV'] ?? '';
            $maHPs = $_POST['MaHP'] ?? []; // Mảng các mã học phần được chọn
            $ngayDK = date('Y-m-d'); // Ngày đăng ký là ngày hiện tại

            if (empty($maSV) || empty($maHPs)) {
                $error = "Vui lòng nhập mã sinh viên và chọn ít nhất một học phần!";
                $hocPhans = $this->hocPhanModel->getAll();
                require_once 'app/views/hocphan/register.php';
                return;
            }

            // Tạo bản ghi trong bảng DangKy
            $maDK = $this->dangKyModel->create($maSV, $ngayDK);
            if ($maDK) {
                // Thêm chi tiết đăng ký cho từng học phần
                foreach ($maHPs as $maHP) {
                    $this->dangKyModel->addChiTietDangKy($maDK, $maHP);
                }
                header('Location: index.php?controller=hocphan&action=index');
                exit;
            } else {
                $error = "Lỗi khi đăng ký học phần!";
                $hocPhans = $this->hocPhanModel->getAll();
                require_once 'app/views/hocphan/register.php';
            }
        } else {
            $hocPhans = $this->hocPhanModel->getAll(); // Lấy tất cả học phần để hiển thị
            require_once 'app/views/hocphan/register.php';
        }
    }
}