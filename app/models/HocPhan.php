<?php
class HocPhan {
    private $conn;
    private $table = "HocPhan";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll($page = 1, $perPage = 4) {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM " . $this->table . " LIMIT :offset, :perPage";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function getTotal() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['total'];
    }
}