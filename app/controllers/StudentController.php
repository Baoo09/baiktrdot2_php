<?php
require_once 'app/models/Student.php';

class StudentController {
    private $student;

    public function __construct($db) {
        $this->student = new Student($db);
    }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại
        $perPage = 4; // Số sinh viên mỗi trang
        $students = $this->student->getAll($page, $perPage); // Lấy danh sách sinh viên
        $totalStudents = $this->student->getTotal(); // Tổng số sinh viên
        $totalPages = ceil($totalStudents / $perPage); // Tổng số trang

        // Truyền các biến vào view
        require_once 'app/views/student/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [];
            $data['MaSV'] = trim($_POST['MaSV'] ?? '');
            $data['HoTen'] = trim($_POST['HoTen'] ?? '');
            $data['GioiTinh'] = $_POST['GioiTinh'] ?? '';
            $data['NgaySinh'] = $_POST['NgaySinh'] ?? '';
            $data['MaNganh'] = $_POST['MaNganh'] ?? '';
            $data['Hinh'] = null;
    
            // Kiểm tra dữ liệu đầu vào
            if (empty($data['MaSV']) || empty($data['HoTen']) || empty($data['GioiTinh']) || 
                empty($data['NgaySinh']) || empty($data['MaNganh'])) {
                $error = "Vui lòng điền đầy đủ thông tin!";
                require_once __DIR__ . '/../views/student/create.php';
                return;
            }
    
            // Xử lý upload ảnh
            if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/php_MVC/Content/images/'; // Đường dẫn tuyệt đối
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
                }
                $imageName = time() . '_' . basename($_FILES['Hinh']['name']);
                $targetFile = $uploadDir . $imageName; // Đường dẫn đầy đủ tới file đích
                $data['Hinh'] = '/php_MVC/Content/images/' . $imageName; // Đường dẫn tương đối để lưu vào DB
    
                // Di chuyển file và kiểm tra lỗi
                if (!move_uploaded_file($_FILES['Hinh']['tmp_name'], $targetFile)) {
                    $error = "Lỗi khi upload ảnh! Kiểm tra quyền thư mục hoặc đường dẫn.";
                    require_once __DIR__ . '/../views/student/create.php';
                    return;
                }
            }
    
            // Thêm sinh viên vào database
            if ($this->student->create($data)) {
                header('Location: index.php?controller=student&action=index');
                exit;
            } else {
                $error = "Lỗi khi thêm sinh viên!";
                require_once __DIR__ . '/../views/student/create.php';
            }
        } else {
            require_once __DIR__ . '/../views/student/create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;
            
            // Xử lý upload ảnh mới (nếu có)
            if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
                $targetDir = "Content/images/";
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['Hinh']['name']);
                $targetFile = $targetDir . $fileName;
                
                if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $targetFile)) {
                    $data['Hinh'] = '/' . $targetFile;
                    // Xóa ảnh cũ nếu cần (tùy yêu cầu)
                    $oldStudent = $this->student->getById($id);
                    if ($oldStudent['Hinh'] && file_exists($_SERVER['DOCUMENT_ROOT'] . $oldStudent['Hinh'])) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . $oldStudent['Hinh']);
                    }
                }
            } else {
                // Giữ ảnh cũ nếu không upload ảnh mới
                $oldStudent = $this->student->getById($id);
                $data['Hinh'] = $oldStudent['Hinh'];
            }

            $this->student->update($data);
            header('Location: index.php?controller=student&action=index');
            exit;
        }
        $student = $this->student->getById($id);
        require_once 'app/views/student/edit.php';
    }

    public function delete($id) {
        $student = $this->student->getById($id);
        if ($student['Hinh'] && file_exists($_SERVER['DOCUMENT_ROOT'] . $student['Hinh'])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $student['Hinh']); // Xóa ảnh khi xóa sinh viên
        }
        $this->student->delete($id);
        header('Location: index.php?controller=student&action=index');
        exit;
    }

    public function detail($id) {
        $student = $this->student->getById($id);
        require_once 'app/views/student/detail.php';
    }


    
}