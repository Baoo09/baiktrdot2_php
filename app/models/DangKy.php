<?php
class DangKy {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($maSV, $ngayDK) {
        $query = "INSERT INTO DangKy (NgayDK, MaSV) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$ngayDK, $maSV]);
        return $this->conn->lastInsertId(); // Trả về MaDK vừa tạo
    }

    public function addChiTietDangKy($maDK, $maHP) {
        $query = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$maDK, $maHP]);
    }
}