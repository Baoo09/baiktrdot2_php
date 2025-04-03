<?php
class Student {
    private $conn;
    private $table = "SinhVien";

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Lấy danh sách sinh viên theo trang
     * @param int $page Số trang hiện tại
     * @param int $perPage Số sinh viên mỗi trang (mặc định 4)
     * @return PDOStatement
     */
    public function getAll($page = 1, $perPage = 4) {
        $offset = ($page - 1) * $perPage; // Tính offset dựa trên trang hiện tại
        $query = "SELECT sv.*, nh.TenNganh 
                 FROM " . $this->table . " sv 
                 LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
                 LIMIT :offset, :perPage";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Lấy tổng số sinh viên
     * @return int Tổng số sinh viên
     */
    public function getTotal() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['total'];
    }

    /**
     * Lấy thông tin một sinh viên theo ID
     * @param string $id Mã sinh viên
     * @return array|null Thông tin sinh viên hoặc null nếu không tìm thấy
     */
    public function getById($id) {
        $query = "SELECT sv.*, nh.TenNganh 
                 FROM " . $this->table . " sv 
                 LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
                 WHERE sv.MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Thêm mới một sinh viên
     * @param array $data Dữ liệu sinh viên
     * @return bool True nếu thành công, False nếu thất bại
     */
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                 (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                 VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['MaSV'],
            $data['HoTen'],
            $data['GioiTinh'],
            $data['NgaySinh'],
            $data['Hinh'],
            $data['MaNganh']
        ]);
    }

    /**
     * Cập nhật thông tin sinh viên
     * @param array $data Dữ liệu sinh viên cần cập nhật
     * @return bool True nếu thành công, False nếu thất bại
     */
    public function update($data) {
        $query = "UPDATE " . $this->table . " 
                 SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? 
                 WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['HoTen'],
            $data['GioiTinh'],
            $data['NgaySinh'],
            $data['Hinh'],
            $data['MaNganh'],
            $data['MaSV']
        ]);
    }

    /**
     * Xóa một sinh viên
     * @param string $id Mã sinh viên cần xóa
     * @return bool True nếu thành công, False nếu thất bại
     */
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}