<?php
require_once 'config/database.php';

class EmployeeModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Lấy danh sách nhân viên với phân trang
    public function getEmployees($offset, $records_per_page) {
        $query = "
            SELECT 
                NV.Ma_NV,
                NV.Ten_NV,
                NV.Phai,
                NV.Noi_Sinh,
                PB.Ten_Phong,
                NV.Luong
            FROM 
                NHANVIEN NV
            JOIN 
                PHONGBAN PB ON NV.Ma_Phong = PB.Ma_Phong
            LIMIT :offset, :records_per_page
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm tổng số nhân viên để tính số trang
    public function getTotalEmployees() {
        $query = "SELECT COUNT(*) FROM NHANVIEN";
        return $this->db->query($query)->fetchColumn();
    }

    // Lấy thông tin nhân viên theo Ma_NV
    public function getEmployeeById($ma_nv) {
        $query = "SELECT * FROM NHANVIEN WHERE Ma_NV = :ma_nv";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ma_nv', $ma_nv);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm nhân viên
    public function addEmployee($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong) {
        $query = "
            INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong)
            VALUES (:ma_nv, :ten_nv, :phai, :noi_sinh, :ma_phong, :luong)
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ma_nv', $ma_nv);
        $stmt->bindParam(':ten_nv', $ten_nv);
        $stmt->bindParam(':phai', $phai);
        $stmt->bindParam(':noi_sinh', $noi_sinh);
        $stmt->bindParam(':ma_phong', $ma_phong);
        $stmt->bindParam(':luong', $luong);
        return $stmt->execute();
    }

    // Sửa nhân viên
    public function updateEmployee($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong) {
        $query = "
            UPDATE NHANVIEN 
            SET Ten_NV = :ten_nv, Phai = :phai, Noi_Sinh = :noi_sinh, Ma_Phong = :ma_phong, Luong = :luong
            WHERE Ma_NV = :ma_nv
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ma_nv', $ma_nv);
        $stmt->bindParam(':ten_nv', $ten_nv);
        $stmt->bindParam(':phai', $phai);
        $stmt->bindParam(':noi_sinh', $noi_sinh);
        $stmt->bindParam(':ma_phong', $ma_phong);
        $stmt->bindParam(':luong', $luong);
        return $stmt->execute();
    }

    // Xóa nhân viên
    public function deleteEmployee($ma_nv) {
        $query = "DELETE FROM NHANVIEN WHERE Ma_NV = :ma_nv";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ma_nv', $ma_nv);
        return $stmt->execute();
    }

    // Lấy danh sách phòng ban (dùng cho form thêm/sửa)
    public function getDepartments() {
        $query = "SELECT * FROM PHONGBAN";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>